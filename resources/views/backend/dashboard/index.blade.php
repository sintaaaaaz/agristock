@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark">
                {{ Auth::user()->role_id == 1 ? 'Dashboard Admin' : 'Dashboard User' }}
            </h3>
            <p class="text-muted">
                Selamat datang di AgriStock, <b>{{ Auth::user()->name }}</b> 👋
            </p>
        </div>

        @if(Auth::user()->role_id == 2)
            <a href="{{ route('user.input') }}" class="btn btn-success rounded-3 shadow-sm">
                <i class="fa-solid fa-plus-circle me-1"></i> Input Barang
            </a>
        @endif
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-check-circle me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 rounded-3">
                <div class="card-body p-4">
                    <h6 class="text-muted fw-semibold uppercase small">Total Transaksi Masuk</h6>
                    <h2 class="fw-bold text-success mb-0 mt-2">{{ $incomingGoods->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 rounded-3">
                <div class="card-body p-4">
                    <h6 class="text-muted fw-semibold uppercase small">Barang Yang Diinput (Qty)</h6>
                    <h2 class="fw-bold text-dark mb-0 mt-2">
                        {{ 
                          $incomingGoods->sum(function($item){
                              return $item->incomingGoodDetails->sum('quantity');
                          })
                        }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 rounded-3">
                <div class="card-body p-4">
                    <h6 class="text-muted fw-semibold uppercase small">Status Akun</h6>
                    <h4 class="text-success fw-bold mb-0 mt-2">
                        <i class="fa-solid fa-circle-check me-1 small"></i> Aktif
                    </h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Tren --}}
@if(Auth::user()->role_id == 1)
    <div class="row mt-4">
        <!-- Grafik Barang Masuk -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title fw-bold text-success mb-0">
                        📈 Tren Barang Masuk (Tahun Ini)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="chartBarangMasuk" style="max-height: 280px; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Barang Keluar (BARU TAMBAH) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title fw-bold text-danger mb-0">
                        📉 Tren Barang Keluar (Tahun Ini)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="chartBarangKeluar" style="max-height: 280px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endif

   {{-- Grup Baris Riwayat Tabel Berdampingan --}}
    <div class="row mt-4">
        
        {{-- 1. Tabel Riwayat Barang Masuk --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                    <h5 class="mb-0 fw-bold text-dark">📋 Riwayat Input Barang</h5>
                    
                    @if(Auth::user()->role_id == 1)
                        <div>
                            <a href="{{ route('dashboard.pdf') }}" class="btn btn-danger btn-sm rounded-3 me-1 px-3">
                                <i class="fa-solid fa-file-pdf me-1"></i> PDF
                            </a>
                        
                        </div>
                    @endif
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4">No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($incomingGoods as $key => $item)
                                <tr>
                                    <td class="px-4 text-muted">{{ $key + 1 }}</td>
                                    <td class="fw-semibold text-success">{{ $item->transaction_code }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->transaction_date)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $item->supplier->supplier_name ?? 'Tanpa Nama' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5">
                                            Berhasil
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-inbox d-block fs-3 mb-2"></i> Belum ada data transaksi barang masuk
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Tabel Riwayat Barang Keluar --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                    <h5 class="mb-0 fw-bold text-dark">📋 Riwayat Barang Keluar</h5>
                    
                    @if(Auth::user()->role_id == 1)
                        <div>
                            <a href="{{ route('dashboard.outgoing.pdf') }}" class="btn btn-danger btn-sm rounded-3 me-1 px-3">
                                <i class="fa-solid fa-file-pdf me-1"></i> PDF
                            </a>
                
                        </div>
                    @endif
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-3">No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Supplier / Tujuan</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($outgoingGoods ?? [] as $key => $item)
                                <tr>
                                    <td class="px-3 text-muted">{{ $key + 1 }}</td>
                                    <td class="fw-semibold text-danger">{{ $item->transaction_code }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->transaction_date)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $item->purpose ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1.5" style="font-size: 12px;">
                                            Keluar
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-inbox d-block fs-3 mb-2"></i> Belum ada data transaksi barang keluar
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- Penutup tag row agar grid terbagi rata --}}

{{-- Script Chart --}}
@if(Auth::user()->role_id == 1)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- 1. Konfigurasi Chart Barang Masuk (Hijau) ---
        const labelIn = {!! json_encode($labelsIn ?? []) !!};
        const totalIn = {!! json_encode($totalsIn ?? []) !!};

        const ctxIn = document.getElementById('chartBarangMasuk').getContext('2d');
        new Chart(ctxIn, {
            type: 'line',
            data: {
                labels: labelIn.length ? labelIn : ['Belum Ada Data'],
                datasets: [{
                    label: 'Transaksi Masuk',
                    data: totalIn.length ? totalIn : [0],
                    backgroundColor: 'rgba(40, 167, 69, 0.15)', 
                    borderColor: 'rgba(40, 167, 69, 1)',     
                    borderWidth: 3,
                    tension: 0.25,
                    fill: true
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // --- 2. Konfigurasi Chart Barang Keluar (Merah - BARU TAMBAH) ---
        const labelOut = {!! json_encode($labelsOut ?? []) !!};
        const totalOut = {!! json_encode($totalsOut ?? []) !!};

        const ctxOut = document.getElementById('chartBarangKeluar').getContext('2d');
        new Chart(ctxOut, {
            type: 'line',
            data: {
                labels: labelOut.length ? labelOut : ['Belum Ada Data'],
                datasets: [{
                    label: 'Transaksi Keluar',
                    data: totalOut.length ? totalOut : [0],
                    backgroundColor: 'rgba(220, 53, 69, 0.15)', 
                    borderColor: 'rgba(220, 53, 69, 1)',     
                    borderWidth: 3,
                    tension: 0.25,
                    fill: true
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
@endif
@endsection