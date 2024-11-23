@extends('utama.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(/dist/images/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Detail Buku</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Home</a></li>
                        <li><a href="{{ route('home.buku') }}">Buku</a></li>
                        <li class="active">{{ $buku->judul }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="featured-courses" class="featured-courses-area left-details default-padding">
        <div class="container">
            <div class="row">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="thumb">
                            <img src="{{ asset('storage/sampul/'. $buku->sampul) }}" alt="Thumb">
                            <div class="live-view">
                                <a href="{{ asset('storage/sampul/'. $buku->sampul) }}" class="item popup-link">
                                    <i class="fa fa-camera text-primary"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 info">
                        <h2>
                            <span>{{ $buku->judul }}</span>
                        </h2>
                        <h4>{{ $buku->kategori->nama }}</h4>
                        <p>
                            {{ $buku->deskripsi }}
                        </p>
                        <h3>Detail Buku</h3>
                        <ul>
                            <li>
                                <i class="fas fa-check-double"></i>
                                <span>Penulis: {{ $buku->penulis }}</span>
                            </li>
                            <li>
                                <i class="fas fa-check-double"></i>
                                <span>Penerbit: {{ $buku->penerbit }}</span>
                            </li>
                            <li>
                                <i class="fas fa-check-double"></i>
                                <span>Tahun Terbit: {{ $buku->tahun_terbit }}</span>
                            </li>
                            <li>
                                <i class="fas fa-check-double"></i>
                                <span>Stok: {{ $buku->stok_buku }} buku</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials-area carousel-shadow default-padding bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-lg-12 offset-lg-2">
                        <h2>Rekomendasi Buku</h2>
                    </div>
                </div>
                <div class="clients-review-carousel owl-carousel owl-theme">
                    @foreach($rekomendasi as $row)
                        <div class="item">
                            <div class="row align-items-center">
                                <div class="col-lg-5 thumb">
                                    <img src="{{ asset('storage/sampul/' . $row->sampul) }}" alt="sampul">
                                </div>
                                <div class="col-lg-7 info">
                                    <h4><a href="{{ route('home.detailBuku', $row->slug) }}">{{ $row->judul }}</a></h4>
                                    <span class="mb-2">{{ $row->kategori->nama }}</span>
                                    <p>{{ Str::limit($row->deskripsi, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
