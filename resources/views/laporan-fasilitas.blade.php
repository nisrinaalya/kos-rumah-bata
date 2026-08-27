@extends("layouts/main")

@section("content")
<section class="flex-1">
    <div class="profile-wrapper">
        <div class="lg:hidden mb-4 flex items-center justify-between">
            <h1 class="text-lg font-bold">Laporan Fasilitas</h1>
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
                <div class="space-y-6">

                    @if(session('success'))
                        <div style="background: #e8f8f5; color: #27ae60; padding: 16px; border-radius: 12px; border: 1px solid #d4efdf; font-weight: 500; font-size: 14px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div style="background: #fdf2f2; color: #ec5b5b; padding: 16px; border-radius: 12px; border: 1px solid #fde8e8; font-weight: 500; font-size: 14px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card space-y-4">
                        <h2 class="font-semibold">Buat Laporan</h2>

                        <form action="/profile/laporan-fasilitas" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div class="space-y-1.5">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Nomor Kamar</label>
                                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-60 md:text-sm" placeholder="Mis. A1" value="Kamar {{ $nomorKamarDefault ?? '-' }}" disabled>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Nama Perbaikan / Keluhan</label>
                                <input type="text" name="nama_perbaikan" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" placeholder="Mis. AC Bocor, Kran Kamar Mandi Patah" value="{{ old('nama_perbaikan') }}" required>
                                @error('nama_perbaikan')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Deskripsi Keluhan</label>
                                <textarea name="deskripsi" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" rows="3" placeholder="Jelaskan detail masalah kerusakan fasilitas..." required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <p class="text-sm font-medium mb-1.5">Foto (opsional)</p>
                                <button type="button" id="uploadButtonTrigger" class="w-full rounded-xl border-2 border-dashed p-4 text-left transition-colors border-border hover:border-primary hover:bg-primary-soft/30">
                                    <div class="flex items-center gap-3">
                                        <span class="h-10 w-10 grid place-items-center rounded-lg bg-secondary text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload h-5 w-5">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" x2="12" y1="3" y2="15"></line>
                                            </svg>
                                        </span>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium truncate" id="uploadStatusText">Klik untuk pilih file</p>
                                            <p class="text-xs text-muted-foreground">Format: JPG, JPEG, PNG (maks 5MB)</p>
                                        </div>
                                    </div>
                                </button>
                                <input type="file" id="fotoMaintenanceInput" name="foto_maintenance" accept=".jpg,.jpeg,.png" class="hidden">

                                <div id="userImagePreviewWrapper" class="hidden mt-3 max-w-xs border border-dashed border-border/80 bg-muted/20 p-2 rounded-xl">
                                    <img id="userImagePreview" src="#" alt="Pratinjau Foto Kerusakan" class="w-full h-auto object-cover rounded-lg shadow-sm max-h-48">
                                </div>

                                @error('foto_maintenance')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">Kirim Laporan</button>
                        </form>
                    </div>

                    <div>
                        <h2 class="font-semibold mb-3">Riwayat Laporan</h2>
                        <div class="space-y-3">

                            @if($riwayatMaintenances->isEmpty())
                                <div class="bg-card border border-border/60 rounded-xl p-6 text-center text-muted-foreground text-sm">
                                    Belum ada riwayat pengajuan perbaikan fasilitas untuk kamar Anda.
                                </div>
                            @else
                                @foreach($riwayatMaintenances as $item)
                                    @php
                                        $badgeText = 'Dikirim';
                                        $badgeColorClass = 'bg-yellow-50 text-yellow-600 border-yellow-200';

                                        if($item->status === 'proses') {
                                            $badgeText = 'Diproses';
                                            $badgeColorClass = 'bg-blue-50 text-blue-600 border-blue-200';
                                        } elseif($item->status === 'selesai') {
                                            $badgeText = 'Selesai';
                                            $badgeColorClass = 'bg-green-50 text-green-600 border-green-200';
                                        }

                                        $tanggalFormatted = $item->tanggal_laporan ? \Carbon\Carbon::parse($item->tanggal_laporan)->translatedFormat('j F Y') : $item->created_at->translatedFormat('j F Y');
                                    @endphp
                                    <div class="bg-card border border-border/60 rounded-xl p-4 shadow-soft">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <p class="font-medium text-xs text-muted-foreground">Kamar {{ $nomorKamarDefault }}</p>
                                                <p class="font-semibold text-base text-foreground mt-0.5">{{ $item->nama_perbaikan }}</p>
                                                <p class="text-sm text-muted-foreground mt-1">{{ $item->deskripsi }}</p>
                                                <p class="text-xs text-muted-foreground mt-2">{{ $tanggalFormatted }}</p>
                                            </div>
                                            <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border {{ $badgeColorClass }}">
                                                {{ $badgeText }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<script>
    const uploadButtonTrigger = document.getElementById('uploadButtonTrigger');
    const fotoMaintenanceInput = document.getElementById('fotoMaintenanceInput');
    const uploadStatusText = document.getElementById('uploadStatusText');
    const previewWrapper = document.getElementById('userImagePreviewWrapper');
    const previewImage = document.getElementById('userImagePreview');

    if(uploadButtonTrigger && fotoMaintenanceInput) {
        uploadButtonTrigger.addEventListener('click', function() {
            fotoMaintenanceInput.click();
        });

        fotoMaintenanceInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if(file) {
                // Tampilkan nama file asli
                uploadStatusText.textContent = file.name;

                // Logika Pemrosesan Live Preview Gambar
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewWrapper.classList.remove('hidden'); // Tampilkan container preview
                }
                reader.readAsDataURL(file);
            } else {
                uploadStatusText.textContent = 'Klik untuk pilih file';
                previewImage.src = '#';
                previewWrapper.classList.add('hidden'); // Sembunyikan jika batal memilih
            }
        });
    }
</script>
@endsection
