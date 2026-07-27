<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceMutation;
use App\Models\FundRequest;
use App\Models\OrganizationBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = FundRequest::with('member')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('keterangan_rincian', 'like', '%' . $request->q . '%')
                  ->orWhereHas('member', function ($m) use ($request) {
                      $m->where('nama_lengkap', 'like', '%' . $request->q . '%');
                  });
            });
        }

        $pengajuans = $query->paginate(10);

        $stats = [
            'pending' => FundRequest::where('status', 'Pending')->count(),
            'total_nilai_pending' => FundRequest::where('status', 'Pending')->sum('nominal'),
        ];

        return view('admin.persetujuan.index', compact('pengajuans', 'stats'));
    }

    public function show($id)
    {
        $pengajuan = FundRequest::with(['member', 'attachments', 'approver'])->findOrFail($id);
        $saldoKas = OrganizationBalance::getSaldoKas();
        $saldoBank = OrganizationBalance::getSaldoBank();

        return view('admin.persetujuan.show', compact('pengajuan', 'saldoKas', 'saldoBank'));
    }

    /**
     * Approve pengajuan — dengan logika Inflow (Kas) vs Outflow (Reimburse)
     */
    public function approve(Request $request, $id)
    {
        $pengajuan = FundRequest::findOrFail($id);

        if ($pengajuan->status !== 'Pending') {
            return back()->withErrors(['error' => 'Pengajuan ini sudah diproses.']);
        }

        // Tentukan sumber saldo berdasarkan metode pencairan
        $sumberSaldo = $pengajuan->metode_pencairan === 'Cash' ? 'Kas' : 'Bank';

        // 🔥 LOGIKA BARU: Tentukan jenis mutasi berdasarkan Kategori Dana
        // 'Kas' = Pemasukan (Inflow), Sisanya = Pengeluaran (Outflow)
        $jenisMutasi = $pengajuan->kategori_dana === 'Kas' ? 'Inflow' : 'Outflow';

        DB::transaction(function () use ($pengajuan, $sumberSaldo, $jenisMutasi) {
            $admin = Auth::guard('admin')->user();

            // Lock baris saldo untuk mencegah race condition
            $balance = OrganizationBalance::where('jenis_saldo', $sumberSaldo)
                ->lockForUpdate()
                ->first();

            if (!$balance) {
                throw new \Exception("Saldo {$sumberSaldo} tidak ditemukan di database.");
            }

            $saldoSebelum = $balance->nominal;
            $saldoSesudah = $saldoSebelum;

            // 🔥 Logika Pemotongan vs Penambahan Saldo
            if ($jenisMutasi === 'Outflow') {
                // Pengeluaran (Operasional, Konsumsi, Lainnya) -> Memotong Saldo
                if ($balance->nominal < $pengajuan->nominal) {
                    throw new \Exception("Saldo {$sumberSaldo} tidak mencukupi. Tersedia: Rp" . number_format($balance->nominal, 0, ',', '.'));
                }
                $balance->decrement('nominal', $pengajuan->nominal);
                $saldoSesudah = $saldoSebelum - $pengajuan->nominal;
            } else {
                // Pemasukan (Kas) -> Menambah Saldo
                $balance->increment('nominal', $pengajuan->nominal);
                $saldoSesudah = $saldoSebelum + $pengajuan->nominal;
            }

            $balance->terakhir_diperbarui_oleh = $admin->id;
            $balance->updated_at = now();
            $balance->save();

            // Update status pengajuan
            $pengajuan->status = 'Approved';
            $pengajuan->disetujui_oleh = $admin->id;
            $pengajuan->save();

            // Catat mutasi
            BalanceMutation::create([
                'request_id' => $pengajuan->id,
                'admin_id' => $admin->id,
                'jenis_mutasi' => $jenisMutasi, // Inflow atau Outflow
                'sumber_saldo' => $sumberSaldo,
                'nominal' => $pengajuan->nominal,
                'saldo_sebelum' => $saldoSebelum,
                'saldo_sesudah' => $saldoSesudah,
                'catatan' => 'Persetujuan ' . $jenisMutasi . ': ' . Str::limit($pengajuan->keterangan_rincian, 50),
                'created_at' => now(),
            ]);
        });

        return redirect()->route('admin.persetujuan')
            ->with('success', 'Pengajuan berhasil disetujui. Saldo ' . ($jenisMutasi === 'Outflow' ? 'dipotong' : 'ditambahkan') . ' secara otomatis.');
    }

    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'alasan_penolakan' => ['required', 'string', 'max:500'],
        ]);

        $pengajuan = FundRequest::findOrFail($id);

        if ($pengajuan->status !== 'Pending') {
            return back()->withErrors(['error' => 'Pengajuan ini sudah diproses.']);
        }

        $admin = Auth::guard('admin')->user();

        $pengajuan->status = 'Rejected';
        $pengajuan->disetujui_oleh = $admin->id;
        $pengajuan->alasan_penolakan = $validated['alasan_penolakan'];
        $pengajuan->save();

        return redirect()->route('admin.persetujuan')
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}