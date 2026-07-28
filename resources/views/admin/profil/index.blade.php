@extends('layouts.admin')

@section('title', 'Profil Administrator — IPJ Finance')

@section('admin-content')
<div class="flex flex-col w-full">
    
    <!-- Hero Section -->
    <section class="px-4 md:px-12 py-10 md:py-20 flex flex-col items-center md:items-start md:flex-row gap-8 md:gap-12 border-b border-surface-container">
        <div class="relative group">
            <!-- Avatar with Edit Button -->
            <div class="w-28 h-28 md:w-40 md:h-40 rounded-full bg-secondary-fixed flex items-center justify-center text-deep-plum overflow-hidden shadow-sm transition-transform duration-500 hover:scale-105 relative">
                @if(auth('admin')->user()->avatar_path)
                    <img src="{{ Storage::url(auth('admin')->user()->avatar_path) }}" 
                         alt="{{ auth('admin')->user()->nama_lengkap }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="font-headline-lg text-headline-lg select-none">
                        {{ strtoupper(substr(auth('admin')->user()->nama_lengkap, 0, 2)) }}
                    </span>
                @endif
                
                <!-- Edit Avatar Button -->
                <button onclick="document.getElementById('avatarModal').classList.remove('hidden')" 
                        class="absolute bottom-1 right-1 bg-ink-black text-on-primary p-2 rounded-full shadow-xl hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[18px]">edit_square</span>
                </button>
            </div>
        </div>

        <div class="flex flex-col gap-4 md:gap-6 max-w-2xl flex-1 text-center md:text-left">
            <div class="space-y-1">
                <span class="font-label-sm text-label-sm text-ash-gray uppercase tracking-[0.2em]">Pengaturan Akun</span>
                {{-- ✅ PERBAIKAN: class text-headline-md tidak terdefinisi di CSS, diganti text-headline-lg (sudah responsif) --}}
                <h1 class="font-headline-lg text-headline-lg text-primary leading-tight break-words">
                    {{ auth('admin')->user()->nama_lengkap }}
                </h1>
                <p class="font-body text-body text-on-surface-variant max-w-md">
                    {{ ucfirst(auth('admin')->user()->role) }} • Terdaftar sejak {{ auth('admin')->user()->created_at->format('F Y') }}
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 md:gap-4">
                <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" 
                        class="bg-primary text-on-primary px-6 md:px-8 py-2.5 md:py-3 rounded-full font-label-sm text-label-sm flex items-center gap-2 hover:opacity-90 transition-all active:scale-95 shadow-md">
                    Edit Profil
                    <span class="material-symbols-outlined text-[18px]">north_east</span>
                </button>
                <a href="{{ route('admin.profil.download-audit') }}" 
                   class="bg-transparent border border-outline text-primary px-6 md:px-8 py-2.5 md:py-3 rounded-full font-label-sm text-label-sm hover:bg-mist-gray transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Unduh Laporan Audit
                </a>
            </div>
        </div>

        {{-- ✅ PERBAIKAN: Kartu dekoratif duplikat ini disembunyikan di HP/tablet (sudah ada info yang sama di atas) --}}
        <!-- Profile Card Artifact -->
        <div class="hidden lg:block bg-paper-white p-6 rounded-[32px] shadow-xl shadow-primary/5 translate-y-8" style="transform: translateY(32px);">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-secondary-container flex items-center justify-center text-deep-plum">
                    @if(auth('admin')->user()->avatar_path)
                        <img src="{{ Storage::url(auth('admin')->user()->avatar_path) }}" 
                             alt="{{ auth('admin')->user()->nama_lengkap }}"
                             class="w-full h-full object-cover rounded-full">
                    @else
                        <span class="font-heading-sm">{{ strtoupper(substr(auth('admin')->user()->nama_lengkap, 0, 2)) }}</span>
                    @endif
                </div>
                <div>
                    <h2 class="font-heading-sm text-heading-sm text-primary">{{ auth('admin')->user()->nama_lengkap }}</h2>
                    <p class="font-body text-ash-gray mt-1">{{ ucfirst(auth('admin')->user()->role) }}</p>
                    <div class="flex gap-2 mt-2">
                        <span class="px-3 py-1 bg-mist-gray rounded-full text-[12px] font-medium text-on-surface-variant">Admin Utama</span>
                        <span class="px-3 py-1 bg-mist-gray rounded-full text-[12px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Verified
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Grid -->
    <section class="p-4 md:p-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
            <!-- Card: Informasi Personal -->
            <div class="bg-mist-gray rounded-[20px] md:rounded-[24px] p-6 md:p-10 flex flex-col gap-6 md:gap-10">
                <div class="flex items-center justify-between">
                    <h2 class="font-heading-sm text-heading-sm text-primary italic">Informasi Personal</h2>
                    <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" 
                            class="text-primary hover:underline font-medium text-sm flex items-center gap-2">
                        Perbarui Data <span class="material-symbols-outlined text-sm">north_east</span>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 md:gap-y-8">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Nama Lengkap</label>
                        <p class="font-body-lg text-body-lg text-primary break-words">{{ auth('admin')->user()->nama_lengkap }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Email</label>
                        <p class="font-body-lg text-body-lg text-primary break-words">{{ auth('admin')->user()->email }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Nomor Telepon</label>
                        <p class="font-body-lg text-body-lg text-primary">{{ auth('admin')->user()->no_telepon ?? '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Lokasi Kantor</label>
                        <p class="font-body-lg text-body-lg text-primary">{{ auth('admin')->user()->lokasi_kantor ?? 'Headquarters, Jakarta Selatan' }}</p>
                    </div>
                </div>
            </div>

            <!-- Card: Keamanan Akun (Accent Mauve) -->
            <div class="bg-secondary-container rounded-[20px] md:rounded-[24px] p-6 md:p-10 flex flex-col gap-6 md:gap-10 border border-secondary-fixed">
                <div class="flex items-center justify-between">
                    <h2 class="font-heading-sm text-heading-sm text-deep-plum italic">Keamanan Akun</h2>
                    <span class="material-symbols-outlined text-deep-plum">shield_person</span>
                </div>
                <div class="flex flex-col gap-8">
                    <div class="flex items-center justify-between group cursor-pointer border-b border-secondary-fixed-dim pb-6" 
                         onclick="document.getElementById('passwordModal').classList.remove('hidden')">
                        <div class="flex flex-col gap-1">
                            <label class="font-label-sm text-label-sm text-on-secondary-container opacity-70 uppercase tracking-wider">Kata Sandi</label>
                            <p class="font-body-lg text-body-lg text-deep-plum">Diperbarui 3 bulan lalu</p>
                        </div>
                        <span class="material-symbols-outlined text-deep-plum transform group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </div>
                    <div class="flex items-center justify-between group cursor-pointer border-b border-secondary-fixed-dim pb-6">
                        <div class="flex flex-col gap-1">
                            <label class="font-label-sm text-label-sm text-on-secondary-container opacity-70 uppercase tracking-wider">Otentikasi Dua Faktor</label>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-deep-plum"></span>
                                <p class="font-body-lg text-body-lg text-deep-plum">Aktif</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-deep-plum transform group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </div>
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex flex-col gap-1">
                            <label class="font-label-sm text-label-sm text-on-secondary-container opacity-70 uppercase tracking-wider">Sesi Perangkat</label>
                            <p class="font-body-lg text-body-lg text-deep-plum">1 Perangkat Terhubung</p>
                        </div>
                        <span class="material-symbols-outlined text-deep-plum transform group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </div>
                </div>
                <div class="mt-auto pt-6">
                    <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl flex gap-4 items-start">
                        <span class="material-symbols-outlined text-deep-plum">info</span>
                        <p class="text-caption font-caption text-on-secondary-container">
                            Demi keamanan, aktivitas akun Anda dipantau secara berkala. Pastikan untuk selalu keluar (logout) dari perangkat publik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activity Log Section -->
    <section class="px-4 md:px-12 py-10 md:py-20 bg-fog-white">
        <div class="max-w-max-width mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-4 mb-8 md:mb-12">
                <div>
                    <h3 class="font-heading-sm text-heading-sm text-primary">Jejak Administratif</h3>
                    <p class="font-caption text-caption text-ash-gray mt-1">Log aktivitas 30 hari terakhir</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.profil.download-audit') }}" 
                       class="font-label-sm text-label-sm text-ash-gray hover:text-primary transition-colors flex items-center gap-2 uppercase tracking-widest">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        PDF
                    </a>
                    <span class="text-ash-gray">|</span>
                    <a href="{{ route('admin.profil.download-audit-csv') }}" 
                       class="font-label-sm text-label-sm text-ash-gray hover:text-primary transition-colors flex items-center gap-2 uppercase tracking-widest">
                        <span class="material-symbols-outlined text-[18px]">table</span>
                        CSV
                    </a>
                </div>
            </div>
            <div class="space-y-4">
                @forelse($activityLogs as $log)
                    <!-- Log Item -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-4 md:p-6 bg-paper-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 md:gap-6">
                            <div class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-mist-gray flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">
                                    @if($log->jenis_mutasi === 'Outflow')
                                        payments
                                    @else
                                        south_east
                                    @endif
                                </span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-body text-primary font-medium truncate">{{ $log->catatan ?? 'Mutasi Saldo' }}</p>
                                <p class="text-caption font-caption text-ash-gray truncate">
                                    {{ $log->sumber_saldo }} • {{ number_format($log->nominal, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <p class="text-caption font-caption text-ash-gray shrink-0 pl-13 sm:pl-0">{{ $log->created_at->format('d M Y, H:i') }}</p>
                    </div>
                @empty
                    <div class="text-center py-12 bg-paper-white rounded-xl">
                        <span class="material-symbols-outlined text-[40px] md:text-[48px] text-ash-gray mb-3">inbox</span>
                        <p class="font-body text-on-surface-variant">Belum ada aktivitas dalam 30 hari terakhir</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Modal: Edit Profile - MENGGUNAKAN POST (bukan PUT) -->
    <div id="editProfileModal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-paper-white/95 backdrop-blur-sm p-4">
        <div class="bg-paper-white rounded-[24px] md:rounded-[32px] p-6 md:p-10 shadow-subtle-3 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6 md:mb-8">
                <h3 class="font-heading-sm text-heading-sm text-primary">Perbarui Informasi Profil</h3>
                <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" 
                        class="material-symbols-outlined text-ash-gray hover:text-primary transition-colors">close</button>
            </div>
            
            {{-- 🔥 PERUBAHAN: HAPUS @method('PUT') karena route menggunakan POST --}}
            <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-6">
                @csrf
                {{-- JANGAN GUNAKAN @method('PUT') --}}
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', auth('admin')->user()->nama_lengkap) }}" 
                               required
                               class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                        @error('nama_lengkap')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth('admin')->user()->email) }}" 
                               required
                               class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                        @error('email')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Nomor Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', auth('admin')->user()->no_telepon) }}" 
                               class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                        @error('no_telepon')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Lokasi Kantor</label>
                        <input type="text" name="lokasi_kantor" value="{{ old('lokasi_kantor', auth('admin')->user()->lokasi_kantor) }}" 
                               class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                        @error('lokasi_kantor')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6">
                    <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" 
                            class="px-8 py-3 rounded-full border border-outline text-primary font-label-sm hover:bg-mist-gray transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-8 py-3 rounded-full bg-primary text-on-primary font-label-sm hover:opacity-90 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Update Avatar -->
    <div id="avatarModal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-paper-white/95 backdrop-blur-sm p-4">
        <div class="bg-paper-white rounded-[24px] md:rounded-[32px] p-6 md:p-10 shadow-subtle-3 max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6 md:mb-8">
                <h3 class="font-heading-sm text-heading-sm text-primary">Perbarui Foto Profil</h3>
                <button onclick="document.getElementById('avatarModal').classList.add('hidden')" 
                        class="material-symbols-outlined text-ash-gray hover:text-primary transition-colors">close</button>
            </div>
            
            <form action="{{ route('admin.profil.update-avatar') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="flex flex-col items-center gap-4">
                    <div class="w-32 h-32 rounded-full bg-secondary-container flex items-center justify-center text-deep-plum overflow-hidden">
                        @if(auth('admin')->user()->avatar_path)
                            <img src="{{ Storage::url(auth('admin')->user()->avatar_path) }}" 
                                 alt="{{ auth('admin')->user()->nama_lengkap }}"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="font-headline-md">{{ strtoupper(substr(auth('admin')->user()->nama_lengkap, 0, 2)) }}</span>
                        @endif
                    </div>
                    
                    <div class="w-full">
                        <label class="block w-full px-6 py-3 bg-primary text-on-primary rounded-full text-center cursor-pointer font-label-sm hover:opacity-90 transition-all">
                            Pilih Foto
                            <input type="file" name="avatar" accept="image/*" required 
                                   class="hidden" onchange="document.getElementById('fileName').textContent = this.files[0]?.name || ''">
                        </label>
                        <p id="fileName" class="text-caption text-ash-gray mt-2 text-center"></p>
                        @error('avatar')
                            <span class="text-error text-sm mt-1 block text-center">{{ $message }}</span>
                        @enderror
                        <p class="text-caption text-ash-gray mt-1 text-center">Maksimal 2MB (JPG, PNG, GIF)</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6">
                    @if(auth('admin')->user()->avatar_path)
                        <button type="button" onclick="if(confirm('Hapus foto profil?')) { document.getElementById('removeAvatarForm').submit(); }" 
                                class="px-6 py-3 rounded-full border border-error text-error font-label-sm hover:bg-error/10 transition-colors">
                            Hapus
                        </button>
                    @endif
                    <button type="button" onclick="document.getElementById('avatarModal').classList.add('hidden')" 
                            class="px-6 py-3 rounded-full border border-outline text-primary font-label-sm hover:bg-mist-gray transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 rounded-full bg-primary text-on-primary font-label-sm hover:opacity-90 transition-all">
                        Simpan
                    </button>
                </div>
            </form>
            
            @if(auth('admin')->user()->avatar_path)
                <form id="removeAvatarForm" action="{{ route('admin.profil.remove-avatar') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endif
        </div>
    </div>

    <!-- Modal: Change Password -->
    <div id="passwordModal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-paper-white/95 backdrop-blur-sm p-4">
        <div class="bg-paper-white rounded-[24px] md:rounded-[32px] p-6 md:p-10 shadow-subtle-3 max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6 md:mb-8">
                <h3 class="font-heading-sm text-heading-sm text-primary">Ubah Kata Sandi</h3>
                <button onclick="document.getElementById('passwordModal').classList.add('hidden')" 
                        class="material-symbols-outlined text-ash-gray hover:text-primary transition-colors">close</button>
            </div>
            
            <form action="{{ route('admin.profil.update-password') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="flex flex-col gap-2">
                    <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" required 
                           class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                    @error('current_password')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex flex-col gap-2">
                    <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Kata Sandi Baru</label>
                    <input type="password" name="new_password" required minlength="8" 
                           class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                    @error('new_password')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex flex-col gap-2">
                    <label class="font-label-sm text-label-sm text-ash-gray uppercase tracking-wider">Konfirmasi Kata Sandi</label>
                    <input type="password" name="new_password_confirmation" required minlength="8" 
                           class="w-full px-5 py-4 bg-paper-white border border-outline-variant rounded-[16px] font-body text-body text-primary focus:outline-none focus:border-primary transition-all">
                </div>

                <div class="flex items-center justify-end gap-4 pt-6">
                    <button type="button" onclick="document.getElementById('passwordModal').classList.add('hidden')" 
                            class="px-6 py-3 rounded-full border border-outline text-primary font-label-sm hover:bg-mist-gray transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 rounded-full bg-primary text-on-primary font-label-sm hover:opacity-90 transition-all">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Close modals on outside click
document.querySelectorAll('[id$="Modal"]').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});

// Close modals on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.classList.add('hidden');
        });
    }
});
</script>
@endpush
@endsection