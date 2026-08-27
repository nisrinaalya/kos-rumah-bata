@extends('admin.layout')

@section('page-title', 'Detail Penghuni')
@section('page-subtitle', 'Data lengkap penghuni, kontak keluarga, dan dokumen administrasi.')

@section('content')

<style>
    .tenant-detail-page {
        display: grid;
        gap: 22px;
    }

    .tenant-detail-grid {
        display: grid;
        grid-template-columns: 330px 1fr;
        gap: 22px;
        align-items: start;
    }

    .tenant-detail-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 24px;
    }

    .tenant-detail-profile-card {
        position: sticky;
        top: 100px;
    }

    .tenant-detail-profile-head {
        text-align: center;
        padding-bottom: 22px;
        border-bottom: 1px solid #f0e3dd;
    }

    .tenant-detail-avatar {
        width: 90px;
        height: 90px;
        border-radius: 28px;
        background: #fbf5f1;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
        margin: 0 auto 16px;
    }

    .tenant-detail-profile-head h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .tenant-detail-profile-head p {
        margin: 7px 0 0;
        color: #86766f;
        font-size: 14px;
    }

    .tenant-detail-status {
        display: inline-flex;
        margin-top: 14px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #e5f7e8;
        color: #2e8b45;
        font-size: 12px;
        font-weight: 600;
    }

    .tenant-detail-mini-info {
        display: grid;
        gap: 0;
        margin-top: 18px;
    }

    .tenant-detail-mini-row {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid #f0e3dd;
    }

    .tenant-detail-mini-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .tenant-detail-mini-row span {
        color: #8f8179;
        font-size: 13px;
    }

    .tenant-detail-mini-row strong {
        color: #211713;
        font-size: 13px;
        font-weight: 600;
        text-align: right;
    }

    .tenant-detail-main {
        display: grid;
        gap: 22px;
    }

    .tenant-detail-card-main {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 24px;
    }

    .tenant-detail-section-head {
        margin-bottom: 18px;
    }

    .tenant-detail-section-head h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .tenant-detail-section-head p {
        margin: 7px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.6;
    }

    .tenant-detail-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .tenant-detail-info-box {
        border: 1px solid #ead6ce;
        background: #ffffff;
        border-radius: 18px;
        padding: 16px;
    }

    .tenant-detail-info-box.full {
        grid-column: 1 / -1;
    }

    .tenant-detail-info-box span {
        display: block;
        color: #8f8179;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .tenant-detail-info-box strong {
        display: block;
        color: #211713;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.5;
    }

    .tenant-detail-payment-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .tenant-detail-payment-box {
        border: 1px solid #ead6ce;
        border-radius: 18px;
        padding: 16px;
        background: #fffdfb;
    }

    .tenant-detail-payment-box span {
        display: block;
        color: #8f8179;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .tenant-detail-payment-box strong {
        display: block;
        color: #211713;
        font-size: 17px;
        font-weight: 600;
    }

    .tenant-detail-payment-box .success {
        color: #2e8b45;
    }

    .tenant-detail-doc-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .tenant-detail-doc-card {
        border: 1px solid #ead6ce;
        background: #ffffff;
        border-radius: 20px;
        padding: 16px;
        display: grid;
        gap: 12px;
    }

    .tenant-detail-doc-card h4 {
        margin: 0;
        color: #211713;
        font-size: 16px;
        font-weight: 700;
    }

    .tenant-detail-doc-preview {
        min-height: 128px;
        border-radius: 16px;
        border: 1px dashed #dca999;
        background: #fbf5f1;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        padding: 14px;
    }

    .tenant-detail-doc-meta {
        color: #86766f;
        font-size: 12px;
        line-height: 1.5;
    }

    .tenant-detail-doc-action {
        min-height: 40px;
        border-radius: 13px;
        background: #c8664a;
        color: #ffffff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .tenant-detail-doc-action:hover {
        background: #b75a41;
    }

    .tenant-detail-doc-action.secondary {
        background: #f4ddd4;
        color: #c8664a;
    }

    .tenant-detail-doc-action.secondary:hover {
        background: #ebcec2;
    }

    .tenant-detail-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .tenant-detail-action-btn {
        min-height: 44px;
        border-radius: 14px;
        padding: 0 18px;
        text-decoration: none;
        border: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .tenant-detail-action-edit {
        background: #c8664a;
        color: #ffffff;
    }

    .tenant-detail-action-edit:hover {
        background: #b75a41;
    }

    .tenant-detail-action-back {
        background: #f4ddd4;
        color: #c8664a;
    }

    .tenant-detail-action-back:hover {
        background: #ebcec2;
    }

    @media (max-width: 1100px) {
        .tenant-detail-grid {
            grid-template-columns: 1fr;
        }

        .tenant-detail-profile-card {
            position: static;
        }

        .tenant-detail-doc-grid,
        .tenant-detail-payment-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .tenant-detail-card {
            padding: 22px;
        }

        .tenant-detail-info-grid {
            grid-template-columns: 1fr;
        }

        .tenant-detail-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .tenant-detail-action-btn {
            width: 100%;
        }
    }
</style>

@php
    // Mendapatkan data pengajuan sewa pertama yang pembayarannya disetujui
    $sewaAktif = $penghuni->pengajuanSewa->first();

    $nomorKamar = '-';
    $towerKamar = '-';
    $hargaKamar = 0;
    $durasiSewa = 0;
    $tanggalMulai = '-';
    $tipePembayaran = '-';
    $totalSudahBayar = 0;

    if ($sewaAktif) {
        if ($sewaAktif->kamar) {
            $nomorKamar = $sewaAktif->kamar->nomor_kamar;
            $towerKamar = ucfirst($sewaAktif->kamar->tower);
            $hargaKamar = $sewaAktif->kamar->harga;
        }
        $durasiSewa = $sewaAktif->durasi_sewa;
        $tanggalMulai = \Carbon\Carbon::parse($sewaAktif->tanggal_mulai)->translatedFormat('F Y');

        // Akumulasi nominal pembayaran yang disetujui
        $pembayaranDisetujui = $sewaAktif->pembayarans->where('status', 'disetujui');
        $totalSudahBayar = $pembayaranDisetujui->sum('nominal');

        if ($pembayaranDisetujui->first()) {
            $tipePembayaran = ucfirst($pembayaranDisetujui->first()->tipe_pembayaran);
        }
    }

    $totalTagihan = $hargaKamar;
    $sisaTagihan = $totalTagihan - $totalSudahBayar;
    if ($sisaTagihan < 0) {
        $sisaTagihan = 0;
    }

    // Pembuatan inisial nama secara otomatis
    $words = explode(' ', $penghuni->nama);
    $initials = '';
    if (count($words) >= 2) {
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
    } else {
        $initials = strtoupper(substr($penghuni->nama, 0, 2));
    }
@endphp

<div class="tenant-detail-page">

    <div class="tenant-detail-grid">

        <div class="tenant-detail-card tenant-detail-profile-card">
            <div class="tenant-detail-profile-head">
                <div class="tenant-detail-avatar">{{ $initials }}</div>
                <h2>{{ $penghuni->nama }}</h2>
                <p>Kamar {{ $nomorKamar }} · Tower {{ $towerKamar }}</p>
                <span class="tenant-detail-status">Penghuni Aktif</span>
            </div>

            <div class="tenant-detail-mini-info">
                <div class="tenant-detail-mini-row">
                    <span>Tipe Penghuni</span>
                    <strong>{{ $penghuni->jenis_kelamin == 'Perempuan' ? 'Mahasiswi' : 'Mahasiswa' }}</strong>
                </div>

                <div class="tenant-detail-mini-row">
                    <span>Mulai Masuk</span>
                    <strong>{{ $tanggalMulai }}</strong>
                </div>

                <div class="tenant-detail-mini-row">
                    <span>Status Bayar</span>
                    @if($sisaTagihan == 0 && $totalTagihan > 0)
                        <strong style="color:#2e8b45;">Lunas</strong>
                    @elseif($totalSudahBayar > 0)
                        <strong style="color:#d39e00;">DP / Dicicil</strong>
                    @else
                        <strong style="color:#c0392b;">Belum Bayar</strong>
                    @endif
                </div>

                <div class="tenant-detail-mini-row">
                    <span>Metode Bayar</span>
                    <strong>{{ $tipePembayaran }}</strong>
                </div>
            </div>
        </div>

        <div class="tenant-detail-main">

            <div class="tenant-detail-card-main tenant-detail-card">
                <div class="tenant-detail-section-head">
                    <h3>Data Diri</h3>
                    <p>Informasi utama penghuni yang tersimpan di sistem admin.</p>
                </div>

                <div class="tenant-detail-info-grid">
                    <div class="tenant-detail-info-box">
                        <span>Nama Lengkap</span>
                        <strong>{{ $penghuni->nama }}</strong>
                    </div>

                    <div class="tenant-detail-info-box">
                        <span>No. HP / WhatsApp</span>
                        <strong>{{ $penghuni->no_hp }}</strong>
                    </div>

                    <div class="tenant-detail-info-box">
                        <span>Kontak Orang Tua / Darurat</span>
                        <strong>{{ $penghuni->kontak_darurat ?? '-' }}</strong>
                    </div>

                    <div class="tenant-detail-info-box">
                        <span>Kamar</span>
                        <strong>Kamar {{ $nomorKamar }} · Tower {{ $towerKamar }}</strong>
                    </div>

                    <div class="tenant-detail-info-box full">
                        <span>Alamat Asal</span>
                        <strong>{{ $penghuni->alamat }}</strong>
                    </div>
                </div>
            </div>

            <div class="tenant-detail-card-main tenant-detail-card">
                <div class="tenant-detail-section-head">
                    <h3>Status Pembayaran</h3>
                    <p>Ringkasan pembayaran penghuni yang sedang berjalan.</p>
                </div>

                <div class="tenant-detail-payment-grid">
                    <div class="tenant-detail-payment-box">
                        <span>Total Tagihan</span>
                        <strong>Rp {{ number_format($totalTagihan, 0, ',', '.') }}</strong>
                    </div>

                    <div class="tenant-detail-payment-box">
                        <span>Sudah Dibayar</span>
                        <strong class="success">Rp {{ number_format($totalSudahBayar, 0, ',', '.') }}</strong>
                    </div>

                    <div class="tenant-detail-payment-box">
                        <span>Sisa Pembayaran</span>
                        <strong style="{{ $sisaTagihan > 0 ? 'color:#c0392b;' : '' }}">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>

            <div class="tenant-detail-card-main tenant-detail-card">
                <div class="tenant-detail-section-head">
                    <h3>Dokumen Penghuni</h3>
                    <p>Dokumen administrasi yang dibutuhkan untuk arsip kos.</p>
                </div>

                <div class="tenant-detail-doc-grid">
                    <div class="tenant-detail-doc-card">
                        <h4>Foto KTP</h4>
                        <div class="tenant-detail-doc-preview">
                            @if($penghuni->ktp_dokumen)
                                <span style="color: #2e8b45;">File KTP Tersedia</span>
                            @else
                                <span style="color: #86766f;">Belum Diunggah</span>
                            @endif
                        </div>
                        <div class="tenant-detail-doc-meta">File identitas penghuni untuk arsip admin.</div>
                        @if($penghuni->ktp_dokumen)
                            <a href="{{ asset($penghuni->ktp_dokumen) }}" target="_blank" class="tenant-detail-doc-action">Lihat File</a>
                        @else
                            <a href="javascript:void(0)" class="tenant-detail-doc-action secondary" style="cursor: not-allowed; opacity: 0.6;">Tidak Ada File</a>
                        @endif
                    </div>

                    <div class="tenant-detail-doc-card">
                        <h4>Surat Komitmen</h4>
                        <div class="tenant-detail-doc-preview">
                            @if($penghuni->surat_komitmen)
                                <span style="color: #2e8b45;">File Surat Tersedia</span>
                            @else
                                <span style="color: #86766f;">Belum Diunggah</span>
                            @endif
                        </div>
                        <div class="tenant-detail-doc-meta">Surat persetujuan aturan tinggal di Kos Rumah Bata.</div>
                        @if($penghuni->surat_komitmen)
                            <a href="{{ asset($penghuni->surat_komitmen) }}" target="_blank" class="tenant-detail-doc-action">Lihat File</a>
                        @else
                            <a href="javascript:void(0)" class="tenant-detail-doc-action secondary" style="cursor: not-allowed; opacity: 0.6;">Tidak Ada File</a>
                        @endif
                    </div>

                    {{-- <div class="tenant-detail-doc-card">
                        <h4>Catatan Admin</h4>
                        <div class="tenant-detail-doc-preview" style="font-weight: normal; color: #211713;">
                            {{ $sewaAktif && $sewaAktif->catatan ? $sewaAktif->catatan : 'Tidak ada catatan khusus' }}
                        </div>
                        <div class="tenant-detail-doc-meta">Catatan tambahan dari pengajuan sewa untuk kebutuhan internal.</div>
                        <a href="/admin/penghuni/edit/{{ $penghuni->id }}" class="tenant-detail-doc-action secondary">Edit Catatan</a>
                    </div> --}}
                </div>
            </div>

            <div class="tenant-detail-actions">
                <a href="/admin/penghuni/{{ $penghuni->id }}/edit" class="tenant-detail-action-btn tenant-detail-action-edit">Edit Data</a>
                <a href="/admin/penghuni" class="tenant-detail-action-btn tenant-detail-action-back">Kembali ke Data Penghuni</a>
            </div>

        </div>

    </div>
</div>

@endsection
