<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\Auth\RoleController;

use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\DendaController as AdminDendaController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;
use App\Http\Controllers\Admin\KategoriDanRakController as AdminKategoriDanRakController;

use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use App\Http\Controllers\Petugas\SiswaController as PetugasSiswaController;
use App\Http\Controllers\Petugas\ProfilController as PetugasProfilController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\KategoriDanRakController as PetugasKategoriDanRakController;

/* ROUTE */

Auth::routes();
Route::get('/', [UtamaController::class, 'index'])->name('home.utama');
Route::get('/buku', [UtamaController::class, 'buku'])->name('home.buku');
Route::get('/buku/cari', [UtamaController::class, 'cari'])->name('home.cariBuku');
Route::get('/buku/{slug}', [UtamaController::class, 'detail'])->name('home.detailBuku');
Route::get('/tata-tertib', [UtamaController::class, 'tataTertib'])->name('home.tataTertib');
Route::get('/visi-misi', [UtamaController::class, 'visiMisi'])->name('home.visiMisi');

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', RoleController::class);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/petugas', [AdminPetugasController::class, 'index'])->name('admin.petugas');
        Route::post('/admin/petugas', [AdminPetugasController::class, 'store'])->name('admin.petugasStore');
        Route::get('/admin/petugas/edit/{nip}', [AdminPetugasController::class, 'edit'])->name('admin.petugasEdit');
        Route::put('/admin/petugas/{nip}', [AdminPetugasController::class, 'update'])->name('admin.petugasUpdate');
        Route::delete('/admin/petugas/{nip}', [AdminPetugasController::class, 'destroy'])->name('admin.petugasDestroy');

        Route::get('/admin/kelas', [AdminKelasController::class, 'index'])->name('admin.kelas');
        Route::post('/admin/kelas', [AdminKelasController::class, 'store'])->name('admin.kelasStore');
        Route::get('/admin/kelas/cetak/{id}', [AdminKelasController::class, 'show'])->name('admin.kelasShow');
        Route::get('/admin/kelas/edit/{id}', [AdminKelasController::class, 'edit'])->name('admin.kelasEdit');
        Route::put('/admin/kelas/{id}', [AdminKelasController::class, 'update'])->name('admin.kelasUpdate');
        Route::delete('/admin/kelas/{id}', [AdminKelasController::class, 'destroy'])->name('admin.kelasDestroy');

        Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa');
        Route::post('/admin/siswa', [AdminSiswaController::class, 'store'])->name('admin.siswaStore');
        Route::get('/admin/siswa/cetak/{nisn}', [AdminSiswaController::class, 'show'])->name('admin.siswaShow');
        Route::get('/admin/siswa/edit/{nisn}', [AdminSiswaController::class, 'edit'])->name('admin.siswaEdit');
        Route::put('/admin/siswa/{nisn}', [AdminSiswaController::class, 'update'])->name('admin.siswaUpdate');
        Route::delete('/admin/siswa/{nisn}', [AdminSiswaController::class, 'destroy'])->name('admin.siswaDestroy');

        Route::get('/admin/kategori', [AdminKategoriDanRakController::class, 'index'])->name('admin.kategori');
        Route::post('/admin/kategori', [AdminKategoriDanRakController::class, 'store'])->name('admin.kategoriStore');
        Route::get('/admin/kategori/cetak/{id}', [AdminKategoriDanRakController::class, 'show'])->name('admin.kategoriShow');
        Route::get('/admin/kategori/edit/{id}', [AdminKategoriDanRakController::class, 'edit'])->name('admin.kategoriEdit');
        Route::put('/admin/kategori/{id}', [AdminKategoriDanRakController::class, 'update'])->name('admin.kategoriUpdate');
        Route::delete('/admin/kategori/{id}', [AdminKategoriDanRakController::class, 'destroy'])->name('admin.kategoriDestroy');

        Route::get('/admin/buku', [AdminBukuController::class, 'index'])->name('admin.buku');
        Route::post('/admin/buku', [AdminBukuController::class, 'store'])->name('admin.bukuStore');
        Route::get('/admin/buku/cetak/{id}', [AdminBukuController::class, 'show'])->name('admin.bukuShow');
        Route::get('/admin/buku/edit/{id}', [AdminBukuController::class, 'edit'])->name('admin.bukuEdit');
        Route::put('/admin/buku/{id}', [AdminBukuController::class, 'update'])->name('admin.bukuUpdate');
        Route::delete('/admin/buku/{id}', [AdminBukuController::class, 'destroy'])->name('admin.bukuDestroy');

        Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan');
        Route::get('/admin/laporan/pdf/{dateRange}', [AdminLaporanController::class, 'pdf'])->name('admin.laporanPDF');

        Route::get('/admin/denda', [AdminDendaController::class, 'index'])->name('admin.denda');
        Route::post('/admin/denda', [AdminDendaController::class, 'store'])->name('admin.dendaStore');
        Route::get('/admin/denda/cetak/{id}', [AdminDendaController::class, 'show'])->name('admin.dendaShow');
        Route::get('/admin/denda/edit/{id}', [AdminDendaController::class, 'edit'])->name('admin.dendaEdit');
        Route::put('/admin/denda/{id}', [AdminDendaController::class, 'update'])->name('admin.dendaUpdate');
        Route::delete('/admin/denda/{id}', [AdminDendaController::class, 'destroy'])->name('admin.dendaDestroy');
    });

    Route::middleware(['role:petugas'])->group(function () {
        Route::get('/petugas/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        Route::get('/petugas/siswa', [PetugasSiswaController::class, 'index'])->name('petugas.siswa');
        Route::get('/petugas/siswa/cetak/{nisn}', [PetugasSiswaController::class, 'show'])->name('petugas.siswaShow');
        Route::delete('/petugas/siswa/{nisn}', [PetugasSiswaController::class, 'destroy'])->name('petugas.siswaDestroy');

        Route::get('/petugas/kategori', [PetugasKategoriDanRakController::class, 'index'])->name('petugas.kategori');
        Route::post('/petugas/kategori', [PetugasKategoriDanRakController::class, 'store'])->name('petugas.kategoriStore');
        Route::get('/petugas/kategori/cetak/{id}', [PetugasKategoriDanRakController::class, 'show'])->name('petugas.kategoriShow');
        Route::get('/petugas/kategori/edit/{id}', [PetugasKategoriDanRakController::class, 'edit'])->name('petugas.kategoriEdit');
        Route::put('/petugas/kategori/{id}', [PetugasKategoriDanRakController::class, 'update'])->name('petugas.kategoriUpdate');
        Route::delete('/petugas/kategori/{id}', [PetugasKategoriDanRakController::class, 'destroy'])->name('petugas.kategoriDestroy');

        Route::get('/petugas/buku', [PetugasBukuController::class, 'index'])->name('petugas.buku');
        Route::post('/petugas/buku', [PetugasBukuController::class, 'store'])->name('petugas.bukuStore');
        Route::get('/petugas/buku/cetak/{id}', [PetugasBukuController::class, 'show'])->name('petugas.bukuShow');
        Route::get('/petugas/buku/edit/{id}', [PetugasBukuController::class, 'edit'])->name('petugas.bukuEdit');
        Route::put('/petugas/buku/{id}', [PetugasBukuController::class, 'update'])->name('petugas.bukuUpdate');
        Route::delete('/petugas/buku/{id}', [PetugasBukuController::class, 'destroy'])->name('petugas.bukuDestroy');

        Route::get('/petugas/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('petugas.peminjaman');
        Route::get('/petugas/peminjaman/scan', [PetugasPeminjamanController::class, 'cek'])->name('petugas.peminjamanScan');
        Route::post('/petugas/peminjaman/pinjam', [PetugasPeminjamanController::class, 'pinjam'])->name('petugas.peminjamanStore');

        Route::get('/petugas/pengembalian', [PetugasPengembalianController::class, 'index'])->name('petugas.pengembalian');
        Route::get('/petugas/pengembalian/scan', [PetugasPengembalianController::class, 'cek'])->name('petugas.pengembalianScan');
        Route::post('/petugas/pengembalian/proses', [PetugasPengembalianController::class, 'proses'])->name('petugas.pengembalianProses');
    });
});

/* ROUTE */
