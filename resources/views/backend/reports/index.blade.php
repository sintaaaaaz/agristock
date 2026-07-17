@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Laporan & Analisis Gudang</h3>
        </div>

        {{-- Widget Ringkasan Statistik --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm bg-success text-white border-0">
                    <div class="card-body d-flex justify-content-between align-items-center py-4">
                        <div>
                            <h6 class="text-uppercase opacity-75 small fw-bold">Total Jenis Produk</h6>
                            <h2 class="fw-bold mb-0">{{ $totalProducts }}</h2>
                        </div>
                        <i class="fa-solid fa-boxes-stacked fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-info text-white border-0">
                    <div class="card-body d-flex justify-content-between align-items-center py-4">
                        <div>
                            <h6 class="text-uppercase opacity-75 small fw-bold">Mitra Supplier</h6>
                            <h2 class="fw-bold mb-0">{{ $totalSuppliers }}</h2>
                        </div>
                        <i class="fa-solid fa-truck-field fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-danger text-white border-0">
                    <div class="card-body d-flex justify-content-between align-items-center py-4">
                        <div>
                            <h6 class="text-uppercase opacity-75 small fw-bold">Produk Krisis Stok</h6>
                            <h2 class="fw-bold mb-0">{{ $lowStockProducts }}</h2>
                        </div>
                        <i class="fa-solid fa-triangle-exclamation fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Tanggal --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('reports.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa-solid fa-filter me-1"></i> Filter Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            {{-- Ringkasan Barang Masuk --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-success"><i class="fa-solid fa-arrow-down-long me-2"></i>Aktivitas
                            Barang Masuk</h5>
                        <span class="badge bg-success">{{ $incomingGoods->count() }} Transaksi</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Supplier</th>
                                        <th>Tanggal</th>
                                        <th>Total Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($incomingGoods as $in)
                                        <tr>
                                            <td class="fw-bold">{{ $in->transaction_code }}</td>
                                            <td>{{ $in->supplier->supplier_name ?? '-' }}</td>
                                            <td>{{ $in->transaction_date ? $in->transaction_date->format('d/m/Y') : '-' }}
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $in->incomingGoodDetails->sum('quantity') }} Item
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">Tidak ada riwayat barang
                                                masuk periode ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Barang Keluar --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-danger"><i class="fa-solid fa-arrow-up-long me-2"></i>Aktivitas Barang
                            Keluar</h5>
                        <span class="badge bg-danger">{{ $outgoingGoods->count() }} Transaksi</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal</th>
                                        <th>Total Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($outgoingGoods as $out)
                                        <tr>
                                            <td class="fw-bold">{{ $out->transaction_code }}</td>
                                            <td>{{ $out->purpose }}</td>
                                            <td>{{ $out->transaction_date ? $out->transaction_date->format('d/m/Y') : '-' }}
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $out->outgoingGoodDetails->sum('quantity') }} Item
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">Tidak ada riwayat barang
                                                keluar periode ini.</td>
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
