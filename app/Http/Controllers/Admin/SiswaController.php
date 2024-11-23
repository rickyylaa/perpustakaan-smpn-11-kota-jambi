<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::orderBy('id', 'ASC')->get();
        $siswa = Siswa::orderBy('id', 'ASC')->get();
        return view('aktor.admin.halaman.siswa.index', compact('kelas', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => 'required|string|max:10',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        try {
            DB::beginTransaction();

            $barcode = rand(1,999999999);

            if ($request->nisn !== $siswa->nisn) {
                $nisnExists = Siswa::where('nisn', $request->nisn)->exists();
                if ($nisnExists) {
                    Alert::toast('<span class="toast-information">NISN sudah diambil.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
            }

            $filename = 'avatar.png';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profil', $filename);
            }

            $siswa->create([
                'barcode' => $barcode,
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'foto' => $filename,
                'kelas_id' => $request->kelas_id
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Siswa berhasil dibuat</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat membuat siswa: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('aktor.admin.halaman.siswa.cetak', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nisn)
    {
        $request->validate([
            'nisn' => 'required|string|max:10',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        try {
            DB::beginTransaction();

            $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
            $barcode = rand(1,999999999);

            if ($request->nisn != $siswa->nisn) {
                $nisnExists = Siswa::where('nisn', $request->nisn)->exists();
                if ($nisnExists) {
                    Alert::toast('<span class="toast-information">NISN sudah diambil.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
            }

            $filename = $siswa->foto;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profil', $filename);

                if ($siswa->foto !== 'avatar.png') {
                    File::delete(storage_path('app/public/profil/' . $siswa->foto));
                }
            }

            $siswa->update([
                'barcode' => $barcode,
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'foto' => $filename,
                'kelas_id' => $request->kelas_id
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Siswa berhasil diperbarui</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat memperbarui siswa: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nisn)
    {
        try {
            DB::beginTransaction();

            $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
            $fotoPath = storage_path('app/public/profil/' . $siswa->foto);
            if ($siswa->foto !== 'avatar.png' && File::exists($fotoPath)) {
                File::delete($fotoPath);
            }
            $siswa->delete();

            DB::commit();

            Alert::toast('<span class="toast-information">Siswa berhasil dihapus</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat menghapus siswa: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }
}
