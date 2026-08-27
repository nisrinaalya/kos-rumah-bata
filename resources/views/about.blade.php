@extends("layouts/main")

@section("content")
<section class="relative overflow-hidden">
    <div class="container-app pt-12 pb-12 md:pt-16 md:pb-16 grid lg:grid-cols-2 gap-10 items-center">
        <div class="animate-fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-primary-soft text-primary px-3.5 py-1.5 text-xs font-semibold">Tentang Kami</span>
            <h1 class="mt-5 text-4xl md:text-5xl font-bold leading-tight tracking-tight">Kos <span class="text-primary">Rumah Bata</span></h1>
            <p class="mt-4 text-base md:text-lg text-muted-foreground max-w-lg">Hunian kos modern bernuansa hangat di tengah Bogor. Dirancang untuk pelajar dan profesional muda yang mencari kenyamanan, keamanan, dan komunitas yang sehat.</p>
            <div class="mt-7 flex flex-wrap gap-3">
                <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-full px-7" href="/kamar">
                    Lihat Kamar
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-1 h-4 w-4">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
                <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-11 rounded-full px-7" href="/aktivitas">Berita Terbaru</a>
            </div>
        </div>
        <div class="relative animate-fade-up" style="animation-delay: 120ms;">
            <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-elevated">
                <img src="about.png" alt="Bangunan Kos Rumah Bata" class="h-full w-full object-cover" width="1280" height="896">
            </div>
        </div>
    </div>
    <div class="absolute inset-0 -z-10 bg-gradient-warm"></div>
</section>

<section class="container-app py-14">
    <div class="max-w-3xl">
        <p class="text-sm font-semibold text-primary uppercase tracking-wide">Tentang Kami</p>
        <h2 class="text-3xl md:text-4xl font-bold mt-2">Tempat tinggal yang terasa seperti rumah.</h2>
        <p class="mt-4 text-muted-foreground leading-relaxed">Kos Rumah Bata berdiri sejak 2019 dengan konsep "rumah kedua" — bangunan bata ekspos yang hangat, ruang komunal yang luas, serta sistem manajemen digital yang transparan. Kami percaya hunian yang baik bukan hanya soal kamar, tapi juga soal komunitas dan kemudahan.</p>
    </div>
    <div class="mt-10 grid md:grid-cols-3 gap-5">
        <div class="bg-card rounded-2xl p-6 border border-border/60 shadow-soft">
            <div class="h-11 w-11 rounded-xl bg-primary-soft text-primary grid place-items-center">
                <svg xmlns="http://www.w3.org/2000/xl" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart h-5 w-5">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                </svg>
            </div>
            <h3 class="mt-4 font-semibold text-lg">Konsep</h3>
            <p class="mt-1.5 text-sm text-muted-foreground">Hunian hangat ala rumah dengan sentuhan modern. Privasi dan kebersamaan seimbang.</p>
        </div>

        <div class="bg-card rounded-2xl p-6 border border-border/60 shadow-soft">
            <div class="h-11 w-11 rounded-xl bg-primary-soft text-primary grid place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target h-5 w-5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="12" r="6"></circle>
                    <circle cx="12" cy="12" r="2"></circle>
                </svg>
            </div>
            <h3 class="mt-4 font-semibold text-lg">Visi</h3>
            <p class="mt-1.5 text-sm text-muted-foreground">Menjadi kos digital paling terpercaya di Bogor dengan pengalaman penghuni terbaik.</p>
        </div>

        <div class="bg-card rounded-2xl p-6 border border-border/60 shadow-soft">
            <div class="h-11 w-11 rounded-xl bg-primary-soft text-primary grid place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-5 w-5">
                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                    <path d="M20 3v4"></path>
                    <path d="M22 5h-4"></path>
                    <path d="M4 17v2"></path>
                    <path d="M5 18H3"></path>
                </svg>
            </div>
            <h3 class="mt-4 font-semibold text-lg">Misi</h3>
            <p class="mt-1.5 text-sm text-muted-foreground">Menyediakan hunian aman, nyaman, transparan, dan terjangkau untuk semua kalangan.</p>
        </div>
    </div>
</section>

{{-- Galeri --}}
<style>
    /* Gaya dasar untuk item galeri */
    .gallery-item {
        position: relative;
        overflow: hidden;
    }

    /* Overlay gelap transparan yang muncul saat hover */
    .gallery-item::after {
        content: '';
        position: absolute;
        /* Menutupi seluruh area gambar secara sempurna */
        inset: 0;
        /* Menggunakan warna gelap solid merata (Hitam transparan 65%) agar foto dijamin menggelap */
        background: rgba(0, 0, 0, 0.65);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 1;
    }

    /* Kontainer teks di dalam gambar */
    .gallery-text-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 24px;
        color: #ffffff;
        z-index: 2;
        /* Teks mulai dari posisi sedikit lebih rendah dan tidak terlihat */
        transform: translateY(20px);
        opacity: 0;
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        text-align: left;
    }

    /* Gaya judul kegiatan */
    .gallery-text-title {
        margin: 0 0 6px !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        letter-spacing: -0.01em !important;
        line-height: 1.3 !important;
        color: #ffffff !important;
    }

    /* Gaya deskripsi singkat */
    .gallery-text-desc {
        margin: 0 !important;
        font-size: 13.5px !important;
        line-height: 1.5 !important;
        color: #f4ddd4 !important; /* Krem lembut kontras tinggi */
    }

    /* Pemicu efek hover */
    .gallery-item:hover::after {
        opacity: 1;
    }

    .gallery-item:hover .gallery-text-content {
        transform: translateY(0); /* Teks bergerak naik ke posisi asli */
        opacity: 1;
    }
</style>

<section class="container-app py-10 pb-16">
    <div class="flex items-end justify-between mb-8 gap-4 flex-wrap">
        <div>
            <p class="text-sm font-semibold text-primary uppercase tracking-wide">Galeri</p>
            <h2 class="text-3xl md:text-4xl font-bold mt-2">Suasana di Kos Rumah Bata</h2>
            <p class="text-muted-foreground mt-2 max-w-lg">Foto kamar, lingkungan, dan aktivitas penghuni.</p>
        </div>
    </div>

    {{-- Mengubah grid menjadi 3 kolom (md:grid-cols-3) untuk mendukung formasi 3x3 --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
        @foreach($galeris as $index => $item)
            {{-- Semua item menggunakan rasio landscape yang sama (aspect-[4/3]) tanpa pengondisian bento --}}
            <div class="gallery-item rounded-2xl shadow-card border border-border/40 aspect-[4/3]">
                <img src="{{ asset( $item->image) }}" alt="{{ $item->title }}" loading="lazy" class="h-full w-full object-cover">
                <div class="gallery-text-content">
                    <h4 class="gallery-text-title">{{ $item->title }}</h4>
                    <p class="gallery-text-desc">{{ $item->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<a href="https://wa.me/628194001701?text=Halo%20Admin%20Kos%20Rumah%20Bata%2C%20saya%20ingin%20bertanya%20mengenai%20ketersediaan%20kamar." target="_blank" rel="noreferrer" class="transition-all duration-300 hover:scale-110" style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 999999 !important; display: flex !important; height: 56px !important; width: 56px !important; align-items: center !important; justify-content: center !important; border-radius: 50% !important; background-color: #CD6D4D !important; color: white !important; box-shadow: 0 8px 30px rgba(205, 109, 77, 0.5) !important;" aria-label="Hubungi Admin via WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle">
        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
    </svg>
</a>
@endsection
