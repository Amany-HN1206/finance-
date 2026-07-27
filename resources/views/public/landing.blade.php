@extends('layouts.app')

@section('title', 'IPJ Finance — Kelola Keuangan Organisasi')

@section('content')
{{-- Navigation --}}
<nav class="fixed top-0 w-full z-50 bg-paper-white/80 backdrop-blur-md">
    <div class="h-20 max-w-[1200px] mx-auto px-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            {{-- Logo dengan Triple Click Access --}}
            <div id="admin-access-logo" class="cursor-pointer select-none" title="IPJ Finance">
                <div class="w-10 h-10 bg-ink-black rounded-full flex items-center justify-center transition-transform hover:scale-105">
                    <span class="text-paper-white font-display text-[14px]">IPJ</span>
                </div>
            </div>
            <span class="font-subheading text-ink-black tracking-tight font-medium uppercase text-label-sm">IPJ Finance</span>
        </div>
        
        <nav class="absolute left-1/2 -translate-x-1/2 flex items-center gap-10">
            <a href="#" class="nav-link-active">Home</a>
            <a href="{{ route('member.login') }}" class="nav-link">Login</a>
            <a href="{{ route('member.register') }}" class="nav-link">Register</a>
        </nav>
        
        <a href="{{ route('member.login') }}" class="btn-primary">Masuk</a>
    </div>
</nav>

<main class="pt-20">
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-paper-white py-16 md:py-24 lg:py-32">
        <div class="max-w-[1200px] mx-auto px-6 relative z-10 text-center">
            {{-- Floating Decorative Elements --}}
            <div class="absolute -left-12 top-20 hidden lg:block animate-float">
                <div class="bg-paper-white p-6 rounded-elevated shadow-subtle-3 w-72 transform -rotate-6 transition-transform hover:rotate-0 duration-700">
                    <div class="flex flex-col gap-4">
                        <span class="text-ash-gray font-label-sm uppercase tracking-widest">Saldo Bank</span>
                        <div class="text-heading-sm font-heading-sm text-ink-black">Rp 2.450.000.000</div>
                        <div class="space-y-3 mt-2">
                            <div class="flex items-center justify-between text-caption">
                                <span class="text-slate-gray">Spotify Sub</span>
                                <span class="text-error font-medium">-Rp 59.000</span>
                            </div>
                            <div class="flex items-center justify-between text-caption border-t border-mist-gray pt-2">
                                <span class="text-slate-gray">Salary Transfer</span>
                                <span class="text-ink-black font-medium">+Rp 50.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ✅ PERBAIKAN: Heading dengan ukuran responsif yang lebih kecil --}}
            <div class="max-w-4xl mx-auto space-y-6">
                <h1 class="font-display text-ink-black leading-tight" 
                    style="font-size: clamp(32px, 5vw, 64px); letter-spacing: -0.02em;">
                    Kelola Keuangan Organisasi Secara 
                    <span class="italic text-deep-plum">Terbuka dan Akuntabel.</span>
                </h1>
                
                <p class="font-subheading text-slate-gray max-w-2xl mx-auto text-lg md:text-xl">
                    Platform tata kelola keuangan internal yang transparan, aman, dan terpusat untuk organisasi modern.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="{{ route('member.register') }}" class="btn-primary">Mulai Sekarang</a>
                    <a href="#features" class="btn-ghost">Pelajari Fitur</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="bg-fog-white py-16 md:py-24">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card-neutral">
                    <div class="w-12 h-12 mb-4 text-ink-black">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-heading-sm text-ink-black mb-2">Transparan</h3>
                    <p class="text-caption text-slate-gray">Setiap transaksi tercatat dengan presisi editorial, memberikan kepercayaan penuh kepada pengurus.</p>
                </div>

                <div class="card-neutral">
                    <div class="w-12 h-12 mb-4 text-ink-black">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-heading-sm text-ink-black mb-2">Real-time</h3>
                    <p class="text-caption text-slate-gray">Pantau arus kas masuk dan keluar secara langsung tanpa rekapitulasi manual.</p>
                </div>

                <div class="card-neutral">
                    <div class="w-12 h-12 mb-4 text-ink-black">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-heading-sm text-ink-black mb-2">Terpusat</h3>
                    <p class="text-caption text-slate-gray">Satu platform untuk seluruh anggota dan bendahara dalam mengelola keuangan organisasi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 md:py-24 bg-ink-black text-paper-white text-center relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-6 relative z-10">
            <h2 class="font-display text-ink-black text-paper-white" 
                style="font-size: clamp(28px, 4vw, 48px); letter-spacing: -0.02em;">
                Siap Wujudkan Keuangan Organisasi yang Transparan?
            </h2>
            <p class="font-subheading text-subheading opacity-70 mt-4 mb-8 md:mb-12">
                Platform ini dirancang untuk memastikan seluruh pendataan anggota dan riwayat transaksi kas tercatat dengan presisi, rapi, dan dapat diakses bersama secara terbuka.
            </p>
            <a href="{{ route('member.register') }}" class="inline-flex items-center gap-2 bg-paper-white text-ink-black px-10 md:px-12 py-4 md:py-5 rounded-full font-medium text-body-lg hover:scale-105 transition-transform">
                Daftar Sekarang
            </a>
        </div>
        
        {{-- Decorative Background Elements --}}
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
    </section>
</main>

{{-- Footer --}}
<footer class="w-full bg-paper-white py-8 border-t border-mist-gray">
    <div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-caption text-ash-gray">© 2026 IPJ Finance. Integritas Intelektual dalam Tata Kelola.</div>
        <div class="flex gap-6">
            <a href="#" class="text-caption text-ash-gray hover:text-ink-black transition-colors">Privacy</a>
            <a href="#" class="text-caption text-ash-gray hover:text-ink-black transition-colors">Terms</a>
            <a href="#" class="text-caption text-ash-gray hover:text-ink-black transition-colors">Support</a>
        </div>
    </div>
</footer>

{{-- Hidden Admin Access Modal --}}
<div id="admin-access-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-paper-white/95 backdrop-blur-sm">
    <div class="bg-paper-white rounded-[32px] p-8 md:p-12 shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-dusty-mauve rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-deep-plum text-[32px]">admin_panel_settings</span>
            </div>
            <h3 class="font-display text-headline text-ink-black mb-4" style="font-size: clamp(24px, 3vw, 36px);">Akses Administrator</h3>
            <p class="text-body text-slate-gray mb-8">
                Anda telah mengaktifkan mode akses administrator. Silakan masukkan kredensial bendahara untuk melanjutkan.
            </p>
            <div class="flex flex-col gap-4">
                <a href="{{ route('admin.login') }}" class="btn-primary w-full justify-center">
                    Lanjutkan ke Login Admin
                </a>
                <button onclick="closeAdminModal()" class="btn-ghost w-full justify-center">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(-6deg); }
    50% { transform: translateY(-20px) rotate(-4deg); }
}
.animate-float {
    animation: float 6s ease-in-out infinite;
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

<script>
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
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                resetClicks();
            }, 300);
            return;
        }
        
        // Set timer to reset if no more clicks
        clickTimer = setTimeout(() => {
            resetClicks();
        }, CLICK_TIMEOUT);
    });
    
    // Close modal functions
    window.closeAdminModal = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };
    
    // Close modal on outside click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeAdminModal();
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeAdminModal();
        }
    });
})();
</script>
@endsection