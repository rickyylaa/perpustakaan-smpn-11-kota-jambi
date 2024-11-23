<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::orderBy('id', 'ASC')->get();
        return view('aktor.petugas.halaman.kelas.index', compact('kelas'));
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
    public function store(Request $request, Kelas $kelas)
    {
        $request->validate([
            'kelas' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $kelas->create([
                'kelas' => $request->kelas
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Kelas berhasil dibuat</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat membuat kelas: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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
        $kelas = Kelas::findOrFail($id);
        return view('aktor.petugas.halaman.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kelas' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $kelas = Kelas::where('id', $id)->firstOrFail();

            $kelas->update([
                'kelas' => $request->kelas
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Kelas berhasil diperbarui</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat memperbarui kelas: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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

            $kelas = Kelas::where('id', $id)->firstOrFail();
            if ($kelas->siswa()->exists()) {
                Alert::toast('<span class="toast-information">Tidak dapat menghapus kelas karena terdapat siswa yang terdaftar di kelas ini.</span>')->hideCloseButton()->padding('25px')->toHtml();
                return redirect()->back();
            }

            $kelas->delete();

            DB::commit();

            Alert::toast('<span class="toast-information">Kelas berhasil dihapus</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat menghapus kelas: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }
}
