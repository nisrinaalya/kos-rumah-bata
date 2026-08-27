<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Kos Rumah Bata</title>
    <style>
        body { font-family: sans-serif; color: #211713; font-size: 12px; line-height: 1.5; }

        /* PENGATURAN HEADER DENGAN LOGO */
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #ead6ce;
            padding-bottom: 15px;
            width: 100%;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-logo {
            width: 80px; /* Atur lebar kotak logo */
            vertical-align: middle;
        }
        .header-text {
            text-align: left;
            padding-left: 15px;
            vertical-align: middle;
        }
        .header h2 { margin: 0; color: #c8664a; font-size: 22px; }
        .header p { margin: 5px 0 0; color: #86766f; font-size: 13px; }

        .summary-table { width: 100%; margin-bottom: 25px; border-collapse: collapse; }
        .summary-table td { padding: 8px; border: 1px solid #ead6ce; }
        .summary-table tr:nth-child(even) { background: #fbf5f1; }
        .bold { font-weight: bold; }

        /* PENGATURAN LEBAR TABEL UTAMA */
        .table-transaksi { width: 100%; border-collapse: collapse; margin-top: 15px; table-layout: fixed; }
        .table-transaksi th, .table-transaksi td { border: 1px solid #ead6ce; padding: 10px; text-align: left; word-wrap: break-word; }
        .table-transaksi th { background-color: #fbf5f1; color: #7a5d52; }

        /* ALOKASI LEBAR KOLOM AGAR NOMINAL MENDAPAT RUANG CUKUP */
        .col-tanggal { width: 15%; }
        .col-jenis { width: 15%; }
        .col-nama { width: 25%; }
        .col-deskripsi { width: 25%; }
        .col-nominal { width: 20%; white-space: nowrap; text-align: right; }

        .text-pemasukan { color: #2e7d32; font-weight: bold; }
        .text-pengeluaran { color: #c62828; font-weight: bold; }
        .right { text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    @if(file_exists(public_path('logo.png')))
                        <img src="{{ public_path('logo.png') }}" style="width: 80px; height: auto;">
                    @else
                        <div style="width: 80px; height: 80px; background: #f4ddd4; border-radius: 10px;"></div>
                    @endif
                </td>
                <td class="header-text">
                    <h2>Laporan Keuangan Kos Rumah Bata</h2>
                    <p>Periode Rekap: <strong>{{ $periodeAktif }}</strong></p>
                </td>
            </tr>
        </table>
    </div>

    <h3>Ringkasan Keuangan</h3>
    <table class="summary-table">
        <tr>
            <td class="bold">Total Pendapatan (Pemasukan)</td>
            <td class="right text-pemasukan">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="bold">Total Pengeluaran (Biaya/Operational)</td>
            <td class="right text-pengeluaran">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="bold">Selisih Bersih (Net Profit)</td>
            <td class="right" style="font-weight: bold;">
                {{ $selisihBersih < 0 ? '-' : '' }} Rp {{ number_format(abs($selisihBersih), 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <h3>Rincian Semua Transaksi</h3>
    <table class="table-transaksi">
        <thead>
            <tr>
                <th class="col-tanggal">Tanggal</th>
                <th class="col-jenis">Jenis</th>
                <th class="col-nama">Nama Transaksi</th>
                <th class="col-deskripsi">Deskripsi</th>
                <th class="col-nominal" style="text-align: right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @if(count($transaksi) > 0)
                @foreach($transaksi as $t)
                    <tr>
                        <td>{{ date('d M Y', strtotime($t->tanggal_bayar)) }}</td>
                        <td>{{ ucfirst($t->jenis) }}</td>
                        <td><strong>{{ $t->nama }}</strong></td>
                        <td>{{ $t->deskripsi ?? '-' }}</td>
                        <td class="col-nominal {{ $t->jenis == 'pemasukan' ? 'text-pemasukan' : 'text-pengeluaran' }}">
                            {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center; color: #86766f; padding: 20px;">
                        Tidak ada transaksi yang tercatat pada periode ini.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
