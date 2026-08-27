@extends('admin.layout')

@section('page-title', 'Tambah Maintenance')
@section('page-subtitle', 'Ajukan perbaikan kamar yang akan diproses admin.')

@section('content')

<style>
    .maintenance-form-page {
        display: grid;
        gap: 22px;
    }

    .maintenance-form-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .maintenance-form-head {
        margin-bottom: 24px;
    }

    .maintenance-form-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .maintenance-form-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 620px;
    }

    .maintenance-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .maintenance-form-full {
        grid-column: 1 / -1;
    }

    .maintenance-form-group label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .maintenance-form-group input,
    .maintenance-form-group select,
    .maintenance-form-group textarea {
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

    .maintenance-form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .maintenance-form-group input:focus,
    .maintenance-form-group select:focus,
    .maintenance-form-group textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .maintenance-form-hint {
        display: block;
        margin-top: 7px;
        color: #9a8d85;
        font-size: 12px;
        line-height: 1.5;
    }

    .maintenance-upload-box {
        border: 1px dashed #dca999;
        background: #fbf5f1;
        border-radius: 18px;
        padding: 18px;
    }

    .maintenance-upload-box input {
        width: 100%;
        border: 1px solid #eee1da;
        background: #ffffff;
        border-radius: 12px;
        padding: 11px;
        font-size: 13px;
        font-family: inherit;
    }

    .maintenance-current-file {
        margin-top: 8px;
        color: #86766f;
        font-size: 12px;
        line-height: 1.5;
    }

    .maintenance-form-actions {
        margin-top: 24px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .maintenance-form-actions .btn {
        min-width: 120px;
    }

    /* Style tambahan untuk pratinjau foto agar selaras dengan desain panel */
    .maintenance-preview-wrapper {
        display: none;
        margin-top: 14px;
        border: 1px solid #ead6ce;
        border-radius: 16px;
        padding: 8px;
        background: #ffffff;
        max-width: 320px;
    }

    .maintenance-preview-wrapper img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        display: block;
    }

    @media (max-width: 900px) {
        .maintenance-form-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .maintenance-form-panel {
            padding: 22px;
        }

        .maintenance-form-head h2 {
            font-size: 24px;
        }

        .maintenance-form-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .maintenance-form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="maintenance-form-page">
    <div class="maintenance-form-panel">

        <div class="maintenance-form-head">
            <h2>Form Tambah Maintenance</h2>
            <p>Tambah data kamar, keluhan, biaya, status pengerjaan, dan catatan perbaikan.</p>
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

        <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="maintenance-form-grid">

                <div class="maintenance-form-group">
                    <label>Kamar</label>
                    <select name="kamar">
                        @foreach($kamars as $kamar)
                            <option value="{{ $kamar->id }}" {{ old('kamar') == $kamar->id ? 'selected' : '' }}>
                                Kamar {{ sprintf("%02d", $kamar->nomor_kamar) }} · Tower {{ $kamar->tower ?? 'Tower' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="maintenance-form-group">
                    <label>Status Maintenance</label>
                    <select name="status">
                        <option value="menunggu" {{ old('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="maintenance-form-group">
                    <label>Nama Perbaikan</label>
                    <input type="text" name="nama_perbaikan" value="{{ old('nama_perbaikan') }}" placeholder="AC Kamar 40 Bocor">
                </div>

                <div class="maintenance-form-group">
                    <label>Biaya</label>
                    <input type="text" name="biaya" value="{{ old('biaya') }}" placeholder="Rp 250.000">
                </div>

                <div class="maintenance-form-group">
                    <label>Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" value="{{ old('tanggal_laporan') }}">
                </div>

                <div class="maintenance-form-group">
                    <label>Estimasi Selesai</label>
                    <input type="date" name="estimasi_selesai" value="{{ old('estimasi_selesai') }}">
                </div>

                <div class="maintenance-form-full maintenance-form-group">
                    <label>Keluhan / Kerusakan</label>
                    <textarea name="deskripsi" placeholder="AC kamar tidak dingin dan perlu dicek oleh teknisi.">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="maintenance-form-full maintenance-form-group">
                    <label>Foto Kerusakan</label>
                    <div class="maintenance-upload-box">
                        <input type="file" id="fotoMaintenanceInput" name="foto_maintenance" accept="image/*">
                        <div class="maintenance-current-file">
                            Pilih file gambar baru jika ingin mengunggah dokumen/foto kerusakan.
                        </div>

                        <div class="maintenance-preview-wrapper" id="imagePreviewWrapper">
                            <img id="imagePreview" src="#" alt="Pratinjau Foto Kerusakan">
                        </div>
                    </div>
                </div>

            </div>

            <div class="maintenance-form-actions">
                <button type="submit" class="btn">Tambah</button>
                <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

    </div>
</div>

<script>
    // JavaScript Logic untuk menghandle Real-time Image Preview
    document.getElementById('fotoMaintenanceInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewWrapper = document.getElementById('imagePreviewWrapper');
        const previewImage = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewWrapper.style.display = 'block'; // Tampilkan container preview
            }

            reader.readAsDataURL(file);
        } else {
            previewImage.src = '#';
            previewWrapper.style.display = 'none'; // Sembunyikan jika batal memilih gambar
        }
    });
</script>

@endsection
