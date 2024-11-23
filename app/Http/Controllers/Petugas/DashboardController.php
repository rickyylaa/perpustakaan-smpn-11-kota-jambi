<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Buku;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\RiwayatPinjam;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $buku = Buku::where('status', 'aktif')->get();

        $siswa = Siswa::where('status', 'aktif')->get();

        $pinjam = RiwayatPinjam::where('status', 'pinjam')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        $kembali = RiwayatPinjam::where('status', 'selesai')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        $aktivity = RiwayatPinjam::with('siswa', 'buku')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        return view('aktor.petugas.halaman.dashboard.index', compact('buku', 'siswa', 'pinjam', 'kembali', 'aktivity'));
    }
}
