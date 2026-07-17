@extends('layouts.backend')

@section('content')
    <h3>Tambah Kategori</h3>

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf
        <div class="mb-3">

            <label class="form-label">

                Nama Kategori

            </label>

            <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror"
                value="{{ old('category_name') }}">

            @error('category_name')
                <div class="invalid-feedback">

                    {{ $message }}

                </div>
            @enderror

        </div>

        <button class="btn btn-success">

            Simpan

        </button>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">

            Kembali

        </a>
    @endsection
