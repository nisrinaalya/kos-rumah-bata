@extends('admin.layout')

@section('page-title', 'Verifikasi Pembayaran')
@section('page-subtitle', 'Cek bukti pembayaran sebelum status sewa diperbarui.')

@section('content')

<style>
    .payment-detail-page {
        display: grid;
        gap: 22px;
    }

    .payment-detail-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .payment-detail-head {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .payment-detail-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .payment-detail-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 620px;
    }

    .payment-detail-back {
        height: 44px;
        border: 1px solid #ead6ce;
        background: #fbf5f1;
        color: #c8664a;
        border-radius: 14px;
        padding: 0 18px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .payment-detail-back:hover {
        background: #f4ddd4;
    }

    .payment-detail-grid {
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 22px;
        align-items: start;
    }

    .payment-detail-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 24px;
        padding: 24px;
    }

    .payment-profile {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 22px;
        margin-bottom: 22px;
        border-bottom: 1px solid #f0e3dd;
    }

    .payment-profile-avatar {
        width: 70px;
        height: 70px;
        border-radius: 22px;
        background: #fbf5f1;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .payment-profile h3 {
        margin: 0;
        color: #211713;
        font-size: 23px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .payment-profile p {
        margin: 7px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.5;
    }

    .payment-status {
        display: inline-flex;
        margin-top: 10px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #fbf5f1;
        color: #7a5d52;
        border: 1px solid #eee1da;
        font-size: 12px;
        font-weight: 600;
    }

    .payment-info-list {
        display: grid;
        gap: 0;
        border: 1px solid #ead6ce;
        border-radius: 20px;
        overflow: hidden;
        background: #fffdfb;
        margin-top: 22px;
    }

    .payment-info-row {
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 16px;
        padding: 16px 18px;
        border-bottom: 1px solid #f0e3dd;
        align-items: center;
    }

    .payment-info-row:last-child {
        border-bottom: none;
    }

    .payment-info-row span {
        color: #8f8179;
        font-size: 14px;
        line-height: 1.5;
    }

    .payment-info-row strong {
        color: #211713;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.5;
    }

    .payment-proof {
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 18px;
        background: #ffffff;
        margin-top: 22px;
    }

    .payment-proof h4 {
        margin: 0 0 14px;
        color: #211713;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .proof-preview {
        min-height: 260px;
        border-radius: 18px;
        border: 1px dashed #dca999;
        background: #fbf5f1;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 14px;
        font-weight: 600;
        padding: 18px;
        margin-bottom: 14px;
    }

    .proof-meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 14px;
    }

    .proof-meta-box {
        border: 1px solid #eee1da;
        border-radius: 16px;
        padding: 14px;
        background: #fffdfb;
    }

    .proof-meta-box span {
        display: block;
        color: #8f8179;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .proof-meta-box strong {
        display: block;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .proof-action {
        min-height: 42px;
        border-radius: 14px;
        background: #c8664a;
        color: #ffffff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .proof-action:hover {
        background: #b75a41;
    }

    .decision-title {
        margin: 0 0 10px;
        color: #211713;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .decision-desc {
        margin: 0 0 18px;
        color: #86766f;
        font-size: 14px;
        line-height: 1.7;
    }

    .decision-checklist {
        display: grid;
        gap: 12px;
        margin-top: 12px;
    }

    .decision-check {
        border: 1px solid #ead6ce;
        background: #fffdfb;
        border-radius: 18px;
        padding: 15px;
        display: grid;
        grid-template-columns: 20px 1fr;
        gap: 12px;
        align-items: start;
        cursor: pointer;
    }

    .decision-check input {
        width: 17px;
        height: 17px;
        margin-top: 2px;
        accent-color: #c8664a;
    }

    .decision-check strong {
        display: block;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.5;
    }

    .decision-check span {
        display: block;
        color: #86766f;
        font-size: 12px;
        line-height: 1.5;
        margin-top: 4px;
    }

    .payment-note {
        margin-top: 18px;
    }

    .payment-note label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .payment-note textarea {
        width: 100%;
        min-height: 115px;
        border: 1px solid #ead6ce;
        border-radius: 16px;
        padding: 14px 16px;
        font-family: inherit;
        font-size: 14px;
        color: #211713;
        outline: none;
        resize: vertical;
        background: #ffffff;
    }

    .payment-note textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .decision-actions {
        display: grid;
        gap: 10px;
        margin-top: 20px;
    }

    .decision-btn {
        min-height: 46px;
        border: none;
        border-radius: 15px;
        padding: 0 18px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .decision-approve {
        background: #c8664a;
        color: #ffffff;
    }

    .decision-approve:disabled {
        background: #dfb2a6;
        cursor: not-allowed;
        opacity: 0.8;
    }

    .decision-approve:hover:not(:disabled) {
        background: #b75a41;
    }

    .decision-reupload {
        background: #f4ddd4;
        color: #c8664a;
    }

    .decision-reupload:hover {
        background: #ebcec2;
    }

    .decision-note {
        margin: 14px 0 0;
        color: #86766f;
        font-size: 12px;
        line-height: 1.6;
    }

    @media (max-width: 1100px) {
        .payment-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .payment-detail-panel,
        .payment-detail-card {
            padding: 22px;
        }

        .payment-detail-head {
            grid-template-columns: 1fr;
        }

        .payment-detail-back {
            width: 100%;
        }

        .payment-info-row {
            grid-template-columns: 1fr;
            gap: 6px;
        }

        .proof-meta {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .payment-detail-head h2 {
            font-size: 24px;
        }

        .payment-profile {
            flex-direction: column;
            align-items: flex-start;
        }

        .payment-profile-avatar {
            width: 62px;
            height: 62px;
            border-radius: 20px;
        }

        .proof-preview {
            min-height: 210px;
        }
    }

    .verify-page {
        display: grid;
        gap: 22px;
    }

    .verify-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .verify-head {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .verify-head h2 {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .verify-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 620px;
    }

    .verify-back {
        height: 44px;
        border: 1px solid #ead6ce;
        background: #fbf5f1;
        color: #c8664a;
        border-radius: 14px;
        padding: 0 18px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .verify-back:hover {
        background: #f4ddd4;
    }

    .verify-grid {
        display: grid;
        grid-template-columns: 1.4fr 0.8fr;
        gap: 22px;
        align-items: start;
    }

    .verify-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 24px;
        padding: 24px;
    }

    .applicant-profile {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 22px;
        margin-bottom: 22px;
        border-bottom: 1px solid #f0e3dd;
    }

    .applicant-avatar {
        width: 70px;
        height: 70px;
        border-radius: 22px;
        background: #fbf5f1;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .applicant-profile h3 {
        margin: 0;
        color: #211713;
        font-size: 23px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .applicant-profile p {
        margin: 7px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.5;
    }

    .status-pill {
        display: inline-flex;
        margin-top: 10px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #fffdfb;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid #ead6ce;
    }

    .status-pill[data-pill-status="pending"] {
        background: #fff9e6;
        color: #b37400;
        border-color: #ffe699;
    }

    .status-pill[data-pill-status="disetujui"] {
        background: #e6f7ed;
        color: #1e7e34;
        border-color: #c3e6cb;
    }

    .status-pill[data-pill-status="ditolak"] {
        background: #fdf2f2;
        color: #dc3545;
        border-color: #f5c6cb;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .info-box {
        border: 1px solid #ead6ce;
        border-radius: 18px;
        padding: 16px;
        background: #fffdfb;
    }

    .info-box.full {
        grid-column: 1 / -1;
    }

    .info-box span {
        display: block;
        color: #8f8179;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .info-box strong {
        display: block;
        color: #211713;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.5;
    }

    .section-title {
        margin: 0 0 16px;
        color: #211713;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .document-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-top: 22px;
    }

    .doc-box {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        padding: 16px;
        background: #ffffff;
    }

    .doc-box h4 {
        margin: 0 0 12px;
        color: #211713;
        font-size: 15px;
        font-weight: 700;
    }

    .doc-preview {
        height: 130px;
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
        margin-bottom: 12px;
    }

    .doc-link {
        min-height: 40px;
        border-radius: 13px;
        background: #c8664a;
        color: #ffffff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .doc-link:hover {
        background: #b75a41;
    }

    .verify-checklist {
        display: grid;
        gap: 12px;
    }

    .check-item {
        border: 1px solid #ead6ce;
        background: #fffdfb;
        border-radius: 18px;
        padding: 15px;
        display: grid;
        grid-template-columns: 20px 1fr;
        gap: 12px;
        align-items: start;
        cursor: pointer;
    }

    .check-item input {
        width: 17px;
        height: 17px;
        margin-top: 2px;
        accent-color: #c8664a;
    }

    .check-item strong {
        display: block;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.5;
    }

    .check-item span {
        display: block;
        color: #86766f;
        font-size: 12px;
        line-height: 1.5;
        margin-top: 4px;
    }

    .admin-note {
        margin-top: 18px;
    }

    .admin-note label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .admin-note textarea {
        width: 100%;
        min-height: 110px;
        border: 1px solid #ead6ce;
        border-radius: 16px;
        padding: 14px 16px;
        font-family: inherit;
        font-size: 14px;
        color: #211713;
        outline: none;
        resize: vertical;
    }

    .admin-note textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .verify-actions {
        display: grid;
        gap: 10px;
        margin-top: 20px;
    }

    .approve-btn,
    .reject-btn {
        min-height: 46px;
        border: none;
        border-radius: 15px;
        padding: 0 18px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .approve-btn {
        background: #c8664a;
        color: #ffffff;
    }

    .approve-btn:hover {
        background: #b75a41;
    }

    .reject-btn {
        background: #f4ddd4;
        color: #c0392b;
    }

    .reject-btn:hover {
        background: #ef4136;
        color: #ffffff;
    }

    .flow-note {
        margin-top: 14px;
        color: #86766f;
        font-size: 12px;
        line-height: 1.6;
    }

    @media (max-width: 1100px) {
        .verify-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .verify-panel,
        .verify-card {
            padding: 22px;
        }

        .verify-head {
            grid-template-columns: 1fr;
        }

        .verify-back {
            width: 100%;
        }

        .info-grid,
        .document-grid {
            grid-template-columns: 1fr;
        }

        .applicant-profile {
            align-items: flex-start;
        }
    }

    @media (max-width: 520px) {
        .verify-head h2 {
            font-size: 24px;
        }

        .applicant-profile {
            flex-direction: column;
        }

        .applicant-avatar {
            width: 62px;
            height: 62px;
            border-radius: 20px;
        }
    }
</style>

@php
    // --- PERBAIKAN PEMETAAN LOGIK VARIABEL DARI OBJEK BARU TABEL PEMBAYARANS ---
    $namaUser = $pembayaranItem->pengajuanSewa->user->nama ?? 'N/A';
    $noHp = $pembayaranItem->pengajuanSewa->user->no_hp ?? '-';
    $kontakDarurat = $pembayaranItem->pengajuanSewa->user->kontak_darurat ?? '-';
    $alamatUser = $pembayaranItem->pengajuanSewa->user->alamat ?? '-';

    $namaKamar = $pembayaranItem->pengajuanSewa->kamar->nomor_kamar ?? 'N/A';
    $towerKamar = $pembayaranItem->pengajuanSewa->kamar->tower ?? 'N/A';
    $hargaKamar = $pembayaranItem->pengajuanSewa->kamar->harga ?? 0;
    $hitunganKamar = $pembayaranItem->pengajuanSewa->kamar->dalam_hitungan ?? 'tahun';

    $tipeBayar = $pembayaranItem->tipe_pembayaran ?? 'full';
    $statusPendaftaran = $pembayaranItem->status ?? 'pending';
    $tanggalUpload = $pembayaranItem->created_at ? $pembayaranItem->created_at->translatedFormat('d F Y') : '-';
    $tanggalMulai = $pembayaranItem->pengajuanSewa->tanggal_mulai ? \Carbon\Carbon::parse($pembayaranItem->pengajuanSewa->tanggal_mulai)->translatedFormat('j M Y') : '-';

    // Nominal dinamis disesuaikan dari data asli record transaksi di tabel pembayarans
    $jumlahDibayar = $pembayaranItem->nominal;
    $sisaPembayaran = 0;
    $labelTipeBayar = 'Lunas';

    if ($tipeBayar === 'dp') {
        $sisaPembayaran = $hargaKamar - $jumlahDibayar;
        $labelTipeBayar = 'DP (Down Payment)';
    } elseif ($tipeBayar === 'pelunasan') {
        $sisaPembayaran = 0;
        $labelTipeBayar = 'Pelunasan sisa DP';
    }

    // Pemetaan label status badge pendaftaran transaksi pembayaran
    $statusLabel = 'Menunggu Verifikasi';
    if ($statusPendaftaran === 'disetujui') {
        $statusLabel = 'Terverifikasi';
    } elseif ($statusPendaftaran === 'ditolak') {
        $statusLabel = 'Upload Ulang';
    }

    // Ekstrak Inisial Nama User
    $words = explode(' ', $namaUser);
    $initials = strtoupper(substr($words[0] ?? 'P', 0, 1) . substr($words[1] ?? '', 0, 1));

    // Ekstrak Nama File Bukti Transfer
    $fileNameBukti = 'tidak_ada_file.jpg';
    if ($pembayaranItem->bukti_transfer) {
        $explodedPath = explode('/', $pembayaranItem->bukti_transfer);
        $fileNameBukti = end($explodedPath);
    }
@endphp

<div class="payment-detail-page">

    <div class="payment-detail-panel">

        <div class="payment-detail-head">
            <div>
                <h2>Cek Bukti Pembayaran</h2>
                <p>Pastikan nominal, tujuan rekening, and bukti transfer sudah sesuai sebelum pembayaran diverifikasi.</p>
            </div>

            <a href="/admin/pembayaran" class="payment-detail-back">Kembali</a>
        </div>

        @if(session('success'))
            <div style="background: #e8f8f5; color: #27ae60; padding: 14px 20px; border-radius: 16px; margin-bottom: 20px; font-size: 14px; font-weight: 600; border: 1px solid #27ae60;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div style="background: #fdf2f2; color: #dc3545; padding: 14px 20px; border-radius: 16px; margin-bottom: 20px; font-size: 14px; font-weight: 600; border: 1px solid #f5c6cb;">
                @if(session('error'))
                    {{ session('error') }}
                @else
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        <form action="/admin/pembayaran/{{ $pembayaranItem->id }}/verifikasi" method="POST" class="verify-grid">
            @csrf
            @method('PUT')

            <div class="verify-card">
                <div class="applicant-profile">
                    <div class="applicant-avatar">{{ $initials }}</div>

                    <div>
                        <h3>{{ $namaUser }}</h3>
                        <p>Mengajukan sewa Kamar {{ $namaKamar }} · {{ $towerKamar }}</p>
                        <span class="status-pill" data-pill-status="{{ $statusPendaftaran }}">{{ $statusLabel }}</span>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-box full">
                        <span>Nama Lengkap</span>
                        <strong>{{ $namaUser }}</strong>
                    </div>

                    <div class="info-box">
                        <span>No. WhatsApp</span>
                        <strong>{{ $noHp }}</strong>
                    </div>

                    <div class="info-box">
                        <span>Kontak Orang Tua / Darurat</span>
                        <strong>{{ $kontakDarurat }}</strong>
                    </div>

                    <div class="info-box">
                        <span>Kamar Diajukan</span>
                        <strong>Kamar {{ $namaKamar }} · Tower {{ $towerKamar }}</strong>
                    </div>

                    <div class="info-box">
                        <span>Mulai Sewa</span>
                        <strong>{{ $tanggalMulai }}</strong>
                    </div>

                    <div class="info-box full">
                        <span>Alamat Asal</span>
                        <strong>{{ $alamatUser }}</strong>
                    </div>
                </div>

                <div class="document-grid">
                    <div class="doc-box">
                        <h4>Foto KTP</h4>
                        <div class="doc-preview" style="padding: 0; overflow: hidden; border-style: solid;">
                            @if($pembayaranItem->pengajuanSewa->user && $pembayaranItem->pengajuanSewa->user->ktp_dokumen && (str_contains($pembayaranItem->pengajuanSewa->user->ktp_dokumen, '.jpg') || str_contains($pembayaranItem->pengajuanSewa->user->ktp_dokumen, '.jpeg') || str_contains($pembayaranItem->pengajuanSewa->user->ktp_dokumen, '.png')))
                                <img src="{{ asset($pembayaranItem->pengajuanSewa->user->ktp_dokumen) }}" alt="KTP" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="padding: 14px;">File Dokumen KTP (PDF/DOC)</div>
                            @endif
                        </div>
                        <a href="{{ asset($pembayaranItem->pengajuanSewa->user->ktp_dokumen ?? '#') }}" target="_blank" class="doc-link">Lihat Foto KTP</a>
                    </div>

                    <div class="doc-box">
                        <h4>Surat Komitmen</h4>
                        <div class="doc-preview">
                            {{-- <span style="color: #c8664a; font-size: 28px; display:block; margin-bottom:4px;">📄</span> --}}
                            Surat Komitmen Penghuni
                        </div>
                        <a href="{{ asset($pembayaranItem->pengajuanSewa->user->surat_komitmen ?? '#') }}" target="_blank" class="doc-link">Lihat Surat</a>
                    </div>
                </div>

                <div class="payment-info-list">
                    <div class="payment-info-row">
                        <span>Jenis Pembayaran</span>
                        <strong>{{ $labelTipeBayar }}</strong>
                    </div>

                    <div class="payment-info-row">
                        <span>Jumlah Dibayar</span>
                        <strong>Rp {{ number_format($jumlahDibayar, 0, ',', '.') }}</strong>
                    </div>

                    <div class="payment-info-row">
                        <span>Total Tagihan</span>
                        <strong>Rp {{ number_format($hargaKamar, 0, ',', '.') }} / {{ $hitunganKamar }}</strong>
                    </div>

                    <div class="payment-info-row">
                        <span>Sisa Pembayaran</span>
                        <strong>Rp {{ number_format($sisaPembayaran, 0, ',', '.') }}</strong>
                    </div>

                    <div class="payment-info-row">
                        <span>Tanggal Upload</span>
                        <strong>{{ $tanggalUpload }}</strong>
                    </div>

                    <div class="payment-info-row">
                        <span>Metode Pembayaran</span>
                        <strong>Transfer Bank</strong>
                    </div>
                </div>

                <div class="payment-proof">
                    <h4>Bukti Transfer</h4>

                    <div class="proof-preview" style="padding: 0; overflow: hidden; border-style: solid;">
                        @if($pembayaranItem->bukti_transfer)
                            <img src="{{ asset($pembayaranItem->bukti_transfer) }}" alt="Bukti Transfer" style="width: 100%; height: 100%; object-fit: contain; background: #fff;">
                        @else
                            <div style="padding: 18px;">Belum ada bukti transfer diupload</div>
                        @endif
                    </div>

                    <div class="proof-meta">
                        <div class="proof-meta-box">
                            <span>Nama File</span>
                            <strong>{{ $fileNameBukti }}</strong>
                        </div>

                        <div class="proof-meta-box">
                            <span>Status File</span>
                            <strong>{{ $pembayaranItem->bukti_transfer ? 'Sudah diupload' : 'Kosong' }}</strong>
                        </div>
                    </div>

                    <a href="{{ asset($pembayaranItem->bukti_transfer ?? '#') }}" target="_blank" class="proof-action">Lihat Bukti Transfer</a>
                </div>
            </div>

            <div class="verify-card">
                <h3 class="section-title">Verifikasi Admin</h3>

                <div class="verify-checklist">
                    <label class="check-item">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Data diri sudah sesuai.</strong>
                            <span>Nama, nomor HP, dan alamat calon penghuni sudah dicek.</span>
                        </div>
                    </label>

                    <label class="check-item">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Kontak orang tua valid.</strong>
                            <span>Nomor orang tua dapat dihubungi jika diperlukan.</span>
                        </div>
                    </label>

                    <label class="check-item">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Dokumen terlihat jelas.</strong>
                            <span>Foto KTP dan surat komitmen dapat dibaca.</span>
                        </div>
                    </label>

                    <label class="check-item">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Kamar masih tersedia.</strong>
                            <span>Kamar yang diajukan belum ditempati penghuni lain.</span>
                        </div>
                    </label>
                </div>

                <div class="decision-checklist">

                    <label class="decision-check">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Nominal pembayaran sesuai.</strong>
                            <span>Jumlah transfer sama dengan data pembayaran yang dikirim penghuni.</span>
                        </div>
                    </label>

                    <label class="decision-check">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Bukti transfer terlihat jelas.</strong>
                            <span>Nama pengirim, nominal, dan tanggal transfer dapat dibaca.</span>
                        </div>
                    </label>

                    <label class="decision-check">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Tujuan rekening sesuai.</strong>
                            <span>Pembayaran masuk ke rekening Kos Rumah Bata.</span>
                        </div>
                    </label>

                    <label class="decision-check">
                        <input type="checkbox" class="verify-checkbox">
                        <div>
                            <strong>Data penghuni cocok.</strong>
                            <span>Nama dan kamar sesuai dengan data penghuni di sistem.</span>
                        </div>
                    </label>

                </div>

                <div class="admin-note">
                    <label>Catatan Admin</label>
                    <textarea name="catatan_admin" placeholder="Tulis catatan jika ada data yang perlu diperbaiki atau alasan penolakan."></textarea>
                </div>

                <div class="decision-actions">
                    <button type="submit" id="btnApprove" name="action" value="setuju" class="decision-btn decision-approve" disabled>
                        Setujui Pengajuan
                    </button>

                    <button type="submit" name="action" value="tolak" class="decision-btn decision-reupload">
                        Tolak Pengajuan
                    </button>
                </div>

                <p class="flow-note">
                    Setelah disetujui, calon penghuni akan masuk ke data penghuni dan bisa melanjutkan pembayaran melalui website pelanggan.
                </p>
            </div>

        </form>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.verify-checkbox');
        const btnApprove = document.getElementById('btnApprove');

        function checkFormValidity() {
            const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;

            if (checkedCount === 8) {
                btnApprove.removeAttribute('disabled');
            } else {
                btnApprove.setAttribute('disabled', 'true');
            }
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', checkFormValidity);
        });
    });
</script>

@endsection
