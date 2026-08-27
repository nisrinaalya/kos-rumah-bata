@extends('admin.layout')

@section('page-title', 'Maintenance')
@section('page-subtitle', 'Pantau perbaikan kamar dan laporan kerusakan dari penghuni.')

@section('content')

<style>
    .maintenance-page {
        display: grid;
        gap: 22px;
    }

    .maintenance-hero,
    .maintenance-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .maintenance-hero {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 18px;
    }

    .maintenance-hero h2 {
        margin: 0;
        color: #211713;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .maintenance-hero p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 560px;
    }

    .maintenance-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .maintenance-request-btn,
    .maintenance-add-btn {
        min-height: 46px;
        border-radius: 15px;
        padding: 0 16px;
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

    .maintenance-request-btn {
        border: 1px solid #ead6ce;
        background: #fbf5f1;
        color: #c8664a;
    }

    .maintenance-request-btn:hover {
        background: #f4ddd4;
    }

    .maintenance-add-btn {
        border: 1px solid #c8664a;
        background: #c8664a;
        color: #ffffff;
    }

    .maintenance-add-btn:hover {
        background: #b75a41;
    }

    .maintenance-count {
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

    .maintenance-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .maintenance-summary-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 20px;
        min-height: 112px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: 0.2s ease;
    }

    .maintenance-summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        border-color: #dfc6ba;
    }

    .maintenance-summary-card span {
        color: #8f8179;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.4;
    }

    .maintenance-summary-card strong {
        color: #211713;
        font-size: 30px;
        font-weight: 700;
        letter-spacing: -0.03em;
        margin-top: 14px;
    }

    .maintenance-summary-card small {
        color: #9a8d85;
        font-size: 12px;
        line-height: 1.5;
        margin-top: 6px;
    }

    .maintenance-panel-head {
        display: grid;
        grid-template-columns: 1fr minmax(260px, 380px);
        gap: 18px;
        align-items: start;
        margin-bottom: 20px;
    }

    .maintenance-panel-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .maintenance-panel-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
    }

    .maintenance-search {
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

    .maintenance-search:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .maintenance-filter {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .maintenance-filter-btn {
        border: 1px solid #ead6ce;
        background: #fbf5f1;
        color: #7a5d52;
        padding: 11px 15px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 500;
        font-family: inherit;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .maintenance-filter-btn:hover {
        background: #f4ddd4;
        color: #c8664a;
    }

    .maintenance-filter-btn.active {
        background: #c8664a;
        border-color: #c8664a;
        color: #ffffff;
    }

    .maintenance-list {
        display: grid;
        gap: 14px;
    }

    .maintenance-item {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        background: #ffffff;
        padding: 18px;
        display: grid;
        grid-template-columns: 54px 1fr auto;
        gap: 16px;
        align-items: center;
        transition: 0.2s ease;
    }

    .maintenance-item:hover {
        border-color: #dfc6ba;
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        transform: translateY(-2px);
    }

    .maintenance-avatar {
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

    .maintenance-main h3 {
        margin: 0;
        color: #211713;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .maintenance-main p {
        margin: 6px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.5;
    }

    .maintenance-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .maintenance-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid transparent;
    }

    .maintenance-date {
        color: #9a8d85;
        font-size: 12px;
    }

    .maintenance-item-actions {
        display: flex;
        gap: 9px;
        align-items: center;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .maintenance-btn {
        min-height: 42px;
        border-radius: 13px;
        padding: 0 15px;
        border: none;
        text-decoration: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .maintenance-btn-edit {
        background: #c8664a;
        color: #ffffff;
    }

    .maintenance-btn-edit:hover {
        background: #b75a41;
    }

    .maintenance-btn-delete {
        background: #f4ddd4;
        color: #c0392b;
    }

    .maintenance-btn-delete:hover {
        background: #ef4136;
        color: #ffffff;
    }

    .empty-maintenance {
        display: none;
        text-align: center;
        padding: 42px 20px;
        border: 1px dashed #ead6ce;
        border-radius: 20px;
        background: #fffdfb;
        color: #86766f;
        margin-top: 16px;
    }

    .empty-maintenance.show {
        display: block;
    }

    .empty-maintenance strong {
        display: block;
        color: #211713;
        font-size: 18px;
        margin-bottom: 8px;
    }

    @media (max-width: 1100px) {
        .maintenance-hero {
            grid-template-columns: 1fr;
        }

        .maintenance-actions {
            justify-content: flex-start;
        }

        .maintenance-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .maintenance-panel-head {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {
        .maintenance-item {
            grid-template-columns: 54px 1fr;
        }

        .maintenance-item-actions {
            grid-column: 2;
            justify-content: flex-start;
        }
    }

    @media (max-width: 620px) {
        .maintenance-hero,
        .maintenance-panel {
            padding: 22px;
        }

        .maintenance-hero h2,
        .maintenance-panel-head h2 {
            font-size: 24px;
        }

        .maintenance-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .maintenance-summary {
            grid-template-columns: 1fr;
        }

        .maintenance-filter {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .maintenance-filter-btn {
            width: 100%;
        }

        .maintenance-item {
            grid-template-columns: 1fr;
        }

        .maintenance-avatar {
            width: 50px;
            height: 50px;
        }

        .maintenance-item-actions {
            grid-column: auto;
            display: grid;
            grid-template-columns: 1fr;
        }

        .maintenance-btn {
            width: 100%;
        }
    }
</style>

<div class="maintenance-page">

    @if(session('success'))
        <div style="background: #e8f8f5; color: #27ae60; padding: 16px; border-radius: 15px; border: 1px solid #d4efdf; font-weight: 600; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="maintenance-hero">
        <div>
            <h2>Maintenance Kamar</h2>
            <p>Pantau perbaikan kamar dan laporan kerusakan dari penghuni yang sudah masuk ke sistem.</p>
        </div>

        <div class="maintenance-actions">
            <a href="{{ route('maintenance.create') }}" class="maintenance-add-btn">
                Tambah Maintenance
            </a>
        </div>
    </div>

    <div class="maintenance-summary">
        <div class="maintenance-summary-card">
            <span>Menunggu</span>
            <strong>{{ $maintenances->where('status', 'menunggu')->count() }}</strong>
            <small>Belum mulai dikerjakan.</small>
        </div>

        <div class="maintenance-summary-card">
            <span>Dalam Proses</span>
            <strong>{{ $maintenances->where('status', 'proses')->count() }}</strong>
            <small>Sedang ditangani.</small>
        </div>

        <div class="maintenance-summary-card">
            <span>Selesai</span>
            <strong>{{ $maintenances->where('status', 'selesai')->count() }}</strong>
            <small>Perbaikan sudah selesai.</small>
        </div>
    </div>

    <div class="maintenance-panel">

        <div class="maintenance-panel-head">
            <div>
                <h2>Daftar Maintenance</h2>
                <p>Data perbaikan yang sudah disetujui dan sedang diproses admin.</p>
            </div>

            <input type="text" id="maintenanceSearch" class="maintenance-search" placeholder="Cari kamar atau keluhan...">
        </div>

        <div class="maintenance-filter">
            <button type="button" class="maintenance-filter-btn active" data-filter="all">Semua</button>
            <button type="button" class="maintenance-filter-btn" data-filter="waiting">Menunggu</button>
            <button type="button" class="maintenance-filter-btn" data-filter="process">Proses</button>
            <button type="button" class="maintenance-filter-btn" data-filter="done">Selesai</button>
        </div>

        <div class="maintenance-list" id="maintenanceList">

            @if($maintenances->isEmpty())
                <div class="empty-maintenance show" id="emptyMaintenance" style="display: block;">
                    <strong>Belum ada pengajuan maintenance</strong>
                    <span>Data perbaikan kamar masih kosong di sistem.</span>
                </div>
            @else
                @foreach($maintenances as $maintenance)
                    @php
                        $jsStatus = 'waiting';
                        $badgeText = 'Menunggu';

                        // Konfigurasi warna spesifik dinamis sesuai status laporan
                        $badgeStyle = "background: #fef9e7; color: #f1c40f; border-color: #fcf3cf;"; // Menunggu: Kuning

                        if($maintenance->status === 'proses') {
                            $jsStatus = 'process';
                            $badgeText = 'Dalam Proses';
                            $badgeStyle = "background: #ebf5fb; color: #2980b9; border-color: #d4e6f1;"; // Proses: Biru
                        } elseif($maintenance->status === 'selesai') {
                            $jsStatus = 'done';
                            $badgeText = 'Selesai';
                            $badgeStyle = "background: #e8f8f5; color: #27ae60; border-color: #d1f2eb;"; // Selesai: Hijau
                        }

                        $nomorKamar = $maintenance->kamar ? $maintenance->kamar->nomor_kamar : $maintenance->kamar_id;
                        $tanggal = $maintenance->tanggal_laporan ? \Carbon\Carbon::parse($maintenance->tanggal_laporan)->translatedFormat('j F Y') : '-';
                        $biaya = $maintenance->biaya ? 'Rp ' . number_format($maintenance->biaya, 0, ',', '.') : 'Rp 0';
                    @endphp

                    <div class="maintenance-item" data-name="kamar {{ $nomorKamar }} {{ strtolower($maintenance->nama_perbaikan) }}" data-status="{{ $jsStatus }}">
                        <div class="maintenance-avatar">{{ sprintf("%02d", $nomorKamar) }}</div>

                        <div class="maintenance-main">
                            <h3>Kamar {{ sprintf("%02d", $nomorKamar) }}</h3>
                            <p>{{ $maintenance->nama_perbaikan }}</p>

                            <div class="maintenance-meta">
                                <span class="maintenance-badge" style="{{ $badgeStyle }}">{{ $badgeText }}</span>
                                <span class="maintenance-date">{{ $tanggal }} · {{ $biaya }}</span>
                            </div>
                        </div>

                        <div class="maintenance-item-actions">
                            <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="maintenance-btn maintenance-btn-edit">Cek Laporan</a>

                            <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data perbaikan ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="maintenance-btn maintenance-btn-delete">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="empty-maintenance" id="emptyMaintenance">
                    <strong>Data maintenance tidak ditemukan</strong>
                    <span>Coba gunakan kata kunci atau filter yang lain.</span>
                </div>
            @endif

        </div>

    </div>

</div>

<script>
    const maintenanceSearch = document.getElementById('maintenanceSearch');
    const maintenanceItems = document.querySelectorAll('.maintenance-item');
    const maintenanceButtons = document.querySelectorAll('.maintenance-filter-btn');
    const emptyMaintenance = document.getElementById('emptyMaintenance');

    let activeMaintenanceFilter = 'all';

    function applyMaintenanceFilter() {
        const keyword = maintenanceSearch.value.toLowerCase().trim();
        let visibleCount = 0;

        maintenanceItems.forEach(item => {
            const name = item.dataset.name;
            const status = item.dataset.status;

            const matchSearch = name.includes(keyword);
            const matchFilter = activeMaintenanceFilter === 'all' || status === activeMaintenanceFilter;

            if (matchSearch && matchFilter) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (emptyMaintenance) {
            if (visibleCount === 0) {
                emptyMaintenance.style.display = 'block';
                emptyMaintenance.classList.add('show');
                if (maintenanceItems.length > 0) {
                    emptyMaintenance.querySelector('strong').textContent = 'Data maintenance tidak ditemukan';
                    emptyMaintenance.querySelector('span').textContent = 'Coba gunakan kata kunci atau filter yang lain.';
                }
            } else {
                emptyMaintenance.style.display = 'none';
                emptyMaintenance.classList.remove('show');
            }
        }
    }

    maintenanceButtons.forEach(button => {
        button.addEventListener('click', function () {
            maintenanceButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            activeMaintenanceFilter = this.dataset.filter;
            applyMaintenanceFilter();
        });
    });

    maintenanceSearch.addEventListener('input', applyMaintenanceFilter);
</script>

@endsection
