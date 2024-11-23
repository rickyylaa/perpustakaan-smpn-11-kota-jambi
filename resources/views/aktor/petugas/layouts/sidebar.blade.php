<div class="leftside-menu">
    <a href="{{ route('petugas.dashboard') }}" class="logo logo-light">
        <span class="logo-lg">
            <h4 class="text-center text-white ms-1 mt-2">PERPUSTAKAAN</h4>
            <h4 class="text-center text-white ms-1 mb-2">SMPN 11 Kota Jambi</h4>
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="small logo">
        </span>
    </a>
    <a href="{{ route('petugas.dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <h4 class="text-center text-white ms-1 mt-2">PERPUSTAKAAN</h4>
            <h4 class="text-center text-white ms-1 mb-2">SMPN 11 Kota Jambi</h4>
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="small logo">
        </span>
    </a>
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <div class="leftbar-user">
            <a href="javascript:;">
                <img src="{{ asset('storage/profil/'. Auth::user()->foto) }}" alt="user-image" height="42" class="rounded-circle bg-secondary-subtle shadow-sm">
                <span class="leftbar-user-name mt-2">{{ Auth::user()->nama }}</span>
            </a>
        </div>
        <ul class="side-nav">
            <li class="side-nav-title">Navigasi</li>
            <li class="side-nav-item {{ (request()->is('petugas/dashboard*')) ? 'menuitem-active' : '' }}">
                <a href="{{ route('petugas.dashboard') }}" class="side-nav-link">
                    <i class="ri-home-4-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-title">Data</li>
            <li class="side-nav-item {{ (request()->is('petugas/siswa*')) ? 'menuitem-active' : '' }}">
                <a href="{{ route('petugas.siswa') }}" class="side-nav-link">
                    <i class="ri-graduation-cap-line"></i>
                    <span> Siswa </span>
                </a>
            </li>
            <li class="side-nav-item {{ request()->is('petugas/kategori*') || request()->is('petugas/buku*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#sidebarBuku" aria-expanded="{{ request()->is('petugas/kategori*') || request()->is('petugas/buku*') ? 'ture' : 'false' }}" aria-controls="sidebarBuku" class="side-nav-link">
                    <i class="ri-book-open-line"></i>
                    <span> Buku </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ request()->is('petugas/kategori*') || request()->is('petugas/buku*') ? 'show' : '' }}" id="sidebarBuku">
                    <ul class="side-nav-second-level">
                        <li class="{{ request()->is('petugas/kategori*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('petugas.kategori') }}">Kategori</a>
                        </li>
                        <li class="{{ request()->is('petugas/buku*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('petugas.buku') }}">Buku</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-title">Lainnya</li>
            <li class="side-nav-item {{ request()->routeIs('petugas.peminjaman*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('petugas.peminjaman') }}" class="side-nav-link">
                    <i class="ri-bookmark-line"></i>
                    <span> Peminjaman </span>
                </a>
            </li>
            <li class="side-nav-item {{ (request()->is('petugas/pengembalian/*')) ? 'menuitem-active' : '' }}">
                <a href="{{ route('petugas.pengembalian') }}" class="side-nav-link">
                    <i class="ri-bookmark-2-line"></i>
                    <span> Pengembalian </span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
