@extends('layouts.backend')


@section('content')

<div class="container-fluid">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">
            Manajemen Produk
        </h3>


        <a href="{{ route('products.create') }}"
            class="btn btn-success">

            <i class="fa-solid fa-plus"></i>
            Tambah Produk

        </a>

    </div>



    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif




    <div class="card shadow-sm">


        <div class="card-body">


            <div class="table-responsive">


                <table class="table table-bordered table-hover align-middle">


                    <thead class="table-success">

                        <tr>

                            <th width="50">
                                No
                            </th>


                            <th width="80">
                                Gambar
                            </th>


                            <th>
                                Kode Produk
                            </th>


                            <th>
                                Nama Produk
                            </th>


                            <th>
                                Kategori
                            </th>


                            <th>
                                Satuan
                            </th>


                            <th>
                                Harga Beli
                            </th>


                            <th>
                                Stok
                            </th>

                            <th width="150">
                                Aksi
                            </th>


                        </tr>

                    </thead>



                    <tbody>


                    @forelse($products as $product)


                        <tr>


                            <td>
                                {{ $loop->iteration }}
                            </td>



                            <td>


                                @if($product->image)

                                    <img src="{{ asset('uploads/products/'.$product->image) }}"
                                    width="60"
                                    height="60"
                                    class="rounded"
                                    style="object-fit:cover;">


                                @else

                                    <span class="text-muted">
                                        Tidak ada
                                    </span>


                                @endif


                            </td>




                            <td>
                                {{ $product->product_code }}
                            </td>




                            <td>
                                {{ $product->product_name }}
                            </td>



                            <td>

                                {{ $product->category->category_name ?? '-' }}

                            </td>




                            <td>
    {{ $product->unit->name ?? '-' }}
</td>




                            <td>

                                Rp {{ number_format($product->purchase_price,0,',','.') }}

                            </td>




                            <td>


                                @if($product->stock <= $product->minimum_stock)

                                    <span class="badge bg-danger">

                                        {{ $product->stock }}

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        {{ $product->stock }}

                                    </span>


                                @endif


                            </td>


                            <td>

    <div class="d-flex gap-2">


        <a href="{{ route('products.edit',$product->id) }}"
        class="btn btn-warning px-3">

            <i class="fa-solid fa-pen me-1"></i>
            Edit

        </a>



        <form action="{{ route('products.destroy',$product->id) }}"
        method="POST">


            @csrf
            @method('DELETE')


            <button type="submit"
            class="btn btn-danger px-3"
            onclick="return confirm('Yakin ingin menghapus produk ini?')">

                <i class="fa-solid fa-trash me-1"></i>
                Hapus

            </button>


        </form>


    </div>

</td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="10"
                            class="text-center text-muted">

                                Belum ada data produk

                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>


            </div>


        </div>


    </div>


</div>


@endsection