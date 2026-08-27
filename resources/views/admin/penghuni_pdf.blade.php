<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penghuni Kos Rumah Bata</title>
    <style>
        body { font-family: sans-serif; color: #211713; font-size: 10px; line-height: 1.5; }

        /* PENGATURAN HEADER DENGAN LOGO */
        .header {
            margin-bottom: 25px;
            border-bottom: 2px solid #ead6ce;
            padding-bottom: 15px;
            width: 100%;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-logo {
            width: 80px;
            vertical-align: middle;
        }
        .header-text {
            text-align: left;
            padding-left: 15px;
            vertical-align: middle;
        }
        .header h2 { margin: 0; color: #c8664a; font-size: 22px; }
        .header p { margin: 5px 0 0; color: #86766f; font-size: 13px; }

        .summary-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .summary-table td { padding: 8px; border: 1px solid #ead6ce; }
        .summary-table tr:nth-child(even) { background: #fbf5f1; }
        .bold { font-weight: bold; }

        /* PENGATURAN TABEL UTAMA */
        .table-penghuni { width: 100%; border-collapse: collapse; margin-top: 15px; table-layout: fixed; }
        .table-penghuni th, .table-penghuni td { border: 1px solid #ead6ce; padding: 8px 6px; text-align: left; word-wrap: break-word; vertical-align: middle; }
        .table-penghuni th { background-color: #fbf5f1; color: #7a5d52; font-weight: bold; }

        /* ALOKASI LEBAR KOLOM YANG PROPORSIONAL */
        .col-no { width: 4%; text-align: center; }
        .col-nama { width: 18%; }
        .col-kamar { width: 14%; }
        .col-kontak { width: 15%; }
        .col-alamat { width: 22%; }
        .col-dokumen { width: 17%; }
        .col-status { width: 10%; text-align: center; }

        .status-aktif { color: #2e8b45; font-weight: bold; }
        .link-dokumen { color: #c8664a; text-decoration: underline; font-weight: bold; display: block; margin-bottom: 2px; }
        .center { text-align: center; }
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
                    <h2>Daftar Penghuni Aktif</h2>
                    <p>Kos Rumah Bata · Diunduh pada: <strong>{{ $tanggalCetak }}</strong></p>
                </td>
            </tr>
        </table>
    </div>

    <h3>Ringkasan Data</h3>
    <table class="summary-table">
        <tr>
            <td class="bold" style="width: 30%;">Total Penghuni Aktif</td>
            <td class="status-aktif">{{ $totalPenghuni }} Orang Penghuni</td>
        </tr>
    </table>

    <h3>Rincian Informasi Penghuni</h3>
    <table class="table-penghuni">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nama">Nama Lengkap</th>
                <th class="col-kamar">Kamar</th>
                <th class="col-kontak">Kontak</th>
                <th class="col-alamat">Alamat Asal</th>
                <th class="col-dokumen">Berkas Dokumen</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($penghuni) > 0)
                @foreach($penghuni as $index => $item)
                    @php
                        $sewaAktif = $item->pengajuanSewa instanceof \Illuminate\Database\Eloquent\Collection
                            ? $item->pengajuanSewa->first()
                            : $item->pengajuanSewa;

                        $nomorKamar = $sewaAktif && $sewaAktif->kamar ? $sewaAktif->kamar->nomor_kamar : '-';
                        $towerKamar = $sewaAktif && $sewaAktif->kamar ? ucfirst($sewaAktif->kamar->tower) : '-';

                        // Menghapus slash ganda di awal path jika ada agar URL tidak rusak
                        $ktpPath = ltrim($item->ktp_dokumen, '/');
                        $suratPath = ltrim($item->surat_komitmen, '/');
                    @endphp
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->nama }}</strong><br>
                            <span style="color: #86766f; font-size: 9px;">{{ $item->email }}</span>
                        </td>
                        <td>
                            <strong>Kamar {{ $nomorKamar }}</strong><br>
                            <span style="color: #86766f; font-size: 9px;">Tower {{ $towerKamar }}</span>
                        </td>
                        <td>
                            <span style="color: #86766f;">WA:</span> {{ $item->no_hp ?? '-' }}<br>
                            <span style="color: #86766f;">Darurat:</span> {{ $item->kontak_darurat ?? '-' }}
                        </td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td>
                            @if($item->ktp_dokumen)
                                <a href="https://kos-rumah-bata.up.railway.app/{{ $ktpPath }}" class="link-dokumen" target="_blank">Lihat KTP</a>
                            @else
                                <span style="color: #bfaaa0; font-style: italic;">KTP Kosong</span><br>
                            @endif

                            @if($item->surat_komitmen)
                                <a href="https://kos-rumah-bata.up.railway.app/{{ $suratPath }}" class="link-dokumen" target="_blank">Lihat Surat Komitmen</a>
                            @else
                                <span style="color: #bfaaa0; font-style: italic;">Surat Kosong</span>
                            @endif
                        </td>
                        <td class="center status-aktif">Aktif</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" style="text-align: center; color: #86766f; padding: 20px;">
                        Tidak ada data penghuni aktif yang tercatat.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
