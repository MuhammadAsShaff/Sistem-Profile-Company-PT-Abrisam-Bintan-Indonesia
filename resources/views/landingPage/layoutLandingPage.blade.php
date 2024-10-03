<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>

  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  
  <!-- Vite Tailwind CSS -->
  @vite('resources/css/app.css')
</head>
<body class="font-poppins bg-white text-gray-900 overflow-x-hidden"> <!-- Tambahkan overflow-x-hidden untuk mencegah scroll horizontal -->
  @include('landingPage.navbar')
  <!-- Main Container -->
  <div class="w-screen mx-0"> <!-- Menggunakan w-screen untuk lebar penuh dan mx-0 untuk margin 0 -->
    <!-- Main Content Area -->
    <div class="py-12">
      <div class="w-screen"> <!-- Container slider dengan lebar penuh -->
        @include('landingPage.content.slider')
      </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6">
      <div class="text-center">
        @include('landingPage.footer')
      </div>
    </footer>
  </div>

  <!-- Vite JS -->
  @vite('resources/js/app.js')
</body>
</html>
