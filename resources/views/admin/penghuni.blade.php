@extends('admin.layout')

@section('page-title', 'Data Penghuni')
@section('page-subtitle', 'Daftar penghuni aktif Kos Rumah Bata.')

@section('content')

<style>
    .tenant-page {
        display: grid;
        gap: 22px;
    }

    .tenant-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .tenant-panel-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .tenant-panel-head h2 {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .tenant-panel-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 520px;
    }

    .tenant-top-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
        justify-content: flex-end;
    }

    .rent-request-btn {
        height: 46px;
        border: 1px solid #ead6ce;
        background: #fbf5f1;
        color: #c8664a;
        border-radius: 15px;
        padding: 0 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .rent-request-btn:hover {
        background: #f4ddd4;
        border-color: #dfc6ba;
    }

    .rent-request-count {
        min-width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #ef4136;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        padding: 0 6px;
    }

    .tenant-add-btn {
        height: 46px;
        border: 1px solid #c8664a;
        background: #c8664a;
        color: #ffffff;
        border-radius: 15px;
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

    .tenant-add-btn:hover {
        background: #b75a41;
    }

    .tenant-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .tenant-search {
        width: 380px;
        max-width: 100%;
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

    .tenant-search:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .tenant-mini-info {
        color: #86766f;
        font-size: 13px;
    }

    .tenant-list {
        display: grid;
        gap: 13px;
    }

    .tenant-item {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        background: #ffffff;
        padding: 16px;
        display: grid;
        grid-template-columns: 54px 1fr auto;
        gap: 16px;
        align-items: center;
        transition: 0.2s ease;
    }

    .tenant-item:hover {
        border-color: #dfc6ba;
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        transform: translateY(-2px);
    }

    .tenant-avatar {
        width: 52px;
        height: 52px;
        border-radius: 18px;
        background: #fbf5f1;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .tenant-main h3 {
        margin: 0;
        color: #211713;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .tenant-main p {
        margin: 6px 0 0;
        color: #86766f;
        font-size: 14px;
    }

    .tenant-status {
        display: inline-flex;
        margin-top: 10px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #e5f7e8;
        color: #2e8b45;
        font-size: 12px;
        font-weight: 600;
    }

    .tenant-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    .tenant-actions a,
    .tenant-actions button {
        min-height: 42px;
        border: none;
        border-radius: 13px;
        padding: 0 15px;
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

    .btn-detail {
        background: #c8664a;
        color: #ffffff;
    }

    .btn-detail:hover {
        background: #b75a41;
    }

    .btn-edit-soft {
        background: #f4ddd4;
        color: #c8664a;
    }

    .btn-edit-soft:hover {
        background: #ebcec2;
    }

    .btn-delete-soft {
        background: #f4ddd4;
        color: #c0392b;
    }

    .btn-delete-soft:hover {
        background: #ef4136;
        color: #ffffff;
    }

    .empty-tenant {
        display: none;
        text-align: center;
        padding: 42px 20px;
        border: 1px dashed #ead6ce;
        border-radius: 20px;
        background: #fffdfb;
        color: #86766f;
        margin-top: 16px;
    }

    .empty-tenant.show {
        display: block;
    }

    .empty-tenant strong {
        display: block;
        color: #211713;
        font-size: 18px;
        margin-bottom: 8px;
    }

    @media (max-width: 1100px) {
        .tenant-item {
            grid-template-columns: 54px 1fr;
        }

        .tenant-actions {
            grid-column: 2;
            justify-content: flex-start;
        }
    }

    @media (max-width: 760px) {
        .tenant-panel {
            padding: 22px;
        }

        .tenant-panel-head {
            flex-direction: column;
        }

        .tenant-top-actions {
            justify-content: flex-start;
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 10px;
        }

        .rent-request-btn,
        .tenant-add-btn {
            flex: 1;
            min-width: 0;
        }

        .tenant-toolbar {
            align-items: stretch;
        }

        .tenant-search {
            width: 100%;
        }

        .tenant-mini-info {
            width: 100%;
        }
    }

    @media (max-width: 520px) {
        .tenant-panel-head h2 {
            font-size: 24px;
        }

        .tenant-top-actions {
            display: flex;
            flex-direction: row;
            gap: 8px;
        }

        .rent-request-btn,
        .tenant-add-btn {
            height: 44px;
            padding: 0 12px;
            font-size: 13px;
        }

        .rent-request-count {
            min-width: 20px;
            height: 20px;
            font-size: 11px;
        }

        .tenant-item {
            grid-template-columns: 1fr;
        }

        .tenant-avatar {
            width: 50px;
            height: 50px;
        }

        .tenant-actions {
            grid-column: auto;
            display: grid;
            grid-template-columns: 1fr;
        }

        .tenant-actions a,
        .tenant-actions button {
            width: 100%;
        }
    }
</style>

<div class="tenant-page">
    <div class="tenant-panel">

        <div class="tenant-panel-head">
            <div>
                <h2>Penghuni Aktif</h2>
                <p>Data penghuni yang sudah diverifikasi dan sedang menempati kamar.</p>
            </div>
            <div class="tenant-top-actions">
                <a href="/admin/penghuni/pdf" class="tenant-add-btn" style="text-decoration: none;">
                    Export PDF
                </a>
            </div>
        </div>


        <div class="tenant-toolbar">
            <input type="text" id="tenantSearch" class="tenant-search" placeholder="Cari nama penghuni atau kamar...">

            <div class="tenant-mini-info">
                <span id="tenantCount">{{ count($penghuni) }}</span> penghuni aktif ditampilkan
            </div>
        </div>

        <div class="tenant-list" id="tenantList">

            @foreach($penghuni as $item)
                @php
                    // Ambil pengajuan sewa pertama yang disetujui (hasMany / belongsTo)
                    // Menggunakan kebiasaan laravel jika hasMany mengambil kumpulan data memakai first()
                    $sewaAktif = $item->pengajuanSewa instanceof \Illuminate\Database\Eloquent\Collection
                        ? $item->pengajuanSewa->first()
                        : $item->pengajuanSewa;

                    $nomorKamar = $sewaAktif && $sewaAktif->kamar ? $sewaAktif->kamar->nomor_kamar : '-';
                    $towerKamar = $sewaAktif && $sewaAktif->kamar ? ucfirst($sewaAktif->kamar->tower) : '-';

                    // Logika inisial avatar dinamis
                    $words = explode(' ', $item->nama);
                    $initials = '';
                    if (count($words) >= 2) {
                        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($item->nama, 0, 2));
                    }

                    // Format pencarian untuk dataset JavaScript
                    $dataName = strtolower($item->nama . ' kamar ' . $nomorKamar . ' tower ' . $towerKamar);
                @endphp

                <div class="tenant-item" data-name="{{ $dataName }}">
                    <div class="tenant-avatar">{{ $initials }}</div>

                    <div class="tenant-main">
                        <h3>{{ $item->nama }}</h3>
                        <p>Kamar {{ $nomorKamar }} · Tower {{ $towerKamar }}</p>
                        <span class="tenant-status">Aktif</span>
                    </div>

                    <div class="tenant-actions">
                        <a href="/admin/penghuni/{{ $item->id }}" class="btn-detail">Detail Informasi</a>
                        <a href="/admin/penghuni/{{ $item->id }}/edit" class="btn-edit-soft">Edit</a>
                        <form action="/admin/penghuni/{{ $item->id }}" method="POST" style="display:none;" id="delete-form-{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn-delete-soft" onclick="confirmDelete({{ $item->id }})">Hapus</button>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="empty-tenant" id="emptyTenant">
            <strong>Data penghuni tidak ditemukan</strong>
            <span>Coba gunakan kata kunci pencarian yang lain.</span>
        </div>

    </div>
</div>

<script>
    const tenantSearch = document.getElementById('tenantSearch');
    const tenantItems = document.querySelectorAll('.tenant-item');
    const emptyTenant = document.getElementById('emptyTenant');
    const tenantCount = document.getElementById('tenantCount');

    tenantSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        tenantItems.forEach(item => {
            const name = item.dataset.name;

            if (name.includes(keyword)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        tenantCount.textContent = visibleCount;
        emptyTenant.classList.toggle('show', visibleCount === 0);
    });

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data penghuni ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection
