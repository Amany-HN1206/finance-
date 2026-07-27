<?php
// app/Http/Controllers/Auth/AdminAuthController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('public.auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial admin tidak valid.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        // Halaman register admin tersembunyi — hanya bisa diakses via URL khusus
        return view('public.auth.admin-register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'secret_key' => ['required', 'string'], // Kunci rahasia untuk registrasi admin
        ]);

        // Verifikasi secret key (konfigurasi di .env)
        if ($validated['secret_key'] !== config('app.admin_register_secret')) {
            return back()->withErrors(['secret_key' => 'Kunci registrasi tidak valid.']);
        }

        Admin::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'no_telepon' => $validated['no_telepon'] ?? null,
            'role' => 'bendahara',
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Akun admin berhasil dibuat. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // 3. Redirect langsung ke Landing Page
        return redirect()->route('landing');
    }
}