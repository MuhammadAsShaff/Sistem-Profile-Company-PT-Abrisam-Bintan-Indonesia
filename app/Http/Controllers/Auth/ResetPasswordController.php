<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ResetPasswordController extends Controller
{
    use ValidatesRequests;

    public function showLinkRequestForm()
    {
        $admin = Admin::first(); // Ambil admin pertama atau sesuaikan query Anda
        return view('auth.forgot-password', ['admin' => $admin]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email_admin' => 'required|email|exists:admins,email_admin'
        ]);

        $email = $request->email_admin;
        $token = Str::random(60);

        // Hapus entri sebelumnya jika ada
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Masukkan entri baru
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Kirim email dengan token
        Mail::send('auth.emails.reset-password', ['token' => $token, 'admin' => Admin::where('email_admin', $email)->first()], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password');
        });

        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }

    public function showResetForm($token)
    {
        // Cek apakah token masih valid
        $resetToken = DB::table('password_reset_tokens')->where('token', $token)->first();

        // Jika token tidak valid atau tidak ditemukan
        if (!$resetToken) {
            return redirect()->route('password.request')->withErrors(['token' => 'Link reset password tidak valid atau sudah pernah digunakan.']);
        }

        // Jika token valid, tampilkan halaman reset password
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'token' => 'required',
            'email_admin' => 'required|email|exists:admins,email_admin',
            'password' => 'required|confirmed|min:8',
        ]);

        // Cari token di database
        $resetToken = DB::table('password_reset_tokens')->where('email', $request->email_admin)->where('token', $request->token)->first();

        // Jika token tidak ditemukan atau sudah pernah digunakan
        if (!$resetToken) {
            return back()->withErrors(['token' => 'Link reset password tidak valid atau sudah pernah digunakan.']);
        }

        // Temukan admin berdasarkan email
        $admin = Admin::where('email_admin', $request->email_admin)->first();
        if (!$admin) {
            return back()->withErrors(['email_admin' => 'Email tidak terdaftar.']);
        }

        // Update password admin
        $admin->password = bcrypt($request->password);
        $admin->save();

        // Hapus entri reset password dari database (agar tidak bisa digunakan lagi)
        DB::table('password_reset_tokens')->where('email', $request->email_admin)->delete();

        // Periksa apakah pengguna sudah login
        if (Auth::guard('admin')->check()) {
            // Jika pengguna sudah login, arahkan ke halaman dashboard
            return redirect()->route('dashboard.dashboard.index')->with('status', 'Password berhasil direset dan Anda sudah login.');
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('admin.login')->with('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');
        }
    }

    public function showSuccessPage()
    {
        return view('auth.finish');
    }
}
