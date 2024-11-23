@extends('aktor.petugas.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-info mb-0" role="alert">
                    <h3 class="alert-heading">Catatan Perihal Peminjaman Buku</h3>
                    <p class="fs-15">Beberapa hal yang dapat di sampaikan kepada siswa mengenai peraturan
                        dalam peminjaman buku di perpustakaan SMPN 11 Kota Jambi</p>
                    <hr class="border-info border-opacity-25">
                    <ul class="px-3">
                        <li class="fs-16 mb-1">
                            <span class="fs-15">
                                Siswa Di Wajibkan Mendaftarkan diri sebagai Anggota
                                Perpustakaan Untuk Bisa Melaukan Peminjaman Buku
                            </span>
                        </li>
                        <li class="fs-16 mb-1">
                            <span class="fs-15">
                                Waktu Peminjaman Buku Hanya 7 Hari. Apabila Melewati
                                Waktu Pengembalian Akan Di Kena Kan Denda
                            </span>
                        </li>
                        @foreach ($denda as $data)
                            <li class="fs-16 mb-1">
                                <span class="fs-15">
                                    Tarif Denda Yaitu Rp.{{ number_format($data->denda_pinjam) }} / Hari
                                </span>
                            </li>
                            <li class="fs-16 mb-1">
                                <span class="fs-15">
                                    Apabila Buku Hilang Maka Siswa Diberlakukan denda Rp.{{ number_format($data->denda_hilang) }} / Buku
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-body">
                        <span class="float-start m-2 me-5">
                            <img src="{{ asset('storage/profil/'. $siswa->foto) }}" alt="avatar" class="img-thumbnail" style="height: 100px;">
                        </span>
                        <div class="mt-2">
                            <ul class="mb-0 list-inline">
                                <li class="list-inline-item me-3">
                                    <p class="mb-0 fs-15 text-dark">NISN :</p>
                                    <p class="mb-0 fs-15 text-dark">Nama :</p>
                                    <p class="mb-0 fs-15 text-dark">Kelas :</p>
                                    <p class="mb-0 fs-15 text-dark">Jenis Kelamin :</p>
                                    <p class="mb-0 fs-15 text-dark">Tanggal Lahir :</p>
                                </li>
                                <li class="list-inline-item">
                                    <p class="mb-0 fs-15 text-dark">{{ $siswa->nisn }}</p>
                                    <p class="mb-0 fs-15 text-dark">{{ ucwords($siswa->nama) }}</p>
                                    <p class="mb-0 fs-15 text-dark">{{ ucwords( $siswa->kelas->nama_kelas) }}</p>
                                    <p class="mb-0 fs-15 text-dark">{{ ucwords($siswa->jenis_kelamin) }}</p>
                                    <p class="mb-0 fs-15 text-dark">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-3 px-2 mb-2">
                            <span class="">{!! DNS1D::getBarcodeHTML($siswa->barcode, 'C39') !!}</span>
                        </div>
                        <span class="fs-16 text-dark px-2">{{ $siswa->barcode }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Pemilihan Buku Untuk Di Pinjam <span class="text-danger">*Maksimal 3 Buku</span></h4>
                        <p class="text-muted fs-14">
                            Scan Kode Buku Agar Lebih Cepat Dalam Proses Pemesanan
                        </p>
                        <form method="POST" action="{{ route('petugas.peminjamanStore') }}" enctype="multipart/form-data">
                            @csrf <input type="hidden" name="siswa" class="form-controler" value="{{ $siswa->id }}">
                            <div class="row">
                                <div class="col-12 mb-0">
                                    <label for="buku1" class="col-form-label">Buku 1:</label>
                                    <select name="buku1" id="buku1" class="form-control select2">
                                        <option value="">Daftar Buku</option>
                                        @foreach ($buku as $data)
                                            <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger small">{{ $errors->first('buku1') }}</p>
                                </div>
                                <div class="col-12 mb-0">
                                    <label for="buku2" class="col-form-label">Buku 2:</label>
                                    <select name="buku2" id="buku2" class="form-control select2">
                                        <option value="">Daftar Buku</option>
                                        @foreach ($buku as $data)
                                            <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger small">{{ $errors->first('buku2') }}</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="buku3" class="col-form-label">Buku 3:</label>
                                    <select name="buku3" id="buku3" class="form-control select2">
                                        <option value="">Daftar Buku</option>
                                        @foreach ($buku as $data)
                                            <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger small">{{ $errors->first('buku3') }}</p>
                                </div>
                            </div>
                            <div class="mb-0 text-end">
                                <button type="submit" class="btn btn-primary w-100">Proses Peminjaman Buku</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="{{ asset('dist/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset('dist/vendor/select2/js/select2.min.js') }}"></script>
@endsection
