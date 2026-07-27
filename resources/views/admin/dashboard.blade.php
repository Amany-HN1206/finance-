@extends('layouts.admin')

@section('title', 'Dashboard Admin — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    {{-- Header Section --}}
    <section class="relative px-10 py-16 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,77.4,-44.7C85.7,-31.3,91.1,-15.7,90.3,-0.5C89.4,14.7,82.3,29.3,73.1,42.1C63.9,54.8,52.6,65.6,39.3,73.5C26,81.3,13,86.2,-0.7,87.5C-14.4,88.7,-28.9,86.3,-41.8,79.1C-54.7,71.9,-66.1,59.8,-74.6,45.9C-83.1,32,-88.7,16,-88.1,0.3C-87.5,-15.3,-80.7,-30.7,-71.2,-43.8C-61.7,-56.9,-49.5,-67.7,-35.8,-74.7C-22.1,-81.6,-11.1,-84.7,2.8,-89.5C16.7,-94.3,31.3,-83.6,44.7,-76.4Z" fill="currentColor" transform="translate(100 100)"/>
            </svg>
        </div>

        <div class="relative z-10">
            <span class="text-[14px] text-[#979799] uppercase tracking-[0.2em] mb-4 block">Sistem Kendali Keuangan</span>
            <h1 class="font-serif-display text-[90px] leading-[1.3] tracking-[-2.25px] text-[#17191c] max-w-4xl">Dashboard Administrasi</h1>
            <p class="text-[20px] text-[#45474a] mt-6 max-w-2xl leading-[1.35]">
                Pantau pergerakan ekosistem finansial IPJ dalam satu ruang kendali. Restorasi transparansi melalui data yang terkurasi dengan presisi editorial.
            </p>
        </div>
    </section>

    {{-- Stat Grid --}}
    <section class="px-10 -mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Total Anggota --}}
            <div class="bg-[#f2f2f3] p-5 rounded-[24px] flex flex-col justify-between min-h-[180px] hover:shadow-md transition-all duration-500 group">
                <div>
                    <span class="material-symbols-outlined text-[#979799] group-hover:text-[#17191c] transition-colors">group</span>
                    <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-wider">Total Anggota</p>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-[32px] font-medium text-[#17191c]">{{ number_format($totalAnggota) }}</span>
                </div>
            </div>

            {{-- Pengajuan Pending --}}
            <div class="bg-[#e6d8dc] p-5 rounded-[24px] flex flex-col justify-between min-h-[180px] hover:shadow-md transition-all duration-500">
                <div>
                    <span class="material-symbols-outlined text-[#4a2c3a]">pending_actions</span>
                    <p class="text-[14px] text-[#4a2c3a]/60 mt-4 uppercase tracking-wider">Pengajuan Pending</p>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-[32px] font-medium text-[#4a2c3a]">{{ $pengajuanPending }}</span>
                    <span class="text-[12px] text-[#4a2c3a] font-medium">Membutuhkan Tindakan</span>
                </div>
            </div>

            {{-- ✅ Total Saldo (Disesuaikan) --}}
            <div class="bg-[#f2f2f3] p-5 rounded-[24px] flex flex-col justify-between min-h-[180px] hover:shadow-md transition-all duration-500 overflow-hidden">
                <div>
                    <span class="material-symbols-outlined text-[#979799]">account_balance_wallet</span>
                    <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-wider">Total Saldo</p>
                </div>
                <div class="flex flex-col">
                    {{-- ✅ Menggunakan currency-display class untuk responsif --}}
                    <span class="currency-display text-[#17191c] leading-none">
                        Rp{{ number_format($saldoKas + $saldoBank, 0, ',', '.') }}
                    </span>
                    <div class="w-full h-1 bg-white mt-3 rounded-full overflow-hidden">
                        <div class="bg-[#17191c] h-full transition-all duration-500" 
                             style="width: {{ $saldoKas + $saldoBank > 0 ? ($saldoKas / ($saldoKas + $saldoBank) * 100) : 0 }}%">
                        </div>
                    </div>
                    <div class="flex justify-between text-[10px] text-[#979799] mt-1.5">
                        <span>Kas: {{ $saldoKas + $saldoBank > 0 ? round(($saldoKas / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                        <span>Bank: {{ $saldoKas + $saldoBank > 0 ? round(($saldoBank / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                    </div>
                </div>
            </div>

            {{-- Mutasi Bulan Ini --}}
            <div class="bg-[#f2f2f3] p-5 rounded-[24px] flex flex-col justify-between min-h-[180px] hover:shadow-md transition-all duration-500">
                <div>
                    <span class="material-symbols-outlined text-[#979799]">insights</span>
                    <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-wider">Outflow Bulan Ini</p>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-[28px] font-medium text-[#17191c]">Rp{{ number_format($mutasiBulanIni, 0, ',', '.') }}</span>
                    <div class="flex gap-1 items-end h-10">
                        @foreach ([20, 40, 60, 100, 80] as $h)
                            <div class="w-1 bg-[#17191c] rounded-full" style="height: {{ $h }}%; opacity: {{ $loop->index / 5 + 0.3 }}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content Table Section --}}
    <section class="px-10 py-20">
        <div class="flex items-end justify-between mb-10 border-b border-[#f2f2f3] pb-6">
            <div class="max-w-md">
                <h2 class="font-serif-display text-[44px] leading-[1.3] tracking-[-0.66px] text-[#17191c]">Persiapan Persetujuan</h2>
                <p class="text-[17px] text-[#979799] mt-2">Daftar pengajuan dana yang memerlukan verifikasi tingkat lanjut oleh administrator utama.</p>
            </div>
            <a href="{{ route('admin.persetujuan') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-[#17191c] text-white text-[14px] hover:opacity-90 transition-all">
                Lihat Semua Antrean
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <div class="bg-white rounded-[32px] overflow-hidden">
            <table class="w-full text-left border-separate border-spacing-y-4">
                <thead>
                    <tr class="text-[#979799] text-[12px] uppercase tracking-widest">
                        <th class="px-8 py-4 font-normal">Identitas Pemohon</th>
                        <th class="px-8 py-4 font-normal">Kategori & Tujuan</th>
                        <th class="px-8 py-4 font-normal">Nominal</th>
                        <th class="px-8 py-4 font-normal">Tanggal</th>
                        <th class="px-8 py-4 font-normal text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($antreanPersetujuan as $pengajuan)
                        <tr class="group hover:bg-[#fafafb] transition-colors cursor-pointer">
                            <td class="px-8 py-6 rounded-l-[20px]">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#e6d8dc] flex items-center justify-center font-medium text-[#4a2c3a]">
                                        {{ substr($pengajuan->member->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-[#17191c]">{{ $pengajuan->member->nama_lengkap }}</p>
                                        <p class="text-[13px] text-[#979799]">ID: #IPJ-{{ str_pad($pengajuan->member_id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-[#f6f3f2] rounded-full text-[12px] font-medium text-[#45474a]">{{ $pengajuan->kategori_dana }}</span>
                                <p class="text-[14px] text-[#979799] mt-1 truncate max-w-[200px]">{{ Str::limit($pengajuan->keterangan_rincian, 40) }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-[18px] font-medium text-[#17191c]">Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-[17px] text-[#979799]">{{ $pengajuan->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-8 py-6 text-right rounded-r-[20px]">
                                <a href="{{ route('admin.persetujuan.show', $pengajuan->id) }}" class="text-[#17191c] font-medium hover:underline inline-flex items-center gap-1 group/link">
                                    Tinjau
                                    <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_right_alt</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <span class="material-symbols-outlined text-[48px] text-[#979799] mb-3">inbox</span>
                                <p class="text-[15px] text-[#979799]">Tidak ada pengajuan pending saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Visual Artifact / Decorative Card --}}
    <section class="px-10 pb-20">
        <div class="bg-[#4a2c3a] text-white p-12 rounded-[40px] relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="relative z-10 max-w-lg">
                <h3 class="font-serif-display text-[44px] leading-[1.3] tracking-[-0.66px] mb-4">Laporan Integritas Finansial</h3>
                <p class="opacity-80 text-[17px] mb-8">Kuartal ini menunjukkan pertumbuhan likuiditas. Seluruh parameter audit berada dalam zona hijau.</p>
                <div class="flex gap-4">
                    <a href="{{ route('admin.mutasi') }}" class="bg-white text-[#4a2c3a] px-6 py-3 rounded-full text-[14px] font-medium hover:scale-105 transition-transform">Lihat Mutasi</a>
                    <a href="{{ route('admin.anggota.index') }}" class="bg-white/10 text-white px-6 py-3 rounded-full text-[14px] font-medium border border-white/20 hover:bg-white/20 transition-colors">Kelola Anggota</a>
                </div>
            </div>
            
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        </div>
    </section>
</div>
@endsection