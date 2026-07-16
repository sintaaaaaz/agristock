@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Detail Barang Keluar</h3>
        <a href="{{ route('outgoing-goods.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Informasi Transaksi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="text-muted ps-0" width="130">No Transaksi</td>
                            <td class="fw-bold text-danger">: {{ $outgoingGood->transaction_code }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Tanggal Keluar</td>
                            <td>: {{ $outgoingGood->transaction_date ? $outgoingGood->transaction_date->format('d/m/Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Tujuan</td>
                            <td class="fw-semibold">: {{ $outgoingGood->purpose }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Catatan</td>
                            <td>: {{ $outgoingGood->note ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0 fw-bold text-dark">Daftar Item Dikeluarkan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-danger">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah (Qty)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($outgoingGood->outgoingGoodDetails as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge bg-secondary">{{ $detail->product->product_code ?? '-' }}</span></td>
                                        <td>{{ $detail->product->product_name ?? 'Produk Terhapus' }}</td>
                                        <td class="fw-bold text-danger">{{ $detail->quantity }} {{ $detail->product->unit->name ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada detail produk.</td>
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