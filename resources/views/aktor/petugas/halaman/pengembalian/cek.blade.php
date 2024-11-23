@extends('aktor.petugas.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-6">
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
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted fs-14">Data - Data Siswa Yang Aktif Melakukan Peminjaman Buku Di Perpustakaan SMPN 11 Kota Jambi</p>
                            <div class="table-responsive mb-0 pb-0">
                                <table id="basic-datatable" class="table table-striped table-centered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Siswa</th>
                                            <th>Buku</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Keterlambatan</th>
                                            <th>Denda</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($pinjam) > 0)
                                            @foreach ($pinjam as $row)
                                                @php
                                                    $hariTerlambat = $row->getKeterlambatan();
                                                    $nominalDenda = $hariTerlambat > 0 ? App\Models\RiwayatPinjam::getNominalDenda() : 0;
                                                @endphp
                                                <tr>
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
                                                        @if ($hariTerlambat > 0)
                                                            <span class="badge badge-danger">Terlambat {{ $hariTerlambat }} Hari</span>
                                                        @else
                                                            <span class="badge bg-info">Tidak Denda</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $nominalDenda > 0 ? 'Rp ' . number_format($nominalDenda, 2, ',', '.') : 'Rp 0,00' }}
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{ route('petugas.pengembalianProses', $row->id) }}" id="proses-form-{{ $row->id }}">
                                                            @csrf <input type="hidden" name="denda" value="{{ $hariTerlambat > 0 ? $hariTerlambat : 0 }}">
                                                                    <input type="hidden" name="nominal" value="{{ $nominalDenda }}"> <input type="hidden" name="id" value="{{ $row->id }}">
                                                            <a href="javasciprt:;" onclick="confirmProses('{{ $row->id }}')" class="text-reset fs-21 px-1" title="Proses">
                                                                <i class="ri-reply-line"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="10">
                                                    <div class="col-12">
                                                        <div class="text-center mt-4">
                                                            <h6 class="fw-lighter text-secondary small mb-2">Anda tidak memiliki data dalam tabel ini</h6>
                                                        </div>
                                                    </div>
                                                </td>
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
    </div>
</div>
@endsection

@section('css')
<link href="{{ asset('dist/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset('dist/vendor/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('script')
    <script>
        function confirmProses(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Apakah buku dan denda telah sesuai dengan sistem ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, proses!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formId = 'proses-form-' + id;
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection

