@extends("layouts/main")

@section("content")
<div class="container-app pt-6">
    <a href="/kamar/{{ $pengajuan->kamar_id }}" class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left h-4 w-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        Kembali
    </a>
</div>

{{-- Membungkus konten utama ke dalam Form POST Multipart --}}
<form id="form-pembayaran" action="/pembayaran/{{ $pengajuan->order_id }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class="container-app py-6 grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            {{-- Pesan Error jika Validasi Gagal --}}
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

            <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
                <h2 class="font-semibold">Metode Pembayaran</h2>
                <div class="mt-4 grid gap-3">
                    <button type="button" class="rounded-xl border-2 p-4 flex items-center gap-3 text-left transition-colors border-primary bg-primary-soft/10">
                        <span class="h-10 w-10 grid place-items-center rounded-lg bg-secondary text-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 h-5 w-5">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                <path d="M10 6h4"></path>
                                <path d="M10 10h4"></path>
                                <path d="M10 14h4"></path>
                                <path d="M10 18h4"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="font-medium">Transfer Bank</p>
                            <p class="text-xs text-muted-foreground">BCA 1234567890 a/n Kos Rumah Bata</p>
                        </div>
                    </button>
                </div>
            </div>

            <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
                <h2 class="font-semibold">Pilih Pembayaran</h2>

                @if($pembayaranTerakhir && $pembayaranTerakhir->status === 'rejected')
                    {{-- KONDISI 1: UPLOAD ULANG (Mengunci jenis pembayaran lama tanpa membuat input baru) --}}
                    <input type="hidden" name="tipe_pembayaran" id="tipe-pembayaran-input" value="{{ $pembayaranTerakhir->tipe_pembayaran }}">

                    <div role="radiogroup" aria-required="false" dir="ltr" class="mt-4 grid gap-3" style="outline: none;">
                        <label id="label-Lunas" class="rounded-xl border-2 p-4 cursor-default transition-colors border-primary bg-primary-soft/40">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button type="button" role="radio" aria-checked="true" data-state="checked" class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background">
                                        <span class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-current text-current">
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                        </span>
                                    </button>
                                    <p class="font-medium">Upload Ulang Bukti ({{ $pembayaranTerakhir->tipe_pembayaran === 'dp' ? 'DP 50%' : 'Lunas 100%' }})</p>
                                </div>
                                <p class="font-bold text-primary">
                                    Rp&nbsp;{{ number_format($pembayaranTerakhir->tipe_pembayaran === 'dp' ? $pengajuan->kamar->harga / 2 : $pengajuan->kamar->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <p class="text-xs text-muted-foreground mt-2 ml-7">Memperbarui berkas bukti transaksi yang ditolak sebelumnya.</p>
                        </label>
                    </div>

                @elseif($pembayaranTerakhir && $pembayaranTerakhir->tipe_pembayaran === 'dp' && $pembayaranTerakhir->status === 'approved')
                    {{-- KONDISI 2: PELUNASAN SISA DP (Hanya menampilkan opsi pelunasan 50% saja) --}}
                    <input type="hidden" name="tipe_pembayaran" id="tipe-pembayaran-input" value="pelunasan">

                    <div role="radiogroup" aria-required="false" dir="ltr" class="mt-4 grid gap-3" style="outline: none;">
                        <label id="label-Pelunasan" class="rounded-xl border-2 p-4 cursor-default transition-colors border-primary bg-primary-soft/40">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button type="button" role="radio" aria-checked="true" data-state="checked" class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background">
                                        <span class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-current text-current">
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                        </span>
                                    </button>
                                    <p class="font-medium">Pelunasan Sisa Kamar (50%)</p>
                                </div>
                                <p class="font-bold text-primary">Rp&nbsp;{{ number_format($pengajuan->kamar->harga / 2, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-xs text-muted-foreground mt-2 ml-7">Pelunasan tahap akhir untuk mengaktifkan seluruh akses sewa kamar kos.</p>
                        </label>
                    </div>

                @else
                    {{-- KONDISI DEFAULT: PEMBAYARAN BARU AWAL (BISA PILIH LUNAS / DP) --}}
                    <input type="hidden" name="tipe_pembayaran" id="tipe-pembayaran-input" value="lunas">

                    <div role="radiogroup" aria-required="false" dir="ltr" class="mt-4 grid sm:grid-cols-2 gap-3" style="outline: none;">
                        {{-- Opsi Lunas --}}
                        <label id="label-Lunas" for="pay-Lunas" class="rounded-xl border-2 p-4 cursor-pointer transition-colors border-primary bg-primary-soft/40">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button type="button" role="radio" aria-checked="true" data-state="checked" value="lunas" class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background" id="pay-Lunas">
                                        <span class="flex items-center justify-center" id="dot-Lunas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-current text-current">
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                        </span>
                                    </button>
                                    <p class="font-medium">Lunas (100%)</p>
                                </div>
                                <p class="font-bold text-primary">Rp&nbsp;{{ number_format($pengajuan->kamar->harga, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-xs text-muted-foreground mt-2 ml-7">Sewa langsung diproses untuk approval.</p>
                        </label>

                        {{-- Opsi DP --}}
                        <label id="label-DP" for="pay-DP" class="rounded-xl border-2 p-4 cursor-pointer transition-colors border-border hover:border-primary/50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button type="button" role="radio" aria-checked="false" data-state="unchecked" value="dp" class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background" id="pay-DP">
                                        <span class="flex items-center justify-center hidden" id="dot-DP">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-current text-current">
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                        </span>
                                    </button>
                                    <p class="font-medium">DP (50%)</p>
                                </div>
                                <p class="font-bold text-primary">Rp&nbsp;{{ number_format($pengajuan->kamar->harga / 2, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-xs text-muted-foreground mt-2 ml-7">Status berubah menjadi Booked sampai pelunasan.</p>
                        </label>
                    </div>
                @endif
            </div>

            <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card space-y-4">
                <div>
                    <h2 class="font-semibold">Upload Bukti Pembayaran</h2>
                    <p class="text-sm text-muted-foreground">Setelah transfer, upload bukti agar admin bisa konfirmasi.</p>
                </div>
                <div>
                    <p class="text-sm font-medium mb-1.5">Bukti Pembayaran <span class="text-destructive">*</span></p>
                    <button type="button" id="upload-zone" class="w-full rounded-xl border-2 border-dashed p-4 text-left transition-colors border-border hover:border-primary hover:bg-primary-soft/30">
                        <div class="flex items-center gap-3">
                            <span class="h-10 w-10 grid place-items-center rounded-lg bg-secondary text-muted-foreground">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload h-5 w-5">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" x2="12" y1="3" y2="15"></line>
                                </svg>
                            </span>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate" id="file-placeholder">Klik untuk pilih file</p>
                                <p class="text-xs text-muted-foreground">Screenshot atau foto bukti transfer.</p>
                            </div>
                        </div>
                    </button>
                    {{-- Input File Asli --}}
                    <input type="file" id="file-input" name="bukti_transfer" accept=".jpg,.jpeg,.png" required class="hidden">

                    {{-- Elemen Tempat Preview Gambar Bukti Pembayaran --}}
                    <div id="preview-box" class="mt-4 hidden border rounded-xl p-2 bg-muted/30">
                        <p class="text-xs font-medium text-muted-foreground mb-1.5">Preview Bukti Transfer:</p>
                        <div id="preview-container" class="max-h-64 overflow-hidden flex items-center justify-start rounded-lg"></div>
                    </div>
                </div>
                {{-- Tombol submit form utama --}}
                <button type="submit" id="btn-submit-bukti" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8 w-full rounded-full">Kirim Bukti</button>
            </div>
        </div>

        <aside class="bg-card border border-border/60 rounded-2xl p-5 shadow-soft self-start lg:sticky lg:top-20 space-y-4">
            <p class="text-sm font-semibold">Ringkasan</p>
            <div>
                <p class="text-sm text-muted-foreground">Kamar</p>
                <p class="font-bold">Kamar {{ $pengajuan->kamar->nomor_kamar }} — {{ $pengajuan->kamar->tower }}</p>
                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-secondary text-secondary-foreground mt-2">ID: {{ $pengajuan->order_id }}</div>
            </div>
            <div class="space-y-2 pt-3 border-t border-border text-sm">
                <div class="flex justify-between"><span class="text-muted-foreground">Harga / tahun</span><span>Rp&nbsp;{{ number_format($pengajuan->kamar->harga, 0, ',', '.') }}</span></div>
                <div class="flex justify-between">
                    <span class="text-muted-foreground">Tipe Pembayaran</span>
                    <span id="summary-tipe">
                        @if($pembayaranTerakhir && $pembayaranTerakhir->status === 'rejected')
                            Upload Ulang ({{ $pembayaranTerakhir->tipe_pembayaran === 'dp' ? 'DP 50%' : 'Lunas' }})
                        @elseif($pembayaranTerakhir && $pembayaranTerakhir->tipe_pembayaran === 'dp' && $pembayaranTerakhir->status === 'approved')
                            Pelunasan Sisa
                        @else
                            Lunas
                        @endif
                    </span>
                </div>
                <div class="flex justify-between"><span class="text-muted-foreground">Metode</span><span>Transfer Bank</span></div>
            </div>
            <div class="pt-3 border-t border-border flex items-baseline justify-between">
                <p class="text-sm text-muted-foreground">Total bayar</p>
                <p class="text-2xl font-bold text-primary" id="summary-total">
                    @if($pembayaranTerakhir && $pembayaranTerakhir->status === 'rejected')
                        Rp&nbsp;{{ number_format($pembayaranTerakhir->tipe_pembayaran === 'dp' ? $pengajuan->kamar->harga / 2 : $pengajuan->kamar->harga, 0, ',', '.') }}
                    @elseif($pembayaranTerakhir && $pembayaranTerakhir->tipe_pembayaran === 'dp' && $pembayaranTerakhir->status === 'approved')
                        Rp&nbsp;{{ number_format($pengajuan->kamar->harga / 2, 0, ',', '.') }}
                    @else
                        Rp&nbsp;{{ number_format($pengajuan->kamar->harga, 0, ',', '.') }}
                    @endif
                </p>
            </div>
        </aside>
    </section>
</form>

{{-- Modal Konfirmasi yang terkunci penuh --}}
<div id="modal-confirm" class="fixed inset-0 z-50 @if(!session('success_payment')) hidden @endif grid place-items-center p-4" style="background-color: rgba(0, 0, 0, 0.6);">
    <div class="relative bg-card border border-border/80 rounded-2xl max-w-sm sm:max-w-md w-full p-6 shadow-2xl space-y-4">

        <div class="mx-auto h-12 w-12 rounded-full bg-primary/10 text-primary grid place-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle2 h-6 w-6">
                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                <path d="m9 12 2 2 4-4"></path>
            </svg>
        </div>

        <div class="text-center space-y-1">
            <h3 class="text-lg font-semibold tracking-tight text-foreground">Pembayaran Berhasil Dikirim</h3>
            <p class="text-sm text-muted-foreground">Bukti transfer Anda telah diterima. Mohon tunggu konfirmasi admin dalam 1x24 jam.</p>
        </div>

        <div class="flex flex-row gap-3 pt-4">
            <a href="https://wa.me/628194001701?text=Halo%20Admin%20Kos%20Rumah%20Bata,%20saya%20sudah%20mengirimkan%20bukti%20pembayaran%20sewa%20dengan%20Order%20ID%20{{ $pengajuan->order_id }}." target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-12 rounded-full px-4 text-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle h-4 w-4 shrink-0">
                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                </svg>
                <span>WhatsApp</span>
            </a>

            <a href="/profile/status-pembayaran" class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-12 rounded-full px-4 text-center shadow-sm">
                Selesai
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const uploadZone = document.getElementById("upload-zone");
        const fileInput = document.getElementById("file-input");
        const filePlaceholder = document.getElementById("file-placeholder");
        const previewBox = document.getElementById("preview-box");
        const previewContainer = document.getElementById("preview-container");

        const formPembayaran = document.getElementById("form-pembayaran");
        const btnSubmitBukti = document.getElementById("btn-submit-bukti");

        // Penanganan Switch Pilihan Tipe Pembayaran (Lunas / DP)
        const payLunas = document.getElementById("pay-Lunas");
        const payDP = document.getElementById("pay-DP");
        const labelLunas = document.getElementById("label-Lunas");
        const labelDP = document.getElementById("label-DP");
        const dotLunas = document.getElementById("dot-Lunas");
        const dotDP = document.getElementById("dot-DP");
        const tipeInput = document.getElementById("tipe-pembayaran-input");

        const summaryTipe = document.getElementById("summary-tipe");
        const summaryTotal = document.getElementById("summary-total");

        const hargaKamar = {{ $pengajuan->kamar->harga }};

        // Event listener hanya diaktifkan jika kedua element radio exist (Kondisi default pembayaran awal)
        if (labelLunas && labelDP && payLunas && payDP) {
            labelLunas.addEventListener("click", function() {
                tipeInput.value = "lunas";
                summaryTipe.textContent = "Lunas";
                summaryTotal.innerHTML = "Rp&nbsp;" + new Intl.NumberFormat('id-ID').format(hargaKamar);

                labelLunas.className = "rounded-xl border-2 p-4 cursor-pointer transition-colors border-primary bg-primary-soft/40";
                labelDP.className = "rounded-xl border-2 p-4 cursor-pointer transition-colors border-border hover:border-primary/50";

                payLunas.setAttribute("aria-checked", "true");
                payLunas.setAttribute("data-state", "checked");
                payDP.setAttribute("aria-checked", "false");
                payDP.setAttribute("data-state", "unchecked");

                dotLunas.classList.remove("hidden");
                dotDP.classList.add("hidden");
            });

            labelDP.addEventListener("click", function() {
                tipeInput.value = "dp";
                summaryTipe.textContent = "DP (50%)";
                summaryTotal.innerHTML = "Rp&nbsp;" + new Intl.NumberFormat('id-ID').format(hargaKamar / 2);

                labelDP.className = "rounded-xl border-2 p-4 cursor-pointer transition-colors border-primary bg-primary-soft/40";
                labelLunas.className = "rounded-xl border-2 p-4 cursor-pointer transition-colors border-border hover:border-primary/50";

                payDP.setAttribute("aria-checked", "true");
                payDP.setAttribute("data-state", "checked");
                payLunas.setAttribute("aria-checked", "false");
                payLunas.setAttribute("data-state", "unchecked");

                dotDP.classList.remove("hidden");
                dotLunas.classList.add("hidden");
            });
        }

        // Area unggah file bukti transfer bank
        if (uploadZone && fileInput) {
            uploadZone.addEventListener("click", function() {
                fileInput.click();
            });

            fileInput.addEventListener("change", function () {
                const file = this.files[0];
                if (file) {
                    filePlaceholder.textContent = file.name;
                    filePlaceholder.classList.add("text-primary");

                    // Live Preview Gambar Bukti Transfer
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewBox.classList.remove("hidden");
                            previewContainer.innerHTML = '';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'max-w-full max-h-48 object-contain rounded-md border';
                            previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewBox.classList.add("hidden");
                        previewContainer.innerHTML = '';
                    }
                } else {
                    filePlaceholder.textContent = "Klik untuk pilih file";
                    filePlaceholder.classList.remove("text-primary");
                    previewBox.classList.add("hidden");
                    previewContainer.innerHTML = '';
                }
            });
        }

        // Intersept submit form untuk validasi input file kosong & proteksi double submit
        if (formPembayaran && btnSubmitBukti) {
            formPembayaran.addEventListener("submit", function(e) {
                if (!fileInput.files.length) {
                    e.preventDefault();
                    alert('Silahkan pilih berkas foto bukti transfer terlebih dahulu!');
                } else {
                    // Jika validasi file lolos, kunci tombol agar tidak terjadi double submit data
                    btnSubmitBukti.setAttribute('disabled', 'true');
                    btnSubmitBukti.innerText = 'Mengirim Bukti Pembayaran...';
                }
            });
        }
    });
</script>
@endsection
