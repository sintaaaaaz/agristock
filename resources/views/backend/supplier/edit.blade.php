@extends('layouts.backend')


@section('content')
    <div class="container-fluid">


        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold">
                Edit Supplier
            </h3>


            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>



        <div class="card shadow-sm">

            <div class="card-body">


                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">

                    @csrf
                    @method('PUT')


                    <div class="mb-3">

                        <label class="form-label">
                            Nama Supplier
                        </label>


                        <input type="text" name="supplier_name" class="form-control"
                            value="{{ old('supplier_name', $supplier->supplier_name) }}">


                        @error('supplier_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror


                    </div>



                    <div class="mb-3">

                        <label class="form-label">
                            Nomor Telepon
                        </label>


                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $supplier->phone) }}">


                        @error('phone')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror


                    </div>




                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>


                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $supplier->email) }}">


                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror


                    </div>




                    <div class="mb-3">

                        <label class="form-label">
                            Alamat
                        </label>


                        <textarea name="address" class="form-control" rows="4">{{ old('address', $supplier->address) }}</textarea>


                        @error('address')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror


                    </div>




                    <button type="submit" class="btn btn-success">

                        Update Supplier

                    </button>


                </form>


            </div>

        </div>


    </div>
@endsection
