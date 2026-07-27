@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#ffffff]">
    {{-- Header --}}
    <header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-[#f2f2f3]">
        <div class="h-16 max-w-full mx-auto px-4 md:px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                {{-- Hamburger Button (Mobile Only) --}}
                <button id="admin-menu-btn" class="md:hidden p-2 -ml-2 text-[#17191c]">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                
                <div class="w-8 h-8 bg-[#17191c] rounded-full flex items-center justify-center">
                    <span class="text-white font-serif-display text-[11px] md:text-[12px]">IPJ</span>
                </div>
                <span class="font-medium text-[13px] md:text-[14px] tracking-widest uppercase text-[#17191c]">IPJ Finance · Admin</span>
            </div>
            <div class="flex items-center gap-3 md:gap-6">
                <button class="text-[#979799] hover:text-[#17191c] transition-colors p-2">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                </button>
                <div class="hidden md:flex items-center gap-3 pl-4 md:pl-6 border-l border-[#f2f2f3]">
                    <div class="text-right">
                        <p class="text-[13px] font-medium leading-none text-[#17191c]">{{ auth()->guard('admin')->user()->nama_lengkap ?? 'Admin' }}</p>
                        <p class="text-[11px] text-[#979799] leading-none mt-1">Bendahara</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#e6d8dc] text-[#4a2c3a] flex items-center justify-center text-[12px] font-medium">
                        {{ auth()->guard('admin')->check() ? substr(auth()->guard('admin')->user()->nama_lengkap, 0, 2) : 'AD' }}
                    </div>
                </div>
                {{-- Mobile avatar only --}}
                <div class="md:hidden w-8 h-8 rounded-full bg-[#e6d8dc] text-[#4a2c3a] flex items-center justify-center text-[12px] font-medium">
                    {{ auth()->guard('admin')->check() ? substr(auth()->guard('admin')->user()->nama_lengkap, 0, 2) : 'AD' }}
                </div>
            </div>
        </div>
    </header>

    {{-- Overlay untuk mobile drawer --}}
    <div id="admin-overlay" class="hidden md:hidden fixed inset-0 bg-[#17191c]/50 z-40 backdrop-blur-sm"></div>

    {{-- Sidebar Desktop & Mobile Drawer --}}
    <aside id="admin-sidebar" class="fixed md:block left-0 top-16 bottom-0 w-64 bg-white border-r border-[#f2f2f3] pt-8 px-6 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
        <nav class="flex flex-col gap-2 h-full">
            @php
                $currentRoute = request()->route()->getName();
                $menuItems = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard'],
                    ['route' => 'admin.persetujuan', 'label' => 'Persetujuan Dana', 'icon' => 'pending_actions'],
                    ['route' => 'admin.anggota.index', 'label' => 'Manajemen Anggota', 'icon' => 'group'],
                    ['route' => 'admin.mutasi', 'label' => 'Mutasi & Saldo', 'icon' => 'account_balance'],
                    ['route' => 'admin.profil', 'label' => 'Profil', 'icon' => 'person'],
                ];
            @endphp

            {{-- Menu Items --}}
            <div class="flex-1">
                @foreach ($menuItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="px-4 py-2.5 rounded-lg text-[14px] transition-colors flex items-center gap-3
                              {{ $currentRoute === $item['route']
                                  ? 'bg-[#f6f3f2] text-[#17191c] font-medium'
                                  : 'text-[#45474a] hover:bg-[#fafafb]' }}">
                        <span class="material-symbols-outlined text-[18px]">{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Logout Button --}}
            <div class="mt-8 pt-8 border-t border-[#f2f2f3]">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-3 px-4 py-2.5 text-[14px] text-[#ba1a1a] font-medium hover:bg-red-50 transition-colors rounded-lg">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="pt-16 md:pl-64 pb-20 md:pb-0 min-h-screen">
        @yield('admin-content')
    </main>
</div>

@push('scripts')
<script>
    // Hamburger menu toggle untuk admin
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('admin-menu-btn');
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-overlay');
        
        if (menuBtn && sidebar && overlay) {
            // Toggle menu saat tombol hamburger diklik
            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });
            
            // Tutup menu saat overlay diklik
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
            
            // Tutup menu saat tombol ESC ditekan
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
            
            // Tutup menu saat link di klik (mobile)
            const menuLinks = sidebar.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            });
        }
    });
</script>
@endpush
@endsection