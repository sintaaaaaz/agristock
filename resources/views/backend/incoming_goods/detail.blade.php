@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Detail Barang Masuk</h3>
        <a href="{{ route('incoming-goods.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        {{-- Ringkasan Informasi Transaksi --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Informasi Transaksi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="text-muted ps-0" width="130">No Transaksi</td>
                            <td class="fw-bold text-success">: {{ $incomingGood->transaction_code }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Tanggal Masuk</td>
                            <td>: {{ $incomingGood->transaction_date ? $incomingGood->transaction_date->format('d/m/Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Supplier</td>
                            <td class="fw-semibold">: {{ $incomingGood->supplier->supplier_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Catatan/Nota</td>
                            <td>: {{ $incomingGood->note ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Daftar Item/Produk di dalam Transaksi --}}
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0 fw-bold text-dark">Item Yang Masuk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah (Qty)</th>
                                    <th>Harga Beli</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @forelse($incomingGood->incomingGoodDetails as $detail)
                                    @php 
                                        $subTotal = $detail->quantity * $detail->purchase_price; 
                                        $grandTotal += $subTotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge bg-secondary">{{ $detail->product->product_code ?? '-' }}</span></td>
                                        <td>{{ $detail->product->product_name ?? 'Produk Terhapus' }}</td>
                                        <td>{{ $detail->quantity }} {{ $detail->product->unit->name ?? '' }}</td>
                                        <td>Rp {{ number_format($detail->purchase_price, 0, ',', '.') }}</td>
                                        <td class="fw-semibold text-end">Rp {{ number_format($subTotal, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Tidak ada detail produk untuk transaksi ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($incomingGood->incomingGoodDetails->isNotEmpty())
                            <tfoot>
                                <tr class="table-light">
                                    <th colspan="5" class="text-end fw-bold">Grand Total Transaksi :</th>
                                    <th class="text-end fw-bold text-success text-nowrap">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection