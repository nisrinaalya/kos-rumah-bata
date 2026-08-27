@extends("layouts/main")

@section("content")

<div class="activity-page-wrapper flex-1">
    <div class="activity-page-layout">
        <section class="activity-header">
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Aktivitas</h1>
            <p class="text-sm text-muted-foreground mt-1">Update terbaru dari Kos Rumah Bata</p>
        </section>
        
        <section class="activity-filter-section sticky top-16 z-20 bg-background/85 backdrop-blur border-b border-border/60">
            <div class="flex gap-1 overflow-x-auto no-scrollbar py-2" id="categoryFilterContainer">
                <button data-target="all" class="category-btn shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors bg-primary text-primary-foreground">Semua</button>
                <button data-target="Info Kamar" class="category-btn shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors bg-secondary text-foreground hover:bg-muted">Info Kamar</button>
                <button data-target="Update Kos" class="category-btn shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors bg-secondary text-foreground hover:bg-muted">Update Kos</button>
                <button data-target="Aktivitas" class="category-btn shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors bg-secondary text-foreground hover:bg-muted">Aktivitas</button>
                <button data-target="Promo" class="category-btn shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors bg-secondary text-foreground hover:bg-muted">Promo</button>
                <button data-target="Social" class="category-btn shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors bg-secondary text-foreground hover:bg-muted">Social</button>
            </div>
        </section>
        
        <section class="activity-feed-section">
            <ul class="activity-feed divide-y divide-border/60" id="activityFeedList">
                @foreach($activities as $activity)
                <li class="activity-card activity-feed-item py-4 px-1 hover:bg-muted/30 transition-colors rounded-lg" data-category="{{ $activity->category }}">
                    <div class="flex gap-3 w-full">
                        <div class="shrink-0">
                            <div class="h-11 w-11 rounded-full bg-gradient-primary text-primary-foreground grid place-items-center font-bold shadow-soft">KB</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="font-semibold text-sm">Kos Rumah Bata</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check h-4 w-4 text-primary">
                                    <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"></path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                                <span class="text-muted-foreground text-sm">@kosrumahbata</span>
                                <span class="text-muted-foreground text-sm">·</span>
                                <span class="text-muted-foreground text-sm">{{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}</span>
                                
                                @if($activity->is_pinned)
                                <span class="ml-auto text-[11px] font-medium text-primary inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-3 w-3">
                                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                        <path d="M20 3v4"></path>
                                        <path d="M22 5h-4"></path>
                                        <path d="M4 17v2"></path>
                                        <path d="M5 18H3"></path>
                                    </svg>
                                    Disematkan
                                </span>
                                @endif
                            </div>
                            
                            <div class="mt-1 flex items-center gap-1.5">
                                @if($activity->category == 'Promo')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full border" style="background-color: #fef3c7; color: #92400e; border-color: #fde68a;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-3 w-3">
                                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                        <path d="M20 3v4"></path>
                                        <path d="M22 5h-4"></path>
                                        <path d="M4 17v2"></path>
                                        <path d="M5 18H3"></path>
                                    </svg>
                                    {{ $activity->category }}
                                </span>
                                @elseif($activity->category == 'Info Kamar')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full border" style="background-color: #dbeafe; color: #1e40af; border-color: #bfdbfe;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bed-double h-3 w-3">
                                        <path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"></path>
                                        <path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"></path>
                                        <path d="M12 4v6"></path>
                                        <path d="M2 18h20"></path>
                                    </svg>
                                    {{ $activity->category }}
                                </span>
                                @elseif($activity->category == 'Aktivitas')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full border" style="background-color: #d1fae5; color: #065f46; border-color: #a7f3d0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-3 w-3">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    {{ $activity->category }}
                                </span>
                                @elseif($activity->category == 'Update Kos')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full border" style="background-color: #ffe4e6; color: #9f1239; border-color: #fecdd3;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-megaphone h-3 w-3">
                                        <path d="m3 11 18-5v12L3 14v-3z"></path>
                                        <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"></path>
                                    </svg>
                                    {{ $activity->category }}
                                </span>
                                @elseif($activity->category == 'Social')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full border" style="background-color: #f3e8ff; color: #6b21a8; border-color: #e9d5ff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-3 w-3">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                    </svg>
                                    {{ $activity->category }}
                                </span>
                                @endif
                            </div>

                            <h2 class="mt-2 text-base font-bold tracking-tight text-foreground">{{ $activity->title }}</h2>
                            
                            <p class="mt-1 text-sm leading-relaxed whitespace-pre-line text-foreground">{{ $activity->description }}</p>
                            
                            @if($activity->image)
                            <div class="mt-3 overflow-hidden rounded-2xl border border-border/60">
                                <img src="{{ asset('images/activities/' . $activity->image) }}" alt="Foto {{ $activity->title }}" loading="lazy" class="w-full max-h-[420px] object-cover">
                            </div>
                            @endif

                            @if($activity->link_url)
                            <div class="mt-3">
                                <a href="{{ $activity->link_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-xs font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground h-7 px-3 rounded-full shadow-sm">
                                    {{ $activity->link_label ?? ($activity->category == 'Info Kamar' ? 'Lihat kamar' : ($activity->category == 'Social' ? 'Follow Instagram' : 'Buka Tautan')) }}
                                </a>
                            </div>
                            @elseif($activity->category == 'Info Kamar')
                            <div class="mt-3">
                                <a href="/kamar" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-xs font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-primary text-primary bg-transparent hover:bg-primary hover:text-primary-foreground h-7 px-3 rounded-full shadow-sm">Lihat kamar</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            
            <div id="emptyFilterMessage" class="hidden py-12 text-center text-sm text-muted-foreground">
                Belum ada pengumuman untuk kategori ini
            </div>

            <div id="endFeedMessage" class="py-10 text-center text-sm text-muted-foreground">Kamu sudah sampai akhir feed</div>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.category-btn');
        const items = document.querySelectorAll('.activity-feed-item');
        const emptyMessage = document.getElementById('emptyFilterMessage');
        const endFeedMessage = document.getElementById('endFeedMessage');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const targetCategory = this.getAttribute('data-target');

                // 1. Perbarui status kelas active tombol tab
                buttons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'text-primary-foreground');
                    btn.classList.add('bg-secondary', 'text-foreground', 'hover:bg-muted');
                });
                
                this.classList.remove('bg-secondary', 'text-foreground', 'hover:bg-muted');
                this.classList.add('bg-primary', 'text-primary-foreground');

                // 2. Tampilkan atau sembunyikan item list berdasarkan kategori
                let visibleCount = 0;
                items.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    if (targetCategory === 'all' || itemCategory === targetCategory) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // 3. Tampilkan pesan kosong jika tidak ada item yang cocok
                if (visibleCount === 0) {
                    emptyMessage.classList.remove('hidden');
                    endFeedMessage.classList.add('hidden');
                } else {
                    emptyMessage.classList.add('hidden');
                    endFeedMessage.classList.remove('hidden');
                }
            });
        });
    });
</script>

@endsection