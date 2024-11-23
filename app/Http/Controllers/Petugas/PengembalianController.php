<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Siswa;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use App\Models\RiwayatPinjam;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatPinjam::with(['siswa', 'buku'])->get();
        return view('aktor.petugas.halaman.pengembalian.index', compact('riwayat'));
    }

    public function cek(Request $request)
    {
        $request->validate([
            'barcode' => 'required|numeric'
        ]);

        $denda = Denda::get();
        $siswa = Siswa::where('barcode', $request->barcode)->first();
        $buku = Buku::where('stok_buku','>',0)->orderBy('judul', 'ASC')->get();
        $pinjam = Pinjam::where('siswa_id', $siswa->id)->get();

        if (!$siswa) {
            Alert::toast('<span class="toast-information">Siswa tidak ditemukan</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }

        return view('aktor.petugas.halaman.pengembalian.cek', compact('denda', 'siswa', 'buku', 'pinjam'));
    }

    public function proses(Request $request)
    {
        $nominal = $request->nominal;
        $id = $request->id;
        $denda = $request->denda * $nominal;

        $riwayat = RiwayatPinjam::find($id);
        $buku_id = $riwayat->buku_id;

        Buku::find($buku_id)->increment('stok_buku');
        RiwayatPinjam::find($id)->update([
            'denda' => $denda,
            'status' => 'selesai',
        ]);

        Pinjam::find($id)->delete();

        Alert::toast('<span class="toast-information">Berhasil Melakukan Proses Pengembalian Buku</span>')->hideCloseButton()->padding('25px')->toHtml();
        return redirect()->back();
    }
}
