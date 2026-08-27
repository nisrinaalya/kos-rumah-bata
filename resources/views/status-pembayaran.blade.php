@extends("layouts/main")

@section("content")
<section class="flex-1">
    <div class="profile-wrapper">
        <div class="lg:hidden mb-4 flex items-center justify-between">
            <h1 class="text-lg font-bold">Status Pembayaran</h1>
            <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:rg:" data-state="closed">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu h-4 w-4">
                    <line x1="4" x2="20" y1="12" y2="12"></line>
                    <line x1="4" x2="20" y1="6" y2="6"></line>
                    <line x1="4" x2="20" y1="18" y2="18"></line>
                </svg>
                Menu
            </button>
        </div>
        <div class="profile-layout">
            @include('components.profile_sidebar')
            <main class="profile-content">
                @if(session('success'))
                    <div class="mb-5 flex items-start gap-4 p-4 rounded-2xl shadow-sm backdrop-blur-sm"
                        style="background-color: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: rgb(5, 150, 105);" role="alert">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl animate-pulse"
                            style="background-color: rgba(16, 185, 129, 0.2); color: rgb(5, 150, 105);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                        </span>
                        <div class="flex-1 pt-1">
                            <h3 class="font-bold text-sm leading-none mb-1 text-emerald-800">Berhasil!</h3>
                            <p class="text-xs font-medium opacity-90 text-emerald-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div class="mb-5 flex items-start gap-4 p-4 rounded-2xl shadow-sm backdrop-blur-sm"
                        style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: rgb(220, 38, 38);" role="alert">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl"
                            style="background-color: rgba(239, 68, 68, 0.2); color: rgb(220, 38, 38);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" x2="12" y1="8" y2="12"/>
                                <line x1="12" x2="12.01" y1="16" y2="16"/>
                            </svg>
                        </span>
                        <div class="flex-1 pt-1">
                            <h3 class="font-bold text-sm leading-none mb-1 text-red-800">Terjadi Kesalahan</h3>
                            @if(session('error'))
                                <p class="text-xs font-medium opacity-90 text-red-700">{{ session('error') }}</p>
                            @else
                                <ul class="list-disc pl-4 text-xs font-medium opacity-90 text-red-700 space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="space-y-4">

                    @forelse($riwayatSewa as $sewa)
                    @php
                        // Total sewa murni harga kamar tunggal tanpa perkalian durasi bulan
                        $totalSewa = $sewa->kamar ? $sewa->kamar->harga : 0;

                        // Hitung akumulasi seluruh nominal pembayaran yang telah disetujui admin
                        $sudahDibayar = $sewa->pembayarans->whereIn('status', ['disetujui', 'pending'])->sum('nominal');

                        // Ambil data detail record pembayaran berdasarkan status untuk validasi yang presisi
                        $pembayaranDitolak = $sewa->pembayarans->where('status', 'ditolak')->first();
                        $pembayaranPending = $sewa->pembayarans->where('status', 'pending')->first();
                        $pembayaranDisetujui = $sewa->pembayarans->where('status', 'disetujui')->first();

                        $statusGlobalSewa = strtolower($sewa->status);

                        // Default penentuan komponen status teks & desain badge
                        $badgeStyle = "bg-warning/15 text-warning-foreground border-warning/40";
                        $statusTeks = "Menunggu Approval";

                        // =====================================================================
                        // URUTAN LOGIKA PENENTU KRITERIA STATUS YANG PRESISI
                        // =====================================================================
                        if ($statusGlobalSewa == 'ditolak') {
                            $badgeStyle = "bg-destructive/15 text-destructive border-destructive/40";
                            $statusTeks = "Upload Ulang";
                        } elseif ($pembayaranDitolak) {
                            // 1. Jika ada pembayaran yang ditolak admin, wajib masuk mode Upload Ulang
                            $badgeStyle = "bg-destructive/15 text-destructive border-destructive/40";
                            $statusTeks = "Upload Ulang";
                        } elseif ($pembayaranPending) {
                            // 2. PRIORITAS UTAMA BARU: Jika ada transaksi pending (baik DP awal atau Pelunasan sisa),
                            //    maka status harus tetap menampilkan "Menunggu Approval"
                            $badgeStyle = "bg-warning/15 text-warning-foreground border-warning/40";
                            $statusTeks = "Menunggu Approval";
                        } elseif ($pembayaranDisetujui) {
                            // 3. Jika tidak ada yang pending/ditolak, baru kita cek akumulasi dana terkumpul
                            if ($sudahDibayar >= $totalSewa) {
                                // Jika sudah bayar pelunasan / full terpenuhi dan disetujui
                                $badgeStyle = "bg-success/15 text-success border-success/40";
                                $statusTeks = "Approved";
                            } else {
                                // Jika baru DP awal yang disetujui dan belum mengirim berkas pelunasan
                                $badgeStyle = "bg-success/15 text-success border-success/40";
                                $statusTeks = "DP Approved";
                            }
                        }

                        $jatuhTempo = \Carbon\Carbon::parse($sewa->tanggal_mulai)->addMonths($sewa->durasi_sewa)->translatedFormat('d F Y');
                    @endphp

                        <div class="bg-card border border-border/60 rounded-2xl p-5 shadow-card">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold">Kamar {{ $sewa->kamar->nomor_kamar ?? '-' }} — Tower {{ $sewa->kamar->tower }}</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">ID {{ $sewa->order_id }} · diajukan {{ \Carbon\Carbon::parse($sewa->created_at)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold border {{ $badgeStyle }}">{{ $statusTeks }}</div>
                                </div>
                            </div>

                            {{-- 1. Menampilkan catatan admin apabila status transaksi ditolak (Upload Ulang) --}}
                            @if($statusTeks == 'Upload Ulang' && $pembayaranDitolak)
                                <div class="mt-4 rounded-xl border border-warning/30 bg-warning/10 p-4 text-sm text-warning-foreground">
                                    <div class="flex items-start gap-2.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle shrink-0 mt-0.5 text-warning-foreground">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" x2="12" y1="8" y2="12"></line>
                                            <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                        </svg>
                                        <div>
                                            <p class="font-bold text-amber-900">Catatan Admin:</p>
                                            <p class="mt-1 text-xs leading-relaxed text-amber-800">
                                                "{{ $pembayaranDitolak->deskripsi ?? 'Bukti transfer terpotong atau kurang jelas, harap unggah kembali struk resmi ATM/M-Banking yang mencantumkan nomor referensi bank secara utuh.' }}"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4 grid sm:grid-cols-3 gap-3 text-sm">
                                <div class="rounded-lg bg-secondary p-3">
                                    <p class="text-xs text-muted-foreground">Total Sewa</p>
                                    <p class="font-semibold mt-0.5">Rp&nbsp;{{ number_format($totalSewa, 0, ',', '.') }}</p>
                                </div>
                                <div class="rounded-lg bg-secondary p-3">
                                    <p class="text-xs text-muted-foreground">Sudah Dibayar</p>
                                    <p class="font-semibold mt-0.5 @if($statusTeks == 'Approved') text-green-600 @endif">
                                        Rp&nbsp;{{ number_format($sudahDibayar, 0, ',', '.') }}
                                        @if($statusTeks == 'Approved') (Lunas) @endif
                                        @if($statusGlobalSewa == 'ditolak') (Gagal) @endif
                                    </p>
                                </div>
                                <div class="rounded-lg bg-secondary p-3">
                                    <p class="text-xs text-muted-foreground">{{ $statusTeks == 'Approved' ? 'Jatuh Tempo Perpanjang' : 'Jatuh Tempo' }}</p>
                                    <p class="font-semibold mt-0.5">{{ $statusGlobalSewa == 'ditolak' ? 'Dibatalkan' : $jatuhTempo }}</p>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                @if($statusTeks == 'Upload Ulang')
                                    <a href="/pembayaran/{{ $sewa->order_id }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 rounded-md px-3 font-semibold shadow-soft">Upload Ulang Bukti</a>
                                @elseif($statusTeks == 'DP Approved')
                                    {{-- 2. Menampilkan tombol Bayar Pelunasan jika masih berstatus DP Approved --}}
                                    <a href="/pembayaran/{{ $sewa->order_id }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-9 rounded-md px-3 font-semibold shadow-soft" style="background-color: #c8664a; color: #ffffff;">Bayar Pelunasan</a>
                                @elseif($statusTeks == 'Approved')
                                    {{-- 3. Jika sudah bayar full / Approve, tombol perpanjang sewa dihilangkan sepenuhnya (sesuai instruksi) --}}
                                @endif

                                <a href="https://wa.me/628194001701?text=Halo%20Admin%2C%20terkait%20sewa%20Kamar%20{{ $sewa->kamar->nomor_kamar ?? '-' }}%20(ID%20{{ $sewa->order_id }})." target="_blank" rel="noreferrer" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle h-3.5 w-3.5">
                                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                                    </svg>
                                    Hubungi Admin
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-card border border-border/60 rounded-2xl p-8 text-center text-muted-foreground shadow-card">
                            <p class="font-medium text-sm">Belum ada riwayat pengajuan pemesanan kamar.</p>
                            <a href="/kamar" class="mt-3 inline-flex text-xs bg-primary text-primary-foreground px-4 py-2 rounded-xl font-semibold">Cari Kamar Kos</a>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>
</section>
@endsection
