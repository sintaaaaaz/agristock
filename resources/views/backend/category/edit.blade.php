@extends('layouts.backend')

@section('content')

<h3>Edit Kategori</h3>

<form action="{{ route('categories.update', $category->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">
            Nama Kategori
        </label>

        <input
            type="text"
            name="category_name"
            class="form-control @error('category_name') is-invalid @enderror"
            value="{{ old('category_name', $category->category_name) }}">

        @error('category_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <button class="btn btn-primary">
        Update
    </button>

    <a href="{{ route('categories.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection