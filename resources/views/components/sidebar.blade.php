<div class="col-md-2 min-vh-100 p-3 d-flex flex-column custom-sidebar">
    <div class="w-100">

        <div class="list-group list-group-flush sidebar-menu">

            <a href="{{ route('dashboard') }}"
                class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <i class="fa-solid fa-chart-pie me-3 sidebar-icon"></i>
                <span>Dashboard</span>
            </a>

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

            <a href="{{route ('incoming-goods.index')}}"
                class="list-group-item list-group-item-action border-0 rounded-3 mb-1 px-3 py-3 d-flex align-items-center sidebar-link
                {{request()->routeIs('incoming-goods.*') ? 'active' : ''}}">

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

        </div>
    </div>
</div>