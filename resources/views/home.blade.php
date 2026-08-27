@extends("layouts/main")

@section("content")
{{-- Hero --}}
<section class="relative overflow-hidden">
    <div class="container-app pt-12 pb-16 md:pt-20 md:pb-24 grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
        <div class="animate-fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-primary-soft text-primary px-3.5 py-1.5 text-xs font-semibold">
                <span class="h-1.5 w-1.5 rounded-full bg-primary"></span> Kost Khusus Mahasiswi
            </span>
            <h1 class="mt-5 text-4xl md:text-5xl lg:text-6xl font-bold leading-[1.05] tracking-tight">
                Hunian nyaman <br>dengan <span class="text-primary">cara modern.</span>
            </h1>
            <p class="mt-5 text-base md:text-lg text-muted-foreground max-w-lg">
                Kos Rumah Bata menyediakan pengelolaan sewa kost putri yang praktis. Cek ketersediaan kamar, ajukan sewa, dan bayar online — semua dalam satu tempat. khusus untuk mahasiswi yang menginginkan hunian aman, tenang, dan strategis.
            </p>
            <div class="mt-7 flex flex-wrap gap-3">
                <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-full px-7 shadow-elevated" href="/kamar">
                    Lihat Kamar Tersedia
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1 h-4 w-4">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#fasilitas" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-11 rounded-full px-7">Fasilitas Kos</a>
            </div>
            <div class="mt-10 grid grid-cols-3 gap-6 max-w-md">
                <div>
                    <p class="text-2xl font-bold">40+</p>
                    <p class="text-xs text-muted-foreground">Kamar tersedia</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">2024</p>
                    <p class="text-xs text-muted-foreground">Sejak Didirikan</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">4.9</p>
                    <p class="text-xs text-muted-foreground">Rating penghuni</p>
                </div>
            </div>
        </div>

        <div class="relative animate-fade-up" style="animation-delay: 120ms;">
            <div class="relative aspect-4/5 rounded-3xl overflow-hidden shadow-elevated">
                <img src="hero.png" alt="Tampilan depan Kos Rumah Bata" class="h-full w-full object-cover" width="1600" height="1000">
            </div>

            <div class="hidden md:flex absolute -right-6 top-10 bg-surface rounded-2xl px-4 py-3 shadow-elevated border border-border/60 items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-4 w-4 text-primary">
                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <p class="text-sm font-medium">Bogor</p>
            </div>
        </div>
    </div>
    <div class="absolute inset-0 -z-10 bg-gradient-warm"></div>
</section>

{{-- Kenapa harus --}}
<section class="container-app py-14">
    <div class="grid md:grid-cols-3 gap-5">
        <div class="bg-card rounded-2xl p-6 border border-border/60 shadow-soft hover:shadow-card transition-shadow">
            <div class="h-11 w-11 rounded-xl bg-primary-soft text-primary grid place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check h-5 w-5">
                <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                <path d="m9 12 2 2 4-4"></path>
                </svg>
            </div>
            <h3 class="mt-4 font-semibold text-lg">Keamanan 24 Jam</h3>
            <p class="mt-1.5 text-sm text-muted-foreground">Lingkungan kos aman terkendali dengan penjagaan dan pengawasan keamanan 24 jam penuh untuk kenyamanan Anda.</p>
        </div>
        <div class="bg-card rounded-2xl p-6 border border-border/60 shadow-soft hover:shadow-card transition-shadow">
            <div class="h-11 w-11 rounded-xl bg-primary-soft text-primary grid place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet h-5 w-5">
                <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path>
                <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path>
                </svg>
            </div>
            <h3 class="mt-4 font-semibold text-lg">Pembayaran Praktis</h3>
            <p class="mt-1.5 text-sm text-muted-foreground">Mendukung sistem pembayaran sewa per tahun yang transparan dengan perhitungan sewa masuk dan keluar per 1 Juni.</p>
        </div>
        <div class="bg-card rounded-2xl p-6 border border-border/60 shadow-soft hover:shadow-card transition-shadow">
            <div class="h-11 w-11 rounded-xl bg-primary-soft text-primary grid place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-5 w-5">
                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                <path d="M20 3v4"></path>
                <path d="M22 5h-4"></path>
                <path d="M4 17v2"></path>
                <path d="M5 18H3"></path>
                </svg>
            </div>
            <h3 class="mt-4 font-semibold text-lg">Bebas Biaya Tambahan</h3>
            <p class="mt-1.5 text-sm text-muted-foreground">Nikmati fasilitas lengkap termasuk akses Wi-Fi gratis dan bebas dari iuran air bulanan.</p>
        </div>
    </div>
</section>

