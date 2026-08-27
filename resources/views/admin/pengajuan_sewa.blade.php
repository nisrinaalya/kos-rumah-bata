@extends('admin.layout')

@section('page-title', 'Pengajuan Sewa')
@section('page-subtitle', 'Data calon penghuni yang mengisi form dari halaman pelanggan.')

@section('content')

<style>
    .request-page {
        display: grid;
        gap: 22px;
    }

    .request-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .request-head {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 18px;
        margin-bottom: 24px;
    }

    .request-head h2 {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .request-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
        max-width: 580px;
    }

    .request-back {
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

    .request-back:hover {
        background: #f4ddd4;
    }

    .request-toolbar {
        display: grid;
        grid-template-columns: minmax(260px, 420px) 1fr;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .request-search {
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

    .request-search:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .request-count {
        color: #86766f;
        font-size: 13px;
        text-align: right;
    }

    .request-list {
        display: grid;
        gap: 14px;
    }

    .request-item {
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

    .request-item:hover {
        border-color: #dfc6ba;
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        transform: translateY(-2px);
    }

    .request-avatar {
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

    .request-main h3 {
        margin: 0;
        color: #211713;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .request-main p {
        margin: 6px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.5;
    }

    .request-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .request-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #fff1cf;
        color: #b47400;
        font-size: 12px;
        font-weight: 600;
    }

    .request-date {
        color: #9a8d85;
        font-size: 12px;
    }

    .request-action {
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

    .request-action:hover {
        background: #b75a41;
    }

    .empty-request {
        display: none;
        text-align: center;
        padding: 42px 20px;
        border: 1px dashed #ead6ce;
        border-radius: 20px;
        background: #fffdfb;
        color: #86766f;
        margin-top: 16px;
    }

    .empty-request.show {
        display: block;
    }

    .empty-request strong {
        display: block;
        color: #211713;
        font-size: 18px;
        margin-bottom: 8px;
    }

    @media (max-width: 900px) {
        .request-item {
            grid-template-columns: 54px 1fr;
        }

        .request-action {
            grid-column: 2;
            justify-self: start;
        }
    }

    @media (max-width: 760px) {
        .request-panel {
            padding: 22px;
        }

        .request-head {
            grid-template-columns: 1fr;
        }

        .request-back {
            width: 100%;
        }

        .request-toolbar {
            grid-template-columns: 1fr;
        }

        .request-count {
            text-align: left;
        }
    }

    @media (max-width: 520px) {
        .request-head h2 {
            font-size: 24px;
        }

        .request-item {
            grid-template-columns: 1fr;
        }

        .request-avatar {
            width: 50px;
            height: 50px;
        }

        .request-action {
            grid-column: auto;
            width: 100%;
        }
    }
</style>

<div class="request-page">
    <div class="request-panel">

        <div class="request-head">
            <div>
                <h2>Menunggu Verifikasi</h2>
                <p>Cek data calon penghuni sebelum admin membuka akses pembayaran.</p>
            </div>

            <a href="/admin/penghuni" class="request-back">Kembali</a>
        </div>

        <div class="request-toolbar">
            <input type="text" id="requestSearch" class="request-search" placeholder="Cari nama calon penghuni atau kamar...">

            <div class="request-count">
                2 pengajuan menunggu verifikasi
            </div>
        </div>

        <div class="request-list" id="requestList">

            <div class="request-item" data-name="raditya cummalaka kamar 01 tower ganjil">
                <div class="request-avatar">RC</div>

                <div class="request-main">
                    <h3>Raditya Cummalaka</h3>
                    <p>Mengajukan sewa Kamar 01 · Tower Ganjil</p>

                    <div class="request-meta">
                        <span class="request-badge">Menunggu Verifikasi</span>
                        <span class="request-date">Dikirim hari ini</span>
                    </div>
                </div>

                <a href="/admin/pengajuan-sewa/detail" class="request-action">Cek Data</a>
            </div>

            <div class="request-item" data-name="nabila azzahra kamar 02 tower genap">
                <div class="request-avatar">NA</div>

                <div class="request-main">
                    <h3>Nabila Azzahra</h3>
                    <p>Mengajukan sewa Kamar 02 · Tower Genap</p>

                    <div class="request-meta">
                        <span class="request-badge">Menunggu Verifikasi</span>
                        <span class="request-date">Dikirim kemarin</span>
                    </div>
                </div>

                <a href="/admin/pengajuan-sewa/detail" class="request-action">Cek Data</a>
            </div>

        </div>

        <div class="empty-request" id="emptyRequest">
            <strong>Pengajuan tidak ditemukan</strong>
            <span>Coba gunakan kata kunci pencarian yang lain.</span>
        </div>

    </div>
</div>

<script>
    const requestSearch = document.getElementById('requestSearch');
    const requestItems = document.querySelectorAll('.request-item');
    const emptyRequest = document.getElementById('emptyRequest');

    requestSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        requestItems.forEach(item => {
            const name = item.dataset.name;

            if (name.includes(keyword)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        emptyRequest.classList.toggle('show', visibleCount === 0);
    });
</script>

@endsection