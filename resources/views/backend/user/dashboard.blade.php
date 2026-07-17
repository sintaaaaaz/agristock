@extends('layouts.backend')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <!-- Dinamis mengikuti role -->
                <h3 class="fw-bold">
                    {{ Auth::user()->role_id == 1 ? 'Dashboard Admin' : 'Dashboard User' }}
                </h3>

                <p class="text-muted">
                    Selamat datang,
                    <b>{{ Auth::user()->name }}</b>
                </p>
            </div>

            <!-- Tombol Input Barang hanya muncul untuk User Biasa -->
            @if (Auth::user()->role_id == 2)
                <a href="{{ route('user.input') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i>
                    Input Barang
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Statistik --}}
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Transaksi</h6>
                        <h2 class="fw-bold">{{ $incomingGoods->count() }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Barang Yang Diinput</h6>
                        <h2 class="fw-bold">
                            {{ $incomingGoods->sum(function ($item) {
                                return $item->incomingGoodDetails->sum('quantity');
                            }) }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Status</h6>
                        <h4 class="text-success">Aktif</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PANUTAN GRAFIK DISISIPKAN DI SINI ================= --}}
        @if (Auth::user()->role_id == 1)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white border-0 pt-3">
                            <h5 class="card-title fw-bold text-dark mb-0">
                                📈 Grafik Tren Aktivitas Barang Masuk (Tahun Ini)
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Wadah Grafik -->
                            <canvas id="chartBarangMasuk" style="max-height: 320px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- ===================================================================== --}}

        {{-- Riwayat --}}
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Riwayat Input Barang</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incomingGoods as $key=>$item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->transaction_code }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->transaction_date)->format('d-m-Y') }}
                                    </td>
                                    <!-- PERBAIKAN: Menggunakan supplier_name sesuai kolom asli di DB -->
                                    <td>{{ $item->supplier->supplier_name ?? 'Tanpa Nama' }}</td>
                                    <td>
                                        <span class="badge bg-success">Berhasil</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data barang masuk</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Script untuk memproses Chart.js --}}
    @if (Auth::user()->role_id == 1)
        <!-- Load Library Chart.js via CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Ambil data array dari compact controller
            const labelBulan = {!! json_encode($labels ?? []) !!};
            const totalBarang = {!! json_encode($totals ?? []) !!};

            const ctx = document.getElementById('chartBarangMasuk').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelBulan.length ? labelBulan : ['Belum Ada Data'],
                    datasets: [{
                        label: 'Total Aktivitas Barang Masuk',
                        data: totalBarang.length ? totalBarang : [0],
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 2,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        </script>
    @endif
@endsection
