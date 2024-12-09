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
  <!-- Navbar -->
  @include('landingPage.navbar')

  <!-- Main Container -->
  <div class="w-screen mx-0">
    <!-- Main Content Area -->
    <div class="py-12">
      <div class="w-screen mt-[40px]">
        <!-- Slider Content -->
        @include('landingPage.content.slider')
        @include('landingPage.content.transisi')
        @include('landingPage.content.paketInternet')
        @include('landingPage.content.blogTerbaru')
        @include('landingPage.content.kategoriProduk')
        @include('landingPage.content.hubungiKami')
      </div>
    </div>

    <!-- Footer Section -->
    <footer class="text-white py-6 ">
        @include('landingPage.footer')
    </footer>
  </div>

  <!-- Vite JS -->
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
