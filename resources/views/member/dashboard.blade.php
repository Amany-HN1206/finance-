@extends('layouts.member')

@section('title', 'Dashboard — IPJ Finance')

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Hero Greeting --}}
    <section class="px-6 md:px-10 py-8 md:py-16 flex flex-col gap-4">
        <div class="flex items-baseline gap-4">
            <span class="text-label-sm text-[#979799] tracking-widest uppercase">Overview</span>
            <div class="h-px flex-1 bg-[#f2f2f3]"></div>
        </div>
        
        {{-- ✅ PERBAIKAN 1: Heading Responsif dengan clamp() --}}
        <h1 class="font-serif-display text-[#17191c] max-w-3xl leading-tight" 
            style="font-size: clamp(32px, 5vw, 64px); letter-spacing: -0.02em;">
            Selamat {{ $greeting }}, 
            <span class="italic text-[#4a2c3a]">
                {{ explode(' ', auth()->guard('member')->user()->nama_lengkap)[0] }}.
            </span>
            <br class="hidden md:block">
            <span style="font-size: clamp(24px, 4vw, 48px);">
                Kepercayaan anggota, prioritas utama kami.
            </span>
        </h1>
    </section>

    {{-- Main Grid --}}
    <div class="px-6 md:px-10 pb-20">
        {{-- ✅ PERBAIKAN 2: Grid Responsif --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
            
            {{-- Left Column: Saldo Cards & Activity --}}
            <div class="lg:col-span-7 flex flex-col gap-6 lg:gap-8">
                
                {{-- ✅ PERBAIKAN 3: Kartu Saldo dengan Grid Responsif --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                    
                    {{-- Saldo Tunai (Neutral Card) --}}
                    <div class="bg-[#f2f2f3] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-md transition-all duration-500 group overflow-hidden">
                        <div>
                            <span class="material-symbols-outlined text-[#979799] group-hover:text-[#17191c] transition-colors">payments</span>
                            <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Saldo Tunai</p>
                        </div>
                        <div class="flex flex-col">
                            {{-- ✅ PERBAIKAN 4: Nominal dengan Truncate --}}
                            <span class="text-[#17191c] leading-none truncate" 
                                  style="font-size: clamp(18px, 2vw, 24px); font-weight: 480;"
                                  title="Rp{{ number_format($saldoKas, 0, ',', '.') }}">
                                Rp{{ number_format($saldoKas, 0, ',', '.') }}
                            </span>
                            <span class="text-[12px] text-[#979799] mt-1">Kas Fisik</span>
                        </div>
                    </div>

                    {{-- Saldo Bank (Neutral Card) --}}
                    <div class="bg-[#f2f2f3] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-md transition-all duration-500 group overflow-hidden">
                        <div>
                            <span class="material-symbols-outlined text-[#979799] group-hover:text-[#17191c] transition-colors">account_balance</span>
                            <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Saldo Bank</p>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[#17191c] leading-none truncate" 
                                  style="font-size: clamp(18px, 2vw, 24px); font-weight: 480;"
                                  title="Rp{{ number_format($saldoBank, 0, ',', '.') }}">
                                Rp{{ number_format($saldoBank, 0, ',', '.') }}
                            </span>
                            <span class="text-[12px] text-[#979799] mt-1">Rekening Operasional</span>
                        </div>
                    </div>

                    {{-- Total Saldo (ACCENT MAUVE CARD — 1 per halaman) --}}
                    <div class="bg-[#e6d8dc] p-6 lg:p-8 rounded-[24px] flex flex-col justify-between min-h-[160px] lg:min-h-[180px] relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#4a2c3a]/5 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-[#4a2c3a]">account_balance_wallet</span>
                            <p class="text-[14px] text-[#4a2c3a]/60 mt-4 uppercase tracking-widest">Total Saldo</p>
                        </div>
                        <div class="relative z-10 flex flex-col">
                            <span class="text-[#4a2c3a] leading-none truncate" 
                                  style="font-size: clamp(20px, 2.5vw, 28px); font-weight: 480;"
                                  title="Rp{{ number_format($saldoTotal ?? $saldoKas + $saldoBank, 0, ',', '.') }}">
                                Rp{{ number_format($saldoTotal ?? $saldoKas + $saldoBank, 0, ',', '.') }}
                            </span>
                            <div class="w-full h-[2px] bg-[#4a2c3a]/10 my-3"></div>
                            <div class="flex justify-between text-[12px] text-[#4a2c3a]/80">
                                <span>Tunai: {{ ($saldoKas + $saldoBank) > 0 ? round(($saldoKas / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                                <span>Bank: {{ ($saldoKas + $saldoBank) > 0 ? round(($saldoBank / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi Cepat --}}
                <div class="flex flex-wrap gap-3 lg:gap-4">
                    <a href="{{ route('member.pengajuan.baru') }}" class="bg-[#17191c] text-white px-8 py-3 rounded-full text-[14px] hover:opacity-90 transition-all flex items-center gap-2">
                        Ajukan Dana
                        <span class="material-symbols-outlined text-[18px]">north_east</span>
                    </a>
                    <a href="{{ route('member.riwayat') }}" class="border border-[#4a2c3a]/20 text-[#4a2c3a] px-8 py-3 rounded-full text-[14px] hover:bg-[#4a2c3a]/5 transition-all">
                        Lihat Riwayat
                    </a>
                </div>

                {{-- Aktivitas Terkini --}}
                <div class="bg-[#f2f2f3] p-6 lg:p-8 rounded-[24px]">
                    <div class="flex justify-between items-center mb-6 lg:mb-8">
                        <h3 class="text-[20px] font-medium text-[#17191c]">Aktivitas Terkini</h3>
                        <a href="{{ route('member.riwayat') }}" class="text-[14px] font-medium text-[#979799] hover:text-[#17191c] transition-colors flex items-center gap-1">
                            Lihat Semua
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="flex flex-col gap-4 lg:gap-6">
                        @forelse ($aktivitasTerbaru as $aktivitas)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3 lg:gap-4">
                                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-white flex items-center justify-center text-[#4a2c3a] shadow-sm group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-[18px] lg:text-[20px]">
                                            {{ $aktivitas->status === 'Approved' ? 'check_circle' : ($aktivitas->status === 'Rejected' ? 'cancel' : 'pending') }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-[14px] font-medium text-[#17191c] truncate max-w-[150px] md:max-w-[200px] lg:max-w-none">
                                            {{ $aktivitas->keterangan_rincian }}
                                        </p>
                                        <p class="text-[12px] text-[#979799]">{{ $aktivitas->created_at->format('d M Y • H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[14px] font-semibold text-[#17191c] truncate max-w-[100px] lg:max-w-none">
                                        Rp{{ number_format($aktivitas->nominal, 0, ',', '.') }}
                                    </p>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full
                                        {{ $aktivitas->status === 'Pending' ? 'bg-amber-100 text-amber-800' : ($aktivitas->status === 'Approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800') }} font-medium">
                                        {{ $aktivitas->status }}
                                    </span>
                                </div>
                            </div>
                            @if (!$loop->last)
                                <div class="h-px bg-[#e6e6e7]"></div>
                            @endif
                        @empty
                            <div class="text-center py-8">
                                <p class="text-[15px] text-[#979799]">Belum ada aktivitas pengajuan.</p>
                                <a href="{{ route('member.pengajuan.baru') }}" class="text-[15px] text-[#17191c] font-medium hover:underline mt-2 inline-block">Buat pengajuan pertama →</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right Column: Status Pengajuan --}}
            <div class="lg:col-span-5 flex flex-col gap-6 lg:gap-8">
                <div class="flex flex-col gap-4">
                    <h3 class="text-[20px] font-medium text-[#17191c] px-2">Status Pengajuan</h3>

                    {{-- Statistik Ringkas --}}
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-[#f6f3f2] p-4 rounded-[20px] text-center">
                            <p class="font-medium text-[#17191c]" style="font-size: clamp(20px, 2vw, 26px);">
                                {{ $statsPengajuan['pending'] ?? 0 }}
                            </p>
                            <p class="text-[12px] text-[#979799]">Pending</p>
                        </div>
                        <div class="bg-[#f6f3f2] p-4 rounded-[20px] text-center">
                            <p class="font-medium text-emerald-700" style="font-size: clamp(20px, 2vw, 26px);">
                                {{ $statsPengajuan['approved'] ?? 0 }}
                            </p>
                            <p class="text-[12px] text-[#979799]">Approved</p>
                        </div>
                        <div class="bg-[#f6f3f2] p-4 rounded-[20px] text-center">
                            <p class="font-medium text-red-600" style="font-size: clamp(20px, 2vw, 26px);">
                                {{ $statsPengajuan['rejected'] ?? 0 }}
                            </p>
                            <p class="text-[12px] text-[#979799]">Rejected</p>
                        </div>
                    </div>

                    @forelse ($pengajuanAktif as $pengajuan)
                        <a href="{{ route('member.riwayat.show', $pengajuan->id) }}" class="bg-[#f6f3f2] p-4 lg:p-6 rounded-[24px] flex items-center justify-between group cursor-pointer hover:bg-[#f2f2f3] transition-colors">
                            <div class="flex items-center gap-3 lg:gap-4">
                                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-white flex items-center justify-center
                                    {{ $pengajuan->status === 'Pending' ? 'text-amber-600' : ($pengajuan->status === 'Approved' ? 'text-emerald-600' : 'text-red-600') }}">
                                    <span class="material-symbols-outlined text-[18px] lg:text-[20px]" style="font-variation-settings: 'FILL' 1;">
                                        {{ $pengajuan->status === 'Pending' ? 'pending' : ($pengajuan->status === 'Approved' ? 'check_circle' : 'cancel') }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-[#17191c] truncate max-w-[120px] md:max-w-[150px] lg:max-w-none">
                                        {{ Str::limit($pengajuan->keterangan_rincian, 30) }}
                                    </p>
                                    <p class="text-[12px] text-[#979799]">{{ $pengajuan->kategori_dana }} • {{ $pengajuan->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[14px] font-semibold text-[#17191c] truncate max-w-[80px] lg:max-w-none">
                                    Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}
                                </p>
                                <span class="text-[11px] px-2 py-0.5 rounded-full
                                    {{ $pengajuan->status === 'Pending' ? 'bg-amber-100 text-amber-800' : ($pengajuan->status === 'Approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800') }} font-medium">
                                    {{ $pengajuan->status }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="bg-[#f6f3f2] p-8 rounded-[24px] text-center">
                            <span class="material-symbols-outlined text-[48px] text-[#979799] mb-3">inbox</span>
                            <p class="text-[15px] text-[#979799]">Belum ada pengajuan aktif.</p>
                        </div>
                    @endforelse

                    <a href="{{ route('member.pengajuan.baru') }}" class="mt-4 w-full py-4 rounded-full border border-[#f2f2f3] text-[#979799] text-[14px] hover:text-[#17191c] hover:border-[#17191c] transition-all text-center">
                        Buat Pengajuan Baru +
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection