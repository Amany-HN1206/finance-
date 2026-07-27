@extends('layouts.member')

@section('title', 'Riwayat Pengajuan — IPJ Finance')

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Header --}}
    <section class="px-10 pt-12 pb-8 flex flex-col gap-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="flex flex-col gap-2">
                <span class="text-label-sm text-[#979799] uppercase tracking-[0.2em]">Transaction Logs</span>
                <h1 class="text-headline text-[#17191c]">Riwayat Pengajuan</h1>
            </div>

            {{-- Filter --}}
            <form action="{{ route('member.riwayat') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <select name="status" onchange="this.form.submit()" class="px-6 py-2.5 rounded-full bg-[#17191c] text-white text-label-sm">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <div class="flex items-center bg-[#f2f2f3] rounded-full px-4 py-1.5">
                    <span class="material-symbols-outlined text-[#979799] text-[20px]">search</span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari aktivitas..."
                           class="bg-transparent border-none focus:ring-0 text-[14px] py-1 px-2 w-48 text-[#17191c] placeholder:text-[#a3a6af] focus:outline-none">
                </div>
            </form>
        </div>

        {{-- Summary Card (Mauve) --}}
        <div class="card-mauve flex flex-col md:flex-row justify-between items-center gap-8 overflow-hidden relative">
            <div class="flex flex-col gap-1 z-10">
                <p class="text-label-sm text-[#4a2c3a] uppercase tracking-wider">Total Disetujui</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-headline text-[#4a2c3a]">Rp{{ number_format($stats['total_nominal_approved'], 0, ',', '.') }}</span>
                    <span class="text-caption text-[#4a2c3a]/70">{{ $stats['approved'] }} pengajuan</span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 z-10">
                <div class="text-center">
                    <p class="text-heading-sm text-[#4a2c3a]">{{ $stats['pending'] }}</p>
                    <p class="text-[12px] text-[#4a2c3a]/70 uppercase tracking-wider">Pending</p>
                </div>
                <div class="text-center">
                    <p class="text-heading-sm text-[#4a2c3a]">{{ $stats['approved'] }}</p>
                    <p class="text-[12px] text-[#4a2c3a]/70 uppercase tracking-wider">Approved</p>
                </div>
                <div class="text-center">
                    <p class="text-heading-sm text-[#4a2c3a]">{{ $stats['rejected'] }}</p>
                    <p class="text-[12px] text-[#4a2c3a]/70 uppercase tracking-wider">Rejected</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Table --}}
    <section class="px-10 pb-20">
        <div class="bg-[#f2f2f3] rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-[#c6c6ca]/30">
                            <th class="text-left px-8 py-6 text-label-sm text-[#979799] uppercase tracking-widest">Tanggal</th>
                            <th class="text-left px-8 py-6 text-label-sm text-[#979799] uppercase tracking-widest">Nama Kegiatan</th>
                            <th class="text-left px-8 py-6 text-label-sm text-[#979799] uppercase tracking-widest">Jumlah Dana</th>
                            <th class="text-right px-8 py-6 text-label-sm text-[#979799] uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#c6c6ca]/20">
                        @forelse ($pengajuans as $p)
                            <tr class="hover:bg-[#fafafb]/50 transition-colors group cursor-pointer" onclick="window.location='{{ route('member.riwayat.show', $p->id) }}'">
                                <td class="px-8 py-6 text-[#17191c] text-[17px]">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-subheading text-[#17191c] text-[17px]">{{ Str::limit($p->keterangan_rincian, 50) }}</span>
                                        <span class="text-caption text-[#979799]">ID: #REQ-{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 font-medium text-[#17191c]">Rp{{ number_format($p->nominal, 0, ',', '.') }}</td>
                                <td class="px-8 py-6 text-right">
                                    <span class="text-label-sm text-[#979799] italic">{{ $p->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <span class="material-symbols-outlined text-[48px] text-[#979799] mb-3">inbox</span>
                                    <p class="text-[15px] text-[#979799]">Belum ada riwayat pengajuan.</p>
                                    <a href="{{ route('member.pengajuan.baru') }}" class="text-[15px] text-[#17191c] font-medium hover:underline mt-2 inline-block">Buat pengajuan pertama →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($pengajuans->hasPages())
                <div class="px-8 py-8 flex items-center justify-between border-t border-[#c6c6ca]/20">
                    <p class="text-caption text-[#979799]">
                        Menampilkan {{ $pengajuans->firstItem() }}-{{ $pengajuans->lastItem() }} dari {{ $pengajuans->total() }} pengajuan
                    </p>
                    <div class="flex items-center gap-2">
                        {{ $pengajuans->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection