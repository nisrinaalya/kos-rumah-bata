@extends('admin.layout')

@section('page-title', 'Laporan')
@section('page-subtitle', 'Ringkasan pendapatan dan pengeluaran Kos Rumah Bata.')

@section('content')

<style>
    .report-page {
        display: grid;
        gap: 22px;
    }

    .report-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .report-hero {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: flex-start;
    }

    .report-hero h2 {
        margin: 0;
        color: #211713;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .report-hero p {
        margin: 10px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.7;
        max-width: 620px;
    }

    .report-filter {
        display: grid;
        gap: 12px;
    }

    .report-type-tabs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: #fbf5f1;
        padding: 4px;
        border-radius: 12px;
        border: 1px solid #ead6ce;
    }

    .tab-btn {
        height: 38px;
        border: none;
        background: transparent;
        color: #86766f;
        font-size: 13px;
        font-weight: 600;
        border-radius: 9px;
        cursor: pointer;
        font-family: inherit;
        transition: 0.2s ease;
    }

    .tab-btn.active {
        background: #ffffff;
        color: #c8664a;
        box-shadow: 0 2px 8px rgba(80, 48, 31, 0.04);
    }

    .report-filter label, .report-form-group label {
        color: #211713;
        font-size: 14px;
        font-weight: 600;
        margin-top: 4px;
    }

    .report-filter select, .report-form-group select, .report-form-group input, .report-form-group textarea {
        width: 100%;
        height: 50px;
        border: 1px solid #ead6ce;
        border-radius: 15px;
        padding: 0 16px;
        font-size: 14px;
        color: #211713;
        font-family: inherit;
        outline: none;
        background: #ffffff;
        box-sizing: border-box;
    }

    .report-form-group textarea {
        height: auto;
        padding: 14px 16px;
    }

    .report-filter select:focus, .report-form-group select:focus, .report-form-group input:focus, .report-form-group textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .report-filter button.btn-apply, .btn-submit-form {
        height: 46px;
        border: none;
        border-radius: 14px;
        background: #c8664a;
        color: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .report-filter button.btn-apply:hover, .btn-submit-form:hover {
        background: #b75a41;
    }

    /* GRID UTAMA UNTUK KARTU (PERSIS SEPERTI REFERENSI GAMBAR) */
    .report-total-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .report-total-card {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 20px;
        padding: 24px;
        position: relative;
        box-shadow: 0 4px 12px rgba(80, 48, 31, 0.02);
        transition: 0.2s ease;
    }

    .report-total-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(80, 48, 31, 0.06);
        border-color: #dfc6ba;
    }

    .card-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 4px;
    }

    .report-total-card span.card-title {
        display: block;
        color: #8f8179;
        font-size: 14px;
        font-weight: 600;
    }

    /* TREND BADGE DI POJOK KANAN ATAS */
    .trend-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .trend-up {
        background-color: #e6f9ed;
        color: #2e7d32;
    }

    .trend-down {
        background-color: #fff0f0;
        color: #c62828;
    }

    .report-total-card h3 {
        margin: 0 0 16px 0;
        color: #211713;
        font-size: 32px;
        font-weight: 700;
        letter-spacing: -0.03em;
    }

    /* PERSIS DI GAMBAR: BAR METRIC PROGRESS BAR */
    .metric-progress-container {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
    }

    .bar-base {
        width: 100%;
        height: 6px;
        background: #f0e3dd;
        border-radius: 999px;
        overflow: hidden;
    }

    .bar-progress-fill {
        height: 100%;
        border-radius: 999px;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fill-pemasukan {
        background: #2e7d32;
    }

    .fill-pengeluaran {
        background: #c62828;
    }

    .metric-values {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        font-weight: 600;
        color: #86766f;
    }

    .report-total-card p.card-desc {
        margin: 0;
        color: #86766f;
        font-size: 13.5px;
        line-height: 1.5;
    }

    /* Style Form Section */
    .report-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 16px;
    }
    .report-form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .report-form-full {
        grid-column: span 2;
    }
    .form-actions-row {
        display: flex;
        justify-content: flex-end;
        margin-top: 12px;
    }

    .report-content-grid {
        display: grid;
        grid-template-columns: 1.25fr 0.75fr;
        gap: 22px;
        align-items: flex-start;
    }

    .report-section-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 18px;
    }

    .report-section-head h3 {
        margin: 0;
        color: #211713;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .report-section-head p {
        margin: 7px 0 0;
        color: #86766f;
        font-size: 14px;
        line-height: 1.6;
    }

    .report-period {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: #fbf5f1;
        border: 1px solid #ead6ce;
        color: #7a5d52;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .transaction-list {
        display: grid;
        gap: 12px;
    }

    .transaction-item {
        border: 1px solid #ead6ce;
        border-radius: 18px;
        padding: 16px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 16px;
        align-items: center;
        background: #ffffff;
    }

    .transaction-item strong {
        display: block;
        color: #211713;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .transaction-item span {
        display: block;
        color: #86766f;
        font-size: 13px;
        line-height: 1.5;
    }

    .transaction-item b {
        font-size: 15px;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-transaction {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin-bottom: 6px;
    }

    .badge-pemasukan {
        background-color: #e6f9ed;
        color: #1e4620;
    }

    .badge-pengeluaran {
        background-color: #fff0f0;
        color: #a82424;
    }

    .text-pemasukan {
        color: #2e7d32;
    }

    .text-pengeluaran {
        color: #c62828;
    }

    .monthly-summary {
        display: grid;
        gap: 14px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid #f0e3dd;
    }

    .summary-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .summary-row span {
        color: #86766f;
        font-size: 14px;
    }

    .summary-row strong {
        color: #211713;
        font-size: 14px;
        font-weight: 700;
        text-align: right;
    }

    .report-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 22px;
    }

    .report-action-btn {
        min-height: 44px;
        border-radius: 14px;
        padding: 0 18px;
        text-decoration: none;
        border: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .report-action-primary {
        background: #c8664a;
        color: #ffffff;
    }

    .report-action-primary:hover {
        background: #b75a41;
    }

    .report-action-secondary {
        background: #f4ddd4;
        color: #c8664a;
    }

    .report-action-secondary:hover {
        background: #ebcec2;
    }

    .report-note {
        margin-top: 16px;
        border: 1px solid #ead6ce;
        background: #fffdfb;
        border-radius: 18px;
        padding: 16px;
        color: #86766f;
        font-size: 13px;
        line-height: 1.7;
    }

    @media (max-width: 1100px) {
        .report-hero {
            grid-template-columns: 1fr;
        }

        .report-content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .report-panel {
            padding: 22px;
        }

        .report-total-grid {
            grid-template-columns: 1fr;
        }

        .report-hero h2 {
            font-size: 24px;
        }

        .report-total-card h3 {
            font-size: 28px;
        }

        .transaction-item {
            grid-template-columns: 1fr;
        }

        .transaction-item b {
            white-space: normal;
        }

        .report-form-grid {
            grid-template-columns: 1fr;
        }

        .report-form-full {
            grid-column: span 1;
        }
    }

    /* CUSTOM STYLING FOR PAGINATION */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .custom-pagination {
        display: flex;
        gap: 6px;
        padding: 0;
        margin: 0;
        list-style: none;
        align-items: center;
    }

    .custom-pagination li a, .custom-pagination li span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 6px;
        border: 1px solid #ead6ce;
        border-radius: 10px;
        background: #ffffff;
        color: #3d332e;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
        cursor: pointer;
    }

    .custom-pagination li a:hover {
        background: #fbf5f1;
        border-color: #d79b86;
        color: #c8664a;
    }

    .custom-pagination li.active span {
        background: #c8664a;
        border-color: #c8664a;
        color: #ffffff;
        cursor: default;
    }

    .custom-pagination li.disabled span {
        background: #fcfbfb;
        color: #c4b9b3;
        border-color: #f0e3dd;
        cursor: not-allowed;
    }
