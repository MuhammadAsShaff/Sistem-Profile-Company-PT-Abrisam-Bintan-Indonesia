<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin;
use Google\Client as GoogleClient;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

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
        // Validasi email menggunakan $request->validate()
        $request->validate([
            'email_admin' => 'required|email|exists:admins,email_admin'
        ]);

        $email = $request->email_admin;
        $token = Str::random(60);

        // Hapus entri token sebelumnya
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Masukkan token baru
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Kirim email reset password menggunakan Gmail API
        try {
            $this->sendEmailWithGmailApi($email, $token);
            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withErrors(['email_admin' => 'Gagal mengirim email reset password.']);
        }
    }


    private function sendEmailWithGmailApi($to, $token)
    {
        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Gmail::MAIL_GOOGLE_COM);
        $client->setAccessType('offline');

        // Cek jika token sudah ada
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // Refresh token jika token expired
        if ($client->isAccessTokenExpired()) {
            $refreshToken = $client->getRefreshToken();
            if ($refreshToken) {
                $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
                file_put_contents($tokenPath, json_encode($accessToken));
            } else {
                throw new \Exception('Autentikasi gagal. Silahkan coba lagi.');
            }
        }

        // Gmail Service
        $gmail = new Gmail($client);
        $message = new Message();

        // Ambil data admin berdasarkan email
        $admin = Admin::where('email_admin', $to)->first();

        // Render template email ke dalam HTML dari Blade Template
        $htmlContent = view('auth.emails.reset-password', compact('admin', 'token'))->render();

        // Membuat MIME message dengan format HTML
        $subject = "Reset Password";
        $rawMessage = $this->createMimeMessage(env('MAIL_FROM_ADDRESS'), $to, $subject, $htmlContent, true);
        $message->setRaw($rawMessage);

        // Kirim email menggunakan Gmail API
        $gmail->users_messages->send('me', $message);

    }

    private function createMimeMessage($from, $to, $subject, $messageText, $isHtml = false)
    {
        $contentType = $isHtml ? 'text/html' : 'text/plain';
        $rawMessageString = "From: $from\r\n";
        $rawMessageString .= "To: $to\r\n";
        $rawMessageString .= "Subject: $subject\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= "Content-Type: $contentType; charset=utf-8\r\n";
        $rawMessageString .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $rawMessageString .= "$messageText";

        return rtrim(strtr(base64_encode($rawMessageString), '+/', '-_'), '=');
    }


    public function showResetForm($token)
    {
        // Cek validitas token
        $resetToken = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$resetToken) {
            return redirect()->route('password.request')->withErrors(['token' => 'Link reset password tidak valid atau sudah pernah digunakan.']);
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        // Validasi input
        $request->validate([
            'token' => 'required',
            'email_admin' => 'required|email|exists:admins,email_admin',
            'password' => 'required|confirmed|min:8',
        ]);

        // Cari token
        $resetToken = DB::table('password_reset_tokens')->where('email', $request->email_admin)->where('token', $request->token)->first();

        if (!$resetToken) {
            return back()->withErrors(['token' => 'Link reset password tidak valid atau sudah pernah digunakan.']);
        }

        // Cari admin berdasarkan email
        $admin = Admin::where('email_admin', $request->email_admin)->first();
        if (!$admin) {
            return back()->withErrors(['email_admin' => 'Email tidak terdaftar.']);
        }

        // Update password admin
        $admin->password = bcrypt($request->password);
        $admin->save();

        // Hapus token dari database
        DB::table('password_reset_tokens')->where('email', $request->email_admin)->delete();

        return redirect()->route('password.success')->with('status', 'Password berhasil direset.');
    }

    public function showSuccessPage()
    {
        return view('auth.finish');
    }
}
