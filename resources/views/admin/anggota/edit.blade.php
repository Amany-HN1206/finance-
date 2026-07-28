@extends('layouts.admin')

@section('title', 'Edit Anggota — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    <section class="px-4 md:px-10 pt-10 md:pt-12 pb-6 md:pb-8">
        <div class="flex items-baseline gap-4 mb-4">
            <span class="text-[13px] md:text-[14px] text-[#979799] uppercase tracking-[0.2em]">Edit Anggota</span>
            <div class="h-px flex-1 bg-[#f2f2f3]"></div>
        </div>
        <h1 class="font-serif-display text-[32px] md:text-[64px] leading-[1.2] md:leading-[1.3] tracking-[-0.5px] md:tracking-[-0.96px] text-[#17191c]">Edit Data Anggota</h1>
    </section>

    <section class="px-4 md:px-10 pb-16 md:pb-20">
        <div class="max-w-[800px] mx-auto bg-white rounded-[24px] md:rounded-[32px] p-6 md:p-12 shadow-[0_0_0_1px_rgba(4,23,43,0.05),0_20px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.1)]">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl">
                    <ul class="text-[14px] text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.anggota.update', $member->id) }}" method="POST" class="flex flex-col gap-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-[14px] text-[#45474a] ml-1">NIM / ID Anggota</label>
                        <input type="text" value="{{ $member->nim_or_id_anggota }}" disabled
                               class="w-full px-5 py-4 bg-[#fafafb] border border-[#c6c6ca] rounded-2xl text-[17px] text-[#979799] cursor-not-allowed">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[14px] text-[#45474a] ml-1">Email</label>
                        <input type="email" value="{{ $member->email }}" disabled
                               class="w-full px-5 py-4 bg-[#fafafb] border border-[#c6c6ca] rounded-2xl text-[17px] text-[#979799] cursor-not-allowed">
                    </div>

                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label class="text-[14px] text-[#45474a] ml-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $member->nama_lengkap) }}" required
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[14px] text-[#45474a] ml-1">Nomor Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $member->no_telepon) }}"
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[14px] text-[#45474a] ml-1">Jabatan Organisasi</label>
                        <input type="text" name="jabatan_organisasi" value="{{ old('jabatan_organisasi', $member->jabatan_organisasi) }}"
                               class="w-full px-5 py-4 bg-white border border-[#c6c6ca] rounded-2xl text-[17px] text-[#17191c] focus:outline-none focus:border-[#17191c] transition-all">
                    </div>

                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label class="text-[14px] text-[#45474a] ml-1">Status Akun</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status_aktif" value="1" {{ $member->status_aktif ? 'checked' : '' }} class="w-4 h-4 accent-[#17191c]">
                                <span class="text-[17px] text-[#17191c]">Aktif</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status_aktif" value="0" {{ !$member->status_aktif ? 'checked' : '' }} class="w-4 h-4 accent-[#17191c]">
                                <span class="text-[17px] text-[#17191c]">Nonaktif</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#17191c] text-white text-[16px] hover:opacity-90 transition-all">
                        Simpan Perubahan
                        <span class="material-symbols-outlined text-[18px]">check</span>
                    </button>
                    <a href="{{ route('admin.anggota.index') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full border border-[#17191c] text-[#17191c] text-[16px] hover:bg-[#fafafb] transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection