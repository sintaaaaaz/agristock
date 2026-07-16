@extends('layouts.backend')

@section('content')

<div class="container">

<h3>
Input Barang Masuk
</h3>


<form action="{{ route('incoming-goods.store') }}"
method="POST">

@csrf


<div class="mb-3">
<label>Kode Transaksi</label>

<input type="text"
name="transaction_code"
class="form-control">

</div>


<div class="mb-3">

<label>Supplier</label>

<select name="supplier_id"
class="form-control">

@foreach($suppliers as $supplier)

<option value="{{ $supplier->id }}">
{{ $supplier->name }}
</option>

@endforeach

</select>

</div>



<div class="mb-3">

<label>Tanggal</label>

<input type="date"
name="transaction_date"
class="form-control">

</div>



<div class="mb-3">

<label>Produk</label>

<select name="product_id"
class="form-control">

@foreach($products as $product)

<option value="{{ $product->id }}">
{{ $product->name }}
</option>

@endforeach

</select>

</div>



<div class="mb-3">

<label>Jumlah</label>

<input type="number"
name="quantity"
class="form-control">

</div>


<div class="mb-3">

<label>Harga Beli</label>

<input type="number"
name="purchase_price"
class="form-control">

</div>


<button class="btn btn-primary">
Simpan
</button>


</form>

</div>

@endsection