<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Keluar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #dc3545;
            color: white;
        }

        /* Warna Merah untuk Barang Keluar */
        .text-center {
            text-align: center;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="title">AGRISTOCK GUDANG HASIL TANI</div>
    <div class="text-center" style="margin-bottom: 20px;">Laporan Transaksi Barang Keluar</div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Tujuan Distribusi</th>
                <th>Daftar Barang Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($outgoingGoods as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->transaction_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('d-m-Y') }}</td>
                    <td>{{ $item->purpose }}</td>
                    <td>
                        @foreach ($item->outgoingGoodDetails as $detail)
                            {{ $detail->product->product_name ?? 'Produk Terhapus' }} ({{ $detail->quantity }}
                            {{ $detail->product->unit->name ?? '' }}),
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
