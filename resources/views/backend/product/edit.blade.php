@extends('layouts.backend')


@section('content')
    <div class="container-fluid">


        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold">
                Edit Produk
            </h3>


            <a href="{{ route('products.index') }}" class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>
                Kembali

            </a>

        </div>



        <div class="card shadow-sm">

            <div class="card-body">


                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">


                    @csrf
                    @method('PUT')



                    {{-- Kategori --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Kategori Produk
                        </label>


                        <select name="category_id" class="form-select">


                            <option value="">
                                -- Pilih Kategori --
                            </option>


                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>

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
                        <label class="form-label fw-semibold text-muted">
                            Kode Produk <small class="text-danger">(Tidak dapat diubah)</small>
                        </label>

                        <!-- Menggunakan bg-light agar otomatis abu-abu dan readonly agar nilainya tetap terkirim saat disubmit -->
                        <input type="text" name="product_code" class="form-control bg-light text-muted fw-bold border-1"
                            value="{{ $product->product_code }}" readonly>
                    </div>





                    {{-- Nama Produk --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Produk
                        </label>


                        <input type="text" name="product_name" class="form-control"
                            value="{{ old('product_name', $product->product_name) }}">


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

                            <option value="">
                                -- Pilih Satuan --
                            </option>


                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>

                                    {{ $unit->name }}

                                </option>
                            @endforeach


                        </select>

                    </div>





                    {{-- Harga Beli --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Harga Beli
                        </label>


                        <input type="number" name="purchase_price" class="form-control"
                            value="{{ old('purchase_price', $product->purchase_price) }}">


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
                                    Stok
                                </label>


                                <input type="number" name="stock" class="form-control"
                                    value="{{ old('stock', $product->stock) }}">


                            </div>


                        </div>




                        <div class="col-md-6">


                            <div class="mb-3">

                                <label class="form-label">
                                    Minimal Stok
                                </label>


                                <input type="number" name="minimum_stock" class="form-control"
                                    value="{{ old('minimum_stock', $product->minimum_stock) }}">


                            </div>


                        </div>


                    </div>





                    {{-- Gambar Lama --}}

                    @if ($product->image)
                        <div class="mb-3">

                            <label class="form-label">
                                Gambar Saat Ini
                            </label>


                            <br>


                            <img src="{{ asset('uploads/products/' . $product->image) }}" width="100" height="100"
                                class="rounded" style="object-fit:cover;">


                        </div>
                    @endif





                    {{-- Upload Gambar Baru --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Ganti Gambar
                        </label>


                        <input type="file" name="image" class="form-control">


                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </small>


                    </div>





                    {{-- Deskripsi --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>


                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>


                    </div>

                    <button type="submit" class="btn btn-success">

                        <i class="fa-solid fa-save"></i>
                        Update Produk

                    </button>



                </form>


            </div>

        </div>


    </div>
@endsection
