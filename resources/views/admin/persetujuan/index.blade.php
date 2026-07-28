@extends('layouts.admin')

@section('title', 'Daftar Persetujuan — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    {{-- Header & Filter --}}
    <section class="px-4 md:px-8 pt-10 md:pt-12 pb-6 flex flex-col gap-6 md:gap-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <span class="text-[13px] md:text-[14px] text-[#979799] uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-[1px] bg-[#c6c6ca]"></span>
                    Administrasi Keuangan
                </span>
                <h1 class="font-serif-display text-[32px] md:text-[64px] leading-[1.2] md:leading-[1.3] tracking-[-0.5px] md:tracking-[-0.96px] text-[#17191c]">Daftar Pengajuan Dana</h1>
            </div>

            <div class="flex gap-4 w-full md:w-auto">
                <div class="bg-[#f2f2f3] rounded-2xl p-5 min-w-0 flex-1 md:flex-none md:min-w-[160px] md:max-w-[220px]">
                    <p class="text-[14px] text-[#979799] mb-1 truncate">Total Pending</p>
                    <p class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c] truncate" title="{{ $stats['pending'] }}">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-[#e6d8dc]/30 rounded-2xl p-5 min-w-0 flex-1 md:flex-none md:min-w-[160px] md:max-w-[220px]">
                    <p class="text-[14px] text-[#4a2c3a] mb-1 truncate">Nilai Tertunda</p>
                    <p class="text-[20px] md:text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#4a2c3a] truncate" title="Rp{{ number_format($stats['total_nilai_pending'], 0, ',', '.') }}">Rp{{ number_format($stats['total_nilai_pending'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <form action="{{ route('admin.persetujuan') }}" method="GET" class="flex flex-wrap items-center gap-4">
            <select name="status" onchange="this.form.submit()" class="px-6 py-2.5 rounded-full bg-[#17191c] text-white text-[14px]">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <div class="flex items-center bg-[#f2f2f3] rounded-full px-4 py-1.5 w-full sm:w-auto">
                <span class="material-symbols-outlined text-[#979799] text-[20px]">search</span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pemohon atau keterangan..."
                       class="bg-transparent border-none focus:ring-0 text-[14px] py-1 px-2 w-full sm:w-64 text-[#17191c] placeholder:text-[#a3a6af] focus:outline-none">
            </div>
        </form>
    </section>

    {{-- Success Message --}}
    @if (session('success'))
        <section class="px-4 md:px-8 pb-6">
            <div class="max-w-[1200px] mx-auto p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                <p class="text-[14px] text-emerald-800">{{ session('success') }}</p>
            </div>
        </section>
    @endif

    {{-- Table Section --}}
    <section class="px-4 md:px-8 pb-16 md:pb-20">
        <div class="bg-[#f2f2f3] rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[640px]">
                    <thead>
                        <tr class="border-b border-[#c6c6ca]/30">
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-wider">Pemohon</th>
                            <th class="px-6 py-6 text-[14px] text-[#979799] uppercase tracking-wider">Kategori & Tanggal</th>
                            <th class="px-6 py-6 text-[14px] text-[#979799] uppercase tracking-wider">Nominal</th>
                            <th class="px-6 py-6 text-[14px] text-[#979799] uppercase tracking-wider">Status</th>
                            <th class="px-8 py-6 text-[14px] text-[#979799] uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuans as $pengajuan)
                            <tr class="group hover:bg-white/50 transition-colors cursor-pointer"
                                onclick="window.location='{{ route('admin.persetujuan.show', $pengajuan->id) }}'">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-[#e6d8dc] flex items-center justify-center font-medium text-[#4a2c3a]">
                                            {{ substr($pengajuan->member->nama_lengkap, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-[17px] text-[#17191c] font-medium">{{ $pengajuan->member->nama_lengkap }}</p>
                                            <p class="text-[15px] text-[#979799]">ID: #RE-{{ str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <p class="text-[17px] text-[#17191c]">{{ $pengajuan->kategori_dana }}</p>
                                    <p class="text-[15px] text-[#979799]">{{ $pengajuan->created_at->format('d M Y, H:i') }}</p>
                                </td>
                                <td class="px-6 py-6">
                                    <p class="text-[17px] text-[#17191c] font-medium">Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</p>
                                    <p class="text-[15px] text-[#979799]">{{ $pengajuan->metode_pencairan }}</p>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="inline-flex items-center gap-1.5 text-[14px] italic
                                        {{ $pengajuan->status === 'Pending' ? 'text-amber-700' : ($pengajuan->status === 'Approved' ? 'text-emerald-700' : 'text-red-700') }}">
                                        @if ($pengajuan->status === 'Pending')
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        @endif
                                        {{ $pengajuan->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('admin.persetujuan.show', $pengajuan->id) }}"
                                       class="text-[#17191c] font-medium hover:underline flex items-center justify-end gap-1 group-hover:translate-x-1 transition-transform">
                                        Tinjau <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <span class="material-symbols-outlined text-[48px] text-[#979799] mb-3">inbox</span>
                                    <p class="text-[15px] text-[#979799]">Tidak ada pengajuan ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengajuans->hasPages())
                <div class="px-8 py-6 bg-[#f2f2f3]/50 flex items-center justify-between border-t border-[#c6c6ca]/30">
                    <p class="text-[15px] text-[#979799]">Menampilkan {{ $pengajuans->firstItem() }}-{{ $pengajuans->lastItem() }} dari {{ $pengajuans->total() }}</p>
                    {{ $pengajuans->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection