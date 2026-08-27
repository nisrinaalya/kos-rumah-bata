@extends('admin.layout')

@section('page-title', 'Edit Activity')
@section('page-subtitle', 'Perbarui informasi activity yang tampil di landing page pelanggan.')

@section('content')

<style>
    .activity-edit-page {
        display: grid;
        gap: 28px;
    }

    .activity-edit-panel {
        background: #ffffff;
        border: none;
        box-shadow: 0 1px 3px rgba(33, 23, 19, 0.03), 0 4px 20px rgba(66, 38, 22, 0.04), inset 0 0 0 1px rgba(234, 214, 206, 0.4);
        border-radius: 16px;
        padding: 28px;
    }

    .activity-edit-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        padding-bottom: 22px;
        margin-bottom: 24px;
        border-bottom: 1px solid #f0e6e2;
    }

    .activity-edit-head h2 {
        margin: 0;
        color: #2c221e;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .activity-edit-head p {
        margin: 6px 0 0;
        color: #94857e;
        font-size: 14px;
        line-height: 1.6;
        max-width: 640px;
    }

    .activity-status-chip {
        min-height: 32px;
        padding: 0 14px;
        border-radius: 999px;
        background: #e5f7e8;
        border: 1px solid #c2ebd0;
        color: #2e8b45;
        font-size: 12.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .activity-edit-form {
        display: grid;
        gap: 20px;
    }

    .activity-field label {
        display: block;
        margin-bottom: 8px;
        color: #2c221e;
        font-size: 13.5px;
        font-weight: 600;
    }

    .activity-field input,
    .activity-field select,
    .activity-field textarea {
        width: 100%;
        border: 1px solid #f0e6e2;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 14px;
        color: #2c221e;
        font-family: inherit;
        outline: none;
        background: #ffffff;
        transition: all 0.2s ease;
    }

    .activity-field input[type="file"] {
        padding: 10px 12px;
        font-size: 13px;
        color: #94857e;
    }

    .activity-field textarea {
        min-height: 140px;
        resize: vertical;
        line-height: 1.6;
    }

    .activity-field input:focus,
    .activity-field select:focus,
    .activity-field textarea:focus {
        border-color: #c8664a;
        box-shadow: 0 0 0 3px rgba(200, 102, 74, 0.05);
    }

    .activity-checkbox-field {
        position: relative;
        display: block;
        padding: 14px 16px 14px 44px;
        background: #ffffff;
        border: 1px dashed #ead6ce;
        border-radius: 12px;
        cursor: pointer;
        user-select: none;
        min-height: 48px;
    }

    .activity-checkbox-field input[type="checkbox"] {
        position: absolute;
        top: 50%;
        left: 16px;
        transform: translateY(-50%); 
        
        width: 18px !important;
        height: 18px !important;
        margin: 0 !important;
        padding: 0 !important;
        accent-color: #c8664a;
        cursor: pointer;
    }

    .activity-checkbox-field p {
        margin: 0 !important;
        padding: 0 !important;
        font-size: 13.5px;
        font-weight: 600;
        color: #2c221e;
        line-height: 1.5 !important;
        text-align: left;
    }

    .activity-edit-grid-three {
        display: grid;
        grid-template-columns: 1.2fr 1fr 1fr;
        gap: 16px;
    }

    /* Grid layout pendukung untuk pasangan input Link URL dan Label */
    .activity-edit-grid-two {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .activity-current-media {
        margin-top: 8px;
        font-size: 12.5px;
        color: #94857e;
    }

    .activity-current-media a {
        color: #c8664a;
        text-decoration: none;
        font-weight: 600;
    }

    .activity-preview {
        border: none;
        box-shadow: inset 0 0 0 1px #f0e6e2;
        border-radius: 16px;
        padding: 20px;
        background: #fdfcfb;
    }

    .activity-preview h3 {
        margin: 0 0 12px;
        color: #2c221e;
        font-size: 16px;
        font-weight: 700;
    }

    .activity-preview-box {
        border: 1px solid #f0e6e2;
        border-radius: 12px;
        padding: 20px;
        background: #ffffff;
        position: relative;
    }

    .activity-preview-header-line {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 6px;
    }

    .activity-preview-box strong {
        color: #2c221e;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
    }

    .activity-preview-box p {
        margin: 8px 0 0;
        color: #6e605a;
        font-size: 14px;
        line-height: 1.6;
    }

    .activity-preview-link {
        margin-top: 8px;
        font-size: 13px;
        color: #6e605a;
    }

    .activity-preview-link a {
        color: #c8664a;
        text-decoration: none;
        font-weight: 600;
    }

    .activity-preview-image {
        margin-top: 14px;
        max-width: 200px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #f0e6e2;
    }

    .activity-preview-image img {
        width: 100%;
        display: block;
        object-fit: cover;
    }

    .activity-preview-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
    }

    .activity-preview-badge {
        padding: 4px 10px;
        background: #fdfbfb;
        border: 1px solid #f0e6e2;
        border-radius: 999px;
        font-size: 12px;
        color: #7a5d52;
        font-weight: 600;
    }

    .activity-preview-badge.category {
        background: #fff1d6;
        color: #b77700;
        border-color: #ffe6b3;
    }

    .activity-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .activity-btn {
        min-height: 44px;
        min-width: 120px;
        border-radius: 12px;
        padding: 0 20px;
        border: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .activity-btn-primary {
        background: #c8664a;
        color: #ffffff;
    }

    .activity-btn-primary:hover {
        background: #b75a41;
    }

    .activity-btn-secondary {
        background: #fbf1ec;
        color: #c8664a;
    }

    .activity-btn-secondary:hover {
        background: #ebcec2;
    }

    @media (max-width: 900px) {
        .activity-edit-grid-three,
        .activity-edit-grid-two {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .activity-edit-panel {
            padding: 20px;
        }

        .activity-edit-head {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }

    @media (max-width: 520px) {
        .activity-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .activity-btn {
            width: 100%;
        }
    }
</style>

<div class="activity-edit-page">
    <div class="activity-edit-panel">

        <div class="activity-edit-head">
            <div>
                <h2>Form Edit Activity</h2>
                <p>Ubah judul, deskripsi, kategori, serta status sematan pengumuman yang akan tampil di landing page pelanggan.</p>
            </div>

            <span class="activity-status-chip">{{ ucfirst($activity->status) }}</span>
        </div>

        <form action="/admin/konten/activity/{{ $activity->id }}" method="POST" enctype="multipart/form-data" class="activity-edit-form">
            @csrf
            @method('PUT')

            <div class="activity-field">
                <label>Judul Activity</label>
                <input type="text" name="title" value="{{ old('title', $activity->title) }}" required>
            </div>

            <div class="activity-field">
                <label>Deskripsi</label>
                <textarea name="description" required>{{ old('description', $activity->description) }}</textarea>
            </div>

            <div class="activity-edit-grid-two">
                <div class="activity-field">
                    <label>Tautan / Link URL <span style="font-weight:400; color:#94857e;">(Opsional)</span></label>
                    <input type="url" name="link_url" placeholder="Contoh: https://instagram.com/p/..." value="{{ old('link_url', $activity->link_url) }}">
                </div>
                <div class="activity-field">
                    <label>Label Link Tombol <span style="font-weight:400; color:#94857e;">(Opsional)</span></label>
                    <input type="text" name="link_label" placeholder="Contoh: Lihat Detail / Follow Instagram" value="{{ old('link_label', $activity->link_label) }}">
                </div>
            </div>

            <div class="activity-edit-grid-three">
                <div class="activity-field">
                    <label>Ganti Foto <span style="font-weight:400; color:#94857e;">(Opsional)</span></label>
                    <input type="file" name="image" accept="image/*">
                    @if($activity->image)
                    <div class="activity-current-media">
                        File lama: <a href="{{ asset('images/activities/' . $activity->image) }}" target="_blank">{{ $activity->image }}</a>
                    </div>
                    @endif
                </div>

                <div class="activity-field">
                    <label>Kategori</label>
                    <select name="category" required>
                        <option value="Info Kamar" {{ old('category', $activity->category) == 'Info Kamar' ? 'selected' : '' }}>Info Kamar</option>
                        <option value="Update Kos" {{ old('category', $activity->category) == 'Update Kos' ? 'selected' : '' }}>Update Kos</option>
                        <option value="Aktivitas" {{ old('category', $activity->category) == 'Aktivitas' ? 'selected' : '' }}>Aktivitas</option>
                        <option value="Promo" {{ old('category', $activity->category) == 'Promo' ? 'selected' : '' }}>Promo</option>
                        <option value="Social" {{ old('category', $activity->category) == 'Social' ? 'selected' : '' }}>Social</option>
                    </select>
                </div>

                <div class="activity-field">
                    <label>Tanggal Rilis</label>
                    <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($activity->date)->format('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="activity-field">
                <label>Pengaturan Sematan</label>
                <label class="activity-checkbox-field">
                    <input type="checkbox" name="is_pinned" value="1" {{ old('is_pinned', $activity->is_pinned) ? 'checked' : '' }}>
                    <p>Sematkan aktivitas ini di bagian paling atas feed beranda</p>
                </label>
            </div>

            <div class="activity-preview">
                <h3>Preview Tampilan Komponen</h3>

                <div class="activity-preview-box">
                    <div class="activity-preview-header-line">
                        <strong>{{ $activity->title }}</strong>
                        
                        <span id="previewPinBadge" style="font-size: 11px; font-weight: 600; color: #c8664a; display: {{ $activity->is_pinned ? 'inline-flex' : 'none' }}; align-items: center; gap: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                            </svg>
                            Disematkan
                        </span>
                    </div>
                    
                    <p>{{ $activity->description }}</p>
                    
                    @if($activity->link_url)
                    <div class="activity-preview-link">
                        Tautan tombol: <a href="{{ $activity->link_url }}" target="_blank">{{ $activity->link_label ?? 'Buka Link' }}</a>
                    </div>
                    @endif
                    
                    @if($activity->image)
                    <div class="activity-preview-image">
                        <img src="{{ asset('images/activities/' . $activity->image) }}" alt="Preview {{ $activity->title }}">
                    </div>
                    @endif

                    <div class="activity-preview-meta">
                        <span class="activity-preview-badge">{{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}</span>
                        <span class="activity-preview-badge category">Kategori: {{ $activity->category }}</span>
                    </div>
                </div>
            </div>

            <div class="activity-actions">
                <a href="/admin/konten/activity" class="activity-btn activity-btn-secondary">Batal</a>
                <button type="submit" class="activity-btn activity-btn-primary">Perbarui Aktivitas</button>
            </div>
        </form>

    </div>
</div>

<script>
    const pinCheckbox = document.querySelector('input[name="is_pinned"]');
    const previewPinBadge = document.getElementById('previewPinBadge');

    if (pinCheckbox && previewPinBadge) {
        pinCheckbox.addEventListener('change', function() {
            previewPinBadge.style.display = this.checked ? 'inline-flex' : 'none';
        });
    }
</script>

@endsection