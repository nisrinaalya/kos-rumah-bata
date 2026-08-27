@extends('admin.layout')

@section('page-title', 'Galeri')
@section('page-subtitle', 'Kelola foto galeri yang tampil di landing page pelanggan.')

@section('content')

<style>
    .gallery-page {
        display: grid;
        gap: 22px;
    }

    .gallery-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .gallery-head {
        margin-bottom: 24px;
    }

    .gallery-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .gallery-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
    }

    .gallery-form {
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 22px;
        background: #fffdfb;
        margin-bottom: 24px;
    }

    .gallery-form h3 {
        margin: 0 0 18px;
        color: #211713;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .gallery-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }

    .gallery-form-footer {
        display: grid;
        grid-template-columns: 1fr 150px 170px;
        gap: 14px;
        align-items: end;
    }

    .gallery-field label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .gallery-field input,
    .gallery-field select {
        width: 100%;
        height: 48px;
        border: 1px solid #ead6ce;
        border-radius: 15px;
        padding: 0 14px;
        font-size: 14px;
        color: #211713;
        font-family: inherit;
        outline: none;
        background: #ffffff;
    }

    .gallery-field input[type="file"] {
        padding: 12px 14px;
        height: 48px;
    }

    .gallery-field input:focus,
    .gallery-field select:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .gallery-add-btn {
        height: 48px;
        border-radius: 15px;
        border: none;
        background: #c8664a;
        color: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .gallery-add-btn:hover {
        background: #b75a41;
    }

    .gallery-toolbar {
        display: grid;
        grid-template-columns: minmax(260px, 420px) auto;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .gallery-search {
        width: 100%;
        height: 48px;
        border: 1px solid #ead6ce;
        border-radius: 15px;
        padding: 0 16px;
        font-size: 14px;
        font-family: inherit;
        color: #211713;
        outline: none;
        background: #ffffff;
    }

    .gallery-search:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .gallery-count {
        color: #86766f;
        font-size: 13px;
        white-space: nowrap;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .gallery-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 24px;
        overflow: hidden;
        transition: 0.2s ease;
    }

    .gallery-card:hover {
        border-color: #dfc6ba;
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        transform: translateY(-2px);
    }

    .gallery-image {
        height: 230px;
        background-size: cover;
        background-position: center;
        background-color: #fbf5f1;
    }

    .gallery-info {
        padding: 16px 16px 8px;
        border-bottom: 1px dashed #f5edea;
    }

    .gallery-title-text {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
        color: #211713;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .gallery-desc-text {
        margin: 0;
        font-size: 13px;
        color: #86766f;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
        height: 36px;
    }

    .gallery-body {
        padding: 14px 16px 16px;
    }

    .gallery-meta {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 14px;
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
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .gallery-btn-small {
        min-height: 42px;
        border: none;
        border-radius: 13px;
        padding: 0 16px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
    }

    .gallery-edit {
        background: #c8664a;
        color: #ffffff;
    }

    .gallery-edit:hover {
        background: #b75a41;
    }

    .gallery-delete {
        background: #f4ddd4;
        color: #c8664a;
    }

    .gallery-delete:hover {
        background: #ebcec2;
    }

    .gallery-empty {
        display: none;
        text-align: center;
        padding: 38px 20px;
        border: 1px dashed #ead6ce;
        border-radius: 20px;
        background: #fffdfb;
        color: #86766f;
        margin-top: 14px;
    }

    .gallery-empty.show {
        display: block;
    }

    .gallery-empty strong {
        display: block;
        color: #211713;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .alert-success {
        padding: 16px;
        background-color: #e6f4ea;
        border: 1px solid #34a853;
        color: #137333;
        border-radius: 18px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    @media (max-width: 1150px) {
        .gallery-form-row {
            grid-template-columns: 1fr;
            gap: 14px;
        }
        .gallery-form-footer {
            grid-template-columns: 1fr 150px;
        }
        .gallery-add-btn {
            grid-column: 1 / -1;
        }
        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .gallery-panel {
            padding: 22px;
        }
        .gallery-form-footer,
        .gallery-toolbar,
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        .gallery-add-btn {
            grid-column: auto;
            width: 100%;
        }
    }
</style>

<div class="gallery-page">

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="gallery-panel">
        <div class="gallery-head">
            <h2>Kelola Galeri</h2>
            <p>Upload dan atur foto beserta info overlay yang akan tampil di halaman tentang kami pelanggan.</p>
        </div>

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" class="gallery-form">
            @csrf

            <h3>Tambah Foto Galeri</h3>

            <div class="gallery-form-row">
                <div class="gallery-field">
                    <label>Judul Kegiatan / Foto</label>
                    <input type="text" name="title" placeholder="Contoh: Kamar Deluxe AC" required>
                </div>

                <div class="gallery-field">
                    <label>Deskripsi Singkat (Muncul saat di-hover)</label>
                    <input type="text" name="description" placeholder="Contoh: Fasilitas pendingin ruangan..." required>
                </div>
            </div>

            <div class="gallery-form-footer">
                <div class="gallery-field">
                    <label>Upload Foto</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>

                <div class="gallery-field">
                    <label>Status</label>
                    <select name="status">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="gallery-field">
                    <label>Urutan Tampil</label>
                    <input type="number" name="sort_order" placeholder="1" value="1" min="1">
                </div>

                <button type="submit" class="gallery-add-btn">Tambah Foto</button>
            </div>
        </form>
    </div>

    <div class="gallery-panel">
        <div class="gallery-toolbar">
            <input type="text" id="gallerySearch" class="gallery-search" placeholder="Cari foto berdasarkan judul, status, atau urutan...">
            <div class="gallery-count">{{ $galeris->count() }} foto ditampilkan</div>
        </div>

        <div class="gallery-grid" id="galleryList">

            @forelse($galeris as $index => $item)
                <div class="gallery-card" data-search="{{ strtolower($item->title) }} {{ strtolower($item->status) }} urutan-{{ $item->sort_order }}">

                    <div class="gallery-image" style="background-image: url('{{ asset($item->image) }}');"></div>

                    <div class="gallery-info">
                        <h4 class="gallery-title-text">{{ $item->title }}</h4>
                        <p class="gallery-desc-text">{{ $item->description }}</p>
                    </div>

                    <div class="gallery-body">
                        <div class="gallery-meta">
                            <span class="gallery-badge">Urutan: {{ $item->sort_order }}</span>
                            <span class="gallery-badge" style="text-transform: capitalize;">{{ $item->status }}</span>
                        </div>

                        <div class="gallery-actions">
                            <a href="{{ route('galeri.edit', $item->id) }}" class="gallery-btn-small gallery-edit">Edit</a>

                            <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto galeri ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="gallery-btn-small gallery-delete" style="width: 100%; border: none;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById('galleryEmpty').classList.add('show');
                    });
                </script>
            @endforelse

        </div>

        <div class="gallery-empty" id="galleryEmpty">
            <strong>Foto tidak ditemukan</strong>
            <span>Belum ada foto galeri yang diunggah atau kata kunci tidak sesuai.</span>
        </div>
    </div>

</div>

<script>
    // Fitur Pencarian / Filter Realtime Sisi Client
    const gallerySearch = document.getElementById('gallerySearch');
    const galleryItems = document.querySelectorAll('.gallery-card');
    const galleryEmpty = document.getElementById('galleryEmpty');
    const galleryCountDisplay = document.querySelector('.gallery-count');

    gallerySearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        galleryItems.forEach(item => {
            const searchTarget = item.dataset.search;

            if (searchTarget.includes(keyword)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Tampilkan teks info pencarian kosong jika tidak ada yang cocok
        galleryEmpty.classList.toggle('show', visibleCount === 0);
        galleryCountDisplay.textContent = `${visibleCount} foto ditampilkan`;
    });
</script>

@endsection
