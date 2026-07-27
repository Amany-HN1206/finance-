<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $member = Auth::guard('member')->user();

        $query = FundRequest::where('member_id', $member->id)
            ->with('attachments');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('q')) {
            $query->where('keterangan_rincian', 'like', '%' . $request->q . '%');
        }

        $pengajuans = $query->orderByDesc('created_at')->paginate(10);

        // Statistik
        $stats = [
            'total' => FundRequest::where('member_id', $member->id)->count(),
            'pending' => FundRequest::where('member_id', $member->id)->where('status', 'Pending')->count(),
            'approved' => FundRequest::where('member_id', $member->id)->where('status', 'Approved')->count(),
            'rejected' => FundRequest::where('member_id', $member->id)->where('status', 'Rejected')->count(),
            'total_nominal_approved' => FundRequest::where('member_id', $member->id)
                ->where('status', 'Approved')
                ->sum('nominal'),
        ];

        return view('member.riwayat.index', compact('pengajuans', 'stats'));
    }

    public function show($id)
    {
        $member = Auth::guard('member')->user();
        $pengajuan = FundRequest::where('member_id', $member->id)
            ->with(['attachments', 'approver'])
            ->findOrFail($id);

        return view('member.riwayat.show', compact('pengajuan'));
    }
}