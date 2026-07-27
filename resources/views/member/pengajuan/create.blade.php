@extends('layouts.member')

@section('title', 'Pengajuan Dana — IPJ Finance')

@section('member-content')
<div class="flex flex-col w-full">
    {{-- Hero --}}
    <section class="relative px-12 pt-24 pb-12 overflow-hidden">
        <div class="max-w-[1200px] mx-auto relative z-10">
            <div class="flex flex-col gap-6">
                <span class="text-label-sm text-[#979799] uppercase tracking-[0.2em]">Permohonan Baru</span>
                <h1 class="text-display text-[#17191c] max-w-2xl leading-tight">
                    Ajukan <span class="italic text-[#4a2c3a]/80">Dana</span>
                </h1>
                <p class="text-subheading text-[#45474a] max-w-lg mt-4">
                    Sederhanakan proses pendanaan kegiatan Anda melalui platform manajemen keuangan IPJ yang terintegrasi.
                </p>
            </div>
        </div>
        <div class="absolute -right-20 -top-20 w-[600px] h-[600px] rounded-full bg-[#e6d8dc]/20 blur-[120px] -z-0"></div>
    </section>

    {{-- Form Section --}}
    <section class="px-12 pb-20">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid grid-cols-12 gap-12">
                {{-- Main Form --}}
                <div class="col-span-12 lg:col-span-7 bg-white rounded-[32px] p-12 shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1)]">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl">
                            <ul class="text-[14px] text-[#ba1a1a] space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('member.pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                        @csrf

                        {{-- Kategori Dana --}}
                        <div class="flex flex-col gap-3">
                            <label class="text-label-sm text-[#45474a]">Kategori Dana</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach (['Kas', 'Operasional', 'Konsumsi', 'Lainnya'] as $kategori)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_dana" value="{{ $kategori }}" class="peer hidden" {{ $loop->first ? 'checked' : '' }} required>
                                        <div class="px-4 py-3 rounded-2xl border border-[#ececec] text-center text-[15px] text-[#45474a] peer-checked:border-[#17191c] peer-checked:bg-[#17191c] peer-checked:text-white transition-all">
                                            {{ $kategori }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Nominal --}}
                        <div class="flex flex-col gap-3">
                            <label class="text-label-sm text-[#45474a]" for="nominal">Nominal Pengajuan</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-0 text-heading-sm text-[#979799] select-none">Rp</span>
                                <input type="number" name="nominal" id="nominal" min="1000" step="1000" required
                                       class="w-full bg-white border-b-2 border-[#f2f2f3] py-4 pl-10 focus:outline-none focus:border-[#17191c] transition-all text-heading-sm text-[#17191c] placeholder:text-[#a3a6af]"
                                       placeholder="0">
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div class="flex flex-col gap-3">
                            <label class="text-label-sm text-[#45474a]" for="keterangan">Keterangan / Deskripsi</label>
                            <textarea name="keterangan_rincian" id="keterangan" rows="4" required
                                      class="w-full bg-[#fafafb] rounded-2xl p-6 focus:outline-none focus:ring-1 focus:ring-[#17191c]/10 transition-all text-[17px] resize-none placeholder:text-[#a3a6af]"
                                      placeholder="Jelaskan secara singkat tujuan dan rincian penggunaan dana..."></textarea>
                        </div>

                        {{-- Metode Pencairan --}}
                        <div class="flex flex-col gap-3">
                            <label class="text-label-sm text-[#45474a]">Metode Pencairan</label>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach (['Cash', 'Transfer'] as $metode)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="metode_pencairan" value="{{ $metode }}" class="peer hidden" {{ $loop->first ? 'checked' : '' }} required>
                                        <div class="px-4 py-4 rounded-2xl border border-[#ececec] text-center text-[15px] text-[#45474a] peer-checked:border-[#17191c] peer-checked:bg-[#17191c] peer-checked:text-white transition-all flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-[18px]">{{ $metode === 'Cash' ? 'payments' : 'account_balance' }}</span>
                                            {{ $metode }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Lampiran --}}
                        <div class="flex flex-col gap-3">
                            <label class="text-label-sm text-[#45474a]">Lampiran Dokumen (PDF/JPG/PNG)</label>
                            <div class="relative group cursor-pointer border-2 border-dashed border-[#f2f2f3] rounded-2xl p-8 transition-all hover:bg-[#fafafb] hover:border-[#979799] flex flex-col items-center justify-center gap-3" id="dropzone">
                                <input type="file" name="lampiran[]" id="lampiran" accept=".pdf,.jpg,.jpeg,.png" multiple
                                       class="absolute inset-0 opacity-0 cursor-pointer">
                                <div class="w-12 h-12 rounded-full bg-[#f6f3f2] flex items-center justify-center text-[#45474a] group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined">upload_file</span>
                                </div>
                                <div class="text-center">
                                    <p class="text-[17px] font-medium">Klik untuk unggah atau seret file</p>
                                    <p class="text-[15px] text-[#979799]">Maksimal 5MB per file • PDF, JPG, PNG</p>
                                </div>
                                <div class="hidden mt-2 text-label-sm text-[#4a2c3a] bg-[#e6d8dc]/30 px-3 py-1 rounded-full" id="file-preview"></div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-6 pt-8">
                            <button type="submit" class="btn-primary">
                                Kirim Pengajuan
                            </button>
                            <a href="{{ route('member.dashboard') }}" class="btn-ghost">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Guidance Column --}}
                <div class="col-span-12 lg:col-span-5 flex flex-col gap-8">
                    {{-- Informational Card (Mauve) --}}
                    <div class="bg-[#e6d8dc] rounded-[24px] p-10 flex flex-col gap-6">
                        <div class="w-12 h-12 bg-[#4a2c3a] rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <span class="material-symbols-outlined">info</span>
                        </div>
                        <h3 class="text-heading-sm text-[#4a2c3a] leading-tight">Panduan Pengajuan</h3>
                        <ul class="flex flex-col gap-4">
                            <li class="flex gap-3 text-[15px] text-[#4a2c3a]/80">
                                <span class="text-[#4a2c3a] font-bold">01.</span>
                                Pastikan nominal yang diajukan sudah termasuk pajak jika diperlukan.
                            </li>
                            <li class="flex gap-3 text-[15px] text-[#4a2c3a]/80">
                                <span class="text-[#4a2c3a] font-bold">02.</span>
                                Lampirkan proposal atau kuitansi pendukung dalam format PDF.
                            </li>
                            <li class="flex gap-3 text-[15px] text-[#4a2c3a]/80">
                                <span class="text-[#4a2c3a] font-bold">03.</span>
                                Proses review memakan waktu maksimal 3 hari kerja oleh tim bendahara.
                            </li>
                        </ul>
                    </div>

                    {{-- Floating Stat: Sisa Anggaran --}}
                    <div class="bg-white p-8 rounded-[32px] shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1)] flex items-center justify-between">
                        <div>
                            <p class="text-[#979799] text-label-sm mb-1">Sisa Saldo Kas</p>
                            <h4 class="text-heading-sm text-[#17191c]">Rp{{ number_format($saldoKas, 0, ',', '.') }}</h4>
                        </div>
                        <div class="w-16 h-16">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-[#4a2c3a]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-dasharray="75, 100" stroke-width="3"/>
                                <path class="text-[#f2f2f3]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-dasharray="100, 100" stroke-width="2"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
const fileInput = document.getElementById('lampiran');
const filePreview = document.getElementById('file-preview');
const dropzone = document.getElementById('dropzone');

fileInput.addEventListener('change', (e) => {
    const files = e.target.files;
    if (files.length > 0) {
        filePreview.textContent = `${files.length} file dipilih`;
        filePreview.classList.remove('hidden');
        dropzone.classList.add('border-[#17191c]', 'bg-[#fafafb]');
    } else {
        filePreview.classList.add('hidden');
        dropzone.classList.remove('border-[#17191c]', 'bg-[#fafafb]');
    }
});
</script>
@endpush
@endsection