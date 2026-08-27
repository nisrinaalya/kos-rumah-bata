@extends('admin.layout')

@section('page-title', 'Pengajuan Maintenance')
@section('page-subtitle', 'Laporan kerusakan yang dikirim penghuni dari halaman pelanggan.')

@section('content')

<style>
    .maintenance-request-page {
        display: grid;
        gap: 22px;
    }

    .maintenance-request-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .maintenance-request-head {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .maintenance-request-head h2 {
        margin: 0;
        color: #211713;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .maintenance-request-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 620px;
    }

    .maintenance-request-back {
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

    .maintenance-request-back:hover {
        background: #f4ddd4;
    }

    .maintenance-request-toolbar {
        display: grid;
        grid-template-columns: minmax(260px, 420px) 1fr;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .maintenance-request-search {
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

    .maintenance-request-search:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .maintenance-request-count {
        color: #86766f;
        font-size: 13px;
        text-align: right;
    }

    .maintenance-request-list {
        display: grid;
        gap: 14px;
    }

    .maintenance-request-item {
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

    .maintenance-request-item:hover {
        border-color: #dfc6ba;
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        transform: translateY(-2px);
    }

    .maintenance-request-avatar {
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

    .maintenance-request-main h3 {
        margin: 0;
        color: #211713;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .maintenance-request-main p {
        margin: 6px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.5;
    }

    .maintenance-request-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .maintenance-request-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #fbf5f1;
        color: #7a5d52;
        border: 1px solid #eee1da;
        font-size: 12px;
        font-weight: 600;
    }

    .maintenance-request-date {
        color: #9a8d85;
        font-size: 12px;
    }

    .maintenance-request-action {
        min-height: 44px;
        border: none;
        border-radius: 14px;
        padding: 0 18px;
        background: #c8664a;
        color: #ffffff;
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

    .maintenance-request-action:hover {
        background: #b75a41;
    }

    .empty-maintenance-request {
        display: none;
        text-align: center;
        padding: 42px 20px;
        border: 1px dashed #ead6ce;
        border-radius: 20px;
        background: #fffdfb;
        color: #86766f;
        margin-top: 16px;
    }

    .empty-maintenance-request.show {
        display: block;
    }

    .empty-maintenance-request strong {
        display: block;
        color: #211713;
        font-size: 18px;
        margin-bottom: 8px;
    }

    @media (max-width: 900px) {
        .maintenance-request-item {
            grid-template-columns: 54px 1fr;
        }

        .maintenance-request-action {
            grid-column: 2;
            justify-self: start;
        }
    }

    @media (max-width: 760px) {
        .maintenance-request-panel {
            padding: 22px;
        }

        .maintenance-request-head {
            grid-template-columns: 1fr;
        }

        .maintenance-request-back {
            width: 100%;
        }

        .maintenance-request-toolbar {
            grid-template-columns: 1fr;
        }

        .maintenance-request-count {
            text-align: left;
        }
    }

    @media (max-width: 520px) {
        .maintenance-request-head h2 {
            font-size: 24px;
        }

        .maintenance-request-item {
            grid-template-columns: 1fr;
        }

        .maintenance-request-avatar {
            width: 50px;
            height: 50px;
        }

        .maintenance-request-action {
            grid-column: auto;
            width: 100%;
        }
    }
</style>

<div class="maintenance-request-page">
    <div class="maintenance-request-panel">

        <div class="maintenance-request-head">
            <div>
                <h2>Laporan Masuk</h2>
                <p>Cek laporan kerusakan dari penghuni sebelum dibuat menjadi data maintenance.</p>
            </div>

            <a href="/admin/maintenance" class="maintenance-request-back">Kembali</a>
        </div>

        <div class="maintenance-request-toolbar">
            <input type="text" id="maintenanceRequestSearch" class="maintenance-request-search" placeholder="Cari kamar, nama penghuni, atau keluhan...">

            <div class="maintenance-request-count">
                3 laporan menunggu dicek
            </div>
        </div>

        <div class="maintenance-request-list" id="maintenanceRequestList">

            <div class="maintenance-request-item" data-name="kamar 08 rani amelia lampu kamar mati">
                <div class="maintenance-request-avatar">08</div>

                <div class="maintenance-request-main">
                    <h3>Kamar 08</h3>
                    <p>Rani Amelia melaporkan lampu kamar mati.</p>

                    <div class="maintenance-request-meta">
                        <span class="maintenance-request-badge">Menunggu Dicek</span>
                        <span class="maintenance-request-date">Dikirim hari ini</span>
                    </div>
                </div>

                <a href="/admin/pengajuan-maintenance/detail" class="maintenance-request-action">
                    Cek Laporan
                </a>
            </div>

            <div class="maintenance-request-item" data-name="kamar 12 melati safira saluran air tersumbat">
                <div class="maintenance-request-avatar">12</div>

                <div class="maintenance-request-main">
                    <h3>Kamar 12</h3>
                    <p>Melati Safira melaporkan saluran air tersumbat.</p>

                    <div class="maintenance-request-meta">
                        <span class="maintenance-request-badge">Menunggu Dicek</span>
                        <span class="maintenance-request-date">Dikirim kemarin</span>
                    </div>
                </div>

                <a href="/admin/pengajuan-maintenance/detail" class="maintenance-request-action">
                    Cek Laporan
                </a>
            </div>

            <div class="maintenance-request-item" data-name="kamar 03 rani amelia ac tidak dingin">
                <div class="maintenance-request-avatar">03</div>

                <div class="maintenance-request-main">
                    <h3>Kamar 03</h3>
                    <p>Penghuni melaporkan AC tidak dingin.</p>

                    <div class="maintenance-request-meta">
                        <span class="maintenance-request-badge">Menunggu Dicek</span>
                        <span class="maintenance-request-date">Dikirim 2 hari lalu</span>
                    </div>
                </div>

                <a href="/admin/pengajuan-maintenance/detail" class="maintenance-request-action">
                    Cek Laporan
                </a>
            </div>

        </div>

        <div class="empty-maintenance-request" id="emptyMaintenanceRequest">
            <strong>Laporan tidak ditemukan</strong>
            <span>Coba gunakan kata kunci pencarian yang lain.</span>
        </div>

    </div>
</div>

<script>
    const maintenanceRequestSearch = document.getElementById('maintenanceRequestSearch');
    const maintenanceRequestItems = document.querySelectorAll('.maintenance-request-item');
    const emptyMaintenanceRequest = document.getElementById('emptyMaintenanceRequest');

    maintenanceRequestSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        maintenanceRequestItems.forEach(item => {
            const name = item.dataset.name;

            if (name.includes(keyword)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        emptyMaintenanceRequest.classList.toggle('show', visibleCount === 0);
    });
</script>

@endsection
