@extends('layouts.backend')


@section('content')
    <div class="container-fluid">


        <h2 class="mb-4">
            Manajemen Supplier
        </h2>

        {{-- Notifikasi Jika Berhasil --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- ================= TAMBAHKAN BLOK NOTIFIKASI GAGAL DI SINI ================= --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- =========================================================================== --}}


        <div class="card shadow-sm">

            <div class="card-body">


                <div class="d-flex justify-content-between mb-3">

                    <h4>Daftar Supplier</h4>


                    <a href="{{ route('suppliers.create') }}" class="btn btn-success">

                        + Tambah Supplier

                    </a>

                </div>


                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>


                        @foreach ($suppliers as $supplier)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $supplier->supplier_name }}
                                </td>


                                <td>
                                    {{ $supplier->email }}
                                </td>


                                <td>
                                    {{ $supplier->phone }}
                                </td>


                                <td>
                                    {{ $supplier->address }}
                                </td>


                                <td>


                                    <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                        class="btn btn-outline-success btn-sm">

                                        Edit

                                    </a>


                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Hapus supplier?')">

                                            Hapus

                                        </button>

                                    </form>


                                </td>

                            </tr>
                        @endforeach


                    </tbody>


                </table>


            </div>

        </div>


    </div>
@endsection
