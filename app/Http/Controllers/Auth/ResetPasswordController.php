<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin;
use GuzzleHttp\Client as HttpClient;

class ResetPasswordController extends Controller
{
    use ValidatesRequests;

    public function showLinkRequestForm()
    {
        $admin = Admin::first();
        return view('auth.forgot-password', ['admin' => $admin]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email_admin' => 'required|email|exists:admins,email_admin',
        ]);

        $email = $request->email_admin;
        $token = Str::random(60);

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        try {
            $this->sendEmailWithBrevoApi($email, $token);
            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withErrors(['email_admin' => 'Gagal mengirim email reset password.']);
        }
    }

    private function sendEmailWithBrevoApi($to, $token)
    {
        $admin = Admin::where('email_admin', $to)->first();
        $htmlContent = view('auth.emails.reset-password', compact('admin', 'token'))->render();

        // API key Brevo diambil dari .env
        $apiKey = env('BREVO_API_KEY');
        if (!$apiKey) {
            throw new \Exception('API key Brevo tidak ditemukan. Silahkan tambahkan di file .env');
        }

        $client = new HttpClient();

        // Request ke endpoint Brevo untuk mengirim email
        $response = $client->post('https://api.brevo.com/v3/smtp/email', [
            'headers' => [
                'accept' => 'application/json',
                'api-key' => $apiKey,
                'content-type' => 'application/json',
            ],
            'json' => [
                'sender' => [
                    'name' => env('MAIL_FROM_NAME', 'PT Abrisam Bintan Indonesia'),
                    'email' => env('MAIL_FROM_ADDRESS'),
                ],
                'to' => [
                    ['email' => $to, 'name' => $admin->name ?? 'User'],
                ],
                'subject' => 'Reset Password',
                'htmlContent' => $htmlContent,
            ],
        ]);

        // Periksa status response
        if ($response->getStatusCode() !== 201) {
            throw new \Exception('Gagal mengirim email melalui Brevo.');
        }
    }

    public function showResetForm($token)
    {
        $resetToken = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$resetToken) {
            return redirect()->route('password.request')->withErrors(['token' => 'Link reset password tidak valid atau sudah pernah digunakan.']);
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email_admin' => 'required|email|exists:admins,email_admin',
            'password' => 'required|confirmed|min:8',
        ]);

        $resetToken = DB::table('password_reset_tokens')->where('email', $request->email_admin)->where('token', $request->token)->first();

        if (!$resetToken) {
            return back()->withErrors(['token' => 'Link reset password tidak valid atau sudah pernah digunakan.']);
        }

        $admin = Admin::where('email_admin', $request->email_admin)->first();
        if (!$admin) {
            return back()->withErrors(['email_admin' => 'Email tidak terdaftar.']);
        }

        $admin->password = bcrypt($request->password);
        $admin->save();

        DB::table('password_reset_tokens')->where('email', $request->email_admin)->delete();

        return redirect()->route('password.success')->with('status', 'Password berhasil direset.');
    }

    public function showSuccessPage()
    {
        return view('auth.finish');
    }
}
