<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            🌾 AgriStock
        </a>

        <div class="ms-auto d-flex align-items-center">

            <span class="text-white me-3">
                Administrator
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>

        </div>

    </div>

</nav>