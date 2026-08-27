@extends("layouts/main")

@section("content")
<div class="container-app pt-6">
    <a href="/kamar" class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left h-4 w-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        Kembali
    </a>
</div>

<section class="container-app py-6 grid lg:grid-cols-5 gap-8">
    <div class="lg:col-span-3">
        <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-muted shadow-card">
            @if($kamar->foto_utama)
                <img id="mainGalleryImage" src="{{ asset($kamar->foto_utama) }}" alt="Kamar {{ $kamar->nomor_kamar }}" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
            @else
                @if($kamar->nomor_kamar == '02')
                    <img id="mainGalleryImage" src="{{ asset('2.jpg') }}" alt="Kamar 02" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
                @elseif($kamar->nomor_kamar == '03')
                    <img id="mainGalleryImage" src="{{ asset('3.jpg') }}" alt="Kamar 03" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
                @elseif($kamar->nomor_kamar == '04')
                    <img id="mainGalleryImage" src="{{ asset('4.jpg') }}" alt="Kamar 04" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
                @elseif($kamar->nomor_kamar == '05')
                    <img id="mainGalleryImage" src="{{ asset('5.jpg') }}" alt="Kamar 05" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
                @elseif($kamar->nomor_kamar == '06')
                    <img id="mainGalleryImage" src="{{ asset('6.jpg') }}" alt="Kamar 06" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
                @else
                    <img id="mainGalleryImage" src="{{ asset('1.jpg') }}" alt="Kamar 01" class="h-full w-full object-cover transition-all duration-300" width="1200" height="900">
                @endif
            @endif
        </div>

        <div class="mt-3 grid grid-cols-4 gap-3">
            <button type="button" class="thumb-btn aspect-[4/3] rounded-xl overflow-hidden border-2 transition-all border-primary shadow-soft">
                @if($kamar->foto_utama)
                    <img src="{{ asset($kamar->foto_utama) }}" alt="" class="h-full w-full object-cover" loading="lazy">
                @else
                    <img src="{{ asset($kamar->nomor_kamar == '02' ? '2.jpg' : ($kamar->nomor_kamar == '03' ? '3.jpg' : ($kamar->nomor_kamar == '04' ? '4.jpg' : ($kamar->nomor_kamar == '05' ? '5.jpg' : ($kamar->nomor_kamar == '06' ? '6.jpg' : '1.jpg'))))) }}" alt="" class="h-full w-full object-cover" loading="lazy">
                @endif
            </button>

            @if($kamar->foto_tambahan_1)
            <button type="button" class="thumb-btn aspect-[4/3] rounded-xl overflow-hidden border-2 transition-all border-transparent opacity-70 hover:opacity-100">
                <img src="{{ asset($kamar->foto_tambahan_1) }}" alt="" class="h-full w-full object-cover" loading="lazy">
            </button>
            @endif

            @if($kamar->foto_tambahan_2)
            <button type="button" class="thumb-btn aspect-[4/3] rounded-xl overflow-hidden border-2 transition-all border-transparent opacity-70 hover:opacity-100">
                <img src="{{ asset($kamar->foto_tambahan_2) }}" alt="" class="h-full w-full object-cover" loading="lazy">
            </button>
            @endif

            @if($kamar->foto_tambahan_3)
            <button type="button" class="thumb-btn aspect-[4/3] rounded-xl overflow-hidden border-2 transition-all border-transparent opacity-70 hover:opacity-100">
                <img src="{{ asset($kamar->foto_tambahan_3) }}" alt="" class="h-full w-full object-cover" loading="lazy">
            </button>
            @endif
        </div>

        <div class="mt-8 bg-card rounded-2xl border border-border/60 p-6 shadow-soft">
            <h2 class="font-semibold text-lg">Deskripsi Kamar</h2>
            <p class="text-sm text-muted-foreground mt-2 leading-relaxed">
                {!! $kamar->deskripsi ? nl2br(e($kamar->deskripsi)) : 'Kamar standar nyaman untuk satu orang. Cocok untuk pelajar atau pekerja yang mengutamakan kenyamanan dengan harga terjangkau. Sirkulasi udara baik dengan jendela besar.' !!}
            </p>

            <h3 class="font-semibold mt-6">Fasilitas</h3>
            <ul class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                @if(is_array($kamar->fasilitas) && count($kamar->fasilitas) > 0)
                    @foreach($kamar->fasilitas as $item)
                        <li class="flex items-center gap-2.5 text-sm">
                            <span class="h-6 w-6 rounded-full bg-accent/15 text-accent grid place-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check h-3.5 w-3.5">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                @else
                    <li class="text-sm text-muted-foreground italic">Fasilitas standar hunian kos Rumah Bata.</li>
                @endif
            </ul>
        </div>
    </div>

    <aside class="lg:col-span-2 lg:sticky lg:top-20 self-start space-y-4 w-full">
        <div class="bg-card rounded-2xl border border-border/60 shadow-card p-6">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-bold leading-tight">Kamar {{ $kamar->nomor_kamar }} — Tower {{ $kamar->tower }}</h1>
                    <p class="text-sm text-muted-foreground mt-1 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-3.5 w-3.5">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Kos Rumah Bata, Bogor
                    </p>
                </div>
                <div>
                    @if($kamar->status == 'tersedia')
                        <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors bg-success text-white border-0 shadow-soft">Tersedia</div>
                    @else
                        <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors text-white border-0 shadow-soft bg-red-600">Penuh</div>
                    @endif
                </div>
            </div>

            <div class="mt-5 grid grid-cols-2 gap-3">
                <div class="rounded-xl bg-secondary p-3">
                    <div class="flex items-center gap-2 text-xs text-muted-foreground">
                        @if($kamar->tipe_kamar == 'ac')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-snowflake h-3.5 w-3.5">
                                <line x1="2" x2="22" y1="12" y2="12"></line>
                                <line x1="12" x2="12" y1="2" y2="22"></line>
                                <path d="m20 16-4-4 4-4"></path>
                                <path d="m4 8 4 4-4 4"></path>
                                <path d="m16 4-4 4-4-4"></path>
                                <path d="m8 20 4-4 4 4"></path>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wind h-3.5 w-3.5">
                                <path d="M12.8 19.6A2 2 0 1 0 14 16H2"></path>
                                <path d="M17.5 8a2.5 2.5 0 1 1 2 4H2"></path>
                                <path d="M9.8 4.4A2 2 0 1 1 11 8H2"></path>
                            </svg>
                        @endif
                        Tipe
                    </div>
                    <p class="font-semibold mt-1">{{ $kamar->tipe_kamar == 'ac' ? 'AC' : 'Non AC' }}</p>
                </div>
                <div class="rounded-xl bg-secondary p-3">
                    <div class="flex items-center gap-2 text-xs text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-maximize2 h-3.5 w-3.5">
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <polyline points="9 21 3 21 3 15"></polyline>
                            <line x1="21" x2="14" y1="3" y2="10"></line>
                            <line x1="3" x2="10" y1="21" y2="14"></line>
                        </svg>
                        Luas
                    </div>
                    <p class="font-semibold mt-1">{{ $kamar->luas }}</p>
                </div>
            </div>

            <div class="mt-5 pt-5 border-t border-border">
                <p class="text-xs text-muted-foreground">Harga sewa</p>
                <p class="text-3xl font-bold text-primary mt-0.5">Rp&nbsp;{{ number_format($kamar->harga, 0, ',', '.') }}<span class="text-sm font-normal text-muted-foreground"> / {{ $kamar->dalam_hitungan ?? 'tahun' }}</span></p>
            </div>

            @if($kamar->status == 'tersedia')
                <a href="/kamar/{{ $kamar->id }}/ajukan-sewa" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8 w-full mt-5 rounded-full shadow-elevated">Ajukan Sewa</a>
            @else
                <button type="button" disabled class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium h-11 px-8 w-full mt-5 rounded-full bg-muted text-muted-foreground cursor-not-allowed border border-border/40 shadow-none">Kamar Penuh</button>
            @endif

            <div class="mt-4 flex items-center gap-2 text-xs text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check h-4 w-4 text-accent">
                    <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
                Pengajuan aman &amp; data tersimpan rapi.
            </div>
        </div>

        <div class="bg-secondary/60 rounded-2xl p-5 text-sm w-full">
            <p class="font-semibold">Butuh bantuan?</p>
            <p class="text-muted-foreground mt-1">Hubungi admin via WhatsApp untuk pertanyaan seputar kamar ini.</p>
            <a href="https://wa.me/628194001701?text=Halo%20Admin,%20saya%20ingin%20tanya%20mengenai%20Kamar%20{{ $kamar->nomor_kamar }}%20Tower%20{{ $kamar->tower }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 mt-3 w-full">Chat Admin</a>
        </div>
    </aside>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainGalleryImage');
        const thumbButtons = document.querySelectorAll('.thumb-btn');

        thumbButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Ambil element img di dalam button yang di-klik
                const clickedImgSrc = this.querySelector('img').src;

                // Tukar src gambar utama ke gambar kecil yang diklik
                mainImage.src = clickedImgSrc;

                // Hilangkan ring border biru aktif dari semua tombol thumbnail
                thumbButtons.forEach(b => {
                    b.classList.remove('border-primary', 'shadow-soft');
                    b.classList.add('border-transparent', 'opacity-70');
                });

                // Tambahkan ring aktif ke thumbnail yang baru saja dipilih
                this.classList.remove('border-transparent', 'opacity-70');
                this.classList.add('border-primary', 'shadow-soft', 'opacity-100');
            });
        });
    });
</script>
@endsection
