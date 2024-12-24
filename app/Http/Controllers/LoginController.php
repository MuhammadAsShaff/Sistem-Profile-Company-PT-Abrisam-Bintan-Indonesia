<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    /**
     * Menampilkan form login atau memproses login admin.
     */
    public function login(Request $request)
    {
        // Jika request adalah POST, proses login
        if ($request->isMethod('post')) {
            return $this->processLogin($request);
        }

        // Jika request adalah GET, tampilkan halaman login
        return view('login');
    }

    /**
     * Proses login admin.
     */
    protected function processLogin(Request $request)
    {
        // Validasi input untuk email dan password
        $request->validate([
            'email_admin' => 'required|email',
            'password' => 'required',
        ]);

        // Buat throttle key berdasarkan email dan IP untuk rate limiting
        $throttleKey = $request->email_admin . '|' . $request->ip();

        // Cek apakah sudah terlalu banyak percobaan login
        // Cek apakah sudah terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('warning', "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik.")
                ->with('seconds', $seconds);
        }


        // Cek kredensial login admin
        if (!Auth::guard('admin')->attempt(['email_admin' => $request->input('email_admin'), 'password' => $request->input('password')])) {
            RateLimiter::hit($throttleKey); // Tambahkan hit pada rate limiter
            return back()->withErrors(['login' => 'Email atau password yang Anda masukkan salah.']);
        }

        // Ambil admin yang sedang login dan perbarui status jika perlu
        $admin = Auth::guard('admin')->user();
        if ($admin->status !== 'Online') {
            $admin->update(['status' => 'Online']);
        }

        // Bersihkan rate limiter setelah login berhasil
        RateLimiter::clear($throttleKey);

        // Redirect ke halaman dashboard
        return redirect()->intended('dashboard');
    }


    /**
     * Proses logout admin.
     */
    public function logout(Request $request)
    {
        // Ambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Cek apakah admin saat ini sedang login dan statusnya Online
        if ($admin && $admin->status === 'Online') {
            // Update status admin menjadi Offline
            $admin->update(['status' => 'Offline']);
        }

        // Hapus semua sesi yang terkait dengan admin ini dari tabel sessions
        \DB::table('sessions')->where('user_id', $admin->id)->delete();

        // Proses logout
        Auth::guard('admin')->logout();

        // Invalidasi dan flush semua data sesi untuk keamanan
        $request->session()->invalidate();
        $request->session()->flush();

        // Regenerate CSRF token untuk sesi yang baru
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect('/admin/login')->with('message', 'Anda telah berhasil logout.');
    }
}
