<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceMutation;
use App\Models\FundRequest;
use App\Models\Member;
use App\Models\OrganizationBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Statistik utama
        $totalAnggota = Member::where('status_aktif', true)->count();
        $pengajuanPending = FundRequest::where('status', 'Pending')->count();
        $saldoKas = OrganizationBalance::getSaldoKas();
        $saldoBank = OrganizationBalance::getSaldoBank();

        // Total mutasi bulan ini (outflow)
        $mutasiBulanIni = BalanceMutation::where('jenis_mutasi', 'Outflow')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('nominal');

        // Data grafik arus kas 6 bulan terakhir
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $inflow = BalanceMutation::where('jenis_mutasi', 'Inflow')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('nominal');
            $outflow = BalanceMutation::where('jenis_mutasi', 'Outflow')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('nominal');
            $chartData[] = [
                'label' => $date->format('M'),
                'inflow' => (float) $inflow,
                'outflow' => (float) $outflow,
            ];
        }

        // Antrean persetujuan terbaru (5 teratas)
        $antreanPersetujuan = FundRequest::with('member')
            ->where('status', 'Pending')
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'admin',
            'totalAnggota',
            'pengajuanPending',
            'saldoKas',
            'saldoBank',
            'mutasiBulanIni',
            'chartData',
            'antreanPersetujuan'
        ));
    }
}