<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        
        // Ambil log aktivitas 30 hari terakhir
        $activityLogs = BalanceMutation::with(['admin', 'request.member'])
            ->where('admin_id', $admin->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.profil.index', compact('admin', 'activityLogs'));
    }

    /**
     * Update profil admin
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'no_telepon' => 'nullable|string|max:20',
            'lokasi_kantor' => 'nullable|string|max:255',
        ]);

        $admin->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        // Verifikasi password lama
        if (!Hash::check($validated['current_password'], $admin->password_hash)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.']);
        }

        $admin->update([
            'password_hash' => Hash::make($validated['new_password']),
        ]);

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }

    /**
     * Update avatar
     */
    public function updateAvatar(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::guard('admin')->user();

        // Hapus avatar lama jika ada
        if ($admin->avatar_path) {
            Storage::disk('public')->delete($admin->avatar_path);
        }

        // Simpan avatar baru
        $path = $request->file('avatar')->store('avatars/admins', 'public');

        $admin->update([
            'avatar_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    /**
     * Hapus avatar
     */
    public function removeAvatar()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->avatar_path) {
            Storage::disk('public')->delete($admin->avatar_path);
            $admin->update(['avatar_path' => null]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus!');
    }

    /**
     * Download laporan audit PDF
     */
    public function downloadAuditReport()
    {
        $admin = Auth::guard('admin')->user();
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $mutations = BalanceMutation::with(['admin', 'request.member'])
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalInflow = $mutations->where('jenis_mutasi', 'Inflow')->sum('nominal');
        $totalOutflow = $mutations->where('jenis_mutasi', 'Outflow')->sum('nominal');
        $totalTransactions = $mutations->count();

        // Jika DomPDF terinstall
        if (class_exists('\\Barryvdh\\DomPDF\\Facade\\Pdf')) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.profil.audit-report', compact(
                'mutations', 'admin', 'startDate', 'endDate',
                'totalInflow', 'totalOutflow', 'totalTransactions'
            ));

            $filename = 'Laporan_Audit_' . $admin->nama_lengkap . '_' . 
                        $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.pdf';

            return $pdf->download($filename);
        }

        // Fallback: download sebagai HTML
        return response()->view('admin.profil.audit-report', compact(
            'mutations', 'admin', 'startDate', 'endDate',
            'totalInflow', 'totalOutflow', 'totalTransactions'
        ));
    }

    /**
     * Download laporan audit CSV
     */
    public function downloadAuditReportCSV()
    {
        $admin = Auth::guard('admin')->user();
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $mutations = BalanceMutation::with(['admin', 'request.member'])
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'Laporan_Audit_' . $admin->nama_lengkap . '_' . 
                    $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.csv';

        $headers = [
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($mutations) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'Tanggal', 'Waktu', 'Admin', 'Jenis Mutasi', 'Sumber Saldo',
                'Nominal', 'Saldo Sebelum', 'Saldo Sesudah', 'Keterangan', 'ID Pengajuan', 'Pemohon'
            ]);

            foreach ($mutations as $mutation) {
                fputcsv($file, [
                    $mutation->created_at->format('Y-m-d'),
                    $mutation->created_at->format('H:i:s'),
                    $mutation->admin->nama_lengkap ?? 'N/A',
                    $mutation->jenis_mutasi,
                    $mutation->sumber_saldo,
                    $mutation->nominal,
                    $mutation->saldo_sebelum,
                    $mutation->saldo_sesudah,
                    $mutation->catatan ?? '',
                    $mutation->request_id ? '#REQ-' . str_pad($mutation->request_id, 5, '0', STR_PAD_LEFT) : 'N/A',
                    $mutation->request->member->nama_lengkap ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}