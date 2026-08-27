@extends('admin.layout')

@section('page-title', 'Cek Laporan Maintenance')
@section('page-subtitle', 'Periksa laporan dan status kerusakan dari maintenance.')

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
        border: 1px solid #eee1da;
        background: #fffaf7;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 14px;
        font-weight: 600;
        padding: 8px;
        margin-bottom: 14px;
        overflow: hidden;
    }

    .photo-preview img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 12px;
        display: block;
        object-fit: contain;
    }

    .photo-action-btn {
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
        border: none;
        cursor: pointer;
    }

    .photo-action-btn:hover {
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
                <p>Periksa laporan dan status data maintenance yang akan diproses perbaikan.</p>
            </div>

            <a href="{{ route('maintenance.index') }}" class="maintenance-back">Kembali</a>
        </div>

        @if ($errors->any())
            <div style="background: #fdf2f2; color: #ec5b5b; padding: 16px; border-radius: 15px; border: 1px solid #fde8e8; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $nomorKamar = $maintenance->kamar ? $maintenance->kamar->nomor_kamar : $maintenance->kamar_id;
            $tipeKamar = $maintenance->kamar ? $maintenance->kamar->tower : 'Tower';
            $badgeText = ucfirst($maintenance->status === 'proses' ? 'Dalam Proses' : $maintenance->status);
            $tanggal = $maintenance->tanggal_laporan ? \Carbon\Carbon::parse($maintenance->tanggal_laporan)->translatedFormat('j F Y') : '-';
            $biayaInputVal = $maintenance->biaya ? 'Rp ' . number_format($maintenance->biaya, 0, ',', '.') : '';

        @endphp

        <div class="maintenance-detail-grid">

            <div class="maintenance-card">

                <div class="report-profile">
                    <div class="report-avatar">{{ sprintf("%02d", $nomorKamar) }}</div>

                    <div>
                        <h3>{{ $maintenance->nama_perbaikan }}</h3>
                        <span class="report-status">{{ $badgeText }}</span>
                    </div>
                </div>

                <div class="report-info-list">
                    <div class="report-info-row">
                        <span>Kamar</span>
                        <strong>Kamar {{ sprintf("%02d", $nomorKamar) }} · {{ $tipeKamar }}</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Tanggal Laporan</span>
                        <strong>{{ $tanggal }}</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Jenis / Nama Perbaikan</span>
                        <strong>{{ $maintenance->nama_perbaikan }}</strong>
                    </div>

                    <div class="report-info-row">
                        <span>Status Saat Ini</span>
                        <strong>{{ $badgeText }}</strong>
                    </div>
                </div>

                <div class="report-description">
                    <h4>Deskripsi Keluhan</h4>
                    <p>
                        {{ $maintenance->deskripsi ?? 'Tidak ada catatan keluhan tambahan.' }}
                    </p>
                </div>

                <div class="report-photo">
                    <h4>Foto Kerusakan</h4>
                    <div class="photo-preview">
                        @if($maintenance->foto_maintenance && file_exists(public_path('images/maintenance/' . $maintenance->foto_maintenance)))
                            <img id="imagePreview" src="{{ asset('images/maintenance/' . $maintenance->foto_maintenance) }}" alt="Foto Kerusakan">
                        @else
                            <img id="imagePreview" src="#" alt="Pratinjau Foto" style="display: none;">
                            <span id="previewPlaceholder">Belum ada foto kerusakan yang diunggah</span>
                        @endif
                    </div>

                    <label class="photo-action-btn" style="text-align: center; cursor: pointer;">
                        Ganti Foto Kerusakan
                        <input type="file" id="fotoMaintenanceInput" name="foto_maintenance" form="updateMaintenanceForm" accept="image/*" style="display: none;">
                    </label>
                </div>

            </div>

            <div class="maintenance-card">

                <h3 class="decision-title">Keputusan Admin</h3>
                <p class="decision-desc">
                    Sesuaikan status perbaikan, estimasi biaya, dan tanggal target selesai secara berkala hingga perbaikan rampung.
                </p>

                <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST" enctype="multipart/form-data" id="updateMaintenanceForm" class="decision-form">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="kamar" value="{{ $maintenance->kamar_id }}">
                    <input type="hidden" name="nama_perbaikan" value="{{ $maintenance->nama_perbaikan }}">
                    <input type="hidden" name="tanggal_laporan" value="{{ $maintenance->tanggal_laporan }}">

                    <div class="decision-field">
                        <label>Status Maintenance</label>
                        <select name="status">
                            <option value="menunggu" {{ old('status', $maintenance->status) === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses" {{ old('status', $maintenance->status) === 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="selesai" {{ old('status', $maintenance->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="decision-field">
                        <label>Estimasi Biaya</label>
                        <input type="text" name="biaya" value="{{ old('biaya', $biayaInputVal) }}" placeholder="Contoh: Rp 200.000">
                    </div>

                    <div class="decision-field">
                        <label>Estimasi Selesai</label>
                        <input type="date" name="estimasi_selesai" value="{{ old('estimasi_selesai', $maintenance->estimasi_selesai) }}">
                    </div>

                    <div class="decision-actions">
                        <button type="submit" class="decision-btn decision-approve">
                            Edit Data Maintenance
                        </button>
                    </div>

                    <p class="decision-note">
                        Data ini masuk ke daftar maintenance dan bisa dipantau status pengerjaannya.
                    </p>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('fotoMaintenanceInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('imagePreview');
        const placeholder = document.getElementById('previewPlaceholder');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                if (placeholder) placeholder.style.display = 'none';
            }

            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
