<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>PT Abrisam Bintan Indonesia</title>

  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Vite Tailwind CSS -->
  @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-white text-gray-900 overflow-x-hidden">
  @include('loading')
  <!-- Navbar -->
  @include('landingPage.navbar')

  <!-- Main Container -->
  <div class="w-screen mx-0">
    <!-- Main Content Area -->
    <div class="py-12">
      <div class="w-full mt-[40px]">
        <!-- Slider Content -->
        @include('landingPage.content.slider')
        @include('landingPage.content.transisi')
        @include('landingPage.content.paketInternet')
        @include('landingPage.content.kategoriProduk')
        @include('landingPage.content.kontakPerusahaan')
        @include('landingPage.content.blogTerbaru')
      </div>
    </div>

    <!-- Bubble Chat -->
  <a href="https://wa.me/6281370304777" target="_blank" class="fixed bottom-5 right-4 z-50 p-2">
    <div
      class="flex items-center justify-center w-16 h-16 bg-green-500 rounded-full shadow-lg hover:bg-green-600 transition duration-300">
      <i class="fab fa-whatsapp text-white text-3xl"></i>
    </div>
  </a>

    <!-- Footer Section -->
    <footer class="bg-gradient-to-r from-[#001a41] to-[#0e336c] text-gray-200 w-full">
      @include('landingPage.footer')
    </footer>
  </div>

  <!-- Vite JS -->
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>