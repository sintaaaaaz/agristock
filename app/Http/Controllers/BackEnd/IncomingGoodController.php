<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\IncomingGood;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IncomingGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Jika yang login adalah USER BIASA (Role 2), TAMPILKAN HANYA BARANG YANG DIA UPLOAD
    if (Auth::user()->role_id == 2) {
        $incomingGoods = IncomingGood::with(['supplier', 'incomingGoodDetails.product'])
            ->where('user_id', Auth::id()) // Memfilter berdasarkan id user yang sedang login
            ->latest()
            ->get();
    } 
    // Jika yang login adalah ADMIN (Role 1), TAMPILKAN SEMUA BARANG DARI SEMUA USER
    else {
        $incomingGoods = IncomingGood::with(['supplier', 'incomingGoodDetails.product'])
            ->latest()
            ->get();
    }

    return view('backend.incoming_goods.index', compact('incomingGoods'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();
         $units = Unit::all();

         return view('backend.user.create', compact('categories', 'units'));
       
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
        'purchase_price'   => 'required|numeric|min:0',
        'image'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
    ]);

    // 1. OTOMATISASI SUPPLIER
    $supplier = Supplier::firstOrCreate(
        ['supplier_name' => $request->supplier_name],
        [
            'phone'   => '-',
            'email'   => Auth::user()->email,
            'address' => 'Pemasok Mandiri Aplikasi'
        ]
    );

    // Proses upload gambar produk jika user memilih file gambar
    $imageName = null;
    if ($request->hasFile('image')) {
        // Membuat nama file unik seperti di ProductController
        $imageName = time() . '.' . $request->image->extension();
        
        // Memindahkan file langsung ke folder public/uploads/products
        $request->image->move(
            public_path('uploads/products'),
            $imageName
        );
    }

    // 2. OTOMATISASI PRODUK (Gambar dan harga beli sekarang dinamis dimasukkan ke data Produk)
   $product = Product::firstOrCreate(
        [
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
        ],
        [
            'product_code'   => 'PRD-' . strtoupper(str()->random(5)),
            'unit_id'        => $request->unit_id,
            'purchase_price' => $request->purchase_price,
            'stock'          => 0,
            'minimum_stock'  => 5,
            'image'          => $imageName, // <-- Menyimpan nama file saja (bukan path storage)
            'description'    => $request->note ?? 'Diinput otomatis oleh user'
        ]
    );

    // 3. GENERATE KODE TRANSAKSI OTOMATIS
    $lastTrx = IncomingGood::orderBy('id', 'desc')->first();
    $nextNumber = $lastTrx ? ((int) substr($lastTrx->transaction_code, 3)) + 1 : 1;
    $transactionCode = 'BM-' . sprintf('%02d', $nextNumber);

    // 4. SIMPAN MASTER TRANSAKSI BARANG MASUK (Menyimpan note/keterangan transaksi jika ada)
    $incomingGood = IncomingGood::create([
        'transaction_code' => $transactionCode,
        'supplier_id'      => $supplier->id,
        'user_id'          => Auth::id(),
        'transaction_date' => $request->transaction_date,
        'note'             => $request->note, // Menyimpan catatan masukan ke kolom headers
    ]);

    // 5. SIMPAN DETAIL TRANSAKSI BARANG MASUK
    $incomingGood->incomingGoodDetails()->create([
        'product_id'     => $product->id,
        'quantity'       => $request->quantity,
        'purchase_price' => $request->purchase_price, // Menyimpan riwayat harga beli transaksi ini
    ]);

    // 6. UPDATE STOK PRODUK DI GUDANG UTAMA ADMIN
    $product->increment('stock', $request->quantity);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Barang hasil tani berhasil disetor, gambar ter-upload, dan tercatat otomatis!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incomingGood = IncomingGood::with([
        'supplier', 
        'user', 
        'incomingGoodDetails.product.unit'
    ])->findOrFail($id);

    // Mengirimkan variabel ke view show yang sudah kita buat
    return view('backend.incoming_goods.show', compact('incomingGood'));
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
