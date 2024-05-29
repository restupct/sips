<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard*') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/pesanan*') ? '' : 'collapsed' }}"
                href="{{ route('pesanan.index') }}">
                <i class="bi bi-basket"></i>
                <span>Pesanan</span>
            </a>
        </li><!-- End Pesanan Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/barang*') || request()->is('admin/kategori*') || request()->is('admin/satuan*') ? '' : 'collapsed' }}"
                data-bs-target="#data-master-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-archive"></i><span>Data Master Barang</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data-master-nav"
                class="nav-content collapse {{ request()->is('admin/barang*') || request()->is('admin/kategori*') || request()->is('admin/satuan*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">

                <li>
                    <a class="nav-link {{ request()->is('admin/barang') ? '' : 'collapsed' }}"
                        href="{{ route('barang.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Data Barang</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ request()->is('admin/barang-masuk*') ? '' : 'collapsed' }}"
                        href="{{ route('barang-masuk.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ request()->is('admin/kategori*') ? '' : 'collapsed' }}"
                        href="{{ route('kategori.index') }}">
                        <i class="bi bi-circle"></i><span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ request()->is('admin/satuan*') ? '' : 'collapsed' }}"
                        href="{{ route('satuan.index') }}">
                        <i class="bi bi-circle"></i><span>Satuan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Data Master Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/pelanggan*') ? '' : 'collapsed' }}"
                href="{{ route('pelanggan.index') }}">
                <i class="bi bi-person"></i>
                <span>Pelanggan</span>
            </a>
        </li>

        {{-- <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav --> --}}

    </ul>

</aside><!-- End Sidebar-->
