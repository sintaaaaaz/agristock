<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    // 1. Ambil data riwayat transaksi untuk tabel khusus milik user yang login
    if (Auth::user()->role_id == 2) {
        $incomingGoods = IncomingGood::with(['supplier', 'incomingGoodDetails.product'])
            ->where('user_id', Auth::id()) 
            ->latest()
            ->get();
    } else {
        $incomingGoods = IncomingGood::with(['supplier', 'incomingGoodDetails.product'])
            ->latest()
            ->get();
    }

    // 2. Logika hitung grafik tren untuk Admin
    $dataBarangMasuk = IncomingGood::select(
        DB::raw("COUNT(id) as total"),
        DB::raw("DATE_FORMAT(transaction_date, '%M') as bulan")
    )
    ->whereYear('transaction_date', date('Y'))
    ->groupBy(DB::raw("MONTH(transaction_date)"), DB::raw("DATE_FORMAT(transaction_date, '%M')"))
    ->orderBy(DB::raw("MONTH(transaction_date)"), 'asc')
    ->get();

    $labels = [];
    $totals = [];
    foreach ($dataBarangMasuk as $data) {
        $labels[] = $data->bulan;
        $totals[] = (int) $data->total;
    }

    // 3. Kirimkan variabel ke View
    return view('backend.dashboard.index', compact('incomingGoods', 'labels', 'totals'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $suppliers = \App\Models\Supplier::all();

    $products = \App\Models\Product::with('unit')
        ->get();


    return view(
        'backend.user.create',
        compact(
            'suppliers',
            'products'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
