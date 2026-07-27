@extends('layouts.app')

@section('title', 'IPJ Finance — Kelola Keuangan Organisasi')

@section('content')
{{-- Navigation Responsif --}}
<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-[#f2f2f3]">
    <div class="h-20 max-w-[1200px] mx-auto px-4 md:px-6 flex items-center justify-between">
        <div class="flex items-center gap-3 md:gap-4">
            {{-- Logo dengan Triple Click Access --}}
            <div id="admin-access-logo" class="cursor-pointer select-none" title="IPJ Finance">
                <div class="w-9 h-9 md:w-10 md:h-10 bg-[#17191c] rounded-full flex items-center justify-center transition-transform hover:scale-105">
                    <span class="text-white font-display text-[12px] md:text-[14px]">IPJ</span>
                </div>
            </div>
            <span class="font-medium text-[12px] md:text-[14px] tracking-tight uppercase text-[#17191c]">IPJ Finance</span>
        </div>
        
        {{-- Menu Desktop --}}
        <nav class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center gap-10">
            <a href="#" class="nav-link-active">Home</a>
            <a href="{{ route('member.login') }}" class="nav-link">Login</a>
            <a href="{{ route('member.register') }}" class="nav-link">Register</a>
        </nav>
        
        {{-- CTA Desktop --}}
        <a href="{{ route('member.login') }}" class="hidden md:inline-flex btn-primary text-[14px] px-6 py-2.5">Masuk</a>
        
        {{-- Hamburger Mobile --}}
        <button id="landing-menu-btn" class="md:hidden p-2 text-[#17191c]">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
    
    {{-- Mobile Menu Dropdown --}}
    <div id="landing-mobile-menu" class="hidden md:hidden bg-white border-t border-[#f2f2f3]">
        <div class="px-4 py-4 flex flex-col gap-3">
            <a href="#" class="px-4 py-3 rounded-lg bg-[#f6f3f2] text-[#17191c] font-medium">Home</a>
            <a href="{{ route('member.login') }}" class="px-4 py-3 rounded-lg text-[#45474a] hover:bg-[#fafafb]">Login</a>
            <a href="{{ route('member.register') }}" class="px-4 py-3 rounded-lg text-[#45474a] hover:bg-[#fafafb]">Register</a>
            <a href="{{ route('member.login') }}" class="btn-primary w-full justify-center mt-2">Masuk</a>
        </div>
    </div>
</nav>

<main class="pt-20">
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-[#ffffff] py-16 md:py-24 lg:py-32">
        <div class="max-w-[1200px] mx-auto px-4 md:px-6 relative z-10 text-center">
            {{-- Floating Cards (Hidden di Mobile) --}}
            <div class="absolute -left-4 md:-left-12 top-20 hidden lg:block animate-float">
                <div class="bg-white p-4 md:p-6 rounded-elevated shadow-subtle-3 w-64 md:w-72 transform -rotate-6 transition-transform hover:rotate-0 duration-700">
                    <div class="flex flex-col gap-3 md:gap-4">
                        <span class="text-[#979799] font-label-sm uppercase tracking-widest">Saldo Bank</span>
                        <div class="text-heading-sm text-[#17191c]">Rp 2.450.000.000</div>
                        <div class="space-y-2 md:space-y-3 mt-2">
                            <div class="flex items-center justify-between text-caption">
                                <span class="text-[#45474a]">Spotify Sub</span>
                                <span class="text-[#ba1a1a] font-medium">-Rp 59.000</span>
                            </div>
                            <div class="flex items-center justify-between text-caption border-t border-[#f2f2f3] pt-2">
                                <span class="text-[#45474a]">Salary Transfer</span>
                                <span class="text-[#17191c] font-medium">+Rp 50.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute -right-20 bottom-10 hidden lg:block animate-float-delayed">
                <div class="bg-white p-6 rounded-elevated shadow-subtle-3 w-80 transform rotate-3 transition-transform hover:rotate-0 duration-700">
                    <div class="flex flex-col gap-2">
                        <span class="text-[#979799] font-label-sm uppercase tracking-widest">Arus Kas: +5.5%</span>
                        <svg class="w-full h-24 stroke-[#4a2c3a] fill-none" stroke-linecap="round" stroke-width="2" viewBox="0 0 200 60">
                            <path class="path-draw" d="M0,50 Q25,45 50,30 T100,20 T150,40 T200,10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Hero Typography Responsif --}}
            <div class="max-w-4xl mx-auto space-y-6 md:space-y-8">
                <h1 class="font-display text-[#17191c] leading-tight" 
                    style="font-size: clamp(32px, 6vw, 64px); letter-spacing: -0.02em;">
                    Kelola Keuangan Organisasi Secara 
                    <span class="italic text-[#4a2c3a]">Terbuka dan Akuntabel.</span>
                </h1>
                
                <p class="font-subheading text-[#45474a] max-w-2xl mx-auto text-base md:text-lg lg:text-xl px-2">
                    Platform tata kelola keuangan internal yang transparan, aman, dan terpusat untuk organisasi modern.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 md:gap-4 pt-4 px-4">
                    <a href="{{ route('member.register') }}" class="btn-primary w-full sm:w-auto">Mulai Sekarang</a>
                    <a href="#features" class="btn-ghost w-full sm:w-auto">Pelajari Fitur</a>
                </div>
            </div>
        </div>

        {{-- Subtle Background Texture --}}
        <div class="absolute inset-0 pointer-events-none opacity-20">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#e5e2e1_1px,transparent_1px)] [background-size:32px_32px]"></div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="bg-[#fafafb] py-12 md:py-20 lg:py-24">
        <div class="max-w-[1200px] mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                <div class="card-neutral bg-white p-6 md:p-8 rounded-xl border border-[#f2f2f3] shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 md:w-12 md:h-12 mb-3 md:mb-4 text-[#17191c]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-[18px] md:text-[20px] font-semibold text-[#17191c] mb-2">Transparan</h3>
                    <p class="text-[13px] md:text-[14px] text-[#45474a]">Setiap transaksi tercatat dengan presisi editorial, memberikan kepercayaan penuh kepada pengurus.</p>
                </div>

                <div class="card-neutral bg-white p-6 md:p-8 rounded-xl border border-[#f2f2f3] shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 md:w-12 md:h-12 mb-3 md:mb-4 text-[#17191c]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-[18px] md:text-[20px] font-semibold text-[#17191c] mb-2">Real-time</h3>
                    <p class="text-[13px] md:text-[14px] text-[#45474a]">Pantau arus kas masuk dan keluar secara langsung tanpa rekapitulasi manual.</p>
                </div>

                <div class="card-neutral bg-white p-6 md:p-8 rounded-xl border border-[#f2f2f3] shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 md:w-12 md:h-12 mb-3 md:mb-4 text-[#17191c]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-[18px] md:text-[20px] font-semibold text-[#17191c] mb-2">Terpusat</h3>
                    <p class="text-[13px] md:text-[14px] text-[#45474a]">Satu platform untuk seluruh anggota dan bendahara dalam mengelola keuangan organisasi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-12 md:py-20 lg:py-24 bg-[#17191c] text-white text-center relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-4 md:px-6 relative z-10">
            <h2 class="font-display text-[28px] md:text-[36px] lg:text-[44px] font-bold leading-tight mb-6 md:mb-8">
                Siap Wujudkan Keuangan Organisasi yang Transparan?
            </h2>
            <p class="font-subheading text-base md:text-lg opacity-70 mb-8 md:mb-12">
                Platform ini dirancang untuk memastikan seluruh pendataan anggota dan riwayat transaksi kas tercatat dengan presisi, rapi, dan dapat diakses bersama secara terbuka.
            </p>
            <a href="{{ route('member.register') }}" class="inline-flex items-center gap-2 bg-white text-[#17191c] px-8 md:px-12 py-4 md:py-5 rounded-full font-medium text-base md:text-lg hover:scale-105 transition-transform">
                Daftar Sekarang
            </a>
        </div>
    </section>
</main>

{{-- Footer Responsif --}}
<footer class="w-full bg-[#ffffff] py-8 md:py-12 border-t border-[#f2f2f3]">
    <div class="max-w-[1200px] mx-auto px-4 md:px-6 flex flex-col md:flex-row justify-between items-center gap-4 md:gap-5">
        <div class="text-[12px] md:text-[13px] text-[#979799] text-center md:text-left">© 2026 IPJ Finance. Integritas Intelektual dalam Tata Kelola.</div>
        <div class="flex gap-6 md:gap-8">
            <a href="#" class="text-[12px] md:text-[13px] text-[#979799] hover:text-[#17191c] transition-colors">Privacy</a>
            <a href="#" class="text-[12px] md:text-[13px] text-[#979799] hover:text-[#17191c] transition-colors">Terms</a>
            <a href="#" class="text-[12px] md:text-[13px] text-[#979799] hover:text-[#17191c] transition-colors">Support</a>
        </div>
    </div>
</footer>

{{-- Hidden Admin Access Modal --}}
<div id="admin-access-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-white/95 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-8 md:p-12 shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-[#e6d8dc] rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-[#4a2c3a] text-[32px]">admin_panel_settings</span>
            </div>
            <h3 class="font-display text-[24px] md:text-[28px] font-bold text-[#17191c] mb-4">Akses Administrator</h3>
            <p class="text-[14px] md:text-[15px] text-[#45474a] mb-8">
                Anda telah mengaktifkan mode akses administrator. Silakan masukkan kredensial bendahara untuk melanjutkan.
            </p>
            <div class="flex flex-col gap-4">
                <a href="{{ route('admin.login') }}" class="btn-primary w-full bg-[#17191c] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#2a2d32] transition-colors">
                    Lanjutkan ke Login Admin
                </a>
                <button onclick="closeAdminModal()" class="btn-ghost w-full px-6 py-3 rounded-lg font-medium text-[#45474a] hover:bg-[#fafafb] transition-colors">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Landing page mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('landing-menu-btn');
        const mobileMenu = document.getElementById('landing-mobile-menu');
        
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
            
            // Close menu on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        }
    });

    // Triple Click Admin Access Implementation
    (function() {
        let clickCount = 0;
        let clickTimer = null;
        const CLICK_THRESHOLD = 3;
        const CLICK_TIMEOUT = 1000; // 1 second to complete triple click
        
        const logo = document.getElementById('admin-access-logo');
        const modal = document.getElementById('admin-access-modal');
        
        // Create progress indicator
        const progressIndicator = document.createElement('div');
        progressIndicator.className = 'click-progress';
        for (let i = 0; i < CLICK_THRESHOLD; i++) {
            const dot = document.createElement('div');
            dot.className = 'click-dot';
            progressIndicator.appendChild(dot);
        }
        document.body.appendChild(progressIndicator);
        
        function updateProgress() {
            const dots = progressIndicator.querySelectorAll('.click-dot');
            dots.forEach((dot, index) => {
                if (index < clickCount) {
                    dot.classList.add('filled');
                } else {
                    dot.classList.remove('filled');
                }
            });
            
            if (clickCount > 0) {
                progressIndicator.classList.add('active');
            } else {
                progressIndicator.classList.remove('active');
            }
        }
        
        function resetClicks() {
            clickCount = 0;
            updateProgress();
        }
        
        if (logo) {
            logo.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Add visual feedback
                this.classList.add('logo-clicked');
                setTimeout(() => this.classList.remove('logo-clicked'), 300);
                
                clickCount++;
                updateProgress();
                
                // Clear existing timer
                if (clickTimer) {
                    clearTimeout(clickTimer);
                }
                
                // Check if threshold reached
                if (clickCount >= CLICK_THRESHOLD) {
                    // Show modal
                    setTimeout(() => {
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                        }
                        resetClicks();
                    }, 300);
                    return;
                }
                
                // Set timer to reset if no more clicks
                clickTimer = setTimeout(() => {
                    resetClicks();
                }, CLICK_TIMEOUT);
            });
        }
        
        // Close modal functions
        window.closeAdminModal = function() {
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        };
        
        if (modal) {
            // Close modal on outside click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeAdminModal();
                }
            });
        }
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeAdminModal();
            }
        });
    })();
</script>
@endpush

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(-6deg); }
    50% { transform: translateY(-20px) rotate(-4deg); }
}
@keyframes float-delayed {
    0%, 100% { transform: translateY(0px) rotate(3deg); }
    50% { transform: translateY(-15px) rotate(1deg); }
}
@keyframes draw {
    to { stroke-dashoffset: 0; }
}
.animate-float {
    animation: float 6s ease-in-out infinite;
}
.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
    animation-delay: 1s;
}
.path-draw {
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
    animation: draw 3s ease-out forwards;
}

/* Logo click feedback animation */
@keyframes logo-pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}
.logo-clicked {
    animation: logo-pulse 0.3s ease-in-out;
}

/* Progress indicator for triple click */
.click-progress {
    position: fixed;
    top: 20px;
    right: 20px;
    display: flex;
    gap: 4px;
    z-index: 9999;
    opacity: 0;
    transition: opacity 0.3s;
}
.click-progress.active {
    opacity: 1;
}
.click-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #e6d8dc;
    transition: background 0.3s;
}
.click-dot.filled {
    background: #4a2c3a;
}
</style>
@endsection