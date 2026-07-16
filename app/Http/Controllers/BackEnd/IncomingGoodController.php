<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\IncomingGood;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomingGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingGoods = IncomingGood::with(['supplier','user'])
        ->latest()
        ->get();

        return view(
            'backend.incoming_goods.index',
            compact('incomingGoods')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();
         $units = Unit::all();

         return view('backend.incoming_goods.create', compact('categories', 'units'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $request->validate([
        'transaction_date' => 'required|date',
        'category_id'      => 'required',
        'unit_id'          => 'required',
        'product_name'     => 'required|string|max:255',
        'quantity'         => 'required|numeric|min:1',
    ]);

    // 1. OTOMATISASI SUPPLIER (Disesuaikan dengan kolom 'supplier_name')
    $supplier = Supplier::firstOrCreate(
        ['supplier_name' => $request->supplier_name], // Menggunakan nama kolom asli kamu
        [
            'phone'   => '-',
            'email'   => Auth::user()->email, // Otomatis mengambil email user yang login
            'address' => 'Pemasok Mandiri Aplikasi'
        ]
    );

    // 2. OTOMATISASI PRODUK (Menggunakan global helper str() agar TIDAK MERAH)
    $product = Product::firstOrCreate(
        [
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
        ],
        [
            'product_code'   => 'PRD-' . strtoupper(str()->random(5)), // Bersih tanpa garis merah
            'unit_id'        => $request->unit_id,
            'purchase_price' => 0, // Mengisi nilai default agar tidak error null
            'stock'          => 0,
            'minimum_stock'  => 5, // Standar stok minimum
            'description'    => 'Diinput otomatis oleh user'
        ]
    );

    // 3. GENERATE KODE TRANSAKSI OTOMATIS (BM-01, BM-02, dst)
    $lastTrx = IncomingGood::orderBy('id', 'desc')->first();
    $nextNumber = $lastTrx ? ((int) substr($lastTrx->transaction_code, 3)) + 1 : 1;
    $transactionCode = 'BM-' . sprintf('%02d', $nextNumber);

    // 4. SIMPAN MASTER TRANSAKSI BARANG MASUK
    $incomingGood = IncomingGood::create([
        'transaction_code' => $transactionCode,
        'supplier_id'      => $supplier->id,
        'user_id'          => Auth::id(),
        'transaction_date' => $request->transaction_date,
    ]);

    // 5. SIMPAN DETAIL TRANSAKSI BARANG MASUK
    // Pastikan nama relasi di model IncomingGood kamu adalah 'incomingGoodDetails'
    $incomingGood->incomingGoodDetails()->create([
        'product_id'     => $product->id,
        'quantity'       => $request->quantity,
        'purchase_price' => 0, 
    ]);

    // 6. UPDATE STOK PRODUK DI GUDANG UTAMA ADMIN
    $product->increment('stock', $request->quantity);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Barang hasil tani berhasil disetor dan tercatat otomatis!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingGood $incomingGood)
    {
        $incomingGood->delete();


        return redirect()
            ->route('incoming-goods.index')
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }
}
