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

       // --- 1. Ambil Data Barang Masuk Harian (Bulan Berjalan) ---
$dataBarangMasuk = IncomingGood::join('incoming_good_details', 'incoming_goods.id', '=', 'incoming_good_details.incoming_good_id')
    ->select(
        DB::raw('DAY(incoming_goods.transaction_date) as hari'),
        DB::raw('SUM(incoming_good_details.quantity) as total')
    )
    ->whereMonth('incoming_goods.transaction_date', date('m')) // Filter bulan sekarang
    ->whereYear('incoming_goods.transaction_date', date('Y')) // Filter tahun sekarang
    ->groupBy(DB::raw("DAY(incoming_goods.transaction_date)"))
    ->orderBy(DB::raw("DAY(incoming_goods.transaction_date)"), 'asc')
    ->pluck('total', 'hari')
    ->toArray();

// --- 2. Ambil Data Barang Keluar Harian (Bulan Berjalan) ---
$dataBarangKeluar = OutgoingGood::join('outgoing_good_details', 'outgoing_goods.id', '=', 'outgoing_good_details.outgoing_good_id')
    ->select(
        DB::raw('DAY(outgoing_goods.transaction_date) as hari'),
        DB::raw('SUM(outgoing_good_details.quantity) as total')
    )
    ->whereMonth('outgoing_goods.transaction_date', date('m'))
    ->whereYear('outgoing_goods.transaction_date', date('Y'))
    ->groupBy(DB::raw("DAY(outgoing_goods.transaction_date)"))
    ->orderBy(DB::raw("DAY(outgoing_goods.transaction_date)"), 'asc')
    ->pluck('total', 'hari')
    ->toArray();

// --- 3. Siapkan Label Tanggal 1 s.d. Akhir Bulan ---
$jumlahHari = date('t'); // Mendapatkan total hari dalam bulan ini (misal 31)
$labels = range(1, $jumlahHari); 

$totalsIn = [];
$totalsOut = [];
foreach ($labels as $hari) {
    $totalsIn[] = isset($dataBarangMasuk[$hari]) ? (int) $dataBarangMasuk[$hari] : 0;
    $totalsOut[] = isset($dataBarangKeluar[$hari]) ? (int) $dataBarangKeluar[$hari] : 0;
}

        // --- 5. Kirimkan Variabel Baru ke View ---
        return view('backend.dashboard.index', compact(
            'incomingGoods', 
            'labels',       // Label bulan Jan - Des
            'totalsIn',     // Data Qty Masuk per bulan
            'totalsOut'     // Data Qty Keluar per bulan
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