{{-- Kamar home --}}
<section class="container-app py-10">
    <div class="flex items-end justify-between mb-8 gap-4 flex-wrap">
        <div>
            <p class="text-sm font-semibold text-primary uppercase tracking-wide">Kamar Pilihan</p>
            <h2 class="text-3xl md:text-4xl font-bold mt-2">Temukan kamar favoritmu</h2>
            <p class="text-muted-foreground mt-2 max-w-lg">Tipe AC dan Non AC dengan fasilitas modern, harga transparan per tahun.</p>
        </div>
        <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 rounded-full" href="/kamar">
            Lihat Semua
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1 h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kamars as $kamar)
        <article class="group bg-card rounded-2xl overflow-hidden shadow-card border border-border/60 hover:shadow-elevated transition-all duration-300 hover:-translate-y-1 flex flex-col">
            <div class="relative aspect-[4/3] overflow-hidden bg-muted">
                <img src="{{ asset($kamar->foto_utama) }}" alt="Kamar {{ $kamar->nomor_kamar }} — Tower {{ ucfirst($kamar->tower) }}" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">

                <div class="absolute top-3 left-3 flex gap-2">
                    <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-secondary/80 gap-1 bg-surface/95 backdrop-blur text-foreground border-0 shadow-soft">
                        @if($kamar->tipe_kamar === 'ac')
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
                    @if($kamar->status === 'tersedia')
                        <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-success text-white border-0 shadow-soft">Tersedia</div>
                    @else
                        <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-secondary/80 bg-foreground/85 text-background border-0 shadow-soft">Penuh</div>
                    @endif
                </div>
            </div>

            <div class="p-5 flex flex-col flex-1">
                <h3 class="font-semibold text-lg leading-snug">Kamar {{ $kamar->nomor_kamar }} — Tower {{ ucfirst($kamar->tower) }}</h3>

                <p class="text-xs text-muted-foreground mt-1">Luas {{ $kamar->luas }}</p>

                <div class="mt-4 mb-5">
                    <p class="text-xs text-muted-foreground">Mulai dari</p>
                    <p class="text-xl font-bold text-primary">Rp {{ number_format($kamar->harga, 0, ',', '.') }}<span class="text-xs font-normal text-muted-foreground"> / {{ $kamar->dalam_hitungan }}</span></p>
                </div>

                <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 mt-auto w-full group/btn" href="/kamar/{{ $kamar->id }}">
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
</section>

{{-- Fasilitas --}}
<section id="fasilitas" class="container-app py-16">
    <div class="grid lg:grid-cols-2 gap-10 items-center">
        
        <div class="grid grid-cols-2 gap-4">
            <img src="1.jpg" alt="Dapur bersama" loading="lazy" class="rounded-2xl aspect-square object-cover shadow-card">
            <img src="2.jpg" alt="Kamar deluxe" loading="lazy" class="rounded-2xl aspect-square object-cover shadow-card mt-8">
            <img src="3.jpg" alt="Area parkir" loading="lazy" class="rounded-2xl aspect-square object-cover shadow-card">
            
            <div class="relative rounded-2xl aspect-square mt-8 overflow-hidden shadow-card">
                <img src="4.jpg" alt="Fasilitas" class="w-full h-full object-cover text-primary-foreground bg-gradient-primary bg-blend-multiply">
            </div>
        </div> <div>
            <p class="text-sm font-semibold text-primary uppercase tracking-wide">Fasilitas</p>
            <h2 class="text-3xl md:text-4xl font-bold mt-2">Semua kebutuhanmu, dalam satu hunian.</h2>
            <p class="text-muted-foreground mt-3 max-w-lg">Nikmati berbagai fasilitas bersama mulai dari dapur luas, area belajar kelompok, hingga pemandangan gunung yang asri demi mendukung produktivitas dan keseimbangan hidupmu.</p>
            
            <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="flex items-center gap-3 bg-card rounded-xl p-3.5 border border-border/60">
                    <div class="h-9 w-9 rounded-lg bg-secondary text-primary grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi h-4.5 w-4.5">
                            <path d="M12 20h.01"></path>
                            <path d="M2 8.82a15 15 0 0 1 20 0"></path>
                            <path d="M5 12.859a10 10 0 0 1 14 0"></path>
                            <path d="M8.5 16.429a5 5 0 0 1 7 0"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Wi-Fi Cepat</p>
                </div>

                <div class="flex items-center gap-3 bg-card rounded-xl p-3.5 border border-border/60">
                    <div class="h-9 w-9 rounded-lg bg-secondary text-primary grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-car h-4.5 w-4.5">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                            <circle cx="7" cy="17" r="2"></circle>
                            <path d="M9 17h6"></path>
                            <circle cx="17" cy="17" r="2"></circle>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Parkir Luas</p>
                </div>

                <div class="flex items-center gap-3 bg-card rounded-xl p-3.5 border border-border/60">
                    <div class="h-9 w-9 rounded-lg bg-secondary text-primary grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils-crossed h-4.5 w-4.5">
                            <path d="m16 2-2.3 2.3a3 3 0 0 0 0 4.2l1.8 1.8a3 3 0 0 0 4.2 0L22 8"></path>
                            <path d="M15 15 3.3 3.3a4.2 4.2 0 0 0 0 6 l7.3 7.3c.7.7 2 .7 2.8 0L15 15Zm0 0 7 7"></path>
                            <path d="m2.1 21.8 6.4-6.3"></path>
                            <path d="m19 5-7 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Dapur Bersama</p>
                </div>

                <div class="flex items-center gap-3 bg-card rounded-xl p-3.5 border border-border/60">
                    <div class="h-9 w-9 rounded-lg bg-secondary text-primary grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shower-head h-4.5 w-4.5">
                            <path d="m4 4 2.5 2.5"></path>
                            <path d="M13.5 6.5a4.95 4.95 0 0 0-7 7"></path>
                            <path d="M15 5 5 15"></path>
                            <path d="M14 17v.01"></path>
                            <path d="M10 16v.01"></path>
                            <path d="M13 13v.01"></path>
                            <path d="M16 10v.01"></path>
                            <path d="M11 20v.01"></path>
                            <path d="M17 14v.01"></path>
                            <path d="M20 11v.01"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Air Bersih 24 Jam</p>
                </div>

                <div class="flex items-center gap-3 bg-card rounded-xl p-3.5 border border-border/60">
                    <div class="h-9 w-9 rounded-lg bg-secondary text-primary grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock h-4.5 w-4.5">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Akses 24 Jam</p>
                </div>

                <div class="flex items-center gap-3 bg-card rounded-xl p-3.5 border border-border/60">
                    <div class="h-9 w-9 rounded-lg bg-secondary text-primary grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-4.5 w-4.5">
                            <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                            <path d="M20 3v4"></path>
                            <path d="M22 5h-4"></path>
                            <path d="M4 17v2"></path>
                            <path d="M5 18H3"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Cleaning Service</p>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Faq --}}
