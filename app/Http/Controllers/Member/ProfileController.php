<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $member = Auth::guard('member')->user();
        return view('member.profil.edit', compact('member'));
    }

    public function update(Request $request)
    {
        $member = Auth::guard('member')->user();

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'jabatan_organisasi' => ['nullable', 'string', 'max:100'],
            'password_lama' => ['nullable', 'required_with:password_baru'],
            'password_baru' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Verifikasi password lama jika ingin ganti password
        if (!empty($validated['password_lama'])) {
            if (!Hash::check($validated['password_lama'], $member->password_hash)) {
                return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
            }
            $member->password_hash = Hash::make($validated['password_baru']);
        }

        $member->nama_lengkap = $validated['nama_lengkap'];
        $member->no_telepon = $validated['no_telepon'] ?? $member->no_telepon;
        $member->jabatan_organisasi = $validated['jabatan_organisasi'] ?? $member->jabatan_organisasi;
        $member->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}