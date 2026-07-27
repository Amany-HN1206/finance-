@extends('layouts.member')

@section('title', 'Detail Pengajuan #' . str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT))

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Breadcrumb --}}
    <section class="px-10 pt-12 pb-4">
        <div class="flex items-center gap-3 text-[14px] text-[#979799]">
            <a href="{{ route('member.dashboard') }}" class="hover:text-[#17191c] transition-colors">Dashboard</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a href="{{ route('member.riwayat') }}" class="hover:text-[#17191c] transition-colors">Riwayat</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-[#17191c] font-medium">#REQ-{{ str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
    </section>

    {{-- Header --}}
    <section class="px-10 pb-8">
        <div class="flex items-baseline gap-4 mb-4">
            <span class="text-[14px] text-[#979799] uppercase tracking-[0.2em]">Referensi #REQ-{{ str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT) }}</span>
            <div class="h-px flex-1 bg-[#f2f2f3]"></div>
        </div>
        <h1 class="font-serif-display text-[64px] text-[#17191c] leading-[1.3] tracking-[-0.96px]">Informasi Pengajuan</h1>
    </section>

    {{-- Main Content Grid --}}
    <section class="px-10 pb-20">
        <div class="max-w-[1200px] mx-auto grid grid-cols-12 gap-12 items-start">
            {{-- Left Column: Detailed Information --}}
            <div class="col-span-12 lg:col-span-7 flex flex-col gap-8">
                <div class="bg-[#f2f2f3] rounded-[24px] p-10 relative overflow-hidden group">
                    {{-- Decorative Icon --}}
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <span class="material-symbols-outlined text-[120px] select-none">payments</span>
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c] mb-10">Detail Permohonan</h2>

                        <div class="space-y-8">
                            {{-- Pemohon --}}
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Pemohon</span>
                                <div class="col-span-2 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#e6d8dc] flex items-center justify-center text-[12px] font-medium text-[#4a2c3a]">
                                        {{ substr($pengajuan->member->nama_lengkap, 0, 2) }}
                                    </div>
                                    <span class="text-[17px] text-[#17191c]">{{ $pengajuan->member->nama_lengkap }}</span>
                                </div>
                            </div>

                            {{-- Kategori --}}
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Kategori</span>
                                <div class="col-span-2">
                                    <span class="text-[14px] text-[#979799]">{{ $pengajuan->kategori_dana }}</span>
                                </div>
                            </div>

                            {{-- Keterangan --}}
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Deskripsi</span>
                                <div class="col-span-2">
                                    <p class="text-[17px] text-[#45474a] leading-[1.5]">{{ $pengajuan->keterangan_rincian }}</p>
                                </div>
                            </div>

                            {{-- Metode --}}
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Metode</span>
                                <div class="col-span-2">
                                    <span class="text-[17px] text-[#17191c]">{{ $pengajuan->metode_pencairan }}</span>
                                </div>
                            </div>

                            {{-- Nominal --}}
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Nominal</span>
                                <div class="col-span-2">
                                    <span class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c]">Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Status</span>
                                <div class="col-span-2">
                                    <span class="text-[14px] italic
                                        {{ $pengajuan->status === 'Pending' ? 'text-amber-700' : ($pengajuan->status === 'Approved' ? 'text-emerald-700' : 'text-red-700') }}">
                                        {{ $pengajuan->status }}
                                    </span>
                                </div>
                            </div>

                            {{-- Alasan Penolakan (jika ada) --}}
                            @if ($pengajuan->status === 'Rejected' && $pengajuan->alasan_penolakan)
                                <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                    <span class="text-[14px] text-[#979799] uppercase tracking-wider">Alasan</span>
                                    <div class="col-span-2">
                                        <p class="text-[17px] text-[#ba1a1a] leading-[1.5]">{{ $pengajuan->alasan_penolakan }}</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Dokumen Lampiran --}}
                            <div class="grid grid-cols-3 gap-4 pt-2">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Dokumen</span>
                                <div class="col-span-2 flex flex-col gap-2">
                                    @forelse ($pengajuan->attachments as $attachment)
                                        <a href="{{ $attachment->public_url }}" target="_blank"
                                           class="inline-flex items-center gap-2 text-[17px] text-[#17191c] group/link">
                                            <span class="material-symbols-outlined text-[20px]">description</span>
                                            <span class="border-b border-[#17191c]/20 group-hover/link:border-[#17191c] transition-all">
                                                Lampiran_{{ $loop->iteration }}.{{ $attachment->file_type }}
                                            </span>
                                            <span class="material-symbols-outlined text-[16px] transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                        </a>
                                    @empty
                                        <span class="text-[14px] text-[#979799] italic">Tidak ada lampiran</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Area --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('member.riwayat') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full border border-[#17191c] text-[#17191c] text-[16px] hover:bg-[#fafafb] transition-all">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali ke Riwayat
                    </a>
                </div>
            </div>

            {{-- Right Column: Timeline --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col gap-8">
                {{-- Timeline Card --}}
                <div class="bg-white p-8 rounded-[24px] shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.1)]">
                    <h3 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c] mb-8">Status Alur Kerja</h3>

                    <div class="relative flex flex-col gap-10">
                        {{-- Timeline Line --}}
                        <div class="absolute left-[11px] top-2 bottom-2 w-[1px] bg-[#f2f2f3]"></div>

                        {{-- Step 1: Pengajuan Diterima --}}
                        <div class="flex gap-6 relative">
                            <div class="w-6 h-6 rounded-full bg-[#17191c] flex items-center justify-center z-10 shrink-0">
                                <span class="material-symbols-outlined text-white text-[14px]">check</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[14px] text-[#979799] uppercase">{{ $pengajuan->created_at->format('d M, H:i') }}</span>
                                <span class="text-[17px] font-medium text-[#17191c]">Pengajuan Diterima</span>
                                <span class="text-[15px] text-[#45474a]">Sistem mencatat entri permohonan baru.</span>
                            </div>
                        </div>

                        {{-- Step 2: Verifikasi (jika sudah diproses) --}}
                        @if ($pengajuan->status !== 'Pending')
                            <div class="flex gap-6 relative">
                                <div class="w-6 h-6 rounded-full bg-[#17191c] flex items-center justify-center z-10 shrink-0">
                                    <span class="material-symbols-outlined text-white text-[14px]">check</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[14px] text-[#979799] uppercase">{{ $pengajuan->updated_at->format('d M, H:i') }}</span>
                                    <span class="text-[17px] font-medium text-[#17191c]">Verifikasi Bendahara</span>
                                    <span class="text-[15px] text-[#45474a]">
                                        Diproses oleh {{ $pengajuan->approver->nama_lengkap ?? 'Admin' }}.
                                    </span>
                                </div>
                            </div>

                            {{-- Step 3: Keputusan --}}
                            <div class="flex gap-6 relative">
                                <div class="w-6 h-6 rounded-full {{ $pengajuan->status === 'Approved' ? 'bg-emerald-600' : 'bg-red-600' }} flex items-center justify-center z-10 shrink-0">
                                    <span class="material-symbols-outlined text-white text-[14px]">
                                        {{ $pengajuan->status === 'Approved' ? 'check' : 'close' }}
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[14px] {{ $pengajuan->status === 'Approved' ? 'text-emerald-700' : 'text-red-700' }} font-medium uppercase tracking-wider">
                                        {{ $pengajuan->status === 'Approved' ? 'Disetujui' : 'Ditolak' }}
                                    </span>
                                    <span class="text-[17px] font-semibold text-[#17191c]">
                                        {{ $pengajuan->status === 'Approved' ? 'Dana telah dicairkan' : 'Pengajuan tidak dapat diproses' }}
                                    </span>
                                    @if ($pengajuan->status === 'Approved')
                                        <span class="text-[15px] text-[#45474a]">Mutasi saldo tercatat di sistem.</span>
                                    @endif
                                </div>
                            </div>
                        @else
                            {{-- Step 3: Menunggu --}}
                            <div class="flex gap-6 relative">
                                <div class="w-6 h-6 rounded-full bg-white border-2 border-[#17191c] flex items-center justify-center z-10 shrink-0">
                                    <div class="w-2 h-2 rounded-full bg-[#17191c] animate-pulse"></div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[14px] text-[#17191c] font-medium uppercase tracking-wider">Sedang Berlangsung</span>
                                    <span class="text-[17px] font-semibold text-[#17191c]">Menunggu Persetujuan</span>
                                    <span class="text-[15px] text-[#45474a]">Bendahara sedang meninjau dokumen Anda.</span>
                                </div>
                            </div>

                            {{-- Step 4: Pencairan (pending) --}}
                            <div class="flex gap-6 relative opacity-40">
                                <div class="w-6 h-6 rounded-full bg-[#f2f2f3] z-10 shrink-0"></div>
                                <div class="flex flex-col">
                                    <span class="text-[14px] text-[#979799] uppercase">Estimasi</span>
                                    <span class="text-[17px] text-[#17191c]">Pencairan Dana</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Editorial Note Card (Mauve) --}}
                <div class="bg-[#e6d8dc] p-10 rounded-[24px] relative group overflow-hidden">
                    <div class="absolute -bottom-4 -right-4 font-serif-display text-[120px] text-[#4a2c3a]/5 select-none pointer-events-none">"</div>
                    <div class="relative z-10 flex flex-col gap-4">
                        <span class="material-symbols-outlined text-[#4a2c3a]">auto_awesome</span>
                        <p class="font-serif-display text-[22px] leading-[1.5] text-[#4a2c3a] italic">
                            "Integritas dalam setiap pengajuan adalah fondasi dari pertumbuhan kolektif kita."
                        </p>
                        <div class="mt-4 pt-4 border-t border-[#4a2c3a]/10">
                            <p class="text-[14px] text-[#4a2c3a] uppercase">Catatan Kepatuhan</p>
                            <p class="text-[15px] text-[#4a2c3a]/80 mt-1">Audit internal dilakukan secara acak setiap kuartal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection