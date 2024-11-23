@extends('aktor.petugas.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="javascript: void(0);" class="btn btn-dark ms-2 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <i class="ri-add-fill"></i> Tambah
                        </a>
                    </div>
                    <h4 class="page-title">Buku</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-borderless table-centered dt-responsive nowrap w-100" id="basic-datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Buku</th>
                                        <th>Penulis</th>
                                        <th>Penerbit & Tahun Terbit</th>
                                        <th>Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($buku) > 0)
                                        @php
                                            $rowNumber = 1;
                                        @endphp
                                        @foreach ($buku as $row)
                                            <tr>
                                                <td>{{ $rowNumber }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/sampul/'. $row->sampul) }}" alt="avatar" class="d-flex me-2 rounded-circle bg-secondary-subtle" height="60">
                                                        <div class="w-100">
                                                            <h5 class="m-0 fs-14">{{ ucwords($row->judul) }}</h5>
                                                            <span class="fs-12 mb-0">{{ $row->isbn }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ ucwords($row->penulis) }}</td>
                                                <td>{{ ucwords($row->penerbit) }} - {{ $row->tahun_terbit }}</td>
                                                <td>{{ $row->stok_buku }} buku</td>
                                                <td class="text-center">
                                                    <form method="POST" action="{{ route('petugas.bukuDestroy', $row->id) }}" id="delete-form-{{ $row->id }}">
                                                        @csrf @method('DELETE')
                                                        <a href="javascript: void(0);" class="text-reset fs-18 px-1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                                                            <i class="ri-edit-box-line"></i>
                                                        </a>
                                                        <a href="javascript: void(0);" class="text-reset fs-18 px-1" onclick="confirmDelete('{{ $row->id }}')">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </form>
                                                </td>
                                                <div class="modal fade" id="editModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header modal-colored-header bg-dark">
                                                                <h4 class="modal-title" id="editModalLabel">Edit Buku</h4>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('petugas.bukuUpdate', $row->id) }}" enctype="multipart/form-data">
                                                                @csrf @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="isbn" class="form-label">ISBN</label>
                                                                            <input type="number" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $row->isbn) }}" placeholder="Masukan international standard book number" required>
                                                                            <p class="text-danger fs-16">{{ $errors->first('isbn') }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="judul" class="form-label">Judul</label>
                                                                            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $row->judul) }}" placeholder="Masukan judul" required>
                                                                            <p class="text-danger fs-16">{{ $errors->first('judul') }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="kategori_id" class="form-label">Kategori</label>
                                                                            <select name="kategori_id" id="kategori_id" class="form-control">
                                                                                <option value="">Pilih salah satu</option>
                                                                                @foreach ($kategori as $data)
                                                                                    <option value="{{ $data->id }}" {{ (($row->kategori_id == $data->id) ? 'selected' : '') }}>{{ $data->nama }}, Rak: {{ $data->rak }}, Baris: {{ $data->baris }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <p class="text-danger fs-16">{{ $errors->first('kategori_id') }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="penulis" class="form-label">Penulis</label>
                                                                            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $row->penulis) }}" placeholder="Masukan penulis" required>
                                                                            <p class="text-danger fs-16">{{ $errors->first('penulis') }}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="penerbit" class="form-label">Penerbit</label>
                                                                            <input type="text" name="penerbit" id="penerbit" class="form-control" value="{{ old('penerbit', $row->penerbit) }}" placeholder="Masukan penerbit" required>
                                                                            <p class="text-danger fs-16">{{ $errors->first('penerbit') }}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                                                            <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $row->tahun_terbit) }}" placeholder="Masukan tahun terbit" required>
                                                                            <p class="text-danger fs-16">{{ $errors->first('tahun_terbit') }}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="stok_buku" class="form-label">Stok Buku</label>
                                                                            <input type="number" name="stok_buku" id="stok_buku" class="form-control" value="{{ old('stok_buku', $row->stok_buku) }}" placeholder="Masukan stok buku" required>
                                                                            <p class="text-danger fs-16">{{ $errors->first('stok_buku') }}</p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label for="sampul" class="form-label d-flex align-items-center">Sampul
                                                                                <div class="dropdown ms-1">
                                                                                    <a href="javascript:;" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                        <i class="ri-information-line text-info fs-16"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu dropdown-menu-start">
                                                                                        <span class="dropdown-item">Bisa dikosongkan jika tidak ingin mengganti sampul</span>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                            <input type="file" name="sampul" id="sampul" class="form-control">
                                                                            <p class="text-danger fs-16">{{ $errors->first('sampul') }}</p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $row->deskripsi) }}</textarea>
                                                                            <p class="text-danger fs-16">{{ $errors->first('deskripsi') }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-dark">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                            @php
                                                $rowNumber++;
                                            @endphp
                                        @endforeach
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

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" type="text/css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>
@endsection

@section('script')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat memulihkan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formId = 'delete-form-' + id;
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection

@section('modal')
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="tambahModalLabel">Tambah Buku</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('petugas.bukuStore') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="number" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}" placeholder="Masukan international standard book number" required>
                                <p class="text-danger fs-16">{{ $errors->first('isbn') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" placeholder="Masukan judul" required>
                                <p class="text-danger fs-16">{{ $errors->first('judul') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control">
                                    <option value="">Pilih salah satu</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}, Rak: {{ $data->rak }}, Baris: {{ $data->baris }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger fs-16">{{ $errors->first('kategori_id') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis') }}" placeholder="Masukan penulis" required>
                                <p class="text-danger fs-16">{{ $errors->first('penulis') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" id="penerbit" class="form-control" value="{{ old('penerbit') }}" placeholder="Masukan penerbit" required>
                                <p class="text-danger fs-16">{{ $errors->first('penerbit') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" placeholder="Masukan tahun terbit" required>
                                <p class="text-danger fs-16">{{ $errors->first('tahun_terbit') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="stok_buku" class="form-label">Stok Buku</label>
                                <input type="number" name="stok_buku" id="stok_buku" class="form-control" value="{{ old('stok_buku') }}" placeholder="Masukan stok buku" required>
                                <p class="text-danger fs-16">{{ $errors->first('stok_buku') }}</p>
                            </div>
                            <div class="col-12">
                                <label for="sampul" class="form-label d-flex align-items-center">Sampul
                                    <div class="dropdown ms-1">
                                        <a href="javascript:;" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-information-line text-info fs-16"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <span class="dropdown-item">Bisa dikosongkan jika tidak ingin memiliki sampul</span>
                                        </div>
                                    </div>
                                </label>
                                <input type="file" name="sampul" id="sampul" class="form-control">
                                <p class="text-danger fs-16">{{ $errors->first('sampul') }}</p>
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
                                <p class="text-danger fs-16">{{ $errors->first('deskripsi') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
