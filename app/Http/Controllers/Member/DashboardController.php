<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\FundRequest;
use App\Models\OrganizationBalance;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $member = Auth::guard('member')->user();

        // Greeting berdasarkan waktu
        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 11 => 'pagi',
            $hour < 15 => 'siang',
            $hour < 18 => 'sore',
            default => 'malam',
        };

        // ✅ PERBAIKAN: Ambil SEMUA jenis saldo
        $saldoKas = OrganizationBalance::getSaldoKas();
        $saldoBank = OrganizationBalance::getSaldoBank();
        $saldoTotal = $saldoKas + $saldoBank;

        // Pengajuan aktif milik anggota (Pending & Approved terbaru)
        $pengajuanAktif = FundRequest::where('member_id', $member->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        // Aktivitas terbaru (semua status)
        $aktivitasTerbaru = FundRequest::where('member_id', $member->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Statistik pengajuan
        $statsPengajuan = [
            'pending' => FundRequest::where('member_id', $member->id)->where('status', 'Pending')->count(),
            'approved' => FundRequest::where('member_id', $member->id)->where('status', 'Approved')->count(),
            'rejected' => FundRequest::where('member_id', $member->id)->where('status', 'Rejected')->count(),
        ];

        return view('member.dashboard', compact(
            'greeting',
            'saldoKas',
            'saldoBank',
            'saldoTotal',
            'pengajuanAktif',
            'aktivitasTerbaru',
            'statsPengajuan'
        ));
    }
}