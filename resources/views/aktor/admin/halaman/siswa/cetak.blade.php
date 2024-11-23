@extends('aktor.admin.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="page-title-box">
                        <div class="page-title-left">
                            <a href="javascript:window.print()" class="btn btn-primary ms-2 flex-shrink-0">
                                <i class="ri-printer-line"></i> Cetak Kartu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="col-md-8 mt-3">
                        <div class="card">
                            <div class="card-header bg-primary rounded-top-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="" height="80">
                                    </div>
                                    <div class="col-md-8 text-center ms-3">
                                        <span class="h4 text-white">Kartu Anggota Perpustakaan</span> <br>
                                        <span class="h4 text-white">SMPN 11 Kota Jambi</span> <br>
                                        <span class="h5 text-white">
                                            Jl. Hos Cokroaminoto, Kel. Selamat,
                                            <br> Kec. Danau Sipin, Jambi, Kota Jambi
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bg-white rounded-3">
                                <div class="row mt-2 ms-2">
                                    <div class="col-4">
                                        <img src="{{ asset('storage/profil/'. $siswa->foto) }}" alt="avatar" height="100" width="100">
                                    </div>
                                    <div class="col-8">
                                        <table border="0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-dark" style="padding: 3px">Nama</td>
                                                    <td class="text-dark">&nbsp;:</td>
                                                    <td class="text-dark">&nbsp;{{ Str::upper($siswa->nama) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-dark" style="padding: 3px">NISN</td>
                                                    <td class="text-dark">&nbsp;:</td>
                                                    <td class="text-dark">&nbsp;{{ Str::upper($siswa->nisn) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-dark" style="padding: 3px">Kelas</td>
                                                    <td class="text-dark">&nbsp;:</td>
                                                    <td class="text-dark">&nbsp;{{ Str::upper($siswa->kelas->nama_kelas) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-dark" style="padding: 3px">Jenis Kelamin</td>
                                                    <td class="text-dark">&nbsp;:</td>
                                                    <td class="text-dark">&nbsp;{{ Str::upper($siswa->jenis_kelamin) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3 ms-2">
                                    <div class="col-6">
                                        <span>
                                            {!! DNS1D::getBarcodeHTML($siswa->barcode, 'C39') !!} <br>
                                            <p class="card-title text-dark">{{ $siswa->barcode }}</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
