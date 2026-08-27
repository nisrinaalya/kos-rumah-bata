@extends("layouts/main")

@section("content")

<section class="bg-gradient-warm border-b border-border/60">
    <div class="container-app py-12">
        <p class="text-sm font-semibold text-primary uppercase tracking-wide">Daftar Kamar</p>
        <h1 class="text-3xl md:text-4xl font-bold mt-2">Pilih kamar yang sesuai untukmu</h1>
        <p class="text-muted-foreground mt-2 max-w-xl">Tersedia berbagai tipe kamar dengan fasilitas lengkap. Pilih sesuai kebutuhan dan budgetmu.</p>
    </div>
</section>

<div class="room-page-wrapper">
    <div class="room-page-layout">
        <section class="room-filter-section">
            <div class="bg-card rounded-2xl border border-border/60 shadow-soft p-4 md:p-5 flex flex-col gap-4 w-full">
                <div class="relative w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    <input id="userKamarSearch" class="flex border border-input px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm pl-10 h-11 rounded-xl bg-background w-full" placeholder="Cari nama kamar...">
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="status-filter-btn px-4 py-1.5 rounded-full text-sm font-medium border transition-colors bg-primary text-primary-foreground border-primary shadow-soft" data-status="all">Semua Status</button>
                    <button type="button" class="status-filter-btn px-4 py-1.5 rounded-full text-sm font-medium border transition-colors bg-surface text-foreground/70 border-border hover:border-primary/40 hover:text-foreground" data-status="tersedia">Tersedia</button>
                    <button type="button" class="status-filter-btn px-4 py-1.5 rounded-full text-sm font-medium border transition-colors bg-surface text-foreground/70 border-border hover:border-primary/40 hover:text-foreground" data-status="penuh">Penuh</button>

                    <span class="mx-2 hidden sm:inline-block w-px bg-border"></span>

                    <button type="button" class="type-filter-btn px-4 py-1.5 rounded-full text-sm font-medium border transition-colors bg-primary text-primary-foreground border-primary shadow-soft" data-type="all">Semua Tipe</button>
                    <button type="button" class="type-filter-btn px-4 py-1.5 rounded-full text-sm font-medium border transition-colors bg-surface text-foreground/70 border-border hover:border-primary/40 hover:text-foreground" data-type="ac">AC</button>
                    <button type="button" class="type-filter-btn px-4 py-1.5 rounded-full text-sm font-medium border transition-colors bg-surface text-foreground/70 border-border hover:border-primary/40 hover:text-foreground" data-type="non-ac">Non AC</button>
                </div>
            </div>
            <div class="flex items-center justify-between mt-4 w-full">
                <p class="text-sm text-muted-foreground">Menampilkan <span id="visibleCount" class="font-semibold text-foreground">{{ $kamars->count() }}</span> dari {{ $kamars->count() }} kamar</p>
            </div>
        </section>

        <section class="room-content-section w-full">
            <div class="room-grid" id="kamarUserGrid">
                @foreach($kamars as $kamar)
                <article class="user-room-card group bg-card rounded-2xl overflow-hidden shadow-card border border-border/60 hover:shadow-elevated transition-all duration-300 hover:-translate-y-1 flex flex-col w-full"
                         data-name="kamar {{ strtolower($kamar->nomor_kamar) }} tower {{ strtolower($kamar->tower) }}"
                         data-status="{{ $kamar->status }}"
                         data-type="{{ $kamar->tipe_kamar }}">

                    <div class="relative aspect-[4/3] overflow-hidden bg-muted w-full">
                        @if($kamar->foto_utama)
                            <img src="{{ asset($kamar->foto_utama) }}" alt="Kamar {{ $kamar->nomor_kamar }}" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            @if($kamar->nomor_kamar == '02')
                                <img src="{{ asset('2.jpg') }}" alt="Kamar 02" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($kamar->nomor_kamar == '03')
                                <img src="{{ asset('3.jpg') }}" alt="Kamar 03" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($kamar->nomor_kamar == '04')
                                <img src="{{ asset('4.jpg') }}" alt="Kamar 04" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($kamar->nomor_kamar == '05')
                                <img src="{{ asset('5.jpg') }}" alt="Kamar 05" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($kamar->nomor_kamar == '06')
                                <img src="{{ asset('6.jpg') }}" alt="Kamar 06" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="{{ asset('1.jpg') }}" alt="Kamar 01" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        @endif

                        <div class="absolute top-3 left-3 flex gap-2">
                            <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-secondary/80 gap-1 bg-surface/95 backdrop-blur text-foreground border-0 shadow-soft">
                                @if($kamar->tipe_kamar == 'ac')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-snowflake h-3 w-3">
                                        <line x1="2" x2="22" y1="12" y2="12"></line>
                                        <line x1="12" x2="12" y1="2" y2="22"></line>
                                        <path d="m20 16-4-4 4-4"></path>
                                        <path d="m4 8 4 4-4 4"></path>
                                        <path d="m16 4-4 4-4-4"></path>
                                        <path d="m8 20 4-4 4 4"></path>
                                    </svg>
                                    AC
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wind h-3 w-3">
                                        <path d="M12.8 19.6A2 2 0 1 0 14 16H2"></path>
                                        <path d="M17.5 8a2.5 2.5 0 1 1 2 4H2"></path>
                                        <path d="M9.8 4.4A2 2 0 1 1 11 8H2"></path>
                                    </svg>
                                    Non AC
                                @endif
                            </div>
                        </div>
                        <div class="absolute top-3 right-3">
                            @if($kamar->status == 'tersedia')
                                <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-success text-white border-0 shadow-soft">Tersedia</div>
                            @else
                                <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors bg-red-600 text-white border-0 shadow-soft" style="background-color: #dc2626;">Penuh</div>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex flex-col items-stretch flex-1 w-full">
                        <h3 class="font-semibold text-lg leading-snug w-full">Kamar {{ $kamar->nomor_kamar }} — Tower {{ $kamar->tower }}</h3>
                        <p class="text-xs text-muted-foreground mt-1 w-full">Luas {{ $kamar->luas }}</p>

                        @if($kamar->status == 'penuh')
                            <p class="text-xs text-warning mt-2">Penuh (Silakan cek berkala atau hubungi admin)</p>
                        @endif

                        <div class="mt-4 mb-5 w-full">
                            <p class="text-xs text-muted-foreground">Mulai dari</p>
                            <p class="text-xl font-bold text-primary">Rp&nbsp;{{ number_format($kamar->harga, 0, ',', '.') }}<span class="text-xs font-normal text-muted-foreground"> / {{ $kamar->dalam_hitungan ?? 'tahun' }}</span></p>
                        </div>
                        <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 mt-auto w-full group/btn" href="/kamar/{{ $kamar->id }}">
                            Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1 h-4 w-4 group-hover/btn:translate-x-0.5 transition-transform">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Empty State Area --}}
            <div id="userKamarEmpty" class="hidden text-center py-12 bg-card rounded-2xl border border-dashed border-border p-6 mt-6 w-full">
                <h3 class="font-semibold text-lg text-foreground">Kamar tidak ditemukan</h3>
                <p class="text-sm text-muted-foreground mt-1">Coba gunakan kata kunci nomor kamar, tower, atau filter tipe lainnya.</p>
            </div>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('userKamarSearch');
        const statusButtons = document.querySelectorAll('.status-filter-btn');
        const typeButtons = document.querySelectorAll('.type-filter-btn');
        const roomCards = document.querySelectorAll('.user-room-card');
        const visibleCountSpan = document.getElementById('visibleCount');
        const emptyStateDiv = document.getElementById('userKamarEmpty');

        let selectedStatus = 'all';
        let selectedType = 'all';

        function filterUserRooms() {
            const keyword = searchInput.value.toLowerCase().trim();
            let count = 0;

            roomCards.forEach(card => {
                const name = card.getAttribute('data-name');
                const status = card.getAttribute('data-status');
                const type = card.getAttribute('data-type');

                const matchSearch = name.includes(keyword);
                const matchStatus = (selectedStatus === 'all' || status === selectedStatus);
                const matchType = (selectedType === 'all' || type === selectedType);

                if (matchSearch && matchStatus && matchType) {
                    card.style.display = 'flex';
                    count++;
                } else {
                    card.style.display = 'none';
                }
            });

            visibleCountSpan.textContent = count;

            if (count === 0) {
                emptyStateDiv.classList.remove('hidden');
            } else {
                emptyStateDiv.classList.add('hidden');
            }
        }

        // PERUBAHAN LOGIKA FILTER: Penukaran kelas status-filter-btn menggunakan selektor yang tepat
        statusButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                statusButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-primary-foreground', 'border-primary', 'shadow-soft');
                    b.classList.add('bg-surface', 'text-foreground/70', 'border-border');
                });
                this.classList.remove('bg-surface', 'text-foreground/70', 'border-border');
                this.classList.add('bg-primary', 'text-primary-foreground', 'border-primary', 'shadow-soft');

                selectedStatus = this.getAttribute('data-status');
                filterUserRooms();
            });
        });

        // PERUBAHAN LOGIKA FILTER: Penukaran kelas type-filter-btn menggunakan selektor yang tepat
        typeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                typeButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-primary-foreground', 'border-primary', 'shadow-soft');
                    b.classList.add('bg-surface', 'text-foreground/70', 'border-border');
                });
                this.classList.remove('bg-surface', 'text-foreground/70', 'border-border');
                this.classList.add('bg-primary', 'text-primary-foreground', 'border-primary', 'shadow-soft');

                selectedType = this.getAttribute('data-type');
                filterUserRooms();
            });
        });

        searchInput.addEventListener('input', filterUserRooms);
    });
</script>

<a href="https://wa.me/628194001701?text=Halo%20Admin%20Kos%20Rumah%20Bata%2C%20saya%20ingin%20bertanya%20mengenai%20ketersediaan%20kamar." target="_blank" rel="noreferrer" class="transition-all duration-300 hover:scale-110" style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 999999 !important; display: flex !important; height: 56px !important; width: 56px !important; align-items: center !important; justify-content: center !important; border-radius: 50% !important; background-color: #CD6D4D !important; color: white !important; box-shadow: 0 8px 30px rgba(205, 109, 77, 0.5) !important;" aria-label="Hubungi Admin via WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle">
        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
    </svg>
</a>

@endsection
