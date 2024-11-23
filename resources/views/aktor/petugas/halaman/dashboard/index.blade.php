@extends('aktor.petugas.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat bg-primary text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-team-line widget-icon bg-white text-primary"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Siswa">Siswa</h6>
                            <h3 class="my-3">{{ $siswa->count() }} Siswa</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat bg-info text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-book-open-line widget-icon bg-white text-info"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Buku">Buku</h6>
                            <h3 class="my-3">{{ $buku->count() }} Buku</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat bg-success text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-bookmark-line widget-icon bg-white text-success"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Riwayat Peminjam">Riwayat Peminjaman</h6>
                            <h3 class="my-3">{{ $pinjam->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat bg-warning text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-bookmark-2-line widget-icon bg-white text-warning"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Riwayat Pengembalian">Riwayat Pengembalian</h6>
                            <h3 class="my-3">{{ $kembali->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-borderless table-centered dt-responsive nowrap w-100" id="basic-datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Siswa</th>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($aktivity) > 0)
                                        @php
                                            $rowNumber = 1;
                                        @endphp
                                        @foreach ($aktivity as $row)
                                            <tr>
                                                <td>{{ $rowNumber }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/profil/'. $row->siswa->foto) }}" alt="avatar" class="d-flex me-2 rounded-circle bg-secondary-subtle" height="60">
                                                        <div class="w-100">
                                                            <h5 class="m-0 fs-14">{{ ucwords($row->siswa->nama) }}</h5>
                                                            <span class="fs-12 mb-0">{{ $row->siswa->nisn }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/sampul/'. $row->buku->sampul) }}" alt="sampul" class="d-flex me-2 rounded-circle bg-secondary-subtle" height="60">
                                                        <div class="w-100">
                                                            <h5 class="m-0 fs-14">{{ ucwords($row->buku->judul) }}</h5>
                                                            <span class="fs-12 mb-0">{{ $row->buku->isbn }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ date('d F Y ', strtotime($row->created_at)) }}</td>
                                                <td>{{ date('d F Y ', strtotime($row->tanggal_kembali)) }}</td>
                                                <td>
                                                    <h5><span class="badge bg-primary text-light">{{ ucwords($row->status) }}</span></h5>
                                                </td>
                                            </tr>
                                            @php
                                                $rowNumber++;
                                            @endphp
                                        @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="10">Tidak ada riwayat aktivity</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
