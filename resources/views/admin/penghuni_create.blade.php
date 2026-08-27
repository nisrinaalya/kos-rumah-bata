@extends('admin.layout')

@section('content')

<style>
    .create-panel {
        background: white;
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 26px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 18px;
    }

    .form-full {
        grid-column: span 2;
    }

    .upload-box {
        border: 1px dashed #dca999;
        background: #faf1ed;
        border-radius: 16px;
        padding: 22px;
        text-align: center;
        color: #c8664a;
    }

    .upload-box p {
        margin: 0 0 10px;
        font-weight: 600;
    }

    .form-actions {
        margin-top: 22px;
        display: flex;
        gap: 10px;
    }

    @media (max-width: 850px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-full {
            grid-column: span 1;
        }
    }
</style>

<div class="topbar">
    <div>
        <h2>Tambah Penghuni</h2>
        <p>Tambahkan data penghuni aktif secara manual.</p>
    </div>

    <a href="/admin/penghuni" class="btn btn-secondary">Kembali</a>
</div>

<div class="create-panel">
    <form action="/admin/penghuni" method="GET" enctype="multipart/form-data">

        <div class="form-grid">

            <div>
                <label>Nama Lengkap</label>
                <input type="text" placeholder="Contoh: Nadya Putri">
            </div>

            <div>
                <label>Tipe Penghuni</label>
                <select>
                    <option>Mahasiswi</option>
                    <option>Pekerja</option>
                </select>
            </div>

            <div>
                <label>Kamar</label>
                <select>
                    <option>Kamar A1 — Standard</option>
                    <option>Kamar A2 — Deluxe AC</option>
                    <option>Kamar B1 — Standard</option>
                    <option>Kamar B2 — Deluxe AC</option>
                </select>
            </div>

            <div>
                <label>Tower</label>
                <select>
                    <option>Tower Ganjil</option>
                    <option>Tower Genap</option>
                </select>
            </div>

            <div>
                <label>No. HP / WhatsApp</label>
                <input type="text" placeholder="Contoh: 0812-3456-7890">
            </div>

            <div>
                <label>Kontak Orang Tua</label>
                <input type="text" placeholder="Contoh: 0813-2222-1111">
            </div>

            <div>
                <label>Tanggal Masuk</label>
                <input type="date">
            </div>

            <div>
                <label>Status Penghuni</label>
                <select>
                    <option>Aktif</option>
                    <option>Menunggu Pembayaran</option>
                    <option>Tidak Aktif</option>
                </select>
            </div>

            <div class="form-full">
                <label>Alamat Asal</label>
                <textarea placeholder="Masukkan alamat asal penghuni"></textarea>
            </div>

            <div>
                <label>Foto KTP</label>
                <div class="upload-box">
                    <p>Upload foto KTP penghuni</p>
                    <input type="file" accept="image/*">
                </div>
            </div>

            <div>
                <label>Surat Komitmen</label>
                <div class="upload-box">
                    <p>Upload surat komitmen penghuni</p>
                    <input type="file" accept=".pdf,image/*">
                </div>
            </div>

            <div class="form-full">
                <label>Catatan Admin</label>
                <textarea placeholder="Contoh: Data ditambahkan manual oleh owner / sudah dicek langsung."></textarea>
            </div>

        </div>

        <div class="form-actions">
            <a href="/admin/penghuni" class="btn">Simpan</a>
            <a href="/admin/penghuni" class="btn btn-secondary">Batal</a>
        </div>

    </form>
</div>

@endsection