<div class="col-md-2 min-vh-100 p-3 d-flex flex-column custom-sidebar border-end bg-white">
    <!-- Bagian Atas: Menu Navigasi -->
    <div class="w-100 flex-grow-1">
        <div class="list-group list-group-flush sidebar-menu">

            <!-- MENU UTK SEMUA USER (Dashboard) -->
            <a href="{{ route('dashboard') }}"
                class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie me-3 sidebar-icon"></i>
                <span>Dashboard</span>
            </a>

            <!-- KHUSUS USER BIASA SAJA (role_id == 2) -->
            @if(Auth::check() && Auth::user()->role_id == 2)
                <a href="{{ route('incoming-goods.create') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('incoming-goods.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-circle-plus me-3 sidebar-icon"></i>
                    <span>Input Barang</span>
                </a>
            @endif


            <!-- KHUSUS ADMINISTRATOR SAJA (role_id == 1) -->
            @if(Auth::check() && Auth::user()->role_id == 1)
                
                <a href="{{ route('categories.index') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags me-3 sidebar-icon"></i>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('suppliers.index') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-truck-field me-3 sidebar-icon"></i>
                    <span>Supplier</span>
                </a>

                <a href="{{ route('products.index') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-boxes-stacked me-3 sidebar-icon"></i>
                    <span>Produk</span>
                </a>

                <a href="{{ route('incoming-goods.index') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('incoming-goods.index') && !request()->routeIs('incoming-goods.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-arrow-down-long me-3 sidebar-icon"></i>
                    <span>Barang Masuk</span>
                </a>

                <a href="{{ route('outgoing-goods.index') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('outgoing-goods.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-arrow-up-long me-3 sidebar-icon"></i>
                    <span>Barang Keluar</span>
                </a>

                <a href="{{ route('reports.index') }}"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                    {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-invoice-dollar me-3 sidebar-icon"></i>
                    <span>Laporan</span>
                </a>

            @endif

        </div>
    </div>

    {{-- <!-- Bagian Bawah: Tombol Logout -->
    @if(Auth::check())
        <div class="mt-auto pt-4 border-top w-100">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center py-2 rounded-3 border-0" style="background-color: rgba(220, 53, 69, 0.05);">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                    <span class="fw-semibold">Keluar Aplikasi</span>
                </button>
            </form>
        </div>
    @endif --}}
</div>