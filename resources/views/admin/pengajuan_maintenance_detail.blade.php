@extends('admin.layout')

@section('page-title', 'Detail Pengajuan Maintenance')
@section('page-subtitle', 'Periksa laporan kerusakan sebelum dibuat menjadi data maintenance.')

@section('content')

<style>
    .maintenance-detail-page {
        display: grid;
        gap: 22px;
    }

    .maintenance-detail-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .maintenance-detail-head {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .maintenance-detail-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .maintenance-detail-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 650px;
    }

    .maintenance-back {
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

    .maintenance-back:hover {
        background: #f4ddd4;
    }

    .maintenance-detail-grid {
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 22px;
        align-items: start;
    }

    .maintenance-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 24px;
        padding: 24px;
    }

    .report-profile {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 22px;
        margin-bottom: 22px;
        border-bottom: 1px solid #f0e3dd;
    }

    .report-avatar {
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

    .report-profile h3 {
        margin: 0;
        color: #211713;
        font-size: 23px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .report-profile p {
        margin: 7px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.5;
    }

    .report-status {
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

    .report-info-list {
        display: grid;
        gap: 0;
        border: 1px solid #ead6ce;
        border-radius: 20px;
        overflow: hidden;
        background: #fffdfb;
        margin-bottom: 22px;
    }

    .report-info-row {
        display: grid;
        grid-template-columns: 210px 1fr;
        gap: 16px;
        padding: 16px 18px;
        border-bottom: 1px solid #f0e3dd;
        align-items: center;
    }

    .report-info-row:last-child {
        border-bottom: none;
    }

    .report-info-row span {
        color: #8f8179;
        font-size: 14px;
        line-height: 1.5;
    }

    .report-info-row strong {
        color: #211713;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.5;
    }

    .report-description {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        padding: 18px;
        background: #ffffff;
        margin-bottom: 22px;
    }

    .report-description h4,
    .report-photo h4 {
        margin: 0 0 12px;
        color: #211713;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .report-description p {
        margin: 0;
        color: #6f625c;
        font-size: 14px;
        line-height: 1.7;
    }

    .report-photo {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        padding: 18px;
        background: #ffffff;
    }

    .photo-preview {
        min-height: 220px;
        border-radius: 18px;
        border: 1px dashed #dca999;
        background: #fffaf7;
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

    .photo-action {
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

    .photo-action:hover {
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

    .decision-form {
        display: grid;
        gap: 16px;
    }

    .decision-field label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .decision-field input,
    .decision-field select,
    .decision-field textarea {
        width: 100%;
        border: 1px solid #ead6ce;
        border-radius: 15px;
        padding: 14px 16px;
        font-size: 14px;
        color: #211713;
        font-family: inherit;
        outline: none;
        background: #ffffff;
    }

    .decision-field textarea {
        min-height: 115px;
        resize: vertical;
        line-height: 1.6;
    }

    .decision-field input:focus,
    .decision-field select:focus,
    .decision-field textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .decision-checklist {
        display: grid;
        gap: 12px;
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

    .decision-actions {
        display: grid;
        gap: 10px;
        margin-top: 4px;
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

    .decision-approve:hover {
        background: #b75a41;
    }

    .decision-reject {
        background: #f4ddd4;
        color: #c8664a;
    }

    .decision-reject:hover {
        background: #ebcec2;
    }

    .decision-note {
        margin: 12px 0 0;
        color: #86766f;
        font-size: 12px;
        line-height: 1.6;
    }

    @media (max-width: 1100px) {
        .maintenance-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .maintenance-detail-panel,
        .maintenance-card {
            padding: 22px;
        }

        .maintenance-detail-head {
            grid-template-columns: 1fr;
        }

        .maintenance-back {
            width: 100%;
        }

        .report-info-row {
            grid-template-columns: 1fr;
            gap: 6px;
        }
    }

    @media (max-width: 520px) {
        .maintenance-detail-head h2 {
            font-size: 24px;
        }

        .report-profile {
            flex-direction: column;
            align-items: flex-start;
        }

        .report-avatar {
            width: 62px;
            height: 62px;
            border-radius: 20px;
        }
    }
</style>

<div class="maintenance-detail-page">
    <div class="maintenance-detail-panel">

        <div class="maintenance-detail-head">
            <div>
                <h2>Cek Laporan Kerusakan</h2>
                <p>Periksa laporan dari penghuni sebelum dibuat menjadi data maintenance yang akan diproses admin.</p>
            </div>

            <a href="/admin/pengajuan-maintenance" class="maintenance-back">Kembali</a>
        </div>

        <div class="maintenance-detail-grid">

            <div class="maintenance-card">

                <div class="report-profile">
                    <div class="report-avatar">08</div>

                    <div>
                        <h3>Lampu Kamar Mati</h3>
                        <p>Dilaporkan oleh Rani Amelia · Kamar 08</p>
                        <span class="report-status">Menunggu Dicek</span>
                    </div>
                </div>

                <div class="report-info-list">
                    <div class="report-info-row">
                        <span>Kamar</span>
                        <strong>Kamar 08 · Tower Genap</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Nama Penghuni</span>
                        <strong>Rani Amelia</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Tanggal Laporan</span>
                        <strong>5 Juni 2026</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Jenis Kerusakan</span>
                        <strong>Lampu kamar tidak menyala</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Status Laporan</span>
                        <strong>Menunggu Dicek</strong>
                    </div>
                </div>

                <div class="report-description">
                    <h4>Deskripsi Keluhan</h4>
                    <p>
                        Lampu utama kamar tidak menyala sejak tadi malam. Penghuni sudah mencoba menyalakan saklar beberapa kali, tetapi lampu tetap mati.
                    </p>
                </div>

                <div class="report-photo">
                    <h4>Foto Kerusakan</h4>
                    <div class="photo-preview">
                        Preview foto kerusakan akan tampil di sini
                    </div>
                    <a href="#" class="photo-action">Lihat Foto Kerusakan</a>
                </div>

            </div>

            <div class="maintenance-card">

                <h3 class="decision-title">Keputusan Admin</h3>
                <p class="decision-desc">
                    Jika laporan valid, admin bisa membuat data maintenance agar perbaikan dapat dicatat dan diproses.
                </p>

                <form action="/admin/maintenance/create" method="GET" class="decision-form">

                    <div class="decision-field">
                        <label>Status Maintenance</label>
                        <select name="status">
                            <option selected>Menunggu</option>
                            <option>Dalam Proses</option>
                            <option>Selesai</option>
                        </select>
                    </div>

                    <div class="decision-field">
                        <label>Estimasi Biaya</label>
                        <input type="text" name="estimasi_biaya" placeholder="Contoh: Rp 200.000">
                    </div>

                    <div class="decision-field">
                        <label>Estimasi Selesai</label>
                        <input type="date" name="estimasi_selesai">
                    </div>

                    <div class="decision-checklist">
                        <label class="decision-check">
                            <input type="checkbox">
                            <div>
                                <strong>Laporan kerusakan jelas.</strong>
                                <span>Keluhan sudah cukup detail untuk dibuat data maintenance.</span>
                            </div>
                        </label>

                        <label class="decision-check">
                            <input type="checkbox">
                            <div>
                                <strong>Kamar dan penghuni sesuai.</strong>
                                <span>Data pelapor sesuai dengan kamar yang ditempati.</span>
                            </div>
                        </label>

                        <label class="decision-check">
                            <input type="checkbox">
                            <div>
                                <strong>Perbaikan perlu diproses.</strong>
                                <span>Laporan dapat diteruskan menjadi pekerjaan maintenance.</span>
                            </div>
                        </label>
                    </div>

                    <div class="decision-field">
                        <label>Catatan Admin</label>
                        <textarea name="catatan_admin" placeholder="Tambahkan catatan untuk teknisi atau admin."></textarea>
                    </div>

                    <div class="decision-actions">
                        <button type="submit" class="decision-btn decision-approve">
                            Buat Data Maintenance
                        </button>

                        <button type="button" class="decision-btn decision-reject" onclick="alert('Laporan ditolak. Nantinya backend akan menyimpan alasan penolakan.')">
                            Tolak Laporan
                        </button>
                    </div>

                    <p class="decision-note">
                        Setelah dibuat, data ini akan masuk ke daftar maintenance dan bisa dipantau status pengerjaannya.
                    </p>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
