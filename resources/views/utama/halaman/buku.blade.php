@extends('utama.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(/dist/images/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Buku</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Home</a></li>
                        <li class="active">Buku</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="event" class="event-area default-padding">
        <div class="container">
            <div class="event-items">
                @foreach ($buku as $row)
                    <div class="item horizontal">
                        <div class="col-lg-6 thumb bg-cover" style="background-image: url({{ asset('storage/sampul/'. $row->sampul) }})"></div>
                        <div class="col-lg-6 info">
                            <h4>
                                <a href="{{ route('home.detailBuku', $row->slug) }}">{{ $row->judul }}</a>
                            </h4>
                            <div class="meta">
                                <ul>
                                    <li>Kategori : {{ $row->kategori->nama }}</li>
                                    <li>Rak : {{ $row->kategori->rak }}</li>
                                    <li>Baris : {{ $row->kategori->baris }}</li>
                                </ul>
                            </div>
                            <p>{{ $row->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
