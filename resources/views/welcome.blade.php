<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di AgriStock</title>
    <!-- Hubungkan ke aset bootstrap bawaan proyek kamu -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-section {
            background: linear-gradient(rgba(40, 167, 69, 0.8), rgba(20, 108, 67, 0.9)), url('https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=1470') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar Minimalis -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3" style="background-color: #f8f9fa; border-bottom: 1px solid #ebebeb;">
    <div class="container">
        <a class="navbar-brand fw-bold text-success fs-3" href="#">AgriStock</a>
        <div class="ms-auto">
            @auth
                <a href="{{ route('login') }}" class="btn btn-success px-4 rounded-pill fw-semibold shadow-sm">
                    <i class="fa-solid fa-gauge me-1"></i> Sign In
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success px-4 rounded-pill fw-semibold me-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-success px-4 rounded-pill fw-semibold shadow-sm">
                    Daftar Akun
                </a>
            @endauth
        </div>
    </div>
</nav>

    <!-- Hero Section Beranda -->
    <header class="hero-section">
        <div class="container text-center text-lg-start">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <span class="badge bg-light text-success fw-bold px-3 py-2 rounded-pill uppercase tracking-wider mb-3">
                        🌾 Sistem Manajemen Gudang Pertanian
                    </span>
                    <h1 class="display-3 fw-black mb-3 text-white" style="line-height: 1.1;">
                        Kelola Hasil Tani Jauh Lebih Terstruktur
                    </h1>
                    <p class="lead text-white-50 mb-4 fs-5">
                        AgriStock membantu para kelompok tani dan administrator gudang memantau pencatatan komoditas barang masuk, inventaris stok, hingga alur distribusi keluar secara real-time.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg text-success fw-bold px-5 py-3 rounded-3 shadow">
                            Mulai Sekarang
                        </a>
                        <a href="#fitur" class="btn btn-outline-light btn-lg px-4 py-3 rounded-3">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Section Singkat Fitur -->
    <section id="fitur" class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Mengapa Memilih AgriStock?</h2>
                <p class="text-muted">Kemudahan manajemen logistik pertanian dalam satu platform terpadu.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card p-4 border-0 shadow-sm rounded-3 h-100">
                        <div class="text-success mb-3 fs-3"><i class="fa-solid fa-arrow-down-long"></i></div>
                        <h5 class="fw-bold">Pencatatan Setoran</h5>
                        <p class="text-muted small mb-0">Petani atau operator dapat langsung menginput data komoditas pasca-panen langsung ke sistem utama.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 border-0 shadow-sm rounded-3 h-100">
                        <div class="text-success mb-3 fs-3"><i class="fa-solid fa-chart-pie"></i></div>
                        <h5 class="fw-bold">Grafik Tren Real-Time</h5>
                        <p class="text-muted small mb-0">Visualisasi data analisis pasokan masuk dan keluar tahunan yang memudahkan estimasi pasar bagi Admin.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 border-0 shadow-sm rounded-3 h-100">
                        <div class="text-success mb-3 fs-3"><i class="fa-solid fa-boxes-stacked"></i></div>
                        <h5 class="fw-bold">Kontrol Stok Akurat</h5>
                        <p class="text-muted small mb-0">Sistem otomatis memotong saldo kuantitas barang di gudang utama setiap ada transaksi pengeluaran logistik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4" style="background-color: #f8f9fa; border-top: 1px solid #ebebeb; color: #6c757d;">
    <div class="container">
        <small>&copy; {{ date('Y') }} AgriStock - Hak Cipta Dilindungi.</small>
    </div>
</footer>

</body>
</html>