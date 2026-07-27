<?php

use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Member\DashboardController as MemberDashboard;
use App\Http\Controllers\Member\FundRequestController;
use App\Http\Controllers\Member\HistoryController;
use App\Http\Controllers\Member\ProfileController as MemberProfile;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\MemberManagementController;
use App\Http\Controllers\Admin\MutationController;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('public.landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Member Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('member')->name('member.')->group(function () {
    Route::middleware('guest:member')->group(function () {
        Route::get('/login', [MemberAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [MemberAuthController::class, 'login']);
        Route::get('/register', [MemberAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [MemberAuthController::class, 'register']);
    });

    Route::middleware('role.member')->group(function () {
        Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('dashboard');
        Route::get('/pengajuan/baru', [FundRequestController::class, 'create'])->name('pengajuan.baru');
        Route::post('/pengajuan', [FundRequestController::class, 'store'])->name('pengajuan.store');
        Route::get('/riwayat', [HistoryController::class, 'index'])->name('riwayat');
        Route::get('/riwayat/{id}', [HistoryController::class, 'show'])->name('riwayat.show');
        
        // Member Profile routes
        Route::get('/profil', [MemberProfile::class, 'edit'])->name('profil');
        Route::put('/profil', [MemberProfile::class, 'update'])->name('profil.update');
        Route::post('/profil/change-password', [MemberProfile::class, 'changePassword'])->name('profil.change-password');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (Hidden / Portal)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/portal')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AdminAuthController::class, 'register']);
    });

    Route::middleware('role.admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/persetujuan', [ApprovalController::class, 'index'])->name('persetujuan');
        Route::get('/persetujuan/{id}', [ApprovalController::class, 'show'])->name('persetujuan.show');
        Route::post('/persetujuan/{id}/approve', [ApprovalController::class, 'approve'])->name('persetujuan.approve');
        Route::post('/persetujuan/{id}/reject', [ApprovalController::class, 'reject'])->name('persetujuan.reject');
        Route::resource('/anggota', MemberManagementController::class)->except(['show']);
        Route::get('/mutasi', [MutationController::class, 'index'])->name('mutasi');
        
        // ✅ Admin Profile routes - SEMUA MENGGUNAKAN POST
        Route::get('/profil', [AdminProfile::class, 'index'])->name('profil');
        Route::post('/profil/update', [AdminProfile::class, 'update'])->name('profil.update');
        Route::post('/profil/update-password', [AdminProfile::class, 'updatePassword'])->name('profil.update-password');
        Route::post('/profil/update-avatar', [AdminProfile::class, 'updateAvatar'])->name('profil.update-avatar');
        Route::post('/profil/remove-avatar', [AdminProfile::class, 'removeAvatar'])->name('profil.remove-avatar');
        
        // ✅ Opsional: Download routes (tetap menggunakan GET)
        Route::get('/profil/download-audit', [AdminProfile::class, 'downloadAuditReport'])->name('profil.download-audit');
        Route::get('/profil/download-audit-csv', [AdminProfile::class, 'downloadAuditReportCSV'])->name('profil.download-audit-csv');
    });
});