</style>

<div class="report-page">

    <div class="report-panel">
        <div class="report-hero">
            <div>
                <h2 style="white-space: nowrap; margin-bottom: 6px;">Laporan Keuangan Kos</h2>
                <p>
                    Laporan ini menampilkan total pendapatan dan pengeluaran kos dalam satu periode bulanan atau tahunan terpilih.
                </p>
            </div>

            <form action="/admin/laporan" method="GET" class="report-filter">
                <input type="hidden" name="tipe" id="report_type_input" value="{{ request('tipe', 'bulanan') }}">

                <div class="report-type-tabs">
                    <button type="button" class="tab-btn {{ request('tipe', 'bulanan') == 'bulanan' ? 'active' : '' }}" onclick="switchReportType('bulanan')">Bulanan</button>
                    <button type="button" class="tab-btn {{ request('tipe') == 'tahunan' ? 'active' : '' }}" onclick="switchReportType('tahunan')">Tahunan</button>
                </div>

                <label id="filter_label">{{ request('tipe') == 'tahunan' ? 'Pilih Tahun Laporan' : 'Pilih Bulan Laporan' }}</label>

                <select name="bulan" id="select_bulan" style="{{ request('tipe') == 'tahunan' ? 'display: none;' : '' }}">
                    @php
                        $daftarBulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
                        $bulanSaatIni = strtolower($daftarBulan[date('n') - 1]) . '-' . date('Y');
                        $bulanPilihan = request('bulan', $bulanSaatIni);
                    @endphp
                    @foreach($daftarBulan as $b)
                        @php $valueBulan = $b . '-' . date('Y'); @endphp
                        <option value="{{ $valueBulan }}" {{ $bulanPilihan == $valueBulan ? 'selected' : '' }}>
                            {{ ucfirst($b) }} {{ date('Y') }} {{ $valueBulan == $bulanSaatIni ? '(Bulan Ini)' : '' }}
                        </option>
                    @endforeach
                </select>

                <select name="tahun" id="select_tahun" style="{{ request('tipe') == 'tahunan' ? '' : 'display: none;' }}">
                    @php
                        $tahunSaatIni = date('Y');
                        $tahunPilihan = request('tahun', $tahunSaatIni);
                    @endphp
                    <option value="2025" {{ $tahunPilihan == '2025' ? 'selected' : '' }}>Tahun 2025</option>
                    <option value="2026" {{ $tahunPilihan == '2026' ? 'selected' : '' }}>Tahun 2026 {{ $tahunSaatIni == '2026' ? '(Tahun Ini)' : '' }}</option>
                    <option value="2027" {{ $tahunPilihan == '2027' ? 'selected' : '' }}>Tahun 2027</option>
                </select>

                <button type="submit" class="btn-apply">Terapkan</button>
            </form>
        </div>
    </div>

    <div class="report-total-grid">
        <div class="report-total-card">
            <div class="card-header-flex">
                <span class="card-title">TOTAL PENDAPATAN</span>
                {{-- <div class="trend-badge trend-up">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7" y2="7" x2="17" y1="7"></polyline></svg>
                    12.5%
                </div> --}}
            </div>
            <h3>{{ $totalPendapatan }}</h3>

            <div class="metric-progress-container">
                <div class="bar-base">
                    <div class="bar-progress-fill fill-pemasukan" style="width: {{ $progressPemasukan }}%;"></div>
                </div>
                {{-- <div class="metric-values">
                    <span>Target Capaian</span>
                    <span>{{ $progressPemasukan }}%</span>
                </div> --}}
            </div>
            <p class="card-desc">Pendapatan berasal dari pembayaran lunas dan DP penghuni periode terpilih.</p>
        </div>

        <div class="report-total-card">
            <div class="card-header-flex">
                <span class="card-title">TOTAL PENGELUARAN</span>
                {{-- <div class="trend-badge trend-down">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="17" y1="7" x2="7" y2="17"></line><polyline points="17" y2="17" x2="7" y1="17"></polyline></svg>
                    4.2%
                </div> --}}
            </div>
            <h3>{{ $totalPengeluaran }}</h3>

            <div class="metric-progress-container">
                <div class="bar-base">
                    <div class="bar-progress-fill fill-pengeluaran" style="width: {{ $progressPengeluaran }}%;"></div>
                </div>
                {{-- <div class="metric-values">
                    <span>Batas Anggaran Operasional</span>
                    <span>{{ $progressPengeluaran }}%</span>
                </div> --}}
            </div>
            <p class="card-desc">Pengeluaran berasal dari biaya maintenance kamar dan kebutuhan operasional kos.</p>
        </div>
    </div>

    <div class="report-panel">
        <div class="report-form-grid" style="margin-top: 0px; margin-bottom: 8px;">
            <div>
                <h3 style="margin: 0; color: #211713; font-size: 22px; font-weight: 700; letter-spacing: -0.02em;">Tambah Transaksi Baru</h3>
                <p style="margin: 7px 0 0; color: #86766f; font-size: 14px; line-height: 1.6;">Catat pemasukan atau pengeluaran operasional kos secara mandiri di sini.</p>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #e6f9ed; border: 1px solid #b3ebb0; color: #1e4620; padding: 12px 16px; border-radius: 12px; font-size: 14px; margin-bottom: 14px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="/admin/laporan" method="POST">
            @csrf
            <div class="report-form-grid">
                <div class="report-form-group">
                    <label>Jenis Transaksi</label>
                    <select name="jenis" required>
                        <option value="pemasukan">Pemasukan (Pendapatan)</option>
                        <option value="pengeluaran">Pengeluaran (Biaya)</option>
                    </select>
                </div>

                <div class="report-form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="report-form-group">
                    <label>Nama / Judul Transaksi</label>
                    <input type="text" name="nama" placeholder="Contoh: Sewa Lapangan, Beli Token Air" required>
                </div>

                <div class="report-form-group">
                    <label>Jumlah (Rupiah)</label>
                    <input type="number" name="jumlah" placeholder="Contoh: 150000" required>
                </div>

                <div class="report-form-group report-form-full">
                    <label>Deskripsi Detail</label>
                    <textarea name="deskripsi" rows="2" placeholder="Tulis rincian atau keterangan tambahan di sini..."></textarea>
                </div>
            </div>

            <div class="form-actions-row">
                <button type="submit" class="btn-submit-form" style="padding: 0 24px;">Simpan Transaksi</button>
            </div>
        </form>
    </div>

    <div class="report-content-grid">
        <div class="report-panel">
            <div class="report-section-head">
                <div>
                    <h3>Rincian Transaksi</h3>
                    <p>Daftar pemasukan dan pengeluaran yang tercatat pada periode terpilih.</p>
                </div>
                <span class="report-period" id="display_period">{{ $periodeAktif }}</span>
            </div>

            <div class="transaction-list">
                @if(isset($transaksi) && count($transaksi) > 0)
                    @foreach($transaksi as $t)
                        <div class="transaction-item">
                            <div>
                                @if($t->jenis == 'pemasukan')
                                    <span class="badge-transaction badge-pemasukan">Pemasukan</span>
                                @else
                                    <span class="badge-transaction badge-pengeluaran">Pengeluaran</span>
                                @endif
                                <strong>{{ $t->nama }}</strong>
                                <span style="margin-bottom: 4px; font-weight: 600; color: #a1928a;">{{ date('d M Y', strtotime($t->tanggal_bayar)) }}</span>
                                <span>{{ $t->deskripsi ?? '-' }}</span>
                            </div>
                            <b class="{{ $t->jenis == 'pemasukan' ? 'text-pemasukan' : 'text-pengeluaran' }}">
                                {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->nominal, 0, ',', '.') }}
                            </b>
                        </div>
                    @endforeach

                    @if($transaksi->hasPages())
                        <div class="pagination-wrapper">
                            <ul class="custom-pagination">
                                {{-- Tombol Halaman Sebelumnya (Previous) --}}
                                @if ($transaksi->onFirstPage())
                                    <li class="disabled"><span>&laquo;</span></li>
                                @else
                                    <li><a href="{{ $transaksi->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                {{-- Elemen Halaman-Halaman Angka --}}
                                @foreach ($transaksi->getUrlRange(1, $transaksi->lastPage()) as $page => $url)
                                    @if ($page == $transaksi->currentPage())
                                        <li class="active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Tombol Halaman Selanjutnya (Next) --}}
                                @if ($transaksi->hasMorePages())
                                    <li><a href="{{ $transaksi->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="disabled"><span>&raquo;</span></li>
                                @endif
                            </ul>
                        </div>
                    @endif

                @else
                    <div style="text-align: center; padding: 24px; color: #86766f;">
                        Tidak ada transaksi yang tercatat pada periode ini.
                    </div>
                @endif
            </div>
        </div>

        <div class="report-panel">
            <div class="report-section-head">
                <div>
                    <h3>Ringkasan</h3>
                    <p>Rekap singkat kondisi keuangan periode ini.</p>
                </div>
            </div>

            <div class="monthly-summary">
                <div class="summary-row">
                    <span>Pendapatan</span>
                    <strong>{{ $totalPendapatan }}</strong>
                </div>

                <div class="summary-row">
                    <span>Pengeluaran</span>
                    <strong>{{ $totalPengeluaran }}</strong>
                </div>

                <div class="summary-row">
                    <span>Selisih Bersih</span>
                    <strong>{{ $selisihBersih }}</strong>
                </div>

                <div class="summary-row">
                    <span>Transaksi Masuk</span>
                    <strong>{{ $transaksiMasukCount }} transaksi</strong>
                </div>

                <div class="summary-row">
                    <span>Maintenance Dibayar</span>
                    <strong>{{ $maintenanceCount }} pekerjaan</strong>
                </div>
            </div>
            <div class="report-actions">
                <a href="/admin/laporan/pdf?{{ http_build_query(request()->all()) }}" class="report-action-btn report-action-primary">Export PDF</a>
                {{-- <a href="/admin/laporan/excel?{{ http_build_query(request()->all()) }}" class="report-action-btn report-action-secondary">Export Excel</a> --}}
            </div>
        </div>
    </div>
</div>

<script>
    function switchReportType(type) {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const selectBulan = document.getElementById('select_bulan');
        const selectTahun = document.getElementById('select_tahun');
        const filterLabel = document.getElementById('filter_label');
        const typeInput = document.getElementById('report_type_input');

        typeInput.value = type;
        tabBtns.forEach(btn => btn.classList.remove('active'));

        if (type === 'bulanan') {
            event.target.classList.add('active');
            selectBulan.style.display = 'block';
            selectTahun.style.display = 'none';
            filterLabel.innerText = 'Pilih Bulan Laporan';
        } else {
            event.target.classList.add('active');
            selectBulan.style.display = 'none';
            selectTahun.style.display = 'block';
            filterLabel.innerText = 'Pilih Tahun Laporan';
        }
    }
</script>

@endsection
