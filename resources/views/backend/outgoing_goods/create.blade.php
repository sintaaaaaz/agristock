@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Tambah Barang Keluar</h3>
        <a href="{{ route('outgoing-goods.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('outgoing-goods.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nomor Transaksi</label>
                    <input type="text" name="transaction_code" class="form-control @error('transaction_code') is-invalid @enderror" placeholder="Contoh: BK-001" value="{{ old('transaction_code') }}">
                    @error('transaction_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tujuan Distribusi / Keperluan</label>
                    <input type="text" name="purpose" class="form-control @error('purpose') is-invalid @enderror" placeholder="Contoh: Pasar Induk / Toko A" value="{{ old('purpose') }}">
                    @error('purpose') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Keluar</label>
                    <input type="date" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror" value="{{ old('transaction_date', date('Y-m-d')) }}">
                    @error('transaction_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr class="my-4">
                <h5 class="fw-bold mb-3 text-danger">Pilih Barang Keluar</h5>

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->product_code }} - {{ $product->product_name }} (Tersedia: {{ $product->stock }} {{ $product->unit->name ?? '' }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Yang Dikeluarkan (Qty)</label>
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" min="1" placeholder="0" value="{{ old('quantity') }}">
                    @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr class="my-4">

                <div class="mb-3">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="note" class="form-control" rows="3" placeholder="Opsional...">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="btn btn-danger w-100 py-2">
                    <i class="fa-solid fa-paper-plane me-1"></i> Simpan & Potong Stok Gudang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection