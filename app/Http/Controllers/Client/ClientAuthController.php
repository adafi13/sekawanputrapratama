<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    /**
     * Show client portal login form.
     */
    public function showLogin()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('client.dashboard');
        }

        return view('client.auth.login');
    }

    /**
     * Handle client portal login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        // Check if customer exists and portal is active
        $customer = \App\Models\Customer::where('email', strtolower(trim($credentials['email'])))->first();

        if (!$customer) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Email ini belum terdaftar sebagai akun klien.',
            ]);
        }

        if (empty($customer->password)) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Akun klien Anda belum memiliki password portal. Silakan hubungi tim support Sekawan Putra Pratama.',
            ]);
        }

        if (!$customer->is_portal_active) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Akun portal Anda saat ini dalam status non-aktif. Silakan hubungi admin Sekawan Putra Pratama.',
            ]);
        }

        if (Auth::guard('customer')->attempt([
            'email' => strtolower(trim($credentials['email'])),
            'password' => $credentials['password'],
        ], $remember)) {
            $request->session()->regenerate();

            // Update last login timestamp
            $customer->update(['last_login_at' => now()]);

            return redirect()->intended(route('client.dashboard'));
        }

        return back()->withInput($request->only('email'))->withErrors([
            'password' => 'Password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Handle client portal logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login')->with('success', 'Anda telah berhasil keluar dari Client Portal.');
    }
}
