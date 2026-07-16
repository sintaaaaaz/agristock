<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingGood;
use App\Models\OutgoingGood;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil filter tanggal jika ada (default 30 hari terakhir)
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        // Statistik Master Data
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $lowStockProducts = Product::whereRaw('stock <= minimum_stock')->count();

        // Rekapitulasi Transaksi Berdasarkan Filter Tanggal
        $incomingGoods = IncomingGood::with(['supplier', 'incomingGoodDetails'])
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->latest()
            ->get();

        $outgoingGoods = OutgoingGood::with(['outgoingGoodDetails'])
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->latest()
            ->get();

        return view('backend.reports.index', compact(
            'totalProducts',
            'totalSuppliers',
            'lowStockProducts',
            'incomingGoods',
            'outgoingGoods',
            'startDate',
            'endDate'
        ));
    }
}