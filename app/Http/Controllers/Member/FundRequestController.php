<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\FundRequest;
use App\Models\OrganizationBalance;
use App\Models\RequestAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FundRequestController extends Controller
{
    public function create()
    {
        $saldoKas = OrganizationBalance::getSaldoKas();
        return view('member.pengajuan.create', compact('saldoKas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_dana' => ['required', 'in:Kas,Operasional,Konsumsi,Lainnya'],
            'nominal' => ['required', 'numeric', 'min:1000'],
            'keterangan_rincian' => ['required', 'string', 'max:1000'],
            'metode_pencairan' => ['required', 'in:Cash,Transfer'],
            'lampiran' => ['nullable', 'array', 'max:5'],
            'lampiran.*' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // 5MB
        ]);

        $member = Auth::guard('member')->user();

        // Buat FundRequest
        $fundRequest = FundRequest::create([
            'member_id' => $member->id,
            'kategori_dana' => $validated['kategori_dana'],
            'nominal' => $validated['nominal'],
            'keterangan_rincian' => $validated['keterangan_rincian'],
            'metode_pencairan' => $validated['metode_pencairan'],
            'status' => 'Pending',
        ]);

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $path = $file->store('lampiran-pengajuan/' . $fundRequest->id, 'public');
                RequestAttachment::create([
                    'request_id' => $fundRequest->id,
                    'file_path_url' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'uploaded_at' => now(),
                ]);
            }
        }

        return redirect()
            ->route('member.riwayat')
            ->with('success', 'Pengajuan dana berhasil dikirim dan sedang menunggu verifikasi bendahara.');
    }
}