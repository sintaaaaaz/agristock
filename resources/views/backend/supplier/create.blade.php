@extends('layouts.backend')

@section('content')
    <h3>Tambah Supplier</h3>

    <form action="{{ route('suppliers.store') }}" method="POST">

        @csrf


        <div class="mb-3">

            <label>
                Nama Supplier
            </label>

            <input type="text" name="supplier_name" class="form-control">

        </div>


        <div class="mb-3">

            <label>
                Nomor Telepon
            </label>

            <input type="text" name="phone" class="form-control">

        </div>


        <div class="mb-3">

            <label>
                Email
            </label>

            <input type="email" name="email" class="form-control">

        </div>


        <div class="mb-3">

            <label>
                Alamat
            </label>

            <textarea name="address" class="form-control"></textarea>

        </div>


        <button class="btn btn-success">
            Simpan
        </button>


    </form>
@endsection
