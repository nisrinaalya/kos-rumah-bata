@extends('admin.layout')

@section('page-title', 'Cek Pengajuan Sewa')
@section('page-subtitle', 'Periksa data calon penghuni sebelum membuka akses pembayaran.')

@section('content')

<style>
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
        background: #fff1cf;
        color: #b47400;
        font-size: 12px;
        font-weight: 600;
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

<div class="verify-page">

    <div class="verify-panel">
        <div class="verify-head">
            <div>
                <h2>Cek Data Calon Penghuni</h2>
                <p>Periksa data pribadi, kamar yang diajukan, kontak keluarga, dan dokumen sebelum menyetujui pengajuan sewa.</p>
            </div>

            <a href="/admin/pengajuan-sewa" class="verify-back">Kembali</a>
        </div>

        <div class="verify-grid">

            <div class="verify-card">
                <div class="applicant-profile">
                    <div class="applicant-avatar">RC</div>

                    <div>
                        <h3>Raditya Cummalaka</h3>
                        <p>Mengajukan sewa Kamar 01 · Tower Ganjil</p>
                        <span class="status-pill">Menunggu Verifikasi</span>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-box full">
                        <span>Nama Lengkap</span>
                        <strong>Raditya Cummalaka</strong>
                    </div>

                    <div class="info-box">
                        <span>No. WhatsApp</span>
                        <strong>0812-4567-9900</strong>
                    </div>

                    <div class="info-box">
                        <span>Kontak Orang Tua</span>
                        <strong>0813-1111-7788</strong>
                    </div>

                    <div class="info-box">
                        <span>Kamar Diajukan</span>
                        <strong>Kamar 01 · Tower Ganjil · Non AC</strong>
                    </div>

                    <div class="info-box">
                        <span>Tanggal Pengajuan</span>
                        <strong>9 Mei 2026</strong>
                    </div>

                    <div class="info-box full">
                        <span>Alamat Asal</span>
                        <strong>Samarinda, Kalimantan Timur</strong>
                    </div>
                </div>

                <div class="document-grid">
                    <div class="doc-box">
                        <h4>Foto KTP</h4>
                        <div class="doc-preview">Preview Foto KTP</div>
                        <a href="#" class="doc-link">Lihat Foto KTP</a>
                    </div>

                    <div class="doc-box">
                        <h4>Surat Komitmen</h4>
                        <div class="doc-preview">Preview Surat Komitmen</div>
                        <a href="#" class="doc-link">Lihat Surat</a>
                    </div>
                </div>
            </div>

            <div class="verify-card">
                <h3 class="section-title">Verifikasi Admin</h3>

                <div class="verify-checklist">
                    <label class="check-item">
                        <input type="checkbox">
                        <div>
                            <strong>Data diri sudah sesuai.</strong>
                            <span>Nama, nomor HP, dan alamat calon penghuni sudah dicek.</span>
                        </div>
                    </label>

                    <label class="check-item">
                        <input type="checkbox">
                        <div>
                            <strong>Kontak orang tua valid.</strong>
                            <span>Nomor orang tua dapat dihubungi jika diperlukan.</span>
                        </div>
                    </label>

                    <label class="check-item">
                        <input type="checkbox">
                        <div>
                            <strong>Dokumen terlihat jelas.</strong>
                            <span>Foto KTP dan surat komitmen dapat dibaca.</span>
                        </div>
                    </label>

                    <label class="check-item">
                        <input type="checkbox">
                        <div>
                            <strong>Kamar masih tersedia.</strong>
                            <span>Kamar yang diajukan belum ditempati penghuni lain.</span>
                        </div>
                    </label>
                </div>

                <div class="admin-note">
                    <label>Catatan Admin</label>
                    <textarea placeholder="Tulis catatan jika ada data yang perlu diperbaiki."></textarea>
                </div>

                <div class="verify-actions">
                    <button type="button" class="approve-btn" onclick="alert('Pengajuan disetujui. Nantinya backend akan mengubah status menjadi terverifikasi dan membuka akses pembayaran.')">
                        Setujui Pengajuan
                    </button>

                    <button type="button" class="reject-btn" onclick="alert('Pengajuan ditolak. Nantinya backend akan menyimpan alasan penolakan.')">
                        Tolak Pengajuan
                    </button>
                </div>

                <p class="flow-note">
                    Setelah disetujui, calon penghuni akan masuk ke data penghuni dan bisa melanjutkan pembayaran melalui website pelanggan.
                </p>
            </div>

        </div>
    </div>

</div>

@endsection
