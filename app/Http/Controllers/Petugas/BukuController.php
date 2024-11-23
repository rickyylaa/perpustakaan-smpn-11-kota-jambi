<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriDanRak;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriDanRak::orderBy('id', 'ASC')->get();
        $buku = Buku::orderBy('id', 'ASC')->get();
        return view('aktor.petugas.halaman.buku.index', compact('kategori', 'buku'));
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
    public function store(Request $request, Buku $buku)
    {
        $request->validate([
            'isbn' => 'required|numeric',
            'judul' => 'required|string',
            'kategori_id' => 'required|exists:kategori_dan_raks,id',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'nullable|numeric',
            'stok_buku' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000'
        ]);

        try {
            DB::beginTransaction();

            $filename = 'sampul.png';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->judul) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/sampul', $filename);
            }

            $buku->create([
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'kategori_id' => $request->kategori_id,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok_buku' => $request->stok_buku,
                'deskripsi' => $request->deskripsi,
                'foto' => $filename,
                'status' => 'aktif'
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Buku berhasil dibuat</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat membuat buku: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'isbn' => 'required|numeric',
            'judul' => 'required|string',
            'kategori_id' => 'required|exists:kategori_dan_raks,id',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'nullable|numeric',
            'stok_buku' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp|max:5000'
        ]);

        try {
            DB::beginTransaction();

            $buku = Buku::where('id', $id)->firstOrFail();

            $filename = $buku->foto;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::slug($request->nama) . '-' . rand(0, 99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profil', $filename);

                if ($buku->foto !== 'avatar.png') {
                    File::delete(storage_path('app/public/profil/' . $buku->foto));
                }
            }

            $buku->update([
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'kategori_id' => $request->kategori_id,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok_buku' => $request->stok_buku,
                'deskripsi' => $request->deskripsi,
                'foto' => $filename
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Buku berhasil diperbarui</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat memperbarui buku: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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

            $buku = Buku::where('id', $id)->firstOrFail();
            $fotoPath = storage_path('app/public/sampul/' . $buku->foto);
            if ($buku->foto !== 'sampul.png' && File::exists($fotoPath)) {
                File::delete($fotoPath);
            }
            $buku->delete();

            DB::commit();

            Alert::toast('<span class="toast-information">Buku berhasil dihapus</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat menghapus buku: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }
}
