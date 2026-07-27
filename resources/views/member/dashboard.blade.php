@extends('layouts.member')

@section('title', 'Dashboard — IPJ Finance')

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Hero Greeting --}}
    <section class="px-4 md:px-10 py-8 md:py-12 flex flex-col gap-3 md:gap-4">
        <div class="flex items-baseline gap-4">
            <span class="text-label-sm text-ash-gray tracking-widest uppercase">Overview</span>
            <div class="h-px flex-1 bg-mist-gray"></div>
        </div>
        <h1 class="font-serif-display text-display text-ink-black max-w-3xl leading-tight">
            Selamat {{ $greeting }}, 
            <span class="italic text-deep-plum">{{ explode(' ', auth()->guard('member')->user()->nama_lengkap)[0] }}.</span>
            <br class="hidden md:block">
            <span class="text-display md:text-display">
                Kedamaian finansial dimulai dari sini.
            </span>
        </h1>
    </section>

    {{-- Main Grid --}}
    <div class="px-4 md:px-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
            
            {{-- Left Column --}}
            <div class="lg:col-span-7 flex flex-col gap-6 lg:gap-8">
                
                {{-- Kartu Saldo --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                    
                    {{-- Saldo Tunai --}}
                    <div class="card-neutral flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-subtle transition-all duration-500 group overflow-hidden">
                        <div>
                            <span class="material-symbols-outlined text-ash-gray group-hover:text-ink-black transition-colors">payments</span>
                            <p class="font-label-sm text-ash-gray mt-4 uppercase tracking-widest">Saldo Tunai</p>
                        </div>
                        <div class="flex flex-col min-w-0">
                            {{-- ✅ TRUNCATE + title tooltip --}}
                            <span class="text-heading-sm text-ink-black leading-none truncate block" 
                                  title="Rp{{ number_format($saldoKas, 0, ',', '.') }}">
                                Rp{{ number_format($saldoKas, 0, ',', '.') }}
                            </span>
                            <span class="font-caption text-slate-gray mt-1">Kas Fisik</span>
                        </div>
                    </div>

                    {{-- Saldo Bank --}}
                    <div class="card-neutral flex flex-col justify-between min-h-[160px] lg:min-h-[180px] hover:shadow-subtle transition-all duration-500 group overflow-hidden">
                        <div>
                            <span class="material-symbols-outlined text-ash-gray group-hover:text-ink-black transition-colors">account_balance</span>
                            <p class="font-label-sm text-ash-gray mt-4 uppercase tracking-widest">Saldo Bank</p>
                        </div>
                        <div class="flex flex-col min-w-0">
                            {{-- ✅ TRUNCATE + title tooltip --}}
                            <span class="text-heading-sm text-ink-black leading-none truncate block" 
                                  title="Rp{{ number_format($saldoBank, 0, ',', '.') }}">
                                Rp{{ number_format($saldoBank, 0, ',', '.') }}
                            </span>
                            <span class="font-caption text-slate-gray mt-1">Rekening Operasional</span>
                        </div>
                    </div>

                    {{-- Total Saldo (Accent Mauve) --}}
                    <div class="card-mauve flex flex-col justify-between min-h-[160px] lg:min-h-[180px] relative overflow-hidden sm:col-span-2 lg:col-span-1">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-deep-plum/5 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-deep-plum">account_balance_wallet</span>
                            <p class="font-label-sm text-deep-plum/60 mt-4 uppercase tracking-widest">Total Saldo</p>
                        </div>
                        <div class="relative z-10 flex flex-col min-w-0">
                            {{-- ✅ TRUNCATE + title tooltip --}}
                            <span class="text-headline text-deep-plum leading-none truncate block" 
                                  title="Rp{{ number_format($saldoTotal, 0, ',', '.') }}">
                                Rp{{ number_format($saldoTotal, 0, ',', '.') }}
                            </span>
                            <div class="w-full h-[2px] bg-deep-plum/10 my-3"></div>
                            <div class="flex justify-between font-caption text-deep-plum/80">
                                <span>Tunai: {{ $saldoTotal > 0 ? round(($saldoKas / $saldoTotal) * 100) : 0 }}%</span>
                                <span>Bank: {{ $saldoTotal > 0 ? round(($saldoBank / $saldoTotal) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-wrap gap-3 lg:gap-4">
                    <a href="{{ route('member.pengajuan.baru') }}" class="btn-primary">
                        Ajukan Dana
                        <span class="material-symbols-outlined text-[18px]">north_east</span>
                    </a>
                    <a href="{{ route('member.riwayat') }}" class="btn-ghost">
                        Lihat Riwayat
                    </a>
                </div>

                {{-- Aktivitas Terkini --}}
                <div class="card-neutral">
                    <div class="flex justify-between items-center mb-6 lg:mb-8">
                        <h3 class="text-heading-sm text-ink-black">Aktivitas Terkini</h3>
                        <a href="{{ route('member.riwayat') }}" class="text-label-sm text-ash-gray hover:text-ink-black transition-colors flex items-center gap-1">
                            Lihat Semua
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="flex flex-col gap-4 lg:gap-6">
                        @forelse ($aktivitasTerbaru as $aktivitas)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3 lg:gap-4 min-w-0 flex-1">
                                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-paper-white flex items-center justify-center text-deep-plum shadow-sm group-hover:scale-105 transition-transform shrink-0">
                                        <span class="material-symbols-outlined text-[18px] lg:text-[20px]">
                                            {{ $aktivitas->status === 'Approved' ? 'check_circle' : ($aktivitas->status === 'Rejected' ? 'cancel' : 'pending') }}
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-label-sm font-medium text-ink-black truncate">
                                            {{ $aktivitas->keterangan_rincian }}
                                        </p>
                                        <p class="text-caption text-ash-gray">{{ $aktivitas->created_at->format('d M Y • H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-right shrink-0 ml-2">
                                    {{-- ✅ TRUNCATE pada nominal aktivitas --}}
                                    <p class="text-label-sm font-semibold text-ink-black truncate max-w-[120px]"
                                       title="Rp{{ number_format($aktivitas->nominal, 0, ',', '.') }}">
                                        Rp{{ number_format($aktivitas->nominal, 0, ',', '.') }}
                                    </p>
                                    <span class="tag italic">{{ $aktivitas->status }}</span>
                                </div>
                            </div>
                            @if (!$loop->last)
                                <div class="h-px bg-mist-gray"></div>
                            @endif
                        @empty
                            <div class="text-center py-8">
                                <p class="text-caption text-ash-gray">Belum ada aktivitas pengajuan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="lg:col-span-5 flex flex-col gap-6 lg:gap-8">
                <div class="flex flex-col gap-4">
                    <h3 class="text-heading-sm text-ink-black px-2">Status Pengajuan</h3>

                    {{-- Statistik Ringkas --}}
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-fog-white p-4 rounded-[20px] text-center">
                            <p class="text-heading-sm text-ink-black">
                                {{ $statsPengajuan['pending'] }}
                            </p>
                            <p class="text-caption text-ash-gray">Pending</p>
                        </div>
                        <div class="bg-fog-white p-4 rounded-[20px] text-center">
                            <p class="text-heading-sm text-emerald-700">
                                {{ $statsPengajuan['approved'] }}
                            </p>
                            <p class="text-caption text-ash-gray">Approved</p>
                        </div>
                        <div class="bg-fog-white p-4 rounded-[20px] text-center">
                            <p class="text-heading-sm text-error">
                                {{ $statsPengajuan['rejected'] }}
                            </p>
                            <p class="text-caption text-ash-gray">Rejected</p>
                        </div>
                    </div>

                    @forelse ($pengajuanAktif as $pengajuan)
                        <a href="{{ route('member.riwayat.show', $pengajuan->id) }}" class="bg-fog-white p-4 lg:p-6 rounded-[24px] flex items-center justify-between group cursor-pointer hover:bg-mist-gray transition-colors">
                            <div class="flex items-center gap-3 lg:gap-4 min-w-0 flex-1">
                                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-paper-white flex items-center justify-center shrink-0
                                    {{ $pengajuan->status === 'Pending' ? 'text-amber-600' : ($pengajuan->status === 'Approved' ? 'text-emerald-600' : 'text-red-600') }}">
                                    <span class="material-symbols-outlined text-[18px] lg:text-[20px]" style="font-variation-settings: 'FILL' 1;">
                                        {{ $pengajuan->status === 'Pending' ? 'pending' : ($pengajuan->status === 'Approved' ? 'check_circle' : 'cancel') }}
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-medium text-ink-black truncate">
                                        {{ Str::limit($pengajuan->keterangan_rincian, 30) }}
                                    </p>
                                    <p class="text-caption text-ash-gray">{{ $pengajuan->kategori_dana }} • {{ $pengajuan->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0 ml-2">
                                {{-- ✅ TRUNCATE pada nominal pengajuan --}}
                                <p class="text-label-sm font-semibold text-ink-black truncate max-w-[120px]"
                                   title="Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}">
                                    Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}
                                </p>
                                <span class="tag italic">{{ $pengajuan->status }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="bg-fog-white p-8 rounded-[24px] text-center">
                            <span class="material-symbols-outlined text-[48px] text-ash-gray mb-3">inbox</span>
                            <p class="text-caption text-ash-gray">Belum ada pengajuan aktif.</p>
                        </div>
                    @endforelse

                    <a href="{{ route('member.pengajuan.baru') }}" class="mt-4 w-full py-4 rounded-full border border-mist-gray text-ash-gray text-label-sm hover:text-ink-black hover:border-ink-black transition-all text-center">
                        Buat Pengajuan Baru +
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection