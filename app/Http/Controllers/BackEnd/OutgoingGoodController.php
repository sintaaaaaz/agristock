<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OutgoingGood;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutgoingGoodController extends Controller
{
    public function index()
    {
        $outgoingGoods = OutgoingGood::latest()->get();
        return view('backend.outgoing_goods.index', compact('outgoingGoods'));
    }

    public function create()
    {
        $products = Product::with('unit')->where('stock', '>', 0)->get();
        return view('backend.outgoing_goods.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|unique:outgoing_goods,transaction_code',
            'transaction_date' => 'required|date',
            'purpose'          => 'required|max:50',
            'product_id'       => 'required',
            'quantity'         => 'required|integer|min:1',
        ]);

        // Cek apakah stok produk mencukupi sebelum transaksi diproses
        $product = Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return back()->withInput()->withErrors(['quantity' => 'Stok tidak mencukupi! Stok saat ini: ' . $product->stock]);
        }

        DB::transaction(function () use ($request) {
            // 1. Simpan data induk barang keluar
            $outgoing = OutgoingGood::create([
                'transaction_code' => $request->transaction_code,
                'transaction_date' => $request->transaction_date,
                'purpose'          => $request->purpose,
                'note'             => $request->note,
            ]);

            // 2. Simpan ke detail barang keluar
            $outgoing->outgoingGoodDetails()->create([
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
            ]);

            // 3. Potong stok produk di gudang
            Product::where('id', $request->product_id)
                ->decrement('stock', $request->quantity);
        });

        return redirect()
            ->route('outgoing-goods.index')
            ->with('success', 'Transaksi barang keluar berhasil dicatat.');
    }

    public function show(string $id)
    {
        $outgoingGood = OutgoingGood::with(['outgoingGoodDetails.product.unit'])->findOrFail($id);
        return view('backend.outgoing_goods.show', compact('outgoingGood'));
    }

    public function destroy(OutgoingGood $outgoingGood)
    {
        DB::transaction(function () use ($outgoingGood) {
            // Kembalikan stok produk sebelum transaksi dihapus
            foreach ($outgoingGood->outgoingGoodDetails as $detail) {
                Product::where('id', $detail->product_id)
                    ->increment('stock', $detail->quantity);
            }
            $outgoingGood->delete();
        });

        return redirect()
            ->route('outgoing-goods.index')
            ->with('success', 'Data transaksi berhasil dihapus dan stok dikembalikan.');
    }
}