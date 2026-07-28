@extends('layouts.app')

@section('title', 'Login Anggota — IPJ Finance')

@section('content')
{{-- ✅ PERBAIKAN: Struktur flex column dengan min-h-screen --}}
<div class="min-h-screen flex flex-col bg-fog-white">
    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-paper-white/80 backdrop-blur-md">
        <div class="h-20 max-w-[1200px] mx-auto px-4 md:px-6 flex items-center justify-between gap-2">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 md:gap-4 shrink-0">
                <div class="w-9 h-9 md:w-10 md:h-10 bg-ink-black rounded-full flex items-center justify-center shrink-0">
                    <span class="text-paper-white font-display text-[14px]">IPJ</span>
                </div>
                <span class="font-subheading text-ink-black tracking-tight font-medium uppercase text-label-sm hidden sm:inline">IPJ Finance</span>
            </a>

            {{-- Desktop nav: centered, hidden on mobile to avoid overlapping the logo --}}
            <nav class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center gap-10">
                <a href="{{ route('landing') }}" class="nav-link">Home</a>
                <a href="{{ route('member.login') }}" class="nav-link-active">Login</a>
                <a href="{{ route('member.register') }}" class="nav-link">Register</a>
            </nav>

            {{-- Mobile nav: single compact link instead of the centered menu --}}
            <a href="{{ route('member.register') }}" class="md:hidden font-label-sm text-ink-black border-b border-ink-black shrink-0">
                Register
            </a>

            <div class="hidden md:block w-24"></div>
        </div>
    </nav>

    {{-- ✅ PERBAIKAN: Main content dengan flex-grow agar footer selalu di bawah --}}
    <main class="flex-grow flex items-center justify-center pt-20 pb-12 px-6">
        <div class="relative w-full max-w-[480px] z-10">
            <div class="bg-paper-white rounded-cards p-8 md:p-12 shadow-subtle-2 transition-all duration-500 hover:shadow-subtle-3">
                {{-- Header --}}
                <div class="mb-8 md:mb-12 text-center">
                    <span class="font-label-sm text-ash-gray uppercase tracking-widest block mb-4">Akses Portofolio</span>
                    <h1 class="font-display text-ink-black leading-none mb-2" 
                        style="font-size: clamp(28px, 4vw, 44px); letter-spacing: -0.02em;">
                        Login Anggota
                    </h1>
                    <div class="w-12 h-px bg-outline-variant mx-auto mt-6"></div>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-error-container border border-error rounded-inputs">
                        <p class="text-caption text-error">{{ $errors->first() }}</p>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('member.login') }}" method="POST" class="space-y-6 md:space-y-8">
                    @csrf

                    {{-- Email --}}
                    <div class="flex flex-col gap-2">
                        <label class="font-label-sm text-slate-gray ml-2">Alamat Email</label>
                        <div class="relative group">
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full h-12 md:h-14 px-6 bg-paper-white border border-outline-variant rounded-buttons font-body text-ink-black focus:outline-none focus:border-ink-black transition-all placeholder:text-smoke-gray"
                                   placeholder="nama@email.com" required>
                            <div class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 md:w-10 md:h-10 bg-mist-gray rounded-full flex items-center justify-center text-ash-gray group-focus-within:text-ink-black transition-colors">
                                <span class="material-symbols-outlined text-[16px] md:text-[18px]">alternate_email</span>
                            </div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center px-2">
                            <label class="font-label-sm text-slate-gray">Kata Sandi</label>
                            <a href="#" class="font-label-sm text-ash-gray hover:text-ink-black transition-colors">Lupa sandi?</a>
                        </div>
                        <div class="relative group">
                            <input type="password" name="password" id="passwordInput"
                                   class="w-full h-12 md:h-14 px-6 bg-paper-white border border-outline-variant rounded-buttons font-body text-ink-black focus:outline-none focus:border-ink-black transition-all placeholder:text-smoke-gray"
                                   placeholder="••••••••" required>
                            <button type="button" onclick="togglePassword()"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 md:w-10 md:h-10 bg-mist-gray rounded-full flex items-center justify-center text-ash-gray hover:text-ink-black transition-colors">
                                <span class="material-symbols-outlined text-[16px] md:text-[18px]" id="passwordIcon">visibility</span>
                            </button>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2 md:pt-4">
                        <button type="submit" class="btn-primary w-full group">
                            Masuk
                            <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </div>
                </form>

                {{-- Footer Link --}}
                <div class="mt-8 md:mt-12 text-center">
                    <p class="font-body text-ash-gray mb-2">Belum punya akun?</p>
                    <a href="{{ route('member.register') }}" class="inline-flex items-center gap-1 font-body text-ink-black border-b border-transparent hover:border-ink-black transition-all">
                        Daftar Sekarang
                        <span class="material-symbols-outlined text-[18px]">north_east</span>
                    </a>
                </div>
            </div>

            {{-- ✅ PERBAIKAN: Badge Keamanan dengan posisi relative, bukan absolute --}}
            <div class="mt-6 bg-secondary-fixed text-on-secondary-fixed-variant p-4 rounded-elevated flex items-center gap-3 shadow-subtle">
                <div class="w-8 h-8 bg-paper-white rounded-full flex items-center justify-center shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">verified_user</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] uppercase font-bold tracking-tighter opacity-70 leading-none">Keamanan</span>
                    <span class="text-label-sm font-medium">Terenskripsi AES-256</span>
                </div>
            </div>
        </div>
    </main>

    {{-- ✅ PERBAIKAN: Footer dengan struktur yang rapi --}}
    <footer class="w-full bg-paper-white py-6 border-t border-mist-gray">
        <div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-caption text-ash-gray">© 2026 IPJ Finance. Integritas Intelektual dalam Tata Kelola.</div>
            <div class="flex gap-6">
                <a href="#" class="text-caption text-ash-gray hover:text-ink-black transition-colors">Privacy</a>
                <a href="#" class="text-caption text-ash-gray hover:text-ink-black transition-colors">Terms</a>
                <a href="#" class="text-caption text-ash-gray hover:text-ink-black transition-colors">Support</a>
            </div>
        </div>
    </footer>
</div>

@push('scripts')
<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('passwordIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerText = 'visibility_off';
    } else {
        input.type = 'password';
        icon.innerText = 'visibility';
    }
}
</script>
@endpush
@endsection