@extends("layouts/main")

@section("content")

<main class="flex-1 grid place-items-center py-12">
    <div class="w-full max-w-md mx-auto px-4">
        <div class="text-center mb-6">
            <div class="flex justify-center mb-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
            </div>
            <h1 class="text-2xl font-bold mt-3">Selamat Datang Kembali</h1>
            <p class="text-sm text-muted-foreground mt-1">Masuk untuk lanjut mengajukan sewa.</p>
        </div>
        <form action="/login" method="POST" class="bg-card border border-border/60 rounded-2xl p-6 shadow-card space-y-4">
            @csrf
            <div class="space-y-1.5">
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
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">Email</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input type="email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm pl-9" id="email" name="email" placeholder="kamu@email.com" required="" value="">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">Password</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground">
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm pl-9" id="password" name="password" placeholder="••••••••" required="" value="">
                </div>
            </div>
            <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8 w-full rounded-full" type="submit">Login</button>
            <p class="text-center text-sm text-muted-foreground">Belum punya akun? <a class="text-primary font-medium hover:underline" href="/register">Daftar</a></p>
        </form>
    </div>
</main>
@endsection
