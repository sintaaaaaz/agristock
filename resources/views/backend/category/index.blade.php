@extends('layouts.backend')

@section('content')
    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

            <h4>Data Kategori</h4>

            <a href="{{ route('categories.create') }}" class="btn btn-success">

                + Tambah Kategori

            </a>

        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Kategori</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $category->category_name }}</td>

                            <td>

                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')


                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                                        <i class="fa-solid fa-trash"></i>
                                        Hapus

                                    </button>


                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                Belum ada data.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection
