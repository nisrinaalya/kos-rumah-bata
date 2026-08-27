@extends('admin.layout')

@section('page-title', 'Edit Penghuni')
@section('page-subtitle', 'Perbarui data penghuni aktif Kos Rumah Bata.')

@section('content')

<style>
    .tenant-form-page {
        display: grid;
        gap: 22px;
    }

    .tenant-form-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .tenant-form-head {
        margin-bottom: 24px;
    }

    .tenant-form-head h2 {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .tenant-form-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
    }

    .tenant-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .tenant-form-full {
        grid-column: 1 / -1;
    }

    .tenant-form-group {
        margin: 0;
    }

    .tenant-form-group label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .tenant-form-group input,
    .tenant-form-group select,
    .tenant-form-group textarea {
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

    .tenant-form-group textarea {
        min-height: 115px;
        resize: vertical;
    }

    .tenant-form-group input:focus,
    .tenant-form-group select:focus,
    .tenant-form-group textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .tenant-form-hint {
        display: block;
        margin-top: 7px;
        color: #9a8d85;
        font-size: 12px;
        line-height: 1.5;
    }

    .tenant-doc-box {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        padding: 18px;
        background: #fffdfb;
    }

    .tenant-doc-title {
        margin: 0 0 14px;
        color: #211713;
        font-size: 16px;
        font-weight: 700;
    }

    .tenant-doc-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .tenant-upload {
        border: 1px dashed #dca999;
        background: #fbf5f1;
        border-radius: 18px;
        padding: 16px;
    }

    .tenant-upload label {
        display: block;
        margin-bottom: 10px;
        color: #211713;
        font-size: 13px;
        font-weight: 600;
    }

    .tenant-upload input {
        width: 100%;
        border: 1px solid #eee1da;
        background: #ffffff;
        border-radius: 12px;
        padding: 11px;
        font-size: 13px;
        font-family: inherit;
    }

    .tenant-current-file {
        margin-top: 8px;
        color: #86766f;
        font-size: 12px;
        line-height: 1.5;
    }

    .tenant-form-actions {
        margin-top: 24px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .tenant-form-actions .btn {
        min-width: 120px;
        height: 46px;
        border: 1px solid #c8664a;
        background: #c8664a;
        color: #ffffff;
        border-radius: 15px;
        padding: 0 18px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
        text-decoration: none;
    }

    .tenant-form-actions .btn:hover {
        background: #b75a41;
    }

    .tenant-form-actions .btn-secondary {
        background: #f4ddd4;
        border-color: #ead6ce;
        color: #c8664a;
    }

    .tenant-form-actions .btn-secondary:hover {
        background: #ebcec2;
    }

    @media (max-width: 900px) {
        .tenant-form-grid,
        .tenant-doc-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .tenant-form-panel {
            padding: 22px;
        }

        .tenant-form-head h2 {
            font-size: 24px;
        }

        .tenant-form-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .tenant-form-actions .btn {
            width: 100%;
        }
    }
</style>

@php
    // Membaca data pengajuan sewa aktif dari user saat ini
    $sewaAktif = $penghuni->pengajuanSewa->first();
    $kamarIdSekarang = $sewaAktif ? $sewaAktif->kamar_id : null;
    $tanggalMasuk = $sewaAktif ? \Carbon\Carbon::parse($sewaAktif->tanggal_mulai)->format('Y-m-d') : '';
    $catatanSewa = $sewaAktif ? $sewaAktif->catatan : '';

    // Kalkulasi ringkasan status pembayaran saat ini
    $totalTagihan = 0;
    $totalSudahBayar = 0;
    if ($sewaAktif) {
        $hargaKamar = $sewaAktif->kamar ? $sewaAktif->kamar->harga : 0;
        $totalTagihan = $hargaKamar * $sewaAktif->durasi_sewa;
        $totalSudahBayar = $sewaAktif->pembayarans->where('status', 'disetujui')->sum('nominal');
    }
    $sisaTagihan = $totalTagihan - $totalSudahBayar;
@endphp

<div class="tenant-form-page">
    <div class="tenant-form-panel">

        <div class="tenant-form-head">
            <h2>Form Edit Penghuni</h2>
            <p>Ubah data penghuni, kamar, kontak keluarga, dan dokumen administrasi.</p>
        </div>

        @if ($errors->any())
            <div style="background: #fdf2f2; border: 1px solid #f8b4b4; padding: 16px; border-radius: 15px; margin-bottom: 20px; color: #9b1c1c; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/penghuni/{{ $penghuni->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="tenant-form-grid">

                <div class="tenant-form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $penghuni->nama) }}" required>
                </div>

                <div class="tenant-form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $penghuni->email) }}" required>
                </div>

                <div class="tenant-form-group">
                    <label>Kamar</label>
                    <select name="kamar_id" required>
                        @foreach($allKamar as $kamar)
                            @php
                                // Filter: Kamar hanya muncul jika statusnya 'tersedia' ATAU kamar tersebut merupakan kamar yang sedang ditempati saat ini oleh si penghuni
                                $isKamarSekarang = ($kamar->id == $kamarIdSekarang);
                                $isTersedia = (strtolower($kamar->status) == 'tersedia');
                            @endphp

                            @if($isTersedia || $isKamarSekarang)
                                <option value="{{ $kamar->id }}" {{ $isKamarSekarang ? 'selected' : '' }}>
                                    Kamar {{ $kamar->nomor_kamar }} · Tower {{ ucfirst($kamar->tower) }}
                                    @if($isKamarSekarang) (Kamar Saat Ini) @endif
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="tenant-form-group">
                    <label>No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $penghuni->no_hp) }}">
                </div>

                <div class="tenant-form-group">
                    <label>Kontak Orang Tua / Darurat</label>
                    <input type="text" name="kontak_darurat" value="{{ old('kontak_darurat', $penghuni->kontak_darurat) }}">
                </div>

                <div class="tenant-form-group">
                    <label>Tanggal Mulai Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $tanggalMasuk) }}">
                </div>

                <div class="tenant-form-full tenant-form-group">
                    <label>Alamat Asal</label>
                    <textarea name="alamat">{{ old('alamat', $penghuni->alamat) }}</textarea>
                </div>

                <div class="tenant-form-full">
                    <div class="tenant-doc-box">
                        <p class="tenant-doc-title">Dokumen Penghuni</p>

                        <div class="tenant-doc-grid">
                            <div class="tenant-upload">
                                <label>Ganti Foto KTP</label>
                                <input type="file" name="foto_ktp" accept="image/*,.pdf">
                                <div class="tenant-current-file">
                                    File saat ini:
                                    @if($penghuni->ktp_dokumen)
                                        <a href="{{ $penghuni->ktp_dokumen }}" target="_blank" style="color: #c8664a; font-weight: 600;">Lihat KTP Saat Ini</a>
                                    @else
                                        <span style="color: #c0392b;">Belum ada dokumen</span>
                                    @endif
                                </div>
                            </div>

                            <div class="tenant-upload">
                                <label>Ganti Surat Komitmen</label>
                                <input type="file" name="surat_komitmen" accept=".pdf,image/*">
                                <div class="tenant-current-file">
                                    File saat ini:
                                    @if($penghuni->surat_komitmen)
                                        <a href="{{ $penghuni->surat_komitmen }}" target="_blank" style="color: #c8664a; font-weight: 600;">Lihat Surat Komitmen Saat Ini</a>
                                    @else
                                        <span style="color: #c0392b;">Belum ada dokumen</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="tenant-form-full tenant-form-group">
                    <label>Catatan / Keterangan Pengajuan</label>
                    <textarea name="catatan_admin" placeholder="Keterangan tambahan dari transaksi sewa.">{{ old('catatan_admin', $catatanSewa) }}</textarea>
                </div> --}}

            </div>

            <div class="tenant-form-actions">
                <button type="submit" class="btn">Update</button>
                <a href="/admin/penghuni/{{ $penghuni->id }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

    </div>
</div>

@endsection
