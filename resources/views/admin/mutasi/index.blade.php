@extends('layouts.admin')

@section('title', 'Mutasi & Saldo — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    {{-- Header --}}
    <section class="px-10 py-12 flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div class="flex flex-col gap-4">
            <span class="text-[14px] text-[#979799] tracking-[0.2em] uppercase">Financial Overview</span>
            <h1 class="font-serif-display text-[44px] leading-[1.3] tracking-[-0.66px] text-[#17191c]">Mutasi & Saldo</h1>
        </div>
    </section>

    {{-- Total Balance Spotlight --}}
    <section class="px-4 md:px-10 mb-12 md:mb-20">
        <div class="relative overflow-hidden rounded-[24px] md:rounded-[32px] bg-[#e6d8dc] p-6 md:p-12 flex flex-col md:flex-row items-start md:items-center justify-between gap-8 md:gap-12">
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full scale-150" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44.7,-76.4C58.3,-69.2,70.1,-58.5,78.9,-45.5C87.7,-32.5,93.5,-17.2,93.1,-2.1C92.7,13.1,86.1,28.1,76.5,41.2C66.9,54.3,54.3,65.6,40.1,73.4C25.9,81.2,10,85.5,-5.1,84.1C-20.2,82.8,-34.5,75.8,-47.5,66.8C-60.5,57.8,-72.2,46.8,-79.3,33.5C-86.4,20.2,-88.9,4.6,-86.8,-10.4C-84.7,-25.4,-78,-39.8,-67.5,-51.2C-57,-62.6,-42.7,-71,-28.7,-77.8C-14.7,-84.6,0,-89.8,14.7,-88.1C29.4,-86.4,44.7,-76.4Z" fill="currentColor" transform="translate(100 100)"/>
                </svg>
            </div>

            {{-- ✅ Total Saldo Saat Ini (Disesuaikan) --}}
            <div class="relative z-10 flex flex-col gap-2 w-full md:w-auto">
                <p class="text-[13px] md:text-[14px] text-[#4a2c3a]/60 uppercase tracking-widest">Total Saldo Saat Ini</p>
                <div class="flex items-baseline gap-2 md:gap-3 flex-wrap">
                    <span class="text-[20px] md:text-[26px] text-[#4a2c3a]/50 font-medium">Rp</span>
                    <span class="text-[#4a2c3a] font-medium leading-none tracking-tight break-all" style="font-size: clamp(22px, 6vw, 48px);">
                        {{ number_format($saldoKas + $saldoBank, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            {{-- ✅ PERBAIKAN: Stack jadi 1 kolom di mobile agar angka tidak nabrak/kepotong --}}
            <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-12 w-full md:w-auto border-t sm:border-t-0 sm:border-l border-[#4a2c3a]/10 pt-6 sm:pt-0 sm:pl-12">
                <div class="flex flex-col">
                    <span class="text-[13px] md:text-[14px] text-[#4a2c3a]/60 mb-1">Kas Tunai</span>
                    <span class="text-[18px] md:text-[22px] leading-[1.5] text-[#4a2c3a] break-all">Rp {{ number_format($saldoKas, 0, ',', '.') }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[13px] md:text-[14px] text-[#4a2c3a]/60 mb-1">Saldo Bank</span>
                    <span class="text-[18px] md:text-[22px] leading-[1.5] text-[#4a2c3a] break-all">Rp {{ number_format($saldoBank, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Ledger Table Section --}}
    <section class="px-10 pb-24">
        <div class="flex items-center justify-between mb-8">
            <div class="flex gap-8 items-center">
                <h3 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c]">Riwayat Transaksi</h3>
                <div class="flex items-center gap-2 px-3 py-1 bg-[#f2f2f3] rounded-full">
                    <div class="w-2 h-2 rounded-full bg-[#17191c] animate-pulse"></div>
                    <span class="text-[14px] text-[#45474a]">Real-time update</span>
                </div>
            </div>

            <form action="{{ route('admin.mutasi') }}" method="GET" class="flex items-center gap-4">
                <select name="jenis" onchange="this.form.submit()" class="px-4 py-2 rounded-full bg-white border border-[#c6c6ca] text-[14px]">
                    <option value="">Semua Jenis</option>
                    <option value="Inflow" {{ request('jenis') === 'Inflow' ? 'selected' : '' }}>Inflow</option>
                    <option value="Outflow" {{ request('jenis') === 'Outflow' ? 'selected' : '' }}>Outflow</option>
                </select>
                <select name="sumber" onchange="this.form.submit()" class="px-4 py-2 rounded-full bg-white border border-[#c6c6ca] text-[14px]">
                    <option value="">Semua Sumber</option>
                    <option value="Kas" {{ request('sumber') === 'Kas' ? 'selected' : '' }}>Kas</option>
                    <option value="Bank" {{ request('sumber') === 'Bank' ? 'selected' : '' }}>Bank</option>
                </select>
            </form>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#ebe7e7]">
                        <th class="py-6 text-[14px] text-[#979799] font-medium uppercase tracking-wider">Tanggal</th>
                        <th class="py-6 text-[14px] text-[#979799] font-medium uppercase tracking-wider">Keterangan</th>
                        <th class="py-6 text-[14px] text-[#979799] font-medium uppercase tracking-wider text-right">Jenis</th>
                        <th class="py-6 text-[14px] text-[#979799] font-medium uppercase tracking-wider text-right">Nominal</th>
                        <th class="py-6 text-[14px] text-[#979799] font-medium uppercase tracking-wider text-right">Saldo Setelah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f2f2f3]">
                    @forelse ($mutasi as $m)
                        <tr class="group hover:bg-[#fafafb] transition-colors">
                            <td class="py-6 align-top">
                                <span class="text-[17px] text-[#17191c]">{{ $m->created_at->format('d M Y') }}</span>
                                <p class="text-[12px] text-[#979799] mt-1">{{ $m->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="py-6 align-top max-w-md">
                                <span class="text-[17px] font-medium text-[#17191c]">{{ $m->catatan ?? 'Mutasi Saldo' }}</span>
                                <p class="text-[15px] text-[#45474a] mt-1">
                                    Sumber: {{ $m->sumber_saldo }} • Oleh: {{ $m->admin->nama_lengkap ?? 'Sistem' }}
                                </p>
                            </td>
                            <td class="py-6 align-top text-right">
                                <span class="text-[14px] italic {{ $m->jenis_mutasi === 'Inflow' ? 'text-emerald-700' : 'text-red-700' }}">
                                    {{ $m->jenis_mutasi }}
                                </span>
                            </td>
                            <td class="py-6 align-top text-right">
                                <span class="text-[17px] {{ $m->jenis_mutasi === 'Inflow' ? 'text-emerald-700' : 'text-red-700' }} font-medium">
                                    {{ $m->jenis_mutasi === 'Inflow' ? '+' : '-' }} Rp{{ number_format($m->nominal, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="py-6 align-top text-right">
                                <span class="text-[17px] font-medium text-[#17191c]">Rp{{ number_format($m->saldo_sesudah, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <span class="material-symbols-outlined text-[48px] text-[#979799] mb-3">receipt_long</span>
                                <p class="text-[15px] text-[#979799]">Belum ada mutasi tercatat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($mutasi->hasPages())
            <div class="mt-12 flex items-center justify-between">
                <span class="text-[15px] text-[#979799]">Menampilkan {{ $mutasi->firstItem() }}-{{ $mutasi->lastItem() }} dari {{ $mutasi->total() }} transaksi</span>
                {{ $mutasi->links() }}
            </div>
        @endif
    </section>
</div>
@endsection