@extends('utama.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(/dist/images/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Buku</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Beranda</a></li>
                        <li class="active">Buku</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-area full-blog left-sidebar full-blog default-padding">
        <div class="container">
            <div class="row">
                <div class="blog-items">
                    <div class="blog-content col-lg-8">
                        @forelse ($buku as $row)
                            <div class="col-lg-4">
                                <div class="single-item">
                                    <div class="item">
                                        <div class="thumb">
                                            <a href="{{ route('home.detailBuku', $row->slug) }}"><img src="{{ asset('storage/sampul/'. $row->sampul) }}" alt="Thumb"></a>
                                        </div>
                                        <div class="info">
                                            <h4>
                                                <a href="{{ route('home.detailBuku', $row->slug) }}">{{ $row->judul }}</a>
                                            </h4>
                                            <div class="meta">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:;">Kategori : {{ $row->kategori->nama }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">Rak : {{ $row->kategori->rak }} - Baris : {{ $row->kategori->baris }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="blog-content col-lg-12">
                                <div class="alert alert-danger">Maaf Buku Dengan Judul Pencarian Tidak Tersedia</div>
                            </div>
                        @endforelse
                    </div>
                    <div class="sidebar col-lg-4">
                        <aside>
                            <div class="sidebar-item search">
                                <div class="title">
                                    <h4>Cari Buku</h4>
                                </div>
                                <div class="sidebar-info">
                                    <form method="GET" action="{{ route('home.cariBuku') }}">
                                        @csrf
                                        <input type="text" name="buku" placeholder="Masukan Judul Buku" class="form-control" required>
                                        <input type="submit" value="Cari">
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-item recent-post">
                                <div class="title">
                                    <h4>Buku Rekomendasi Untuk Di Baca</h4>
                                </div>
                                @foreach ($rekomendasi as $row)
                                    <div class="item">
                                        <div class="content">
                                            <div class="thumb">
                                                <a href="{{ route('home.detailBuku', $row->slug) }}">
                                                    <img src="{{ asset('storage/sampul/'. $row->sampul) }}" alt="sampul">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <h4>
                                                    <a href="{{ route('home.detailBuku', $row->slug) }}">{{ $row->judul }}</a>
                                                </h4>
                                                <div class="meta">
                                                    <i class="fas fa-dot"></i>Kategori : {{ Str::upper($row->kategori->nama) }}<br>
                                                    <i class="fas fa-dot"></i>Penerbit : {{ Str::upper($row->penerbit) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
