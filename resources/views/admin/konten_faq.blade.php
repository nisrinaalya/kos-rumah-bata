@extends('admin.layout')

@section('page-title', 'FAQ')
@section('page-subtitle', 'Kelola pertanyaan yang tampil di landing page pelanggan.')

@section('content')

<style>
    .faq-page {
        display: grid;
        gap: 22px;
    }

    .faq-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .faq-head {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .faq-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .faq-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 650px;
    }

    .faq-add-btn {
        min-height: 44px;
        border-radius: 14px;
        padding: 0 18px;
        background: #c8664a;
        color: #ffffff;
        text-decoration: none;
        border: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        transition: 0.2s ease;
    }

    .faq-add-btn:hover {
        background: #b75a41;
    }

    .faq-form {
        display: grid;
        gap: 16px;
        padding: 20px;
        border: 1px solid #ead6ce;
        border-radius: 22px;
        background: #fffdfb;
        margin-bottom: 24px;
    }

    .faq-form h3 {
        margin: 0;
        color: #211713;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .faq-field label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .faq-field input,
    .faq-field select,
    .faq-field textarea {
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

    .faq-field textarea {
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .faq-field input:focus,
    .faq-field select:focus,
    .faq-field textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .faq-form-grid {
        display: grid;
        grid-template-columns: 1fr 180px;
        gap: 16px;
    }

    .faq-form-actions {
        display: flex;
        justify-content: flex-end;
    }

    .faq-toolbar {
        display: grid;
        grid-template-columns: minmax(260px, 420px) auto;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .faq-search {
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

    .faq-search:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .faq-count {
        color: #86766f;
        font-size: 13px;
        white-space: nowrap;
    }

    .faq-list {
        display: grid;
        gap: 14px;
    }

    .faq-item {
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 18px;
        background: #ffffff;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 18px;
        align-items: center;
        transition: 0.2s ease;
    }

    .faq-item:hover {
        border-color: #dfc6ba;
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        transform: translateY(-2px);
    }

    .faq-info h3 {
        margin: 0;
        color: #211713;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .faq-info p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.7;
    }

    .faq-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .faq-badge {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        padding: 0 10px;
        border-radius: 999px;
        background: #fbf5f1;
        border: 1px solid #eee1da;
        color: #7a5d52;
        font-size: 12px;
        font-weight: 600;
    }

    .faq-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
        flex-wrap: wrap;
    }

    .faq-btn-small {
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
        white-space: nowrap;
    }

    .faq-edit {
        background: #c8664a;
        color: #ffffff;
    }

    .faq-edit:hover {
        background: #b75a41;
    }

    .faq-delete {
        background: #f4ddd4;
        color: #c8664a;
    }

    .faq-delete:hover {
        background: #ebcec2;
    }

    .faq-empty {
        display: none;
        text-align: center;
        padding: 38px 20px;
        border: 1px dashed #ead6ce;
        border-radius: 20px;
        background: #fffdfb;
        color: #86766f;
        margin-top: 14px;
    }

    .faq-empty.show {
        display: block;
    }

    .faq-empty strong {
        display: block;
        color: #211713;
        font-size: 18px;
        margin-bottom: 8px;
    }

    @media (max-width: 900px) {
        .faq-head,
        .faq-form-grid,
        .faq-toolbar,
        .faq-item {
            grid-template-columns: 1fr;
        }

        .faq-count {
            white-space: normal;
        }

        .faq-actions {
            justify-content: flex-start;
        }
    }

    @media (max-width: 520px) {
        .faq-panel {
            padding: 22px;
        }

        .faq-head h2 {
            font-size: 24px;
        }

        .faq-form {
            padding: 18px;
        }

        .faq-form-actions,
        .faq-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .faq-add-btn,
        .faq-btn-small {
            width: 100%;
        }
    }
</style>

<div class="faq-page">

    @if(session('success'))
        <div style="background: #e6f4ea; border: 1px solid #b7e1cd; color: #137333; padding: 16px; border-radius: 15px; font-size: 14px; font-weight: 600;">
            {{ session('success') }}
        </div>
    @endif

    <div class="faq-panel">

        <div class="faq-head">
            <div>
                <h2>Kelola FAQ</h2>
                <p>Atur pertanyaan dan jawaban yang akan tampil di landing page agar calon penghuni lebih mudah memahami informasi kos.</p>
            </div>
        </div>

        <form action="/admin/konten/faq" method="POST" class="faq-form">
            @csrf

            <h3>Tambah FAQ Baru</h3>

            <div class="faq-field">
                <label>Pertanyaan</label>
                <input type="text" name="question" placeholder="Contoh: Apakah kos menerima mahasiswa?" required value="{{ old('question') }}">
            </div>

            <div class="faq-field">
                <label>Jawaban</label>
                <textarea name="answer" placeholder="Tulis jawaban yang akan tampil di landing page." required>{{ old('answer') }}</textarea>
            </div>

            <div class="faq-form-grid">
                <div class="faq-field">
                    <label>Status Tampil</label>
                    <select name="status" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="faq-field">
                    <label>Urutan</label>
                    <input type="number" name="sort_order" placeholder="1" min="1" required value="{{ old('sort_order', 1) }}">
                </div>
            </div>

            <div class="faq-form-actions">
                <button type="submit" class="faq-add-btn">Tambah FAQ</button>
            </div>
        </form>

    </div>

    <div class="faq-panel">

        <div class="faq-toolbar">
            <input type="text" id="faqSearch" class="faq-search" placeholder="Cari pertanyaan FAQ...">
            <div class="faq-count">{{ $faqs->count() }} FAQ ditampilkan</div>
        </div>

        <div class="faq-list" id="faqList">
            @foreach($faqs as $faq)
            <div class="faq-item" data-name="{{ strtolower($faq->question) }}">
                <div class="faq-info">
                    <h3>{{ $faq->question }}</h3>
                    <p>{{ $faq->answer }}</p>

                    <div class="faq-meta">
                        <span class="faq-badge">Urutan {{ $faq->sort_order }}</span>
                        <span class="faq-badge">{{ ucfirst($faq->status) }}</span>
                    </div>
                </div>

                <div class="faq-actions">
                    <a href="/admin/konten/faq/{{ $faq->id }}/edit" class="faq-btn-small faq-edit">Edit</a>
                    
                    <form action="/admin/konten/faq/{{ $faq->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="faq-btn-small faq-delete">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="faq-empty {{ $faqs->isEmpty() ? 'show' : '' }}" id="faqEmpty">
            <strong>FAQ tidak ditemukan</strong>
            <span>Coba gunakan kata kunci pencarian yang lain.</span>
        </div>

    </div>

</div>

<script>
    const faqSearch = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const faqEmpty = document.getElementById('faqEmpty');

    faqSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        faqItems.forEach(item => {
            const name = item.dataset.name;

            if (name.includes(keyword)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        faqEmpty.classList.toggle('show', visibleCount === 0);
    });
</script>

@endsection