@extends('layouts.app')

@section('title', 'Daftar Anggota — IPJ Finance')

@section('content')
<header class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-md">
    <div class="h-20 max-w-[1200px] mx-auto px-6 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#17191c] rounded-full flex items-center justify-center">
                <span class="text-white font-serif-display text-[14px]">IPJ</span>
            </div>
            <span class="font-medium tracking-tight uppercase text-[14px]">IPJ Finance</span>
        </a>
        <nav class="absolute left-1/2 -translate-x-1/2 flex items-center gap-10">
            <a href="{{ route('landing') }}" class="nav-link">Home</a>
            <a href="{{ route('member.login') }}" class="nav-link">Login</a>
            <a href="{{ route('member.register') }}" class="nav-link-active pb-1">Register</a>
        </nav>
        <div class="w-24"></div>
    </div>
</header>

<main class="pt-20 min-h-screen">
    <section class="flex-1 flex items-center justify-center px-6 py-20 bg-[#fafafb]">
        <div class="w-full max-w-[480px] relative">
            {{-- Decorative Circle --}}
            <div class="absolute -top-12 -left-16 w-32 h-32 opacity-20 pointer-events-none">
                <svg class="w-full h-full text-[#17191c]" fill="none" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="48" stroke="currentColor" stroke-dasharray="4 4" stroke-width="0.5"/>
                </svg>
            </div>

            {{-- Registration Card --}}
            <div class="bg-white rounded-[32px] p-10 shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1)] relative z-10">
                <div class="mb-10 text-center">
                    <h1 class="text-headline text-[#17191c] mb-3">Buat Akun</h1>
                    <p class="text-caption text-[#979799]">Mulai perjalanan manajemen keuangan intelektual Anda bersama IPJ Finance.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl">
                        <ul class="text-[14px] text-[#ba1a1a] space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('member.register') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- NIM / ID Anggota --}}
                    <div class="space-y-2">
                        <label class="text-label-sm text-[#45474a] ml-1">NIM / ID Anggota</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" required
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all placeholder:text-[#a3a6af]"
                               placeholder="Contoh: 2021010001">
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="space-y-2">
                        <label class="text-label-sm text-[#45474a] ml-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all placeholder:text-[#a3a6af]"
                               placeholder="Aris Setiawan">
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="text-label-sm text-[#45474a] ml-1">Email Institusi</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all placeholder:text-[#a3a6af]"
                               placeholder="name@company.com">
                    </div>

                    {{-- Password Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-label-sm text-[#45474a] ml-1">Kata Sandi</label>
                            <input type="password" name="password" required
                                   class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all placeholder:text-[#a3a6af]"
                                   placeholder="••••••••">
                        </div>
                        <div class="space-y-2">
                            <label class="text-label-sm text-[#45474a] ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all placeholder:text-[#a3a6af]"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    {{-- Jabatan (Optional) --}}
                    <div class="space-y-2">
                        <label class="text-label-sm text-[#45474a] ml-1">Jabatan Organisasi <span class="text-[#979799]">(Opsional)</span></label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all placeholder:text-[#a3a6af]"
                               placeholder="Contoh: Koordinator Divisi">
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4 space-y-6">
                        <button type="submit" class="btn-primary w-full">
                            Daftar Sekarang
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                        <div class="flex items-center justify-center gap-2 text-[#979799] text-caption">
                            <span>Sudah memiliki akun?</span>
                            <a href="{{ route('member.login') }}" class="text-[#17191c] font-medium hover:underline underline-offset-4">Masuk ke Dashboard →</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="w-full bg-white py-20 border-t border-[#f2f2f3]">
    <div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-5">
        <div class="text-[14px] text-[#979799]">© 2026 IPJ Finance. Integritas Intelektual dalam Tata Kelola.</div>
        <div class="flex gap-8">
            <a href="#" class="text-[14px] text-[#979799] hover:text-[#17191c]">Privacy</a>
            <a href="#" class="text-[14px] text-[#979799] hover:text-[#17191c]">Terms</a>
            <a href="#" class="text-[14px] text-[#979799] hover:text-[#17191c]">Support</a>
        </div>
    </div>
</footer>
@endsection