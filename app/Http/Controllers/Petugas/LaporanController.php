<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\RiwayatPinjam;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\PDF as PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $riwayat = RiwayatPinjam::join('siswas', 'siswas.id', '=', 'riwayat_pinjams.siswa_id')
            ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->join('bukus', 'bukus.id', '=', 'riwayat_pinjams.buku_id')
            ->select('riwayat_pinjams.*', 'bukus.judul', 'bukus.isbn', 'bukus.sampul', 'siswas.nis', 'siswas.nama', 'kelas.kelas')
            ->latest()
            ->get();
        return view('aktor.petugas.halaman.laporan.index', compact('riwayat'));
    }

    public function cetak_pdf()
    {
        $riwayat = RiwayatPinjam::join('siswas', 'siswas.id', '=', 'riwayat_pinjams.siswa_id')
            ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->join('bukus', 'bukus.id', '=', 'riwayat_pinjams.buku_id')
            ->select('riwayat_pinjams.*', 'bukus.judul', 'bukus.isbn', 'bukus.sampul', 'siswas.nis', 'siswas.nama', 'kelas.kelas')
            ->latest()
            ->get();

        $pdf = PDF::loadview('aktor.petugas.halaman.laporan.pdf', ['riwayat' => $riwayat]);

        return $pdf->stream();
    }

    public function cari_laporan(Request $request)
    {
        $data = explode(' - ', $request->daterange);

        $startDate = date('d F Y', strtotime($data[0]));
        $endDate = date('d F Y', strtotime($data[1]));

        $riwayat = RiwayatPinjam::join('siswas', 'siswas.id', '=', 'riwayat_pinjams.siswa_id')
            ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->join('bukus', 'bukus.id', '=', 'riwayat_pinjams.buku_id')
            ->select('riwayat_pinjams.*', 'bukus.judul', 'bukus.isbn', 'bukus.sampul', 'siswas.nis', 'siswas.nama', 'kelas.kelas')
            ->whereBetween('riwayat_pinjams.tanggal_kembali', [$startDate, $endDate])
            ->get();

        $pdf = PDF::loadview('aktor.petugas.halaman.laporan.pdf', ['riwayat' => $riwayat]);
        return $pdf->stream();
    }
}
