<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Google\Client as GoogleClient;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Support\Str;

class OTPController extends Controller
{
    // Method untuk menyimpan data pengguna dan menyimpannya di cookies
    public function simpanDataDiri(Request $request)
    {
        // Ambil data dari inputan form
        $nik = $request->input('nik');
        $namaLengkap = $request->input('namaLengkap');
        $jenisKelamin = $request->input('jenisKelamin');
        $email = $request->input('email');
        $nomorHandphone = $request->input('nomorHandphone');
        $provinsi = $request->input('provinsi');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan');
        $kelurahan = $request->input('kelurahan');
        $kodepos = $request->input('kodepos');
        $idProduk = $request->input('idProduk');
        $alamat = $request->input('alamat');

        // Validasi jika data penting tidak ada
        if (!$nik || !$namaLengkap || !$email || !$nomorHandphone || !$alamat) {
            return redirect()->back()->withErrors('Data yang wajib diisi belum lengkap.');
        }

        // Mengemas data form ke dalam array
        $data = [
            'nik' => $nik,
            'namaLengkap' => $namaLengkap,
            'jenisKelamin' => $jenisKelamin,
            'email' => $email,
            'nomorHandphone' => $nomorHandphone,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'kodepos' => $kodepos,
            'idProduk' => $idProduk,
            'alamat' => $alamat,
        ];

        // Simpan data dalam cookies dengan waktu hidup 1 jam
        Cookie::queue('data', json_encode($data), 60);  // 60 menit = 1 jam

        return redirect()->route('sendOTP');  // Arahkan ke halaman pengiriman OTP
    }

    // Method untuk mengirim OTP ke email yang tersimpan di cookies
    public function sendOTP(Request $request)
    {
        // Ambil data dari cookies
        $data = json_decode($request->cookie('data'), true);

        // Cek apakah email ada di cookies
        $email = $data['email'] ?? null;

        if (!$email) {
            return redirect()->back()->withErrors('Email tidak ditemukan.');
        }

        // Generate OTP 4 digit
        $otp = rand(1000, 9999);

        // Simpan OTP di session
        Session::put('otp', $otp);

        // Kirim OTP ke email
        $this->sendEmailWithGmailApi($email, $otp);

        // Redirect ke halaman verifikasi OTP dengan pesan sukses
        return redirect()->route('verifikasiOTP')->with('success', 'OTP berhasil dikirim ke email!');
    }

    private function sendEmailWithGmailApi($to, $otp)
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
        $gmailService = new Gmail($client);
        $message = new Message();

        // Render template email ke dalam HTML dari Blade Template
        $htmlContent = view('pesanProduk.email.emailOTP', compact('otp'))->render();

        // Buat MIME message dengan format HTML
        $subject = "Verifikasi OTP Anda";
        $rawMessage = $this->createMimeMessage(env('MAIL_FROM_ADDRESS'), $to, $subject, $htmlContent, true);

        // Encode pesan menjadi base64url
        $rawMessageEncoded = rtrim(strtr(base64_encode($rawMessage), '+/', '-_'), '=');
        $message->setRaw($rawMessageEncoded);

        // Kirim email menggunakan Gmail API
        $gmailService->users_messages->send('me', $message);
    }

    // Membuat body untuk email yang berisi OTP
    private function createMimeMessage($from, $to, $subject, $message, $isHtml = false)
    {
        $fromName = env('MAIL_FROM_NAME', 'PT Abrisam Bintan Indonesia');

        // Menyertakan nama pengirim sebelum alamat email
        $from = $fromName . ' <' . $from . '>';
        
        $mime = "From: <$from>\r\n";
        $mime .= "To: <$to>\r\n";
        $mime .= "Subject: $subject\r\n";
        $mime .= "MIME-Version: 1.0\r\n";

        if ($isHtml) {
            $mime .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
        } else {
            $mime .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
        }

        $mime .= "$message\r\n";

        return $mime;
    }
}
