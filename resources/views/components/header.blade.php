<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            🌾 AgriStock
        </a>

        <div class="ms-auto d-flex align-items-center">

            <!-- Menampilkan nama user dengan ukuran lebih besar (fs-5), tebal (fw-semibold), dan jarak (me-3) -->
            <span class="text-white fs-5 fw-semibold me-3 text-capitalize">
                {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <!-- Mempercantik tombol logout agar sudutnya sedikit melengkung -->
                <button type="submit" class="btn btn-light btn-sm px-3 rounded-2 shadow-sm fw-medium">
                    Logout
                </button>
            </form>

        </div>

    </div>

</nav>
