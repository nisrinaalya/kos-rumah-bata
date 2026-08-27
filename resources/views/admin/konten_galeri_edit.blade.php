@extends('admin.layout')

@section('page-title', 'Edit Galeri')
@section('page-subtitle', 'Perbarui foto galeri yang tampil di landing page pelanggan.')

@section('content')

<style>
    .gallery-edit-page {
        display: grid;
        gap: 22px;
    }

    .gallery-edit-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .gallery-edit-head {
        padding-bottom: 22px;
        margin-bottom: 24px;
        border-bottom: 1px solid #f0e3dd;
    }

    .gallery-edit-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .gallery-edit-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
    }

    .gallery-edit-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 22px;
        align-items: start;
    }

    .gallery-edit-form {
        display: grid;
        gap: 18px;
    }

    .gallery-form-box {
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 22px;
        background: #fffdfb;
        display: grid;
        gap: 18px;
    }

    .gallery-form-box h3 {
        margin: 0;
        color: #211713;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .gallery-form-grid {
        display: grid;
        grid-template-columns: 1fr 160px;
        gap: 18px;
    }

    .gallery-field label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .gallery-field input,
    .gallery-field textarea,
    .gallery-field select {
        width: 100%;
        border: 1px solid #ead6ce;
        border-radius: 15px;
        padding: 0 14px;
        font-size: 14px;
        color: #211713;
        font-family: inherit;
        outline: none;
        background: #ffffff;
        box-sizing: border-box;
    }

    .gallery-field input,
    .gallery-field select {
        height: 48px;
    }

    .gallery-field textarea {
        padding: 12px 14px;
        resize: vertical;
        min-height: 90px;
    }

    .gallery-field input[type="file"] {
        padding: 12px 14px;
    }

    .gallery-field input:focus,
    .gallery-field textarea:focus,
    .gallery-field select:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .gallery-current-file {
        margin-top: 8px;
        color: #86766f;
        font-size: 12px;
        line-height: 1.5;
    }

    .gallery-note {
        border: 1px solid #ead6ce;
        background: #fbf5f1;
        color: #7a5d52;
        border-radius: 16px;
        padding: 14px 16px;
        font-size: 13px;
        line-height: 1.6;
    }

    /* --- CSS Preview Card --- */
    .gallery-preview-card {
        border: 1px solid #ead6ce;
        border-radius: 24px;
        background: #ffffff;
        overflow: hidden;
        position: sticky;
        top: 98px;
    }

    .gallery-preview-image {
        height: 280px;
        background-size: cover;
        background-position: center;
        background-color: #fbf5f1;
        position: relative;
        overflow: hidden;
    }

    .gallery-preview-image::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(33, 23, 19, 0.9) 10%, rgba(33, 23, 19, 0.3) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .gallery-hover-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        color: #ffffff;
        z-index: 2;
        transform: translateY(20px);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .gallery-hover-title {
        margin: 0 0 6px;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .gallery-hover-desc {
        margin: 0;
        font-size: 13px;
        line-height: 1.5;
        color: #f4ddd4;
    }

    .gallery-preview-card:hover .gallery-preview-image::before {
        opacity: 1;
    }

    .gallery-preview-card:hover .gallery-hover-content {
        transform: translateY(0);
        opacity: 1;
    }

    .gallery-preview-body {
        padding: 16px;
        border-top: 1px solid #f0e3dd;
        background: #fffdfb;
    }

    .gallery-preview-title {
        margin: 0 0 12px;
        color: #86766f;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .gallery-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .gallery-badge {
        min-height: 28px;
        padding: 0 10px;
        border-radius: 999px;
        background: #fbf5f1;
        border: 1px solid #eee1da;
        color: #7a5d52;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .gallery-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .gallery-btn {
        min-height: 44px;
        min-width: 120px;
        border-radius: 14px;
        padding: 0 18px;
        border: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .gallery-btn-primary {
        background: #c8664a;
        color: #ffffff;
    }

    .gallery-btn-primary:hover {
        background: #b75a41;
    }

    .gallery-btn-secondary {
        background: #f4ddd4;
        color: #c8664a;
    }

    .gallery-btn-secondary:hover {
        background: #ebcec2;
    }

    @media (max-width: 1000px) {
        .gallery-edit-grid {
            grid-template-columns: 1fr;
        }
        .gallery-preview-card {
            position: static;
        }
    }

    @media (max-width: 620px) {
        .gallery-edit-panel {
            padding: 22px;
        }
        .gallery-edit-head h2 {
            font-size: 24px;
        }
        .gallery-form-grid {
            grid-template-columns: 1fr;
        }
        .gallery-actions {
            display: grid;
            grid-template-columns: 1fr;
        }
        .gallery-btn {
            width: 100%;
        }
    }
</style>

<div class="gallery-edit-page">
    <div class="gallery-edit-panel">

        <div class="gallery-edit-head">
            <h2>Form Edit Galeri</h2>
            <p>Ubah foto, informasi teks, status, dan urutan galeri yang akan tampil di landing page.</p>
        </div>

        <div class="gallery-edit-grid">

            <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="gallery-edit-form">
                @csrf
                @method('PUT')

                <div class="gallery-form-box">
                    <h3>Data Foto & Konten</h3>

                    <div class="gallery-field">
                        <label>Ganti Foto</label>
                        <input type="file" id="imageInput" name="image" accept="image/*">
                        <div class="gallery-current-file">
                            File saat ini: {{ basename($galeri->image) }}
                        </div>
                    </div>

                    <div class="gallery-field">
                        <label>Judul Kegiatan</label>
                        <input type="text" id="titleInput" name="title" value="{{ old('title', $galeri->title) }}" placeholder="Contoh: Makan Malam Bersama" required>
                    </div>

                    <div class="gallery-field">
                        <label>Deskripsi Singkat</label>
                        <textarea id="descInput" name="description" placeholder="Tuliskan deskripsi singkat" required>{{ old('description', $galeri->description) }}</textarea>
                    </div>

                    <div class="gallery-form-grid">
                        <div class="gallery-field">
                            <label>Status</label>
                            <select id="statusInput" name="status">
                                <option value="aktif" {{ $galeri->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $galeri->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="gallery-field">
                            <label>Urutan</label>
                            <input type="number" id="sortInput" name="sort_order" value="{{ old('sort_order', $galeri->sort_order) }}" min="1" required>
                        </div>
                    </div>

                    <div class="gallery-note">
                        Foto, judul, dan deskripsi ini akan tersimpan ke database dan muncul secara interaktif ketika dilewati kursor (hover) oleh pengunjung web.
                    </div>
                </div>

                <div class="gallery-actions">
                    <a href="{{ route('galeri.index') }}" class="gallery-btn gallery-btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="gallery-btn gallery-btn-primary">
                        Update Galeri
                    </button>
                </div>
            </form>

            <div class="gallery-preview-card">
                <div class="gallery-preview-image" id="cardImagePreview" style="background-image: url('{{ asset($galeri->image) }}');">
                    <div class="gallery-hover-content">
                        <h4 class="gallery-hover-title" id="previewTitle">{{ $galeri->title }}</h4>
                        <p class="gallery-hover-desc" id="previewDesc">{{ $galeri->description }}</p>
                    </div>
                </div>

                <div class="gallery-preview-body">
                    <h3 class="gallery-preview-title">Arahkan Kursor untuk melihat Preview</h3>
                    <div class="gallery-meta">
                        <span class="gallery-badge" id="previewSort">Urutan: {{ $galeri->sort_order }}</span>
                        <span class="gallery-badge" id="previewStatus" style="text-transform: capitalize;">{{ $galeri->status }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    const titleInput = document.getElementById('titleInput');
    const descInput = document.getElementById('descInput');
    const sortInput = document.getElementById('sortInput');
    const statusInput = document.getElementById('statusInput');
    const imageInput = document.getElementById('imageInput');

    const previewTitle = document.getElementById('previewTitle');
    const previewDesc = document.getElementById('previewDesc');
    const previewSort = document.getElementById('previewSort');
    const previewStatus = document.getElementById('previewStatus');
    const cardImagePreview = document.getElementById('cardImagePreview');

    titleInput.addEventListener('input', function() {
        previewTitle.textContent = this.value || 'Judul Kegiatan';
    });

    descInput.addEventListener('input', function() {
        previewDesc.textContent = this.value || 'Deskripsi singkat kegiatan.';
    });

    sortInput.addEventListener('input', function() {
        previewSort.textContent = 'Urutan: ' + (this.value || '1');
    });

    statusInput.addEventListener('change', function() {
        previewStatus.textContent = this.value;
    });

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                cardImagePreview.style.backgroundImage = `url('${e.target.result}')`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
