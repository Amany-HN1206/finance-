@extends('layouts.admin')

@section('title', 'Tinjau Pengajuan #' . str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT))

@section('admin-content')
<div class="flex flex-col w-full">
    {{-- Breadcrumb --}}
    <section class="px-10 pt-12 pb-4">
        <div class="flex items-center gap-3 text-[14px] text-[#979799]">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-[#17191c] transition-colors">Dashboard</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a href="{{ route('admin.persetujuan') }}" class="hover:text-[#17191c] transition-colors">Persetujuan</a>
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
        <h1 class="font-serif-display text-[64px] leading-[1.3] tracking-[-0.96px] text-[#17191c]">Tinjau Pengajuan</h1>
    </section>

    {{-- Error Message --}}
    @if ($errors->any())
        <section class="px-10 pb-6">
            <div class="max-w-[1200px] mx-auto p-4 bg-red-50 border border-red-100 rounded-2xl">
                <p class="text-[14px] text-red-700">{{ $errors->first() }}</p>
            </div>
        </section>
    @endif

    {{-- Main Content --}}
    <section class="px-10 pb-20">
        <div class="max-w-[1200px] mx-auto grid grid-cols-12 gap-12 items-start">
            {{-- Left Column --}}
            <div class="col-span-12 lg:col-span-7 flex flex-col gap-8">
                {{-- Detail Card --}}
                <div class="bg-[#f2f2f3] rounded-[24px] p-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <span class="material-symbols-outlined text-[120px] select-none">payments</span>
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c] mb-10">Detail Permohonan</h2>

                        <div class="space-y-8">
                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Pemohon</span>
                                <div class="col-span-2 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#e6d8dc] flex items-center justify-center text-[12px] font-medium text-[#4a2c3a]">
                                        {{ substr($pengajuan->member->nama_lengkap, 0, 2) }}
                                    </div>
                                    <span class="text-[17px] text-[#17191c]">{{ $pengajuan->member->nama_lengkap }}</span>
                                    <span class="text-[12px] text-[#979799]">({{ $pengajuan->member->jabatan_organisasi ?? 'Anggota' }})</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Kategori</span>
                                <div class="col-span-2">
                                    <span class="text-[14px] text-[#979799]">{{ $pengajuan->kategori_dana }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Deskripsi</span>
                                <div class="col-span-2">
                                    <p class="text-[17px] text-[#45474a] leading-[1.5]">{{ $pengajuan->keterangan_rincian }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Metode</span>
                                <div class="col-span-2">
                                    <span class="text-[17px] text-[#17191c]">{{ $pengajuan->metode_pencairan }} → Saldo {{ $pengajuan->metode_pencairan === 'Cash' ? 'Kas' : 'Bank' }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 border-b border-[#c6c6ca]/30 pb-6">
                                <span class="text-[14px] text-[#979799] uppercase tracking-wider">Nominal</span>
                                <div class="col-span-2">
                                    <span class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c]">Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</span>
                                </div>
                            </div>

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

                {{-- Action Buttons (hanya jika pending) --}}
                @if ($pengajuan->status === 'Pending')
                    <div class="flex flex-col gap-6">
                        {{-- Approve Form --}}
                        <form action="{{ route('admin.persetujuan.approve', $pengajuan->id) }}" method="POST"
                              onsubmit="return confirm('Setujui pengajuan ini? Saldo total akan otomatis berubah.');">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-10 py-4 rounded-full bg-[#17191c] text-white text-[16px] hover:opacity-90 transition-all shadow-xl">
                                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                Setujui Pengajuan
                            </button>
                        </form>

                        {{-- Reject Form --}}
                        <form action="{{ route('admin.persetujuan.reject', $pengajuan->id) }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div class="flex flex-col gap-2">
                                <label class="text-[14px] text-[#979799] uppercase tracking-wider">Alasan Penolakan (Wajib jika menolak)</label>
                                <textarea name="alasan_penolakan" rows="3"
                                          class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#ba1a1a] transition-all placeholder:text-[#a3a6af]"
                                          placeholder="Jelaskan alasan penolakan..."></textarea>
                                @error('alasan_penolakan')
                                    <span class="text-[12px] text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="inline-flex items-center gap-2 px-10 py-4 rounded-full border border-[#ba1a1a] text-[#ba1a1a] text-[16px] hover:bg-red-50 transition-all">
                                <span class="material-symbols-outlined text-[20px]">cancel</span>
                                Tolak Pengajuan
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-[#fafafb] p-6 rounded-2xl border border-[#f2f2f3]">
                        <p class="text-[14px] text-[#979799]">
                            Pengajuan ini sudah diproses dengan status:
                            <span class="font-medium text-[#17191c]">{{ $pengajuan->status }}</span>
                            @if ($pengajuan->approver)
                                oleh {{ $pengajuan->approver->nama_lengkap }}.
                            @endif
                        </p>
                    </div>
                @endif
            </div>

            {{-- Right Column: Saldo Info --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col gap-8">
                {{-- Saldo Card (Mauve) --}}
                <div class="bg-[#e6d8dc] rounded-[24px] p-10 flex flex-col gap-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#4a2c3a]">Saldo Organisasi</h3>
                        <span class="material-symbols-outlined text-[#4a2c3a]">account_balance</span>
                    </div>

                    <div class="flex flex-col gap-4">
                        <div class="flex justify-between items-center pb-4 border-b border-[#4a2c3a]/10">
                            <span class="text-[14px] text-[#4a2c3a]/70 uppercase tracking-wider">Saldo Kas</span>
                            <span class="text-[20px] text-[#4a2c3a] font-medium">Rp{{ number_format($saldoKas, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-[#4a2c3a]/10">
                            <span class="text-[14px] text-[#4a2c3a]/70 uppercase tracking-wider">Saldo Bank</span>
                            <span class="text-[20px] text-[#4a2c3a] font-medium">Rp{{ number_format($saldoBank, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-[14px] text-[#4a2c3a]/70 uppercase tracking-wider">Total</span>
                            <span class="text-[26px] text-[#4a2c3a] font-medium">Rp{{ number_format($saldoKas + $saldoBank, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if ($pengajuan->status === 'Pending')
                        <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl flex gap-4 items-start mt-4">
                            <span class="material-symbols-outlined text-[#4a2c3a]">info</span>
                            <p class="text-[15px] text-[#4a2c3a] leading-[1.5]">
                                Jika disetujui, saldo <strong>{{ $pengajuan->metode_pencairan === 'Cash' ? 'Kas' : 'Bank' }}</strong> akan otomatis berubah sebesar <strong>Rp{{ number_format($pengajuan->nominal, 0, ',', '.') }}</strong>.
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Timeline --}}
                <div class="bg-white p-8 rounded-[24px] shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.1)]">
                    <h3 class="text-[26px] leading-[1.18] tracking-[-0.23px] font-medium text-[#17191c] mb-8">Timeline</h3>

                    <div class="relative flex flex-col gap-8">
                        <div class="absolute left-[11px] top-2 bottom-2 w-[1px] bg-[#f2f2f3]"></div>

                        <div class="flex gap-6 relative">
                            <div class="w-6 h-6 rounded-full bg-[#17191c] flex items-center justify-center z-10 shrink-0">
                                <span class="material-symbols-outlined text-white text-[14px]">check</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[14px] text-[#979799] uppercase">{{ $pengajuan->created_at->format('d M Y, H:i') }}</span>
                                <span class="text-[17px] font-medium text-[#17191c]">Pengajuan Dibuat</span>
                                <span class="text-[15px] text-[#45474a]">oleh {{ $pengajuan->member->nama_lengkap }}</span>
                            </div>
                        </div>

                        @if ($pengajuan->status !== 'Pending')
                            <div class="flex gap-6 relative">
                                <div class="w-6 h-6 rounded-full {{ $pengajuan->status === 'Approved' ? 'bg-emerald-600' : 'bg-red-600' }} flex items-center justify-center z-10 shrink-0">
                                    <span class="material-symbols-outlined text-white text-[14px]">
                                        {{ $pengajuan->status === 'Approved' ? 'check' : 'close' }}
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[14px] text-[#979799] uppercase">{{ $pengajuan->updated_at->format('d M Y, H:i') }}</span>
                                    <span class="text-[17px] font-medium text-[#17191c]">{{ $pengajuan->status }}</span>
                                    <span class="text-[15px] text-[#45474a]">oleh {{ $pengajuan->approver->nama_lengkap ?? 'Admin' }}</span>
                                </div>
                            </div>
                        @else
                            <div class="flex gap-6 relative">
                                <div class="w-6 h-6 rounded-full bg-white border-2 border-[#17191c] flex items-center justify-center z-10 shrink-0">
                                    <div class="w-2 h-2 rounded-full bg-[#17191c] animate-pulse"></div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[14px] text-[#17191c] font-medium uppercase tracking-wider">Menunggu</span>
                                    <span class="text-[17px] font-semibold text-[#17191c]">Perlu Tindakan Anda</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection