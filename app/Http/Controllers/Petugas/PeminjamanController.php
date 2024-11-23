<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Siswa;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RiwayatPinjam;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('aktor.petugas.halaman.peminjaman.index');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'barcode' => 'required|numeric'
        ]);

        $denda = Denda::get();
        $siswa = Siswa::where('barcode', $request->barcode)->first();
        $buku = Buku::where('stok_buku','>',0)->orderBy('judul', 'ASC')->get();

        if (!$siswa) {
            Alert::toast('<span class="toast-information">Siswa tidak ditemukan</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect()->back();
        }

        return view('aktor.petugas.halaman.peminjaman.cek', compact('denda', 'siswa', 'buku'));
    }

    public function pinjam(Request $request)
    {
        $request->validate([
            'buku1' => 'nullable',
            'buku2' => 'nullable',
            'buku3' => 'nullable'
        ]);

        try {
            DB::beginTransaction();

            $siswaPinjaman = Pinjam::where('siswa_id', $request->siswa)->count();

            if ($siswaPinjaman >= 3) {
                Alert::toast('<span class="toast-information">Maaf, Siswa sudah meminjam 3 buku, tidak dapat meminjam lebih dari itu.</span>')->hideCloseButton()->padding('25px')->toHtml();
                return redirect()->back();
            }

            $tanggal = date('d F Y', strtotime("+7 day", strtotime(date("d F Y"))));

            if ($request->buku1 != null) {
                if ($siswaPinjaman >= 3) {
                    Alert::toast('<span class="toast-information">Maaf, sudah tidak dapat meminjam lebih dari 3 buku.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
                $pinjam1 = Pinjam::create([
                    'siswa_id' => $request->siswa,
                    'buku_id' => $request->buku1,
                    'tanggal_kembali' => $tanggal
                ]);

                RiwayatPinjam::create([
                    'siswa_id' => $request->siswa,
                    'buku_id' => $request->buku1,
                    'tanggal_kembali' => $tanggal,
                    'status' => 'pinjam'
                ]);

                Buku::find($request->buku1)->decrement('stok_buku');
                $siswaPinjaman++;
            }

            if ($request->buku2 != null) {
                if ($siswaPinjaman >= 3) {
                    Alert::toast('<span class="toast-information">Maaf, sudah tidak dapat meminjam lebih dari 3 buku.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
                $pinjam2 = Pinjam::create([
                    'siswa_id' => $request->siswa,
                    'buku_id' => $request->buku2,
                    'tanggal_kembali' => $tanggal
                ]);

                RiwayatPinjam::create([
                    'siswa_id' => $request->siswa,
                    'buku_id' => $request->buku2,
                    'tanggal_kembali' => $tanggal,
                    'status' => 'pinjam'
                ]);

                Buku::find($request->buku2)->decrement('stok_buku');
                $siswaPinjaman++;
            }

            if ($request->buku3 != null) {
                if ($siswaPinjaman >= 3) {
                    Alert::toast('<span class="toast-information">Maaf, sudah tidak dapat meminjam lebih dari 3 buku.</span>')->hideCloseButton()->padding('25px')->toHtml();
                    return redirect()->back();
                }
                $pinjam3 = Pinjam::create([
                    'siswa_id' => $request->siswa,
                    'buku_id' => $request->buku3,
                    'tanggal_kembali' => $tanggal
                ]);

                RiwayatPinjam::create([
                    'siswa_id' => $request->siswa,
                    'buku_id' => $request->buku3,
                    'tanggal_kembali' => $tanggal,
                    'status' => 'pinjam'
                ]);

                Buku::find($request->buku3)->decrement('stok_buku');
            }

            DB::commit();

            Alert::toast('<span class="toast-information">Buku berhasil dipinjam</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect(route('petugas.peminjaman'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('<span class="toast-information">Terjadi kesalahan saat meminjam buku: ' . $e->getMessage() . '</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect(route('petugas.peminjaman'));
        }
    }
}
