@extends('utama.layouts.app')
@section('title', 'Perpustakaan SMPN 11 Kota Jambi')

@section('content')
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(/dist/images/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Visi Misi</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Home</a></li>
                        <li class="active">Visi Misi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="event" class="event-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 faq-content">
                    <div class="acd-items acd-arrow">
                        <div class="panel-group symb" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ac1">
                                            Visi
                                        </a>
                                    </h4>
                                </div>
                                <div id="ac1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Terwujudnya Minat, Kemampuan, dan Kebiasaan Membaca Menuju Siswa Mandiri dalam Memahami/Menelaah, Menirukan dan Menambahkan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ac2">
                                            Misi
                                        </a>
                                    </h4>
                                </div>
                                <div id="ac2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li>1. Menjadikan Perpustakaan Sebagai Sumber Belajar</li>
                                            <li>2. Mendorong Siswa Gemar Membaca</li>
                                            <li>3. Mendorong Terlaksananya Pembelajaran Berbasis Teknologi Informasi</li>
                                            <li>4. Membangun Kreatifitas Siswa</li>
                                            <li>5. Menumbuhkan Minat dan Bakat Siswa di Bidang Kesusastraan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
