<aside class="profile-sidebar">
    <div class="sticky top-24">
        <div class="bg-card border border-border/60 rounded-2xl p-5 shadow-card w-full flex flex-col">
            <div class="flex flex-col items-center text-center pb-5 border-b border-border/60">
                <span class="grid h-20 w-20 place-items-center rounded-full bg-gradient-primary text-primary-foreground text-3xl font-bold shadow-elevated">
                    {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
                </span>
                <h2 class="mt-3 font-bold truncate max-w-full">{{ Auth::user()->nama }}</h2>
                <p class="text-xs text-muted-foreground truncate max-w-full">{{ Auth::user()->email }}</p>
            </div>
            <nav class="mt-4 flex flex-col items-stretch gap-2 w-full">

                <a href="/profile" class="w-full flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors text-left min-h-[44px] {{ request()->is('profile') ? 'bg-primary text-primary-foreground shadow-soft' : 'text-foreground hover:bg-secondary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-4 w-4 shrink-0">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="flex-1 truncate">Profil Saya</span>
                </a>

                <a href="/profile/status-pembayaran" class="w-full flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors text-left min-h-[44px] {{ request()->is('profile/status-pembayaran') ? 'bg-primary text-primary-foreground shadow-soft' : 'text-foreground hover:bg-secondary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-4 w-4 shrink-0">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                        <path d="M10 9H8"></path>
                        <path d="M16 13H8"></path>
                        <path d="M16 17H8"></path>
                    </svg>
                    <span class="flex-1 truncate">Status Pembayaran</span>
                </a>

                <a href="/profile/laporan-fasilitas" class="w-full flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors text-left min-h-[44px] {{ request()->is('profile/laporan-fasilitas') ? 'bg-primary text-primary-foreground shadow-soft' : 'text-foreground hover:bg-secondary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench h-4 w-4 shrink-0">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                    <span class="flex-1 truncate">Laporan Fasilitas</span>
                </a>

                <div class="my-2 h-px bg-border"></div>

                <a href="/logout" class="w-full flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-destructive hover:bg-destructive/10 transition-colors text-left min-h-[44px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out h-4 w-4 shrink-0">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" x2="9" y1="12" y2="12"></line>
                    </svg>
                    <span class="flex-1 truncate">Logout</span>
                </a>
            </nav>
        </div>
    </div>
</aside>
