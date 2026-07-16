@extends('layouts.backend')


@section('content')

<div class="container-fluid">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">
            Tambah Produk
        </h3>


        <a href="{{ route('products.index') }}"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali

        </a>

    </div>



    <div class="card shadow-sm">

        <div class="card-body">


            <form action="{{ route('products.store') }}"
            method="POST"
            enctype="multipart/form-data">


                @csrf



                {{-- Kategori --}}

                <div class="mb-3">

                    <label class="form-label">
                        Kategori Produk
                    </label>


                    <select name="category_id"
                    class="form-select">


                        <option value="">
                            -- Pilih Kategori --
                        </option>


                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->category_name }}

                            </option>

                        @endforeach


                    </select>


                    @error('category_id')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror


                </div>





                {{-- Kode Produk --}}

                <div class="mb-3">

                    <label class="form-label">
                        Kode Produk
                    </label>


                    <input type="text"
                    name="product_code"
                    class="form-control"
                    placeholder="Contoh: P001"
                    value="{{ old('product_code') }}">


                    @error('product_code')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror


                </div>





                {{-- Nama Produk --}}

                <div class="mb-3">

                    <label class="form-label">
                        Nama Produk
                    </label>


                    <input type="text"
                    name="product_name"
                    class="form-control"
                    placeholder="Masukkan nama produk"
                    value="{{ old('product_name') }}">


                    @error('product_name')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror


                </div>





                {{-- Satuan --}}

                <div class="mb-3">

                    <label class="form-label">
                        Satuan
                    </label>


                    <select name="unit_id" class="form-select">

<option>
-- Pilih Satuan --
</option>

@foreach($units as $unit)

<option value="{{ $unit->id }}">

{{ $unit->name }}

</option>

@endforeach

</select>


                </div>





                {{-- Harga --}}

                <div class="mb-3">

                    <label class="form-label">
                        Harga Beli
                    </label>


                    <input type="number"
                    name="purchase_price"
                    class="form-control"
                    placeholder="Masukkan harga beli"
                    value="{{ old('purchase_price') }}">


                    @error('purchase_price')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror


                </div>

                <div class="row">


                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Stok Awal
                            </label>


                            <input type="number"
                            name="stock"
                            class="form-control"
                            value="{{ old('stock',0) }}">


                        </div>

                    </div>




                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Minimal Stok
                            </label>


                            <input type="number"
                            name="minimum_stock"
                            class="form-control"
                            value="{{ old('minimum_stock',10) }}">


                        </div>

                    </div>


                </div>





                {{-- Gambar --}}

                <div class="mb-3">

                    <label class="form-label">
                        Gambar Produk
                    </label>


                    <input type="file"
                    name="image"
                    class="form-control">


                    @error('image')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror


                </div>





                {{-- Deskripsi --}}

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>


                    <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Keterangan produk">{{ old('description') }}</textarea>


                </div>


                <button type="submit"
                class="btn btn-success">

                    <i class="fa-solid fa-save"></i>
                    Simpan Produk

                </button>



            </form>


        </div>

    </div>


</div>


@endsection