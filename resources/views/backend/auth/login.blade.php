<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AgriStock</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center vh-100 align-items-center">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">

                    <h3>🌾 AgriStock</h3>

                    <small>Sistem Manajemen Gudang Hasil Pertanian</small>

                </div>

                <div class="card-body">
                    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                    <form action="{{ route('login.process') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                                 @error('email')
    <small class="text-danger">
        {{ $message }}
    </small>
@enderror

                        </div>

                       

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                                @error('password')
    <small class="text-danger">
        {{ $message }}
    </small>
@enderror

                        </div>
                       <div class="mb-3">


    <div class="mb-2">

        <img src="{{ captcha_src('default') }}"
             class="img-fluid border rounded">

    </div>


    <input
        type="text"
        name="captcha"
        class="form-control"
        placeholder="Masukkan kode captcha"
        required>


    @error('kode captcha salah')

    <small class="text-danger">
        {{ $message }}
    </small>

    @enderror


</div>

                        <button class="btn btn-success w-100">

                            Login

                        </button>

                 <div class="text-center mt-4">
    <a href="{{ url('/') }}" class="text-decoration-none" style="color: #6c757d; font-size: 0.9rem; transition: 0.3s;">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Beranda
    </a>
</div>

<style>
    .text-decoration-none:hover { color: #28a745 !important; } /* Warna berubah jadi hijau saat disorot */
</style>

                       


<div class="text-center mt-3">

    <small>
        Belum punya akun?
    </small>

    <br>

    <a href="{{ route('register') }}">
        Register Here
    </a>

</div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>