@extends('utama.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(/dist/images/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Tata Tertib</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Home</a></li>
                        <li class="active">Tata Tertib</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="event" class="event-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 faq-content">
                    <div class="acd-items acd-arrow">
                        <div class="panel-group symb" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ac1">
                                            Tata Tertib Peminjaman Buku
                                        </a>
                                    </h4>
                                </div>
                                <div id="ac1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>
                                            Tata Terbit Dalam Melakukan Transaksi Peminjaman Buku di SMPN 11 Kota Jambi
                                            yang harus Di Patuhi Oleh Seluruh Siswa SMPN 11 Kota Jambi
                                        </p>
                                        <ul>
                                            <li>Siswa Di Wajibkan Mendaftarkan Diri Sebagai Anggota Perpustakaan</li>
                                            <li>Telah Mengembalikan Semua Buku Yang Di Pinjam Sebelumnya</li>
                                            <li>Memberikan Buku dan Kartu Anggota Kepada Petugas Perpustakaan Untuk Proses Peminjaman</li>
                                            <li>Siswa Hanya Dapat Meminjam Maksimal 3 Buku </li>
                                            <li>Dilarang Bagi Siswa Yang Meminjam Buku untuk Mencoret, Menyobek, atau Menghilangkan Buku Yang Di Pinjam</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ac2">
                                            Tata Tertib Pengembalian / Mengembalikan Buku
                                        </a>
                                    </h4>
                                </div>
                                <div id="ac2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            Tata Tertib bagi Siswa SMPN 11 Kota Jambi dalam proses Pengembalian Buku di Perpustakaan
                                            yang wajib di patuhi oleh seluruh siswa / anggota Perpustakaan SMPN 11 Kota Jambi
                                        </p>
                                        <ul>
                                            <li>Membawa Kartu Anggota Perpustakaan dan Membawa Buku yang akan di Kembalikan</li>
                                            <li>Buku Dalam Keadaan Baik dan Tidak di Coret - Coret</li>
                                            <li>Keterlambatan Pengembalian Akan Di Kenakan Denda Rp.{{ number_format($denda->denda_pinjam) }},-  Perhari</li>
                                            <li>Menghilangkan Buku Akan Di Denda Rp.{{ number_format($denda->denda_hilang) }},- PerBuku yang hilang</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
