<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingGood;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dataBarangMasuk = IncomingGood::select(
            DB::raw("SUM(jumlah_masuk) as total"),
            DB::raw("MONTHNAME(created_at) as bulan")
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
        ->orderBy(DB::raw("MONTH(created_at)"))
        ->get();

        $labels = [];
        $totals = [];

        foreach ($dataBarangMasuk as $data) {
            $labels[] = $data->bulan;
            $totals[] = $data->total;
        }

        return view('backend.dashboard', compact('labels', 'totals'));
    }
}
