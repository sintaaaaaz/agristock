@extends('layouts.backend')

@section('content')
    <div class="container-fluid">

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary rounded-3 shadow-sm px-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="row">
            {{-- Ringkasan Informasi Transaksi --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-success text-white py-3 rounded-top-3">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-circle-info me-2"></i> Info Barang Masuk</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Kode Transaksi</small>
                            <span class="fw-bold text-success fs-5">{{ $incomingGood->transaction_code }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Tanggal Transaksi</small>
                            <span
                                class="fw-semibold">{{ \Carbon\Carbon::parse($incomingGood->transaction_date)->format('d F Y') }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Nama Supplier Pemasok</small>
                            <span
                                class="fw-bold text-dark">{{ $incomingGood->supplier->supplier_name ?? 'Pemasok Mandiri Aplikasi' }}</span>
                        </div>
                        <div class="mb-0">
                            <small class="text-muted d-block">Catatan / Keterangan</small>
                            <p class="mb-0 text-secondary bg-light p-2 rounded border border-light-subtle mt-1"
                                style="font-size: 13px;">
                                {{ $incomingGood->note ?? 'Tidak ada catatan tambahan.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Rincian Item Barang Masuk --}}
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-boxes-stacked me-2 text-success"></i>
                            Rincian Item Komoditas Masuk</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4" width="60">No</th>
                                        <th>Nama Produk</th>
                                        <th>Kode Produk</th>
                                        <th class="text-end px-4">Jumlah Masuk (Qty)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($incomingGood->incomingGoodDetails as $key => $detail)
                                        <tr>
                                            <td class="px-4 text-muted">{{ $key + 1 }}</td>
                                            <td class="fw-bold text-dark">
                                                {{ $detail->product->product_name ?? 'Produk Terhapus' }}
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-secondary border">
                                                    {{ $detail->product->product_code ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="text-end fw-bold text-success px-4 fs-6">
                                                {{ $detail->quantity }}
                                                <small
                                                    class="fw-normal text-muted">{{ $detail->product->unit->name ?? '' }}</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">Tidak ada rincian item
                                                untuk transaksi ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
