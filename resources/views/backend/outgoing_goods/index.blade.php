@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Barang Keluar</h3>
        <a href="{{ route('outgoing-goods.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Tambah Barang Keluar
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th width="50">No</th>
                            <th>No Transaksi</th>
                            <th>Tujuan Distribusi</th>
                            <th>Tanggal Keluar</th>
                            <th>Keterangan</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($outgoingGoods as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="fw-bold text-danger">{{ $item->transaction_code }}</span></td>
                            <td>{{ $item->purpose }}</td>
                            <td>{{ $item->transaction_date ? $item->transaction_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $item->note ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('outgoing-goods.show', $item->id) }}" class="btn btn-info btn-sm text-white px-2">
                                        <i class="fa-solid fa-eye me-1"></i> Detail
                                    </a>
                                    <form action="{{ route('outgoing-goods.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-2" onclick="return confirm('Hapus transaksi ini? Stok gudang akan otomatis dikembalikan.')">
                                            <i class="fa-solid fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Belum ada data barang keluar</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection