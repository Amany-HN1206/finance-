@extends('layouts.member')

@section('title', 'Dashboard — IPJ Finance')

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Hero Greeting --}}
    <section class="px-10 py-16 flex flex-col gap-4">
        <div class="flex items-baseline gap-4">
            <span class="text-label-sm text-[#979799] tracking-widest uppercase">Overview</span>
            <div class="h-px flex-1 bg-[#f2f2f3]"></div>
        </div>
        <h1 class="text-display text-[#17191c] max-w-3xl">
            Selamat {{ $greeting }}, <span class="italic text-[#4a2c3a]">{{ explode(' ', auth()->guard('member')->user()->nama_lengkap)[0] }}.</span> Kepercayaan anggota, prioritas utama kami.
        </h1>
    </section>

    {{-- Main Grid --}}
    <div class="px-10 pb-20 grid grid-cols-12 gap-8 items-start">
        {{-- Left Column --}}
        <div class="col-span-12 lg:col-span-7 flex flex-col gap-10">
            
            {{-- ✅ PERBAIKAN: 3 Kartu Saldo (1 Mauve + 2 Neutral) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Saldo Tunai (Neutral Card) --}}
                <div class="bg-[#f2f2f3] p-8 rounded-[24px] flex flex-col justify-between min-h-[180px] hover:shadow-md transition-all duration-500 group">
                    <div>
                        <span class="material-symbols-outlined text-[#979799] group-hover:text-[#17191c] transition-colors">payments</span>
                        <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Saldo Tunai</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[28px] font-medium text-[#17191c]">Rp{{ number_format($saldoKas, 0, ',', '.') }}</span>
                        <span class="text-[12px] text-[#979799] mt-1">Kas Fisik</span>
                    </div>
                </div>

                {{-- Saldo Bank (Neutral Card) --}}
                <div class="bg-[#f2f2f3] p-8 rounded-[24px] flex flex-col justify-between min-h-[180px] hover:shadow-md transition-all duration-500 group">
                    <div>
                        <span class="material-symbols-outlined text-[#979799] group-hover:text-[#17191c] transition-colors">account_balance</span>
                        <p class="text-[14px] text-[#979799] mt-4 uppercase tracking-widest">Saldo Bank</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[28px] font-medium text-[#17191c]">Rp{{ number_format($saldoBank, 0, ',', '.') }}</span>
                        <span class="text-[12px] text-[#979799] mt-1">Rekening Operasional</span>
                    </div>
                </div>

                {{-- Total Saldo (ACCENT MAUVE CARD — 1 per halaman) --}}
                <div class="bg-[#e6d8dc] p-8 rounded-[24px] flex flex-col justify-between min-h-[180px] relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#4a2c3a]/5 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-[#4a2c3a]">account_balance_wallet</span>
                        <p class="text-[14px] text-[#4a2c3a]/60 mt-4 uppercase tracking-widest">Total Saldo</p>
                    </div>
                    <div class="relative z-10 flex flex-col">
                        <span class="text-[32px] font-medium text-[#4a2c3a] leading-none">Rp{{ number_format($saldoTotal ?? $saldoKas + $saldoBank, 0, ',', '.') }}</span>
                        <div class="w-full h-[2px] bg-[#4a2c3a]/10 my-3"></div>
                        <div class="flex justify-between text-[12px] text-[#4a2c3a]/80">
                            <span>Tunai: {{ ($saldoKas + $saldoBank) > 0 ? round(($saldoKas / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                            <span>Bank: {{ ($saldoKas + $saldoBank) > 0 ? round(($saldoBank / ($saldoKas + $saldoBank)) * 100) : 0 }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi Cepat --}}
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('member.pengajuan.baru') }}" class="bg-[#17191c] text-white px-8 py-3 rounded-full text-[14px] hover:opacity-90 transition-all flex items-center gap-2">
                    Ajukan Dana
                    <span class="material-symbols-outlined text-[18px]">north_east</span>
                </a>
                <a href="{{ route('member.riwayat') }}" class="border border-[#4a2c3a]/20 text-[#4a2c3a] px-8 py-3 rounded-full text-[14px] hover:bg-[#4a2c3a]/5 transition-all">
                    Lihat Riwayat
                </a>
            </div>

            {{-- Aktivitas Terkini --}}
            <div class="bg-[#f2f2f3] p-8 rounded-[24px]">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-[20px] font-medium text-[#17191c]">Aktivitas Terkini</h3>
                    <a href="{{ route('member.riwayat') }}" class="text-[14px] font-medium text-[#979799] hover:text-[#17191c] transition-colors flex items-center gap-1">
                        Lihat Semua
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <div class="flex flex-col gap-6">
                    @forelse ($aktivitasTerbaru as $aktivitas)
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#4a2c3a] shadow-sm group-hover:scale-105 transition-transform">
                                    <span class="material-symbols-outlined">
                                        {{ $aktivitas->status === 'Approved' ? 'check_circle' : ($aktivitas->status === 'Rejected' ? 'cancel' : 'pending') }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium text-[#17191c]">{{ $aktivitas->keterangan_rincian }}</p>
                                    <p class="text-[12px] text-[#979799]">{{ $aktivitas->created_at->format('d M Y • H:i') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[14px] font-semibold text-[#17191c]">Rp{{ number_format($aktivitas->nominal, 0, ',', '.') }}</p>
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
        <div class="col-span-12 lg:col-span-5 flex flex-col gap-8">
            <div class="flex flex-col gap-4">
                <h3 class="text-[20px] font-medium text-[#17191c] px-2">Status Pengajuan</h3>

                {{-- Statistik Ringkas --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-[#f6f3f2] p-4 rounded-[20px] text-center">
                        <p class="text-[24px] font-medium text-[#17191c]">{{ $statsPengajuan['pending'] ?? 0 }}</p>
                        <p class="text-[12px] text-[#979799]">Pending</p>
                    </div>
                    <div class="bg-[#f6f3f2] p-4 rounded-[20px] text-center">
                        <p class="text-[24px] font-medium text-emerald-700">{{ $statsPengajuan['approved'] ?? 0 }}</p>
                        <p class="text-[12px] text-[#979799]">Approved</p>
                    </div>
                    <div class="bg-[#f6f3f2] p-4 rounded-[20px] text-center">
                        <p class="text-[24px] font-medium text-red-600">{{ $statsPengajuan['rejected'] ?? 0 }}</p>
                        <p class="text-[12px] text-[#979799]">Rejected</p>
                    </div>
                </div>

                @forelse ($pengajuanAktif as $pengajuan)
                    <a href="{{ route('member.riwayat.show', $pengajuan->id) }}" class="bg-[#f6f3f2] p-6 rounded-[24px] flex items-center justify-between group cursor-pointer hover:bg-[#f2f2f3] transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center
                                {{ $pengajuan->status === 'Pending' ? 'text-amber-600' : ($pengajuan->status === 'Approved' ? 'text-emerald-600' : 'text-red-600') }}">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                                    {{ $pengajuan->status === 'Pending' ? 'pending' : ($pengajuan->status === 'Approved' ? 'check_circle' : 'cancel') }}
                                </span>
                            </div>
                            <div>
                                <p class="font-medium text-[#17191c]">{{ Str::limit($pengajuan->keterangan_rincian, 30) }}</p>
                                <p class="text-[12px] text-[#979799]">{{ $pengajuan->kategori_dana }} • {{ $pengajuan->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[14px] font-semibold text-[#17191c]">Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</p>
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
@endsection