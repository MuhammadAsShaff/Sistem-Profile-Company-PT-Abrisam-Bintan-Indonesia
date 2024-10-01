<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Link ke Google Fonts untuk menggunakan font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        body {
            font-family: 'Poppins';
            /* Ubah font menjadi Poppins */
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
            /* Ubah ketebalan font */
        }

        .main-content p {
            color: #555555;
            line-height: 1.5;
            margin: 10px 0;
            font-weight: 400;
            /* Ubah ketebalan font */
        }

        .main-content .btn {
            display: inline-block;
            background-color: #e3342f;
            /* Ubah warna background menjadi merah */
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: 600;
            /* Ubah ketebalan font */
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777777;
            border-top: 1px solid #dddddd;
            font-weight: 400;
            /* Ubah ketebalan font */
        }

        .footer a {
            color: #e3342f;
            /* Ubah warna link menjadi merah */
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <!-- Main Content -->
        <div class="main-content">
            <h2>Hai, {{ $admin->nama_admin }}</h2>
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
            <p>Jika Anda merasa tidak pernah meminta reset password, abaikan saja email ini. Namun, jika memang Anda
                ingin melakukan reset password, silakan klik tombol di bawah ini:</p>
            <a href="{{ url('reset-password/' . $token) }}" class="btn">Reset Password Anda</a>

            <p>Jika tombol di atas tidak berfungsi, Anda juga dapat menyalin dan menempelkan tautan berikut ke peramban
                Anda:</p>

            <p>Terima kasih,<br>Tim PT Abrisam Bintan Indonesia</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                Email ini dikirim ke <a href="mailto:{{ $admin->email_admin }}">{{ $admin->email_admin }}</a>.
                Jika Anda tidak ingin menerima email seperti ini lagi, Anda dapat menghapus akun Anda.
            </p>
            <p>© 2024 PT Abrisam Bintan Indonesia. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>