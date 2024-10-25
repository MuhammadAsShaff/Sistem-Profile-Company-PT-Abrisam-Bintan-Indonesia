<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Google\Client as GoogleClient;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

class GmailController extends Controller
{
    public function sendEmailWithGmailApi()
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
                return redirect($client->createAuthUrl());
            }
        }

        // Gmail Service
        $gmail = new Gmail($client);
        $message = new Message();
        $rawMessage = $this->createMimeMessage("m.assohff@gmail.com", "subject", "Body message here");
        $message->setRaw($rawMessage);

        try {
            $gmail->users_messages->send('me', $message);
            return 'Email berhasil dikirim!';
        } catch (\Exception $e) {
            return 'Gagal mengirim email: ' . $e->getMessage();
        }
    }

    private function createMimeMessage($to, $subject, $messageText)
    {
        $rawMessageString = "From: " . env('MAIL_FROM_ADDRESS') . "\r\n";
        $rawMessageString .= "To: $to\r\n";
        $rawMessageString .= "Subject: $subject\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= "Content-Type: text/plain; charset=utf-8\r\n";
        $rawMessageString .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $rawMessageString .= "$messageText";

        return rtrim(strtr(base64_encode($rawMessageString), '+/', '-_'), '=');
    }

  public function handleGoogleCallback(Request $request)
  {
    $client = new GoogleClient();
    $client->setAuthConfig(storage_path('app/google/credentials.json'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

    $authCode = $request->input('code');
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

    if (isset($accessToken['error'])) {
      return redirect('/')->withErrors('Failed to authenticate.');
    }

    // Simpan token
    $refreshToken = $client->getRefreshToken();
    if ($refreshToken) {
      file_put_contents(storage_path('app/google/token.json'), json_encode($client->getAccessToken()));
      return redirect('/')->with('status', 'Berhasil autentikasi! Silahkan kirim email.');
    }

    return redirect('/')->withErrors('Tidak ada refresh token yang ditemukan.');
  }

}
