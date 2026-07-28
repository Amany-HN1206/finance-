@extends('layouts.admin')

@section('title', 'Manajemen Anggota — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    {{-- Header --}}
    <section class="px-4 md:px-10 pt-10 md:pt-12 pb-6 md:pb-8">
        <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row md:items-end justify-between gap-6 md:gap-8">
            <div class="flex flex-col">
                <span class="text-[13px] md:text-[14px] text-[#979799] uppercase tracking-[0.2em] mb-3 md:mb-4">Internal Directory</span>
                <h1 class="font-serif-display text-[40px] md:text-[64px] lg:text-[90px] leading-[1.15] md:leading-[1.3] tracking-[-1px] md:tracking-[-2.25px] text-[#17191c]">Daftar Anggota</h1>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.anggota.create') }}" class="flex items-center justify-center gap-2 px-6 md:px-8 py-3.5 md:py-4 bg-[#17191c] text-white rounded-full transition-transform hover:scale-[1.02] active:scale-95 duration-200 w-full md:w-auto">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    <span class="text-[15px] md:text-[16px] font-medium">Tambah Anggota</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Success Message --}}
    @if (session('success'))
        <section class="px-4 md:px-10 pb-6">
            <div class="max-w-[1200px] mx-auto p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                <p class="text-[14px] text-emerald-800">{{ session('success') }}</p>
            </div>
        </section>
    @endif

    {{-- Search & Filter --}}
    <section class="px-4 md:px-10 mb-8 md:mb-10">
        <div class="max-w-[1200px] mx-auto">
            <form action="{{ route('admin.anggota.index') }}" method="GET" class="relative w-full group">
                <input type="text" name="q" value="{{ request('q') }}"
                       class="w-full h-14 md:h-16 pl-14 pr-6 bg-white border border-[#c6c6ca] rounded-2xl text-[15px] md:text-[17px] outline-none focus:border-[#17191c] transition-all duration-300 shadow-sm group-hover:shadow-md placeholder:text-[#a3a6af]"
                       placeholder="Cari berdasarkan nama, email, atau jabatan..." onchange="this.form.submit()">
                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-[#979799] group-focus-within:text-[#17191c] transition-colors">search</span>
            </form>
        </div>
    </section>

    {{-- Table Section --}}
    <section class="px-4 md:px-10 pb-16 md:pb-20">
        <div class="max-w-[1200px] mx-auto bg-[#f2f2f3] rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-widest border-b border-[#f2f2f3]/50">Nama</th>
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-widest border-b border-[#f2f2f3]/50">Email</th>
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-widest border-b border-[#f2f2f3]/50">Jabatan</th>
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-widest border-b border-[#f2f2f3]/50">Status</th>
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-widest border-b border-[#f2f2f3]/50 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f2f2f3]/30">
                        @forelse ($members as $member)
                            <tr class="group hover:bg-white/40 transition-colors duration-200">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-[#e5e2e1] flex items-center justify-center font-medium text-[#45474a]">
                                            {{ substr($member->nama_lengkap, 0, 2) }}
                                        </div>
                                        <span class="text-[18px] font-medium text-[#17191c]">{{ $member->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-[17px] text-[#45474a]">{{ $member->email }}</td>
                                <td class="px-8 py-6 text-[17px] text-[#45474a]">{{ $member->jabatan_organisasi ?? '-' }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-1.5 {{ $member->status_aktif ? '' : 'opacity-40' }}">
                                        <span class="w-2 h-2 rounded-full {{ $member->status_aktif ? 'bg-[#4a2c3a] animate-pulse' : 'bg-[#979799]' }}"></span>
                                        <span class="text-[14px] {{ $member->status_aktif ? 'text-[#4a2c3a]' : 'text-[#979799]' }}">
                                            {{ $member->status_aktif ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.anggota.edit', $member->id) }}"
                                           class="p-2 hover:bg-[#17191c] hover:text-white rounded-full transition-all text-[#45474a]" title="Edit">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>
                                        <form action="{{ route('admin.anggota.destroy', $member->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus anggota ini secara permanen?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 hover:bg-red-600 hover:text-white rounded-full transition-all text-[#45474a]" title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <span class="material-symbols-outlined text-[48px] text-[#979799] mb-3">group</span>
                                    <p class="text-[15px] text-[#979799]">Belum ada anggota terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($members->hasPages())
                <div class="px-8 py-6 bg-[#f6f3f2]/30 flex items-center justify-between border-t border-[#f2f2f3]/50">
                    <p class="text-[15px] text-[#979799]">Menampilkan {{ $members->firstItem() }}-{{ $members->lastItem() }} dari {{ $members->total() }} anggota</p>
                    {{ $members->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- Decorative Accent Card --}}
    <aside class="px-4 md:px-10 pb-16 md:pb-20 md:-mt-10 relative z-10 flex justify-end">
        <div class="bg-[#e6d8dc] p-6 md:p-10 rounded-[24px] md:rounded-[32px] w-full sm:max-w-md shadow-xl md:translate-x-4">
            <h3 class="font-serif-display text-[28px] md:text-[44px] leading-[1.3] tracking-[-0.5px] md:tracking-[-0.66px] text-[#4a2c3a] mb-4">Statistik Keanggotaan</h3>
            <div class="grid grid-cols-2 gap-6 md:gap-8">
                <div>
                    <p class="text-[13px] md:text-[14px] text-[#4a2c3a]/80 uppercase tracking-widest mb-1">Total Aktif</p>
                    <p class="font-serif-display text-[40px] md:text-[64px] leading-[1.3] tracking-[-0.5px] md:tracking-[-0.96px] text-[#4a2c3a]">{{ $stats['aktif'] }}</p>
                </div>
                <div>
                    <p class="text-[13px] md:text-[14px] text-[#4a2c3a]/80 uppercase tracking-widest mb-1">Total</p>
                    <p class="font-serif-display text-[40px] md:text-[64px] leading-[1.3] tracking-[-0.5px] md:tracking-[-0.96px] text-[#4a2c3a]">{{ $stats['total'] }}</p>
                </div>
            </div>
            <div class="mt-8 h-[1px] bg-[#4a2c3a]/10 w-full"></div>
            <p class="mt-6 text-[14px] md:text-[15px] text-[#4a2c3a]/80 leading-[1.5] italic">
                "Keamanan data adalah prioritas utama. Pastikan setiap akses anggota dikelola dengan prinsip least-privilege."
            </p>
        </div>
    </aside>
</div>
@endsection