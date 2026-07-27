@extends('layouts.member')

@section('title', 'Profil — IPJ Finance')

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Header --}}
    <section class="px-12 py-20 flex flex-col items-center md:items-start md:flex-row gap-12 border-b border-[#f2f2f3]">
        <div class="relative group">
            <div class="w-40 h-40 rounded-full bg-[#e6d8dc] flex items-center justify-center text-[#4a2c3a] overflow-hidden shadow-sm transition-transform duration-500 hover:scale-105">
                <span class="font-serif-display text-[64px] select-none">
                    {{ collect(explode(' ', $member->nama_lengkap))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
                </span>
            </div>
        </div>

        <div class="flex flex-col gap-6 max-w-2xl">
            <div class="space-y-1">
                <span class="text-[14px] text-[#979799] uppercase tracking-[0.2em]">Profil Anggota</span>
                <h1 class="font-serif-display text-[44px] leading-[1.3] tracking-[-0.66px] text-[#17191c]">{{ $member->nama_lengkap }}</h1>
                <p class="text-[17px] text-[#45474a] max-w-md">Terdaftar sebagai anggota sejak {{ $member->created_at->format('F Y') }}. Memiliki akses penuh ke manajemen dana dan mutasi saldo.</p>
            </div>
        </div>
    </section>

    {{-- Success Message --}}
    @if (session('success'))
        <section class="px-12 pt-8">
            <div class="max-w-[1200px] mx-auto p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                <p class="text-[14px] text-emerald-800">{{ session('success') }}</p>
            </div>
        </section>
    @endif

    {{-- Content Grid --}}
    <section class="p-12">
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Card: Informasi Pribadi --}}
            <div class="bg-[#f2f2f3] rounded-[24px] p-10 flex flex-col gap-10">
                <div class="flex items-center justify-between">
                    <h2 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c]">Informasi Pribadi</h2>
                    <span class="material-symbols-outlined text-[#979799]">person</span>
                </div>

                <form action="{{ route('member.profil.update') }}" method="POST" class="flex flex-col gap-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-[14px] text-[#979799] uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $member->nama_lengkap) }}" required
                                   class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[14px] text-[#979799] uppercase tracking-wider">Email</label>
                            <input type="email" value="{{ $member->email }}" disabled
                                   class="w-full px-5 py-4 bg-[#fafafb] border border-[#c6c6ca] rounded-2xl text-[17px] text-[#979799] cursor-not-allowed">
                            <span class="text-[12px] text-[#979799]">Email tidak dapat diubah</span>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[14px] text-[#979799] uppercase tracking-wider">Nomor Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $member->no_telepon) }}"
                                   class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all"
                                   placeholder="+62 ...">
                        </div>

                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-[14px] text-[#979799] uppercase tracking-wider">Jabatan Organisasi</label>
                            <input type="text" name="jabatan_organisasi" value="{{ old('jabatan_organisasi', $member->jabatan_organisasi) }}"
                                   class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all"
                                   placeholder="Contoh: Koordinator Divisi">
                        </div>
                    </div>

                    {{-- Password Section --}}
                    <div class="pt-8 border-t border-[#c6c6ca]/30">
                        <h3 class="text-[20px] font-medium text-[#17191c] mb-6">Ubah Kata Sandi <span class="text-[14px] text-[#979799] font-normal">(Opsional)</span></h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-[14px] text-[#979799] uppercase tracking-wider">Password Lama</label>
                                <input type="password" name="password_lama"
                                       class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all"
                                       placeholder="••••••••">
                                @error('password_lama')
                                    <span class="text-[12px] text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-[14px] text-[#979799] uppercase tracking-wider">Password Baru</label>
                                <input type="password" name="password_baru"
                                       class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all"
                                       placeholder="••••••••">
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="text-[14px] text-[#979799] uppercase tracking-wider">Konfirmasi Password Baru</label>
                                <input type="password" name="password_baru_confirmation"
                                       class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#17191c] text-white text-[16px] hover:opacity-90 transition-all">
                            Simpan Perubahan
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Card: Keamanan Akun (Accent Mauve) --}}
            <div class="bg-[#e6d8dc] rounded-[24px] p-10 flex flex-col gap-10">
                <div class="flex items-center justify-between">
                    <h2 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#4a2c3a]">Keamanan Akun</h2>
                    <span class="material-symbols-outlined text-[#4a2c3a]">shield_person</span>
                </div>

                <div class="flex flex-col gap-8">
                    <div class="flex items-center justify-between group cursor-pointer border-b border-[#4a2c3a]/10 pb-6">
                        <div class="flex flex-col gap-1">
                            <label class="text-[14px] text-[#4a2c3a]/70 uppercase tracking-wider">Status Akun</label>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#4a2c3a]"></span>
                                <p class="text-[20px] text-[#4a2c3a]">{{ $member->status_aktif ? 'Aktif' : 'Nonaktif' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between group cursor-pointer border-b border-[#4a2c3a]/10 pb-6">
                        <div class="flex flex-col gap-1">
                            <label class="text-[14px] text-[#4a2c3a]/70 uppercase tracking-wider">NIM / ID Anggota</label>
                            <p class="text-[20px] text-[#4a2c3a]">{{ $member->nim_or_id_anggota }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex flex-col gap-1">
                            <label class="text-[14px] text-[#4a2c3a]/70 uppercase tracking-wider">Terakhir Login</label>
                            <p class="text-[20px] text-[#4a2c3a]">{{ now()->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-auto pt-6">
                    <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl flex gap-4 items-start">
                        <span class="material-symbols-outlined text-[#4a2c3a]">info</span>
                        <p class="text-[15px] text-[#4a2c3a] leading-[1.5]">Demi keamanan, aktivitas akun Anda dipantau secara berkala. Pastikan untuk selalu keluar dari perangkat publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection