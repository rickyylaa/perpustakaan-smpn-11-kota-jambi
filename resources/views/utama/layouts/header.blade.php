<header id="home">
    <nav class="navbar navbar-default navbar-sticky bootsnav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="{{ url('/') }}" class="navbar-brand">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" class="logo" alt="Logo" width="50" height="50">
                        <span class="text-dark h4 mt-3">SMPN 11 KOTA JAMBI</span>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="{{ (request()->is('buku*')) ? 'active' : '' }}">
                        <a href="{{ route('home.buku') }}">Buku</a>
                    </li>
                    <li class="{{ (request()->is('tata-tertib')) ? 'active' : '' }}">
                        <a href="{{ route('home.tataTertib') }}">Tata Tertib</a>
                    </li>
                    <li class="{{ (request()->is('visi-misi')) ? 'active' : '' }}">
                        <a href="{{ route('home.visiMisi') }}">Visi Misi</a>
                    </li>
                    <li class="search">
                        <a href="javascript:;">|</a>
                    </li>
                    @auth
                        <li class="side-menu"><a href="{{ route('petugas.dashboard') }}"><i class="fa fa-user"></i></a></li>
                    @else
                        <li class="side-menu"><a href="{{ route('login') }}"><i class="fa fa-user"></i></a></li>
                    @endauth
                </ul>
        </div>
    </nav>
</header>
