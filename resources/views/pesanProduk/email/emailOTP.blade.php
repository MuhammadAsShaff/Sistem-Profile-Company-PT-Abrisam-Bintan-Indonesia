<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verifikasi</title>
    <!-- Link ke Google Fonts untuk menggunakan font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .header img {
            width: 100px;
        }

        .main-content {
            padding: 20px;
        }

        .main-content h2 {
            color: #333333;
            margin: 0;
            font-weight: 600;
        }

        .main-content p {
            color: #555555;
            line-height: 1.5;
            margin: 10px 0;
            font-weight: 400;
        }

        .main-content .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #e3342f;
            padding: 10px;
            background-color: #f0f0f0;
            text-align: center;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="https://via.placeholder.com/100" alt="Logo" />
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Verifikasi OTP untuk Akun Anda</h2>
            <p>Halo,</p>
            <p>Untuk melanjutkan proses verifikasi, kami mengirimkan kode OTP yang dapat Anda gunakan untuk melanjutkan.</p>

            <!-- OTP Code -->
            <div class="otp-code">
                {{ $otp }}
            </div>

            <p>Masukkan kode di atas pada halaman verifikasi untuk melanjutkan.</p>

            <p>Jika Anda tidak merasa melakukan permintaan verifikasi ini, Anda dapat mengabaikan email ini.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT Abrisam Bintan Indonesia. Semua hak dilindungi.</p>
        </div>
    </div>
</body>

</html>
