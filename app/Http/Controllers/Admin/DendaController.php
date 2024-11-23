<?php

namespace App\Http\Controllers\Admin;

use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $denda = Denda::orderBy('id', 'ASC')->get();
        return view('aktor.admin.halaman.denda.index', compact('denda'));
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
    public function store(Request $request, denda $denda)
    {
        $request->validate([
            'denda_pinjam' => 'required|numeric',
            'denda_hilang' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $denda->create([
                'denda_pinjam' => $request->denda_pinjam,
                'denda_hilang' => $request->denda_hilang
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Denda berhasil dibuat</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat membuat denda: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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
            'denda_pinjam' => 'required|numeric',
            'denda_hilang' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $denda = Denda::where('id', $id)->firstOrFail();

            $denda->update([
                'denda_pinjam' => $request->denda_pinjam,
                'denda_hilang' => $request->denda_hilang
            ]);

            DB::commit();

            Alert::toast('<span class="toast-information">Denda berhasil diperbarui</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat memperbarui denda: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
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

            $denda = Denda::where('id', $id)->firstOrFail();
            $denda->delete();

            DB::commit();

            Alert::toast('<span class="toast-information">Denda berhasil dihapus</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat menghapus denda: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }
    }
}
