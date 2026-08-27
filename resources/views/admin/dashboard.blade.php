@extends('admin.layout')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola operasional Kos Rumah Bata.')

@section('content')

<style>
    .dashboard-page {
        display: grid;
        gap: 22px;
    }

    .dashboard-welcome {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 36px 40px;
    }

    .welcome-label {
        color: #c8664a;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 12px;
    }

    .dashboard-welcome h1 {
        margin: 0;
        font-size: 42px;
        line-height: 1.12;
        letter-spacing: -0.04em;
        color: #211713;
        font-weight: 700;
    }

    .dashboard-welcome p {
        margin: 14px 0 0;
        color: #766960;
        font-size: 16px;
        line-height: 1.8;
        max-width: 780px;
    }

    .welcome-actions {
        margin-top: 24px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .dash-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .dash-card {
        background: white;
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 22px;
    }

    .dash-card span {
        font-size: 13px;
        color: #8a746a;
        font-weight: 600;
    }

    .dash-card h2 {
        margin: 12px 0 7px;
        font-size: 34px;
        color: #211713;
        font-weight: 700;
        letter-spacing: -0.04em;
    }

    .dash-card p {
        margin: 0;
        font-size: 13px;
        color: #947d72;
        line-height: 1.5;
    }

    .dash-main {
        display: grid;
        grid-template-columns: 1.3fr 0.7fr;
        gap: 22px;
    }

    .dash-box {
        background: white;
        border: 1px solid #ead6ce;
        border-radius: 24px;
        overflow: hidden;
    }

    .dash-box-head {
        padding: 20px 22px;
        border-bottom: 1px solid #ead6ce;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
    }

    .dash-box-head h3 {
        margin: 0;
        font-size: 21px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .dash-box-head p {
        margin: 5px 0 0;
        color: #88786f;
        font-size: 14px;
    }

    .small-pill {
        background: #fbf5f1;
        border: 1px solid #ead6ce;
        color: #c8664a;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .activity-list {
        display: grid;
    }

    .activity-item {
        display: grid;
        grid-template-columns: 44px 1fr auto;
        gap: 14px;
        align-items: center;
        padding: 17px 22px;
        border-bottom: 1px solid #f0e3dd;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 42px;
        height: 42px;
        border-radius: 15px;
        background: #faf1ed;
        color: #c8664a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .activity-item strong {
        display: block;
        margin-bottom: 4px;
        color: #211713;
        font-weight: 600;
    }

    .activity-item p {
        margin: 0;
        font-size: 13px;
        color: #806f66;
        line-height: 1.5;
    }

    .activity-time {
        color: #9b8a82;
        font-size: 13px;
        white-space: nowrap;
        font-weight: 500;
    }

    .room-map {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        padding: 20px;
    }

    .room {
        height: 38px;
        border-radius: 11px;
        border: 1px solid #ead6ce;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
    }

    .room.filled {
        background: #faf1ed;
        color: #c8664a;
        border-color: #e8c8bc;
    }

    .room.empty {
        background: #ffffff;
        color: #9b8a82;
        border-color: #e2d5ce;
    }

    .room.fix {
        background: #fef3e0;
        color: #a0620a;
        border-color: #efd29a;
    }

    .room-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        padding: 0 20px 20px;
        font-size: 12px;
        color: #806f66;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .legend-color {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .note-list {
        padding: 20px 22px;
        display: grid;
        gap: 14px;
    }

    .note-item {
        border-bottom: 1px solid #f0e3dd;
        padding-bottom: 14px;
    }

    .note-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .note-item strong {
        display: block;
        margin-bottom: 5px;
        color: #211713;
        font-weight: 600;
    }

    .note-item p {
        margin: 0;
        color: #806f66;
        font-size: 13px;
        line-height: 1.6;
    }

    @media (max-width: 1150px) {
        .dash-main {
            grid-template-columns: 1fr;
        }

        .dash-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .dashboard-welcome {
            padding: 26px 24px;
        }

        .dashboard-welcome h1 {
            font-size: 31px;
        }

        .dashboard-welcome p {
            font-size: 15px;
        }

        .dash-stats {
            grid-template-columns: 1fr;
        }

        .activity-item {
            grid-template-columns: 42px 1fr;
        }

        .activity-time {
            grid-column: 2;
        }

        .room-map {
            grid-template-columns: repeat(4, 1fr);
        }
    }
</style>

<div class="dashboard-page">

    <div class="dashboard-welcome">
        <div class="welcome-label">Admin Panel</div>

        <h1>Selamat datang, Admin.</h1>

        <p>
            Pantau data kamar, penghuni, pembayaran, dan maintenance Kos Rumah Bata
            dari satu halaman admin yang ringkas dan mudah dikelola.
        </p>

        <div class="welcome-actions">
            <a href="/admin/kamar" class="btn">Kelola Kamar</a>
            <a href="/admin/pembayaran" class="btn btn-secondary">Cek Pembayaran</a>
        </div>
    </div>

    <div class="dash-stats">
        <div class="dash-card">
            <span>Total Kamar</span>
            <h2>{{ $totalKamar }}</h2>
            <p>Tower ganjil & genap</p>
        </div>

        <div class="dash-card">
            <span>Penghuni Aktif</span>
            <h2>{{ $penghuniAktif }}</h2>
            <p>Sedang menempati kamar</p>
        </div>

        <div class="dash-card">
            <span>Pembayaran</span>
            <h2>{{ $pembayaranDP }}</h2>
            <p>Menunggu pelunasan</p>
        </div>

        <div class="dash-card">
            <span>Maintenance</span>
            <h2>{{ $maintenanceCount }}</h2>
            <p>Sedang diproses</p>
        </div>
    </div>

    <div class="dash-main">

        <div class="dash-box">
            <div class="dash-box-head">
                <div>
                    <h3>Aktivitas Terbaru</h3>
                    <p>Update terbaru dari sistem admin.</p>
                </div>

                <span class="small-pill">Hari ini</span>
            </div>

            <div class="activity-list">
                @forelse($recentActivities as $act)
                    <div class="activity-item">
                        <div class="activity-icon">{{ $act['icon'] }}</div>

                        <div>
                            <strong>{{ $act['title'] }}</strong>
                            <p>{{ $act['description'] }}</p>
                        </div>

                        <div class="activity-time">
                            {{ \Carbon\Carbon::parse($act['time'])->timezone('Asia/Jakarta')->format('H.i') }}
                        </div>
                    </div>
                @empty
                    <div style="padding: 24px; text-align: center; color: #806f66; font-size: 13px;">
                        Belum ada riwayat aktivitas sistem baru hari ini.
                    </div>
                @endforelse
            </div>
        </div>

        <div style="display:grid; gap:18px;">
            <div class="dash-box">
                <div class="dash-box-head">
                    <div>
                        <h3>Peta Kamar</h3>
                        <p>{{ $totalKamar }} kamar total</p>
                    </div>
                </div>

                <div class="room-map">
                    @forelse($kamars as $kamar)
                        @php
                            $classStatus = 'empty';
                            if ($kamar->status_visual === 'maintenance') {
                                $classStatus = 'fix';
                            } elseif ($kamar->status_visual === 'terisi') {
                                $classStatus = 'filled';
                            }
                        @endphp
                        <div class="room {{ $classStatus }}">{{ str_pad($kamar->nomor_kamar, 2, '0', STR_PAD_LEFT) }}</div>
                    @empty
                        <div style="grid-column: span 5; padding: 20px; text-align: center; color: #806f66; font-size: 13px;">
                            Belum ada data kamar terdaftar di sistem.
                        </div>
                    @endforelse
                </div>

                <div class="room-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background:#c8664a;"></span>
                        Terisi
                    </div>

                    <div class="legend-item">
                        <span class="legend-color" style="background:#d5c5bd;"></span>
                        Kosong
                    </div>

                    <div class="legend-item">
                        <span class="legend-color" style="background:#b77700;"></span>
                        Maintenance
                    </div>
                </div>
            </div>

            <div class="dash-box">
                <div class="dash-box-head">
                    <h3>Catatan Operasional</h3>
                </div>

                <div class="note-list">
                    <div class="note-item">
                        <strong>Pengajuan sewa</strong>
                        <p>Calon penghuni dari website pelanggan perlu diverifikasi sebelum bisa melakukan pembayaran.</p>
                    </div>

                    <div class="note-item">
                        <strong>Verifikasi pembayaran</strong>
                        <p>Bukti pembayaran dari penghuni dicek admin sebelum status pembayaran diperbarui.</p>
                    </div>

                    <div class="note-item">
                        <strong>Maintenance</strong>
                        <p>Laporan kerusakan dari penghuni dapat diterima admin sebelum masuk ke daftar maintenance.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
