<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.png') }}" type="image/x-icon">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

    <link rel="stylesheet" href="{{ asset('pdf/vendor/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pdf/vendor/font-awesome/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('pdf/css/stylesheet.css') }}" type="text/css">
</head>
<body>
    <div class="container-fluid invoice-container">
        <main>
            <div class="table-responsive">
                <table class="table table-bordered border border-secondary mb-0">
                    <tbody>
                        <tr>
                            <td colspan="2" class="bg-light text-center">
                                <h3 class="mb-0">PERPUSTAKAAN SMPN 11 KOTA JAMBI</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center text-uppercase">
                                DINAS PENDIDIKAN PEMERINTAH KOTA JAMBI<br>
                                SEKOLAH MENENGAH PERTAMA NEGERI 11 KOTA JAMBI<br>
                                Alamat : JL. HOS COKRO AMINOTO Kel. Selamat Kec. Danau Sipin, Jambi, Kota Jambi
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="p-0">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr class="bg-light">
                                            <td class="col-1"><strong>No</strong></td>
                                            <td class="col-1"><strong>NISN</strong></td>
                                            <td class="col-2"><strong>Nama Siswa</strong></td>
                                            <td class="col-1"><strong>Kelas</strong></td>
                                            <td class="col-3"><strong>Buku</strong></td>
                                            <td class="col-1"><strong>Tanggal Pinjam</strong></td>
                                            <td class="col-1"><strong>Tanggal Kembali</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @forelse ($riwayat as $data)
                                            <tr>
                                                <td class="col-1">{{ $i++ }}</td>
                                                <td class="col-1">{{ $data->siswa->nisn }}</td>
                                                <td class="col-2">{{ ucwords($data->siswa->nama) }}</td>
                                                <td class="col-1">{{ $data->siswa->kelas->nama_kelas }}</td>
                                                <td class="col-3">{{ $data->buku->judul }}</td>
                                                <td class="col-1">{{ date('d M Y', strtotime($data->created_at)) }}</td>
                                                <td class="col-1">{{ date('d M Y', strtotime($data->tanggal_kembali)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Anda tidak memiliki data dalam tabel ini</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <footer class="text-center mt-4">
            <div class="btn-group btn-group-sm d-print-none">
                <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none">
                    <i class="fa fa-print"></i> Print & Download
                </a>
            </div>
        </footer>
    </div>
</body>
</html>
