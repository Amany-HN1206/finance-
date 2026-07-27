<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%')
                  ->orWhere('jabatan_organisasi', 'like', '%' . $request->q . '%');
            });
        }

        $members = $query->orderBy('created_at', 'desc')->paginate(10);
        $stats = [
            'total' => Member::count(),
            'aktif' => Member::where('status_aktif', true)->count(),
        ];

        return view('admin.anggota.index', compact('members', 'stats'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim_or_id_anggota' => ['required', 'string', 'max:50', 'unique:members'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8'],
            'jabatan_organisasi' => ['nullable', 'string', 'max:100'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        Member::create([
            'nim_or_id_anggota' => $validated['nim_or_id_anggota'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'jabatan_organisasi' => $validated['jabatan_organisasi'] ?? null,
            'no_telepon' => $validated['no_telepon'] ?? null,
            'status_aktif' => true,
        ]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.anggota.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jabatan_organisasi' => ['nullable', 'string', 'max:100'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'status_aktif' => ['required', 'boolean'],
        ]);

        $member->update($validated);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus secara permanen.');
    }
}