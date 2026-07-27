<?php
// app/Http/Controllers/Auth/MemberAuthController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberAuthController extends Controller
{
    public function showLogin()
    {
        return view('public.auth.member-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('member')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('member.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('public.auth.member-register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:50', 'unique:members,nim_or_id_anggota'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        $member = Member::create([
            'nim_or_id_anggota' => $validated['nim'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'jabatan_organisasi' => $validated['jabatan'] ?? null,
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        Auth::guard('member')->login($member);

        return redirect()->route('member.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
}