<section id="faq" class="container-app py-16">
    <div class="grid lg:grid-cols-[1fr_1.4fr] gap-10 lg:gap-16 items-start">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-primary-soft text-primary px-3.5 py-1.5 text-xs font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-help h-3.5 w-3.5">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <path d="M12 17h.01"></path>
                </svg>
                FAQ
            </span>
            <h2 class="text-3xl md:text-4xl font-bold mt-3">Pertanyaan yang sering ditanyakan</h2>
            <p class="text-muted-foreground mt-3 max-w-md">Jawaban cepat seputar proses sewa, pembayaran, dan layanan di Kos Rumah Bata. Masih bingung? Hubungi admin kami via WhatsApp.</p>
            <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 mt-6 rounded-full" href="/tentang-kami">
                Tentang Kami
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1 h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="bg-card border border-border/60 rounded-2xl p-2 sm:p-4 shadow-card">
            <div class="w-full">
                @foreach($faqs as $faq)
                <details class="border-b last:border-b-0 px-3 group" {{ $loop->first ? 'open' : '' }}>
                    <summary class="flex flex-1 items-center justify-between py-4 text-left text-base font-semibold cursor-pointer list-none select-none">
                        {{ $faq->question }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 shrink-0 transition-transform duration-200 group-open:rotate-180">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </summary>
                    <div class="pb-4 pt-0 text-sm text-muted-foreground leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </details>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Lokasi --}}
<section class="container-app py-14">
    <div class="rounded-3xl bg-gradient-primary text-primary-foreground p-8 md:p-12 grid md:grid-cols-2 gap-8 items-center shadow-elevated">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest opacity-90">Lokasi Strategis</p>
            <h2 class="text-3xl md:text-4xl font-bold mt-2">Dekat kampus, mall, dan pusat kuliner.</h2>
            <p class="mt-3 opacity-90 max-w-md">Berlokasi sangat strategis di Jln Sancang Dalam No. 26, Bogor. Dekat dengan area kampus, pusat kuliner, dan mudah diakses untuk mendukung aktivitas perkuliahanmu sehari-hari.</p>
            <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-secondary text-secondary-foreground hover:bg-secondary/80 h-11 px-8 mt-6 rounded-full" href="/kamar">
                Mulai Cari Kamar
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1 h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="aspect-4/3 rounded-2xl overflow-hidden border border-white/20"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4407536609333!2d106.80501227430405!3d-6.5920120644385225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c589173195e5%3A0x5ee079d689237b51!2sRumah%20bata%20kost%20wanita%20dekat%20kampus%20ipb%20bogor%20kota%20cibelende!5e0!3m2!1sid!2sid!4v1778941761238!5m2!1sid!2sid" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </div>
</section>

<a href="https://wa.me/628194001701?text=Halo%20Admin%20Kos%20Rumah%20Bata%2C%20saya%20ingin%20bertanya%20mengenai%20ketersediaan%20kamar." target="_blank" rel="noreferrer" class="transition-all duration-300 hover:scale-110" style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 999999 !important; display: flex !important; height: 56px !important; width: 56px !important; align-items: center !important; justify-content: center !important; border-radius: 50% !important; background-color: #CD6D4D !important; color: white !important; box-shadow: 0 8px 30px rgba(205, 109, 77, 0.5) !important;" aria-label="Hubungi Admin via WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle">
        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
    </svg>
</a>

@endsection

{{-- @push("scripts")
<script type="module" crossorigin="" src="script.js"></script>
@endpush --}}
