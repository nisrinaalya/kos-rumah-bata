@extends("layouts/main")

@section("content")
<section class="flex-1">
    <div class="profile-wrapper">
        <div class="lg:hidden mb-4 flex items-center justify-between">
            <h1 class="text-lg font-bold">Data Diri</h1>
            <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:rg:" data-state="closed">
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
                <div class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
                    <h2 class="font-semibold mb-4">Profil Saya</h2>

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

                    <div class="space-y-6">
                        <form id="profileForm" action="/profile" method="POST" enctype="multipart/form-data" class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
                            @csrf
                            @method('PUT')

                            <div class="flex items-center justify-between mb-5">
                                <div>
                                    <h2 class="font-semibold">Data Diri Penghuni</h2>
                                </div>
                                <button type="button" id="editBtn" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil h-3.5 w-3.5">
                                        <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path>
                                        <path d="m15 5 4 4"></path>
                                    </svg>
                                    Edit
                                </button>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Nama Lengkap</label>
                                    <input type="text" name="nama" class="editable-input flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" disabled value="{{ old('nama', Auth::user()->nama) }}" required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Email</label>
                                    <input type="email" name="email" class="editable-input flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" disabled value="{{ old('email', Auth::user()->email) }}" required>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">No HP</label>
                                    <input type="text" name="no_hp" class="editable-input flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" disabled value="{{ old('no_hp', Auth::user()->no_hp) }}" required>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="editable-input flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" disabled required>
                                        <option value="Perempuan" {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Alamat Asal (Sesuai KTP)</label>
                                    <textarea name="alamat" class="editable-input flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" rows="3" disabled required>{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-sm font-medium leading-none">No. Telepon Kontak Darurat (Orang Tua / Wali)</label>
                                    <input type="text" name="kontak_darurat" class="editable-input flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" disabled value="{{ old('kontak_darurat', Auth::user()->kontak_darurat) }}" required>
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Dokumen KTP</label>
                                    <input type="file" id="ktpInput" name="ktp_dokumen" class="editable-file hidden my-1 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" accept="image/*">

                                    <div class="flex items-center gap-3 p-3 border border-input bg-secondary/30 rounded-md text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-muted-foreground h-4 w-4 shrink-0">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                        </svg>
                                        <span id="ktpFileName" class="flex-1 truncate text-foreground font-medium">
                                            {{ Auth::user()->ktp_dokumen ?? 'Belum ada file KTP' }}
                                        </span>
                                        <a href="{{ Auth::user()->ktp_dokumen ? asset( Auth::user()->ktp_dokumen) : '#' }}" id="ktpPreview" target="_blank" class="text-xs font-semibold text-primary hover:underline {{ Auth::user()->ktp_dokumen ? '' : 'pointer-events-none opacity-50' }}">Lihat Dokumen</a>
                                    </div>
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Dokumen Surat Komitmen</label>
                                    <input type="file" id="suratInput" name="surat_komitmen" class="editable-file hidden my-1 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" accept="application/pdf">

                                    <div class="flex items-center gap-3 p-3 border border-input bg-secondary/30 rounded-md text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-muted-foreground h-4 w-4 shrink-0">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                        </svg>
                                        <span id="suratFileName" class="flex-1 truncate text-foreground font-medium">
                                            {{ Auth::user()->surat_komitmen ?? 'Belum ada file Surat Komitmen' }}
                                        </span>
                                        <a href="{{ Auth::user()->surat_komitmen ? asset( Auth::user()->surat_komitmen) : '#' }}" id="suratPreview" target="_blank" class="text-xs font-semibold text-primary hover:underline {{ Auth::user()->surat_komitmen ? '' : 'pointer-events-none opacity-50' }}">Lihat Dokumen</a>
                                    </div>
                                </div>
                            </div>

                            <div id="saveBtnContainer" class="mt-4 hidden">
                                <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>

                        <form action="/profile/password" method="POST" class="bg-card border border-border/60 rounded-2xl p-6 shadow-card">
                            @csrf
                            @method('PUT')
                            <h2 class="font-semibold mb-4">Ubah Password</h2>
                            <div class="grid sm:grid-cols-3 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Password Lama</label>
                                    <input type="password" name="current" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 md:text-sm" required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Password Baru</label>
                                    <input type="password" name="password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 md:text-sm" required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-sm font-medium leading-none">Konfirmasi Password</label>
                                    <input type="password" name="confirm" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 md:text-sm" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('editBtn');
        const saveContainer = document.getElementById('saveBtnContainer');
        const editableInputs = document.querySelectorAll('.editable-input');
        const editableFiles = document.querySelectorAll('.editable-file');

        // Handler klik tombol Edit
        editBtn.addEventListener('click', function () {
            editableInputs.forEach(input => input.removeAttribute('disabled'));
            editableFiles.forEach(fileInput => fileInput.classList.remove('hidden'));
            saveContainer.classList.remove('hidden');
            editBtn.classList.add('hidden');
        });

        // Real-time Preview untuk file KTP
        const ktpInput = document.getElementById('ktpInput');
        const ktpFileName = document.getElementById('ktpFileName');
        const ktpPreview = document.getElementById('ktpPreview');

        ktpInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                ktpFileName.textContent = file.name;

                const blobUrl = URL.createObjectURL(file);
                ktpPreview.setAttribute('href', blobUrl);
                ktpPreview.classList.remove('pointer-events-none', 'opacity-50');
            }
        });

        // Real-time Preview untuk file Surat Komitmen
        const suratInput = document.getElementById('suratInput');
        const suratFileName = document.getElementById('suratFileName');
        const suratPreview = document.getElementById('suratPreview');

        suratInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                suratFileName.textContent = file.name;

                const blobUrl = URL.createObjectURL(file);
                suratPreview.setAttribute('href', blobUrl);
                suratPreview.classList.remove('pointer-events-none', 'opacity-50');
            }
        });
    });
</script>
@endsection
