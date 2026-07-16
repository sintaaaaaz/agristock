<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register AgriStock</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="bg-light">


<div class="container">

<div class="row justify-content-center vh-100 align-items-center">


<div class="col-md-4">


<div class="card shadow">


<div class="card-header bg-success text-white text-center">

<h3>🌾 AgriStock</h3>

<small>
Registrasi User
</small>

</div>


<div class="card-body">


@if(session('error'))

<div class="alert alert-danger">
{{ session('error') }}
</div>

@endif



<form action="{{ route('register.process') }}"
method="POST">


@csrf


<div class="mb-3">

<label>Nama</label>

<input type="text"
name="name"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Password</label>

<input type="password"
name="password"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Konfirmasi Password</label>

<input type="password"
name="email_verified_at"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Captcha</label>

<br>

<img src="{{ captcha_src('default') }}"
class="mb-2 border rounded">


<input type="text"
name="captcha"
class="form-control"
placeholder="Masukkan captcha"
required>


@error('captcha')

<small class="text-danger">
{{ $message }}
</small>

@enderror


</div>



<button class="btn btn-success w-100">

Register

</button>



<div class="text-center mt-3">

<a href="{{ route('login') }}">

Sudah punya akun? Login

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