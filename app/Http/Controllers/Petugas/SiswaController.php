<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        return view('aktor.petugas.halaman.siswa.index', compact('kelas', 'siswa'));
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
            'nis' => 'required|numeric',
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000'
        ]);

        try {
            DB::beginTransaction();

            $barcode = rand(1,999999999);

            if ($request->nis !== $siswa->nis) {
                $nisExists = Siswa::where('nis', $request->nis)->exists();
                if ($nisExists) {
                    Alert::toast('<span class="toast-information">NIS sudah diambil.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
            }

            $filename = 'avatar.png';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profiles', $filename);
            }

            $siswa->create([
                'barcode' => $barcode,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'foto' => $filename,
                'status' => 'aktif'
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
        return view('aktor.petugas.halaman.siswa.cetak', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('aktor.petugas.halaman.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nis)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000'
        ]);

        try {
            DB::beginTransaction();

            $siswa = Siswa::where('nis', $nis)->firstOrFail();

            if ($request->nis != $siswa->nis) {
                $nisExists = Siswa::where('nis', $request->nis)->exists();
                if ($nisExists) {
                    Alert::toast('<span class="toast-information">NIS sudah diambil.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
            }

            $filename = $siswa->foto;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profiles', $filename);

                if ($siswa->foto !== 'avatar.png') {
                    File::delete(storage_path('app/public/profiles/' . $siswa->foto));
                }
            }

            $siswa->update([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'foto' => $filename,
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
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $siswa = Siswa::where('id', $id)->firstOrFail();
            $photoPath = storage_path('app/public/profiles/' . $siswa->foto);
            if ($siswa->foto !== 'avatar.png' && File::exists($photoPath)) {
                File::delete($photoPath);
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
