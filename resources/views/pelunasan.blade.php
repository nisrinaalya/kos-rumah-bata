@extends("layouts/main")

@section("content")
<div class="container-app pt-6">
    <a href="/profile/status-pembayaran" class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left h-4 w-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        Kembali
    </a>
</div>

<section class="container-app py-6 grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
            <h2 class="font-semibold">Metode Pembayaran</h2>
            <div class="mt-4 grid sm:grid-cols-2 gap-3">
                <button type="button" class="rounded-xl border-2 p-4 flex items-center gap-3 text-left transition-colors border-primary bg-primary-soft/40">
                    <span class="h-10 w-10 grid place-items-center rounded-lg bg-secondary text-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code h-5 w-5">
                            <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                            <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                            <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                            <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                            <path d="M21 21v.01"></path>
                            <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                            <path d="M3 12h.01"></path>
                            <path d="M12 3h.01"></path>
                            <path d="M12 16v.01"></path>
                            <path d="M16 12h1"></path>
                            <path d="M21 12v.01"></path>
                            <path d="M12 21v-1"></path>
                        </svg>
                    </span>
                    <div>
                        <p class="font-medium">QRIS</p>
                        <p class="text-xs text-muted-foreground">Scan QR via mobile banking / e-wallet</p>
                    </div>
                </button>
                <button type="button" class="rounded-xl border-2 p-4 flex items-center gap-3 text-left transition-colors border-border hover:border-primary/50">
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
                        <p class="font-medium">Transfer</p>
                        <p class="text-xs text-muted-foreground">BCA 1234567890 a/n Kos Rumah Bata</p>
                    </div>
                </button>
            </div>
        </div>

        <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
            <h2 class="font-semibold">Pilih Pembayaran</h2>
            <div class="mt-4 rounded-xl border-2 border-primary bg-primary-soft/40 p-4">
                <div class="flex items-center justify-between">
                    <p class="font-medium">Pelunasan (100%)</p>
                    <p class="font-bold text-primary">Rp&nbsp;6.900.000</p>
                </div>
                <p class="text-xs text-muted-foreground mt-2">Sisa pembayaran dari total Rp&nbsp;13.800.000 (sudah dibayar Rp&nbsp;6.900.000). Status sewa akan menunggu approval admin.</p>
            </div>
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
                            <p class="text-xs text-muted-foreground">Screenshot atau foto bukti transfer/QRIS.</p>
                        </div>
                    </div>
                </button>
                <input type="file" id="file-input" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
            </div>
            <button type="button" id="btn-submit-bukti" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8 w-full rounded-full">Kirim Bukti</button>
        </div>
    </div>

    <aside class="bg-card border border-border/60 rounded-2xl p-5 shadow-soft self-start lg:sticky lg:top-20 space-y-4">
        <p class="text-sm font-semibold">Ringkasan</p>
        <div>
            <p class="text-sm text-muted-foreground">Kamar</p>
            <p class="font-bold">Kamar B1 — Deluxe AC</p>
            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 mt-2">ID: R-1777970464572</div>
        </div>
        <div class="space-y-2 pt-3 border-t border-border text-sm">
            <div class="flex justify-between"><span class="text-muted-foreground">Harga / tahun</span><span>Rp&nbsp;13.800.000</span></div>
            <div class="flex justify-between"><span class="text-muted-foreground">Sudah dibayar</span><span>Rp&nbsp;6.900.000</span></div>
            <div class="flex justify-between"><span class="text-muted-foreground">Tipe Pembayaran</span><span>Pelunasan</span></div>
            <div class="flex justify-between"><span class="text-muted-foreground">Metode</span><span>QRIS</span></div>
        </div>
        <div class="pt-3 border-t border-border flex items-baseline justify-between">
            <p class="text-sm text-muted-foreground">Total bayar</p>
            <p class="text-2xl font-bold text-primary">Rp&nbsp;6.900.000</p>
        </div>
    </aside>
</section>

<div id="modal-confirm" class="fixed inset-0 z-50 hidden grid place-items-center p-4" style="background-color: rgba(0, 0, 0, 0.6);">
    <div class="relative bg-card border border-border/80 rounded-2xl max-w-sm sm:max-w-md w-full p-6 shadow-2xl space-y-4">
        
        <button type="button" id="btn-x-modal" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground transition-colors p-1 rounded-lg hover:bg-secondary/50">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18 M6 6 l12 12"></path>
            </svg>
        </button>
        
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
            <a href="https://wa.me/628194001701?text=Halo%20Admin%20Kos%20Rumah%20Bata,%20saya%20sudah%20mengirimkan%20bukti%20pelunasan%20sewa." target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-12 rounded-full px-4 text-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle h-4 w-4 shrink-0">
                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                </svg>
                <span>Konfirmasi via WhatsApp</span>
            </a>
            
            <a href="/profile" class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-12 rounded-full px-4 text-center shadow-sm">
                Cek Status
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const uploadZone = document.getElementById("upload-zone");
        const fileInput = document.getElementById("file-input");
        const filePlaceholder = document.getElementById("file-placeholder");
        
        const btnSubmit = document.getElementById("btn-submit-bukti");
        const modalConfirm = document.getElementById("modal-confirm");
        const btnXModal = document.getElementById("btn-x-modal");

        // Fungsionalitas upload file finder & update nama file
        if (uploadZone && fileInput) {
            uploadZone.addEventListener("click", function() {
                fileInput.click();
            });
            
            fileInput.addEventListener("change", function () {
                if (this.files && this.files[0]) {
                    filePlaceholder.textContent = this.files[0].name;
                    filePlaceholder.classList.add("text-primary");
                }
            });
        }

        // Tampilkan Modal saat Kirim Bukti ditekan
        if (btnSubmit && modalConfirm) {
            btnSubmit.addEventListener("click", function (e) {
                e.preventDefault(); 
                modalConfirm.classList.remove("hidden");
            });
        }

        // Tutup Modal lewat klik tombol silang (X)
        if (btnXModal && modalConfirm) {
            btnXModal.addEventListener("click", function () {
                modalConfirm.classList.add("hidden");
            });
        }
        
        // Tutup Modal apabila area gelap di luar box diklik
        if (modalConfirm) {
            modalConfirm.addEventListener("click", function (e) {
                if (e.target === modalConfirm) {
                    modalConfirm.classList.add("hidden");
                }
            });
        }
    });
</script>
@endsection