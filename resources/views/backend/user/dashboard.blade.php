@extends('layouts.backend')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold">
                Dashboard User
            </h3>

            <p class="text-muted">
                Selamat datang,
                <b>{{ Auth::user()->name }}</b>
            </p>
        </div>


        <a href="{{ route('user.input') }}"
           class="btn btn-success">

            <i class="bi bi-plus-circle"></i>
            Input Barang

        </a>

    </div>



    {{-- Statistik --}}
    <div class="row">


        <div class="col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Transaksi
                    </h6>

                    <h2 class="fw-bold">
                        {{ $incomingGoods->count() }}
                    </h2>

                </div>

            </div>

        </div>



        <div class="col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">
                        Barang Yang Diinput
                    </h6>

                    <h2 class="fw-bold">

                        {{ 
                          $incomingGoods
                          ->sum(function($item){

                              return $item
                              ->incomingGoodDetails
                              ->sum('quantity');

                          })
                        }}

                    </h2>


                </div>

            </div>

        </div>



        <div class="col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">
                        Status
                    </h6>


                    <h4 class="text-success">

                        Aktif

                    </h4>


                </div>

            </div>

        </div>


    </div>



    {{-- Riwayat --}}
    <div class="card shadow-sm border-0 mt-4">


        <div class="card-header bg-white">

            <h5 class="mb-0">
                Riwayat Input Barang
            </h5>

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


                        </tr>

                    </thead>


                    <tbody>


                    @forelse($incomingGoods as $key=>$item)


                        <tr>


                            <td>
                                {{ $key+1 }}
                            </td>


                            <td>
                                {{ $item->transaction_code }}
                            </td>


                            <td>
                                {{ 
                                  $item->transaction_date
                                  ->format('d-m-Y')
                                }}
                            </td>


                            <td>
                                {{ 
                                  $item->supplier->name
                                }}
                            </td>


                            <td>

                                <span class="badge bg-success">
                                    Berhasil
                                </span>

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="5"
                                class="text-center">

                                Belum ada data barang masuk

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