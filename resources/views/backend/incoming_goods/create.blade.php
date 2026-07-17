@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Tambah Barang Masuk</h3>
            <a href="{{ route('incoming-goods.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('incoming-goods.store') }}" method="POST">
                    @csrf

                    {{-- Supplier --}}
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nomor Transaksi --}}
                    <div class="mb-3">
                        <label class="form-label">Nomor Transaksi</label>
                        <input type="text" name="transaction_code" class="form-control" placeholder="Contoh: BM-001"
                            value="{{ old('transaction_code') }}">
                        @error('transaction_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="transaction_date" class="form-control"
                            value="{{ old('transaction_date', date('Y-m-d')) }}">
                        @error('transaction_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> {{-- <-- Perbaikan: Menutup tag div tanggal --}}

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3">Detail Barang</h5>

                    {{-- Produk --}}
                    <div class="mb-3">
                        <label class="form-label">Produk</label>
                        <select name="product_id" class="form-select">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_code }} - {{ $product->product_name }}
                                    ({{ $product->unit->name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- Quantity --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah (Quantity)</label>
                            <input type="number" name="quantity" class="form-control" min="1" placeholder="0"
                                value="{{ old('quantity') }}">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Harga Beli --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Beli (Per Satuan)</label>
                            <input type="number" name="purchase_price" class="form-control" placeholder="0"
                                value="{{ old('purchase_price') }}">
                            @error('purchase_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Keterangan --}}
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                    </div> {{-- <-- Perbaikan: Menutup tag div keterangan --}}

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-save"></i> Simpan Barang Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
