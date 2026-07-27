@extends('layouts.app')

@section('title', 'Akses Admin — IPJ Finance')

@section('content')
<main class="min-h-screen">
    <div class="grid grid-cols-1 lg:grid-cols-12 min-h-screen">
        {{-- Left: Branding Visual --}}
        <div class="lg:col-span-7 bg-[#fafafb] flex flex-col justify-center px-6 md:px-12 lg:px-24 py-20 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 800">
                    <defs>
                        <radialGradient id="grad1" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" style="stop-color:#e6d8dc;stop-opacity:0.3"/>
                            <stop offset="100%" style="stop-color:transparent;stop-opacity:0"/>
                        </radialGradient>
                    </defs>
                    <circle cx="400" cy="400" fill="url(#grad1)" r="300"/>
                </svg>
            </div>

            <div class="relative z-10 max-w-xl">
                <div class="inline-flex items-center gap-3 mb-2">
                    <span class="text-label-sm text-[#979799] uppercase tracking-widest">Panel Administrasi</span>
                    <div class="w-12 h-px bg-[#c6c6ca]"></div>
                </div>
                <h1 class="text-headline-lg text-[#17191c] mb-6">Akses Admin</h1>
                <p class="text-body-lg text-[#45474a] mb-12 max-w-md">
                    Portal manajemen terpusat untuk integritas data dan pengawasan operasional IPJ Finance.
                </p>

                {{-- Floating Artifact: System Health --}}
                <div class="relative group">
                    <div class="bg-white p-8 rounded-[24px] shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1)] transform group-hover:-translate-y-2 transition-transform duration-700">
                        <div class="flex justify-between items-end mb-8">
                            <div>
                                <span class="text-label-sm text-[#979799] block mb-1">System Health</span>
                                <span class="text-heading-sm text-[#17191c]">99.9% Operational</span>
                            </div>
                            <div class="flex gap-1 h-12 items-end">
                                <div class="w-1 bg-[#17191c]/10 h-1/2 rounded-full"></div>
                                <div class="w-1 bg-[#17191c]/20 h-3/4 rounded-full"></div>
                                <div class="w-1 bg-[#17191c]/10 h-2/3 rounded-full"></div>
                                <div class="w-1 bg-[#17191c] h-full rounded-full"></div>
                                <div class="w-1 bg-[#17191c]/30 h-4/5 rounded-full"></div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-2 w-full bg-[#f2f2f3] rounded-full overflow-hidden">
                                <div class="h-full bg-[#17191c] w-[75%]"></div>
                            </div>
                            <div class="flex justify-between text-label-sm text-[#979799]">
                                <span>Database Sync</span>
                                <span>Active</span>
                            </div>
                        </div>
                    </div>

                    {{-- Secondary Decorative Card --}}
                    <div class="absolute -bottom-6 -right-6 bg-[#e6d8dc] text-[#4a2c3a] p-6 rounded-[20px] shadow-lg hidden md:block">
                        <span class="material-symbols-outlined text-[32px] mb-2">shield_person</span>
                        <p class="text-label-sm leading-tight">Secure Terminal<br/>v.4.02.1</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Login Form --}}
        <div class="lg:col-span-5 bg-white flex flex-col justify-center px-6 md:px-12 lg:px-24 py-20">
            <div class="max-w-sm w-full mx-auto lg:mx-0">
                <div class="mb-10">
                    <span class="text-label-sm text-[#979799] uppercase tracking-widest">Otorisasi</span>
                    <h2 class="text-heading-sm text-[#17191c] mt-2">Masuk sebagai Bendahara</h2>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl">
                        <p class="text-[14px] text-[#ba1a1a]">{{ $errors->first() }}</p>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl">
                        <p class="text-[14px] text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label class="text-label-sm text-[#979799] uppercase tracking-wider ml-1">Admin ID / Email</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-6 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-colors placeholder:text-[#a3a6af]"
                                   placeholder="admin@ipj.id">
                            <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-[#979799]">person</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-label-sm text-[#979799] uppercase tracking-wider">Password</label>
                            <a href="#" class="text-[13px] text-[#979799] hover:text-[#17191c] transition-colors">Lupa Password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="adminPassword" required
                                   class="w-full px-6 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-colors placeholder:text-[#a3a6af]"
                                   placeholder="••••••••">
                            <button type="button" onclick="toggleAdminPassword()"
                                    class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-[#979799] hover:text-[#17191c] transition-colors" id="togglePasswordBtn">visibility_off</button>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full group">
                        Masuk ke Dashboard
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>

                    <div class="pt-8 border-t border-[#f2f2f3] text-center lg:text-left">
                        <div class="flex items-center justify-center lg:justify-start gap-2 text-[#979799] mb-2">
                            <span class="material-symbols-outlined text-[18px]">verified_user</span>
                            <span class="text-caption">Enkripsi End-to-End Aktif</span>
                        </div>
                        <p class="text-caption text-[#979799] leading-relaxed">
                            Hanya personel terautorisasi yang diizinkan mengakses area ini.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
function toggleAdminPassword() {
    const input = document.getElementById('adminPassword');
    const icon = document.getElementById('togglePasswordBtn');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerText = 'visibility';
    } else {
        input.type = 'password';
        icon.innerText = 'visibility_off';
    }
}
</script>
@endpush
@endsection