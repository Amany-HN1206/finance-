@extends('layouts.admin')

@section('title', 'Dashboard Admin — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    {{-- Header Section --}}
    <section class="relative px-6 md:px-10 py-12 md:py-16 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,77.4,-44.7C85.7,-31.3,91.1,-15.7,90.3,-0.5C89.4,14.7,82.3,29.3,73.1,42.1C63.9,54.8,52.6,65.6,39.3,73.5C26,81.3,13,86.2,-0.7,87.5C-14.4,88.7,-28.9,86.3,-41.8,79.1C-54.7,71.9,-66.1,59.8,-74.6,45.9C-83.1,32,-88.7,16,-88.1,0.3C-87.5,-15.3,-80.7,-30.7,-71.2,-43.8C-61.7,-56.9,-49.5,-67.7,-35.8,-74.7C-22.1,-81.6,-11.1,-84.7,2.8,-89.5C16.7,-94.3,31.3,-83.6,44.7,-76.4Z" fill="currentColor" transform="translate(100 100)"/>
            </svg>
        </div>

        <div class="relative z-10">
            <span class="text-[14px] text-[#979799] uppercase tracking-[0.2em] mb-4 block">Sistem Kendali Keuangan</span>
            <h1 class="font-serif-display text-[#17191c] max-w-4xl leading-tight" 
                style="font-size: clamp(40px, 6vw, 90px); letter-spacing: -0.02em;">
                Dashboard Administrasi
            </h1>
            <p class="text-[17px] md:text-[20px] text-[#45474a] mt-4 md:mt-6 max-w-2xl leading-[1.35]">
                Pantau pergerakan ekosistem finansial IPJ dalam satu ruang kendali. Restorasi transparansi melalui data yang terkurasi dengan presisi editorial.
            </p>
        </div>
    </section>

    {{-- ✅ Stat Grid (Disesuaikan dengan perbaikan responsif) --}}
    <section class="px-6 md:px-10 -mt-6 md:-mt-8">
        {{-- ✅ PERBAIKAN: Grid Responsif (1 → 2 → 4 kolom) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            
            {{-- 1. Total Anggota --}}
            <div class="bg-[#f2f2f3] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-md transition-all duration-500 group overflow-hidden">
                <div>
                    <span class="material-symbols-outlined text-[#979799] group-hover:text-[#17191c] transition-colors">group</span>
                    <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Total Anggota</p>
                </div>
                <div class="flex items-baseline gap-2">
                    {{-- ✅ Font responsif dengan clamp() --}}
                    <span class="text-[#17191c] leading-none" style="font-size: clamp(24px, 3vw, 32px); font-weight: 480;">
                        {{ number_format($totalAnggota) }}
                    </span>
                </div>
            </div>

            {{-- 2. Pengajuan Pending (Accent Mauve Card) --}}
            <div class="bg-[#e6d8dc] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-md transition-all duration-500 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#4a2c3a]/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10">
                    <span class="material-symbols-outlined text-[#4a2c3a]">pending_actions</span>
                    <p class="text-[14px] text-[#4a2c3a]/60 mt-4 uppercase tracking-widest">Pengajuan Pending</p>
                </div>
                <div class="relative z-10 flex items-baseline gap-2">
                    <span class="text-[#4a2c3a] leading-none" style="font-size: clamp(24px, 3vw, 32px); font-weight: 480;">
                        {{ $pengajuanPending }}
                    </span>
                    <span class="text-[12px] text-[#4a2c3a]/80 font-medium">Membutuhkan Tindakan</span>
                </div>
            </div>

            {{-- 3. Total Saldo --}}
            <div class="bg-[#f2f2f3] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-md transition-all duration-500 overflow-hidden">
                <div>
                    <span class="material-symbols-outlined text-[#979799]">account_balance_wallet</span>
                    <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Total Saldo</p>
                </div>
                <div class="flex flex-col">
                    {{-- ✅ PERBAIKAN: Truncate + title untuk tooltip --}}
                    <span class="text-[#17191c] leading-none truncate" 
                          style="font-size: clamp(18px, 2vw, 28px); font-weight: 480;"
                          title="Rp{{ number_format($saldoKas + $saldoBank, 0, ',', '.') }}">
                        Rp{{ number_format($saldoKas + $saldoBank, 0, ',', '.') }}
                    </span>
                    <div class="w-full h-1 bg-white mt-2 rounded-full overflow-hidden">
                        <div class="bg-[#17191c] h-full transition-all duration-500" 
                             style="width: {{ $saldoKas + $saldoBank > 0 ? ($saldoKas / ($saldoKas + $saldoBank) * 100) : 0 }}%">
                        </div>
                    </div>
                    <div class="flex justify-between text-[10px] text-[#979799] mt-1">
                        <span>Kas: {{ $saldoKas + $saldoBank > 0 ? round(($saldoKas / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                        <span>Bank: {{ $saldoKas + $saldoBank > 0 ? round(($saldoBank / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                    </div>
                </div>
            </div>

            {{-- 4. Outflow Bulan Ini --}}
            <div class="bg-[#f2f2f3] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-md transition-all duration-500 overflow-hidden">
                <div>
                    <span class="material-symbols-outlined text-[#979799]">insights</span>
                    <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Outflow Bulan Ini</p>
                </div>
                <div class="flex items-end justify-between">
                    {{-- ✅ PERBAIKAN: Truncate + title untuk tooltip --}}
                    <span class="text-[#17191c] leading-none truncate" 
                          style="font-size: clamp(18px, 2vw, 28px); font-weight: 480;"
                          title="Rp{{ number_format($mutasiBulanIni, 0, ',', '.') }}">
                        Rp{{ number_format($mutasiBulanIni, 0, ',', '.') }}
                    </span>
                    <div class="flex gap-1 items-end h-10 ml-2">
                        @foreach ([20, 40, 60, 100, 80] as $h)
                            <div class="w-1 bg-[#17191c] rounded-full" style="height: {{ $h }}%; opacity: {{ $loop->index / 5 + 0.3 }}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content Table Section --}}
    <section class="px-6 md:px-10 py-12 md:py-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 md:mb-10 border-b border-[#f2f2f3] pb-6 gap-4">
            <div class="max-w-md">
                <h2 class="font-serif-display text-[#17191c] leading-tight" 
                    style="font-size: clamp(28px, 4vw, 44px); letter-spacing: -0.02em;">
                    Persiapan Persetujuan
                </h2>
                <p class="text-[15px] md:text-[17px] text-[#979799] mt-2">Daftar pengajuan dana yang memerlukan verifikasi tingkat lanjut oleh administrator utama.</p>
            </div>
            <a href="{{ route('admin.persetujuan') }}" class="inline-flex items-center gap-2 px-6 md:px-8 py-3 rounded-full bg-[#17191c] text-white text-[14px] hover:opacity-90 transition-all whitespace-nowrap">
                Lihat Semua Antrean
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        {{-- ✅ PERBAIKAN: Table Responsif dengan overflow-x-auto --}}
        <div class="bg-white rounded-[32px] overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-4 min-w-[700px]">
                <thead>
                    <tr class="text-[#979799] text-[12px] uppercase tracking-widest">
                        <th class="px-4 md:px-8 py-4 font-normal">Identitas Pemohon</th>
                        <th class="px-4 md:px-8 py-4 font-normal">Kategori & Tujuan</th>
                        <th class="px-4 md:px-8 py-4 font-normal">Nominal</th>
                        <th class="px-4 md:px-8 py-4 font-normal hidden md:table-cell">Tanggal</th>
                        <th class="px-4 md:px-8 py-4 font-normal text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($antreanPersetujuan as $pengajuan)
                        <tr class="group hover:bg-[#fafafb] transition-colors cursor-pointer">
                            <td class="px-4 md:px-8 py-4 md:py-6 rounded-l-[20px]">
                                <div class="flex items-center gap-3 md:gap-4">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#e6d8dc] flex items-center justify-center font-medium text-[#4a2c3a] text-[12px] md:text-[14px]">
                                        {{ substr($pengajuan->member->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-[#17191c] text-[14px] md:text-[16px] truncate max-w-[100px] md:max-w-none">{{ $pengajuan->member->nama_lengkap }}</p>
                                        <p class="text-[11px] md:text-[13px] text-[#979799]">ID: #IPJ-{{ str_pad($pengajuan->member_id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 md:px-8 py-4 md:py-6">
                                <span class="px-2 md:px-3 py-1 bg-[#f6f3f2] rounded-full text-[10px] md:text-[12px] font-medium text-[#45474a] whitespace-nowrap">{{ $pengajuan->kategori_dana }}</span>
                                <p class="text-[12px] md:text-[14px] text-[#979799] mt-1 truncate max-w-[120px] md:max-w-[200px]">{{ Str::limit($pengajuan->keterangan_rincian, 30) }}</p>
                            </td>
                            <td class="px-4 md:px-8 py-4 md:py-6">
                                <p class="text-[15px] md:text-[18px] font-medium text-[#17191c] whitespace-nowrap">Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-4 md:px-8 py-4 md:py-6 hidden md:table-cell">
                                <p class="text-[15px] md:text-[17px] text-[#979799] whitespace-nowrap">{{ $pengajuan->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-4 md:px-8 py-4 md:py-6 text-right rounded-r-[20px]">
                                <a href="{{ route('admin.persetujuan.show', $pengajuan->id) }}" class="text-[#17191c] font-medium hover:underline inline-flex items-center gap-1 group/link text-[13px] md:text-[16px]">
                                    Tinjau
                                    <span class="material-symbols-outlined text-[16px] md:text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 md:px-8 py-12 md:py-20 text-center">
                                <span class="material-symbols-outlined text-[36px] md:text-[48px] text-[#979799] mb-3">inbox</span>
                                <p class="text-[14px] md:text-[15px] text-[#979799]">Tidak ada pengajuan pending saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Visual Artifact / Decorative Card --}}
    <section class="px-6 md:px-10 pb-12 md:pb-20">
        <div class="bg-[#4a2c3a] text-white p-8 md:p-12 rounded-[32px] md:rounded-[40px] relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 md:gap-10">
            <div class="relative z-10 max-w-lg">
                <h3 class="font-serif-display text-[#ffffff] leading-tight" 
                    style="font-size: clamp(28px, 4vw, 44px); letter-spacing: -0.02em;">
                    Laporan Integritas Finansial
                </h3>
                <p class="opacity-80 text-[15px] md:text-[17px] mt-3 md:mt-4 mb-6 md:mb-8">Kuartal ini menunjukkan pertumbuhan likuiditas. Seluruh parameter audit berada dalam zona hijau.</p>
                <div class="flex flex-wrap gap-3 md:gap-4">
                    <a href="{{ route('admin.mutasi') }}" class="bg-white text-[#4a2c3a] px-5 md:px-6 py-2.5 md:py-3 rounded-full text-[13px] md:text-[14px] font-medium hover:scale-105 transition-transform">Lihat Mutasi</a>
                    <a href="{{ route('admin.anggota.index') }}" class="bg-white/10 text-white px-5 md:px-6 py-2.5 md:py-3 rounded-full text-[13px] md:text-[14px] font-medium border border-white/20 hover:bg-white/20 transition-colors">Kelola Anggota</a>
                </div>
            </div>
            
            <div class="absolute -bottom-20 -left-20 w-60 md:w-80 h-60 md:h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        </div>
    </section>
</div>
@endsection