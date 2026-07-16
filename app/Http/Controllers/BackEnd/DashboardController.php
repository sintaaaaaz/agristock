<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingGood;
use App\Models\OutgoingGood;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
   public function index()
    {
        // 1. Ambil data barang masuk untuk tabel & statistik
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

        // 2. Logika Grafik BARANG MASUK (Sudah Ada)
        $dataBarangMasuk = IncomingGood::select(
            DB::raw('COUNT(id) as total'),
            DB::raw("DATE_FORMAT(transaction_date, '%M') as bulan")
        )
        ->whereYear('transaction_date', date('Y'))
        ->groupBy(DB::raw("MONTH(transaction_date)"), DB::raw("DATE_FORMAT(transaction_date, '%M')"))
        ->orderBy(DB::raw("MONTH(transaction_date)"), 'asc')
        ->get();

        $labelsIn = [];
        $totalsIn = [];
        foreach ($dataBarangMasuk as $data) {
            $labelsIn[] = $data->bulan;
            $totalsIn[] = (int) $data->total;
        }

        // 3. TAMBAHKAN: Logika Grafik BARANG KELUAR 
        $dataBarangKeluar = OutgoingGood::select(
            DB::raw('COUNT(id) as total'),
            DB::raw("DATE_FORMAT(transaction_date, '%M') as bulan")
        )
        ->whereYear('transaction_date', date('Y'))
        ->groupBy(DB::raw("MONTH(transaction_date)"), DB::raw("DATE_FORMAT(transaction_date, '%M')"))
        ->orderBy(DB::raw("MONTH(transaction_date)"), 'asc')
        ->get();

        $labelsOut = [];
        $totalsOut = [];
        foreach ($dataBarangKeluar as $data) {
            $labelsOut[] = $data->bulan;
            $totalsOut[] = (int) $data->total;
        }

        // 4. Kirimkan semua variabel baru ke view dashboard
        return view('backend.dashboard.index', compact(
            'incomingGoods', 
            'labelsIn', 'totalsIn', 
            'labelsOut', 'totalsOut'
        ));
    }
    public function exportPdf()
{
    // 1. Ambil data transaksi barang masuk sama seperti di dashboard
    $incomingGoods = IncomingGood::with(['supplier', 'incomingGoodDetails.product'])
        ->latest()
        ->get();

    // 2. Arahkan ke file blade khusus cetak cetak
    $pdf = Pdf::loadView('backend.dashboard.incoming_good_pdf', compact('incomingGoods'));
    
    // 3. Download file PDF-nya
    return $pdf->download('Laporan_Barang_Masuk_' . date('d-m-Y') . '.pdf');
}

    public function exportOutgoingPdf()
{
    // Ambil semua data barang keluar beserta detail dan produknya
    $outgoingGoods = OutgoingGood::with(['outgoingGoodDetails.product.unit'])
        ->latest()
        ->get();

    $pdf = Pdf::loadView('backend.dashboard.outgoing_good_pdf', compact('outgoingGoods'));
    
    return $pdf->download('Laporan_Barang_Keluar_' . date('d-m-Y') . '.pdf');
}


}
