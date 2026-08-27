@extends("layouts/main")

@section("content")

<div class="container-app pt-6">
    <a href="/kamar/{{ $kamar->id }}" class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left h-4 w-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        Kembali
    </a>
</div>
<section class="container-app py-6 grid lg:grid-cols-3 gap-6">
    {{-- Form Utama (Ditambahkan id="rentForm") --}}
    <form id="rentForm" action="/kamar/{{ $kamar->id }}/ajukan-sewa" method="POST" enctype="multipart/form-data" class="lg:col-span-2 bg-card border border-border/60 rounded-2xl p-6 shadow-card space-y-5">
        @csrf
        <input type="hidden" name="user_ktp" value="{{ $userLogedIn->ktp_dokumen }}">
        <input type="hidden" name="user_komitmen" value="{{ $userLogedIn->surat_komitmen }}">
        <div>
            <h1 class="text-2xl font-bold">Form Pengajuan Sewa</h1>
            <p class="text-sm text-muted-foreground mt-1">Lengkapi data diri &amp; dokumen untuk mengajukan sewa.</p>
        </div>

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

        <div class="grid sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="text-sm font-semibold leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="fullName">Nama Lengkap <span class="text-destructive">*</span></label>
                <input type="text" name="nama" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" id="fullName" required value="{{ old('nama', $userLogedIn->name ?? $userLogedIn->nama ?? '') }}">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-semibold leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="startDate">Tanggal Mulai Sewa <span class="text-destructive">*</span></label>
                <input type="date" name="tanggal_mulai" id="startDate" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" required value="{{ old('tanggal_mulai') }}">
            </div>
        </div>

        <div>
            <p class="text-sm font-semibold mb-1.5">Upload KTP <span class="text-destructive">*</span></p>
            <button type="button" id="btn-ktp" class="w-full rounded-xl border-2 border-dashed p-4 text-left transition-colors border-border hover:border-primary hover:bg-primary-soft/30">
                <div class="flex items-center gap-3">
                    <span class="h-10 w-10 grid place-items-center rounded-lg bg-secondary text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload h-5 w-5">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" x2="12" y1="3" y2="15"></line>
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate" id="label-ktp">
                            @if(!empty($userLogedIn->ktp_dokumen))
                                {{ basename($userLogedIn->ktp_dokumen) }} (Tersedia)
                            @else
                                Klik untuk pilih file
                            @endif
                        </p>
                        <p class="text-xs text-muted-foreground">Foto KTP yang jelas. Format: JPG/PNG/PDF.</p>
                    </div>
                </div>
            </button>
            <input type="file" id="input-ktp" name="ktp_dokumen" accept=".pdf,.jpg,.jpeg,.png" class="hidden">

            <div id="preview-container-ktp" class="mt-3 @if(empty($userLogedIn->ktp_dokumen)) hidden @endif border rounded-xl p-2 bg-muted/30">
                <p class="text-xs font-medium text-muted-foreground mb-1">Preview KTP:</p>
                <div id="preview-content-ktp" class="max-h-60 overflow-hidden flex items-center justify-start rounded-lg">
                    @if(!empty($userLogedIn->ktp_dokumen))
                        @if(Str::endsWith(strtolower($userLogedIn->ktp_dokumen), ['.pdf']))
                            <embed src="{{ asset($userLogedIn->ktp_dokumen) }}" type="application/pdf" class="w-full h-64 rounded-md border">
                        @elseif(Str::endsWith(strtolower($userLogedIn->ktp_dokumen), ['.jpg', '.jpeg', '.png']))
                            <img src="{{ asset($userLogedIn->ktp_dokumen) }}" class="max-w-full max-h-48 object-contain rounded-md border">
                        @else
                            <p class="text-sm text-foreground italic py-2">Berkas KTP sudah tersimpan.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="text-sm font-semibold leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="phone">No HP <span class="text-destructive">*</span></label>
                <input type="tel" name="no_hp" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" id="phone" required value="{{ old('no_hp', $userLogedIn->no_hp ?? $userLogedIn->phone ?? '') }}">
            </div>
            <div class="space-y-1.5">
                <label class="text-sm font-semibold leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="emergencyPhone">No HP Orang Tua / Emergency <span class="text-destructive">*</span></label>
                <input type="tel" name="kontak_darurat" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" id="emergencyPhone" required value="{{ old('kontak_darurat', $userLogedIn->kontak_darurat ?? '') }}">
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="text-sm font-semibold leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="address">Alamat Asal <span class="text-destructive">*</span></label>
            <textarea name="alamat" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="address" rows="3" required>{{ old('alamat', $userLogedIn->alamat ?? '') }}</textarea>
        </div>

        <div class="space-y-3">
            <div>
                <p class="text-sm font-semibold">Surat Komitmen<span class="text-destructive">*</span></p>
                <p class="text-xs text-muted-foreground mt-0.5">Unduh berkas template, isi dan tanda tangani, kemudian unggah kembali di bawah ini.</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 border border-primary/20 bg-primary-soft/10 rounded-xl">
                <div class="flex items-start gap-2.5 min-w-0">
                    <span class="p-2 rounded-lg bg-primary/10 text-primary mt-0.5 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-4 w-4">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                            <path d="M10 9H8"></path>
                            <path d="M16 13H8"></path>
                            <path d="M16 17H8"></path>
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm font-medium truncate text-foreground">Template Surat Komitmen</p>
                        <p class="text-xs text-muted-foreground mt-0.5">Tipe berkas: .docx</p>
                    </div>
                </div>
                <a href="/Surat-Komitmen.docx" download class="inline-flex items-center justify-center gap-1.5 whitespace-nowrap rounded-lg text-xs font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-8 px-3 shadow-soft shrink-0">
                    <svg xmlns="http://www.w3.org/2000/xl" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download h-3.5 w-3.5">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" x2="12" y1="3" y2="15"></line>
                    </svg>
                    Unduh Template
                </a>
            </div>

            <button type="button" id="btn-komitmen" class="w-full rounded-xl border-2 border-dashed p-4 text-left transition-colors border-border hover:border-primary hover:bg-primary-soft/30">
                <div class="flex items-center gap-3">
                    <span class="h-10 w-10 grid place-items-center rounded-lg bg-secondary text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload h-5 w-5">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" x2="12" y1="3" y2="15"></line>
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate" id="label-komitmen">
                            @if(!empty($userLogedIn->surat_komitmen))
                                {{ basename($userLogedIn->surat_komitmen) }} (Tersedia)
                            @else
                                Klik untuk pilih file surat komitmen
                            @endif
                        </p>
                        <p class="text-xs text-muted-foreground">Format yang didukung: .PDF (Maksimal 2MB)</p>
                    </div>
                </div>
            </button>
            <input type="file" id="input-komitmen" name="surat_komitmen" accept=".pdf" class="hidden">

            <div id="preview-container-komitmen" class="mt-3 @if(empty($userLogedIn->surat_komitmen)) hidden @endif border rounded-xl p-2 bg-muted/30">
                <p class="text-xs font-medium text-muted-foreground mb-1">Preview Surat Komitmen:</p>
                <div id="preview-content-komitmen" class="max-h-60 overflow-hidden flex items-center justify-start rounded-lg">
                    @if(!empty($userLogedIn->surat_komitmen))
                        @if(Str::endsWith(strtolower($userLogedIn->surat_komitmen), ['.pdf']))
                            <embed src="{{ asset($userLogedIn->surat_komitmen) }}" type="application/pdf" class="w-full h-64 rounded-md border">
                        @elseif(Str::endsWith(strtolower($userLogedIn->surat_komitmen), ['.jpg', '.jpeg', '.png']))
                            <img src="{{ asset($userLogedIn->surat_komitmen) }}" class="max-w-full max-h-48 object-contain rounded-md border">
                        @else
                            <p class="text-sm text-foreground italic py-2">Berkas Surat Komitmen sudah tersimpan.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 text-xs text-muted-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check h-4 w-4 text-accent">
                <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                <path d="m9 12 2 2 4-4"></path>
            </svg>
            Data Anda aman dan hanya digunakan untuk proses sewa.
        </div>

        {{-- Mengimbuhkan id="btnSubmitRent" untuk dibaca oleh script ganda di bawah --}}
        <button type="submit" id="btnSubmitRent" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8 w-full rounded-full">
            Kirim Pengajuan Sewa
        </button>
    </form>

    {{-- Data Dinamis untuk Ringkasan Kamar --}}
    <aside class="bg-card border border-border/60 rounded-2xl p-5 shadow-soft self-start lg:sticky lg:top-20 space-y-4">
        <p class="text-sm font-semibold">Ringkasan Kamar</p>
        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-muted">
            <img src="{{ $kamar->foto_utama ? asset($kamar->foto_utama) : asset('3.jpg') }}" alt="Kamar {{ $kamar->nomor_kamar }}" class="h-full w-full object-cover">
        </div>
        <div>
            <h2 class="font-bold leading-tight">Kamar {{ $kamar->nomor_kamar }} — {{ $kamar->tower }}</h2>
            <div class="flex items-center gap-2 mt-2">
                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80">
                    {{ strtoupper($kamar->tipe_kamar) }}
                </div>
                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80">
                    {{ $kamar->luas }}
                </div>
            </div>
        </div>
        <div class="pt-3 border-t border-border">
            <p class="text-xs text-muted-foreground">Harga sewa</p>
            <p class="text-2xl font-bold text-primary">Rp&nbsp;{{ number_format($kamar->harga, 0, ',', '.') }}<span class="text-sm font-normal text-muted-foreground"> / {{ $kamar->dalam_hitungan ?? 'tahun' }}</span></p>
        </div>
        <div class="pt-2 text-xs text-muted-foreground space-y-1">
            <p>Tanggal Mulai: <span id="summary-start-date" class="font-medium text-foreground">-</span></p>
            <p>Durasi Sewa: <span id="summary-duration" class="font-medium text-foreground">{{ ucwords($kamar->dalam_hitungan ?? 'tahun') }} (s.d. {{ \Carbon\Carbon::parse($tanggalMulaiOtomatis)->translatedFormat('d F Y') }})</span></p>
            <p>Status awal pengajuan: <span class="font-medium text-foreground">Pending</span></p>
        </div>
    </aside>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Logika pencegahan Double Submit Data Pengajuan
        const rentForm = document.getElementById('rentForm');
        const btnSubmitRent = document.getElementById('btnSubmitRent');

        if (rentForm && btnSubmitRent) {
            rentForm.addEventListener('submit', function () {
                btnSubmitRent.setAttribute('disabled', 'true');
                btnSubmitRent.innerText = 'Mengirim Pengajuan Sewa...';
            });
        }

        // Data dasar periode hitungan dan tanggal otomatis dari backend laravel
        const hitunganKamar = "{{ $kamar->dalam_hitungan ?? 'tahun' }}";
        const tanggalMulaiOtomatis = "{{ $tanggalMulaiOtomatis }}"; // Mengambil 'Y-m-d'

        // Ambil element input dan summary teks
        const startDateInput = document.getElementById('startDate');
        const summaryStartDate = document.getElementById('summary-start-date');
        const summaryDuration = document.getElementById('summary-duration');

        // Logika menonaktifkan tanggal sebelum hari ini pada input #startDate
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1;
        let dd = today.getDate();

        if (mm < 10) mm = '0' + mm;
        if (dd < 10) dd = '0' + dd;

        const formattedToday = yyyy + '-' + mm + '-' + dd;
        startDateInput.setAttribute('min', formattedToday);

        // Fungsi pembantu format tanggal ke teks Indonesia (Contoh: 1 Juni 2026)
        function formatIndonesianDate(dateString) {
            if(!dateString) return "-";
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            const dateObj = new Date(dateString);
            if(isNaN(dateObj)) return "-";

            return dateObj.getDate() + ' ' + months[dateObj.getMonth()] + ' ' + dateObj.getFullYear();
        }

        // Jalankan event listener ketika user memilih tanggal mulai sewa
        startDateInput.addEventListener('change', function() {
            const selectedDateValue = this.value;
            if(selectedDateValue) {
                // 1. Update Teks Tanggal Mulai secara Live mengikuti pilihan user
                summaryStartDate.textContent = formatIndonesianDate(selectedDateValue);

                // 2. Update Teks Durasi dengan tanggal "s.d." yang FIX ke tanggalMulaiOtomatis
                let durasiText = hitunganKamar;
                const tanggalFixJuni = formatIndonesianDate(tanggalMulaiOtomatis);

                if (hitunganKamar.toLowerCase().includes('bulan')) {
                    const angkaBulan = parseInt(hitunganKamar) || 1;
                    durasiText = `${angkaBulan} Bulan (s.d. ${tanggalFixJuni})`;
                } else if (hitunganKamar.toLowerCase() === 'tahun' || hitunganKamar.toLowerCase() === 'tahunan') {
                    durasiText = `1 Tahun (s.d. ${tanggalFixJuni})`;
                }

                summaryDuration.textContent = durasiText;
            }
        });

        // Setup File Upload & Preview
        setupFilePreview('btn-ktp', 'input-ktp', 'label-ktp', 'preview-container-ktp', 'preview-content-ktp', 'Klik untuk pilih file KTP');
        setupFilePreview('btn-komitmen', 'input-komitmen', 'label-komitmen', 'preview-container-komitmen', 'preview-content-komitmen', 'Klik untuk pilih file surat komitmen');

        function setupFilePreview(btnId, inputId, labelId, containerId, contentId, defaultLabel) {
            const btn = document.getElementById(btnId);
            const input = document.getElementById(inputId);
            const label = document.getElementById(labelId);
            const container = document.getElementById(containerId);
            const content = document.getElementById(contentId);

            btn.addEventListener('click', function () {
                input.click();
            });

            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    label.textContent = file.name;
                    container.classList.remove('hidden');
                    content.innerHTML = '';

                    const reader = new FileReader();

                    if (file.type.startsWith('image/')) {
                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'max-w-full max-h-48 object-contain rounded-md border';
                            content.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    } else if (file.type === 'application/pdf') {
                        reader.onload = function (e) {
                            const embed = document.createElement('embed');
                            embed.src = e.target.result;
                            embed.type = 'application/pdf';
                            embed.className = 'w-full h-64 rounded-md border';
                            content.appendChild(embed);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        content.innerHTML = `<p class="text-sm text-foreground italic py-2">Berkas terpilih: ${file.name} (${(file.size/1024).toFixed(1)} KB)</p>`;
                    }
                } else {
                    if(content.children.length === 0 || content.textContent.trim() === "") {
                        label.textContent = defaultLabel;
                        container.classList.add('hidden');
                        content.innerHTML = '';
                    }
                }
            });
        }
    });
</script>
@endsection
