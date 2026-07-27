@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-paper-white">
    {{-- Header — Responsive padding only —}}
    <header class="fixed top-0 w-full z-40 bg-paper-white/80 backdrop-blur-md border-b border-mist-gray">
        <div class="h-16 max-w-full mx-auto px-4 md:px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-ink-black rounded-full flex items-center justify-center">
                    <span class="text-paper-white font-display text-[11px]">IPJ</span>
                </div>
                <span class="font-medium text-[13px] md:text-[14px] tracking-widest uppercase text-ink-black">IPJ Finance</span>
            </div>
            <div class="flex items-center gap-3 md:gap-6">
                <button class="text-ash-gray hover:text-ink-black transition-colors p-2">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                </button>
                <div class="hidden md:flex items-center gap-3 pl-4 md:pl-6 border-l border-mist-gray">
                    <div class="text-right">
                        <p class="text-[13px] font-medium leading-none text-ink-black">{{ auth()->guard('member')->user()->nama_lengkap }}</p>
                        <p class="text-[11px] text-ash-gray leading-none mt-1">Member</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-mist-gray flex items-center justify-center text-[12px] font-medium text-ink-black">
                        {{ substr(auth()->guard('member')->user()->nama_lengkap, 0, 2) }}
                    </div>
                </div>
                {{-- Mobile avatar only --}}
                <div class="md:hidden w-8 h-8 rounded-full bg-mist-gray flex items-center justify-center text-[12px] font-medium text-ink-black">
                    {{ substr(auth()->guard('member')->user()->nama_lengkap, 0, 2) }}
                </div>
            </div>
        </div>
    </header>

    {{-- Sidebar Desktop (Hidden di Mobile) --}}
    <aside class="hidden md:block fixed left-0 top-16 bottom-0 w-64 bg-paper-white border-r border-mist-gray pt-8 px-6 z-30">
        <nav class="flex flex-col gap-2">
            @php
                $currentRoute = request()->route()->getName();
                $menuItems = [
                    ['route' => 'member.dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard'],
                    ['route' => 'member.pengajuan.baru', 'label' => 'Pengajuan Dana', 'icon' => 'request_quote'],
                    ['route' => 'member.riwayat', 'label' => 'Riwayat', 'icon' => 'history'],
                    ['route' => 'member.profil', 'label' => 'Profil', 'icon' => 'person'],
                ];
            @endphp

            @foreach ($menuItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="px-4 py-2.5 rounded-lg text-[14px] transition-colors flex items-center gap-3
                          {{ $currentRoute === $item['route']
                              ? 'bg-mist-gray text-ink-black font-medium'
                              : 'text-slate-gray hover:bg-fog-white' }}">
                    <span class="material-symbols-outlined text-[18px]">{{ $item['icon'] }}</span>
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="mt-8 pt-8 border-t border-mist-gray">
                <form action="{{ route('member.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-[14px] text-error font-medium hover:bg-red-50 transition-colors rounded-lg">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Bottom Navigation Mobile (Hanya di Mobile) --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-paper-white border-t border-mist-gray z-40 pb-safe">
        <div class="flex justify-around items-center h-16">
            @php
                $bottomMenuItems = [
                    ['route' => 'member.dashboard', 'label' => 'Home', 'icon' => 'home'],
                    ['route' => 'member.pengajuan.baru', 'label' => 'Ajukan', 'icon' => 'add_circle'],
                    ['route' => 'member.riwayat', 'label' => 'Riwayat', 'icon' => 'history'],
                    ['route' => 'member.profil', 'label' => 'Profil', 'icon' => 'person'],
                ];
            @endphp

            @foreach ($bottomMenuItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex flex-col items-center justify-center flex-1 h-full py-1
                          {{ $currentRoute === $item['route']
                              ? 'text-ink-black'
                              : 'text-ash-gray' }}">
                    <span class="material-symbols-outlined text-[22px] {{ $currentRoute === $item['route'] ? 'text-ink-black' : '' }}">
                        {{ $item['icon'] }}
                    </span>
                    <span class="text-[10px] mt-0.5 font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </nav>

    {{-- Main Content — Responsive padding only —}}
    <main class="pt-16 md:pl-64 pb-20 md:pb-0 min-h-screen">
        @yield('member-content')
    </main>
</div>
@endsection