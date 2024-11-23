@extends('aktor.petugas.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('petugas.peminjamanScan') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-0">
                                <label class="form-label mb-2" for="barcode">Scan Barcode Siswa / Kartu Anggota Perpus Siswa</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="barcode"><i class="ri-user-search-line fs-21"></i></span>
                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="ID Siswa" aria-describedby="barcode" required>
                                </div>
                                <p class="text-danger small">{{ $errors->first('barcode') }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
