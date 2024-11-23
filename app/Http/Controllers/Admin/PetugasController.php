<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $petugas = User::whereHas('roles', function ($query) {
            $query->where('name', 'petugas');
        })->orderBy('id', 'ASC')->get();
        return view('aktor.admin.halaman.petugas.index', compact('petugas'));
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
    public function store(Request $request, User $petugas)
    {
        $request->validate([
            'nip' => 'required|string|max:18',
            'nama' => 'required|string',
            'password' => 'required|string|min:8',
            'telepon' => 'required|numeric',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000'
        ]);

        try {
            DB::beginTransaction();

            if ($request->nip !== $petugas->nip) {
                $nipExists = User::where('nip', $request->nip)->exists();
                if ($nipExists) {
                    Alert::toast('<span class="toast-information">NIP sudah diambil.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
            }

            $filename = 'avatar.png';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profil', $filename);
            }

            $telepon = $request->telepon;
            if (substr($telepon, 0, 1) !== '0') {
                $telepon = '0' . $telepon;
            }

            $petugas->create([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'telepon' => $telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'foto' => $filename
            ])->assignRole('petugas');

            DB::commit();

            Alert::toast('<span class="toast-information">Petugas berhasil dibuat</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat membuat petugas: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $nip)
    {
        $request->validate([
            'nip' => 'required|string|max:18',
            'nama' => 'required|string',
            'password' => 'nullable|string|min:8',
            'telepon' => 'required|numeric',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000'
        ]);

        try {
            DB::beginTransaction();

            $petugas = User::where('nip', $nip)->firstOrFail();

            if ($request->nip != $petugas->nip) {
                $nipExists = User::where('nip', $request->nip)->exists();
                if ($nipExists) {
                    Alert::toast('<span class="toast-information">NIP sudah diambil.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
            }

            $filename = $petugas->foto;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profil', $filename);

                if ($petugas->foto !== 'avatar.png') {
                    File::delete(storage_path('app/public/profil/' . $petugas->foto));
                }
            }

            $telepon = $request->telepon;
            if (substr($telepon, 0, 1) !== '0') {
                $telepon = '0' . $telepon;
            }

            $petugas->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'telepon' => $telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'foto' => $filename
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Petugas berhasil diperbarui</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat memperbarui petugas: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        try {
            DB::beginTransaction();

            $petugas = User::where('nip', $nip)->firstOrFail();
            $fotoPath = storage_path('app/public/profil/' . $petugas->foto);
            if ($petugas->foto !== 'avatar.png' && File::exists($fotoPath)) {
                File::delete($fotoPath);
            }
            $petugas->delete();

            DB::commit();

            Alert::toast('<span class="toast-information">Petugas berhasil dihapus</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat menghapus petugas: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }
}
