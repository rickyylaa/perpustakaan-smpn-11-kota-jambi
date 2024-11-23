<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Models\KategoriDanRak;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriDanRakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriDanRak::orderBy('id', 'ASC')->get();
        return view('aktor.petugas.halaman.kategori.index', compact('kategori'));
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
    public function store(Request $request, KategoriDanRak $kategori)
    {
        $request->validate([
            'nama' => 'required|string',
            'rak' => 'required|numeric',
            'baris' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $kategori->create([
                'nama' => $request->nama,
                'rak' => $request->rak,
                'baris' => $request->baris
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Kategori dan Rak berhasil dibuat</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat membuat kategori dan rak: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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
        $kategori = KategoriDanRak::findOrFail($id);
        return view('aktor.petugas.halaman.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'rak' => 'required|numeric',
            'baris' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $kategori = KategoriDanRak::where('id', $id)->firstOrFail();

            $kategori->update([
                'nama' => $request->nama,
                'rak' => $request->rak,
                'baris' => $request->baris
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Kategori dan Rak berhasil diperbarui</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat memperbarui kategori dan rak: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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

            $kategori = KategoriDanRak::where('id', $id)->firstOrFail();
            if ($kategori->buku()->exists()) {
                Alert::toast('<span class="toast-information">Tidak dapat menghapus kategori dan rak karena terdapat buku yang terdaftar di kategori dan rak ini.</span>')->hideCloseButton()->padding('25px')->toHtml();
                return redirect()->back();
            }

            $kategori->delete();

            DB::commit();

            Alert::toast('<span class="toast-information">Kategori dan Rak berhasil dihapus</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat menghapus kategori dan rak: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }
}
