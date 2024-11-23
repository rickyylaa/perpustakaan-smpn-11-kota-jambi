@extends('utama.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
<div class="banner-area auto-height shadow dark text-light content-top-heading bg-fixed text-normal text-center" style="background-image: url(/dist/images/banner/1.jpg); height:100%;">
    <div class="item">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="content">
                        <h1>Selamat datang diperpustakaan online SMPN 11 Kota Jambi</h1>
                        <form method="GET" action="{{ route('home.cariBuku') }}">
                            <input type="text" name="buku" class="form-control" placeholder="Cari Judul Buku" required>
                            <button type="submit">
                                <i class="fa fa-search" style="color: white"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
