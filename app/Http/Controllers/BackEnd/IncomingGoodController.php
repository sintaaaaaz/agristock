<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingGood;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
         $suppliers = Supplier::all();

        $products = Product::with('unit')
            ->get();


        return view(
            'backend.incoming_goods.create',
            compact('suppliers','products')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

           'supplier_id'      => 'required',
        'transaction_code' => 'required|unique:incoming_goods,transaction_code', // Tambahkan ini
        'transaction_date' => 'required|date',                                   // Ubah dari 'date'
        'product_id'       => 'required',
        'quantity'         => 'required|integer|min:1',
        'purchase_price'   => 'required|numeric'

        ]);

         DB::transaction(function() use ($request){


            $incoming = IncomingGood::create([

                'supplier_id'      => $request->supplier_id,
                'user_id'          => Auth::id(),
            'transaction_code' => $request->transaction_code, // Tambahkan ini
            'transaction_date' => $request->transaction_date, 
            'note'             => $request->note

            ]);

            $incoming->incomingGoodDetails()->create([
        'product_id'=>$request->product_id,
        'quantity'=>$request->quantity,
        'purchase_price'=>$request->purchase_price
    ]);



            Product::where('id',$request->product_id)
                ->increment(
                    'stock',
                    $request->quantity
                );


        });

        return redirect()
            ->route('incoming-goods.index')
            ->with(
                'success',
                'Barang masuk berhasil ditambahkan'
            );
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
