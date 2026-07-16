@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Input Barang Tani</h3>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm rounded-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form action="{{ route('incoming-goods.store') }}" method="POST">
                @csrf

                {{-- 1. Nama Anda (Sebagai Supplier) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Supplier (Nama Anda)</label>
                    <input type="text" class="form-control bg-light border-0 py-2 text-capitalize" value="{{ Auth::user()->name }}" readonly>
                    <input type="hidden" name="supplier_name" value="{{ Auth::user()->name }}">
                </div>

                {{-- 2. Tanggal --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Tanggal Masuk</label>
                    <input type="date" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror py-2" value="{{ old('transaction_date', date('Y-m-d')) }}">
                    @error('transaction_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4 text-muted">

                {{-- 3. Kategori --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Kategori Barang</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror py-2">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. Unit / Satuan --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Satuan (Unit)</label>
                    <select name="unit_id" class="form-select @error('unit_id') is-invalid @enderror py-2">
                        <option value="">-- Pilih Satuan --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- 5. Produk (Otomatis Dibuat Berdasarkan Ketikan User) --}}
                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-semibold text-muted">Nama Produk Hasil Tani</label>
                        <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror py-2" placeholder="Contoh: Padi IR64, Jagung Manis" value="{{ old('product_name') }}">
                        @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 6. Jumlah --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold text-muted">Jumlah (Quantity)</label>
                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror py-2" min="1" placeholder="0" value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2.5 mt-3 rounded-3 fw-bold shadow-sm">
                    <i class="fa-solid fa-paper-plane me-1"></i> Setor Barang ke Gudang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection