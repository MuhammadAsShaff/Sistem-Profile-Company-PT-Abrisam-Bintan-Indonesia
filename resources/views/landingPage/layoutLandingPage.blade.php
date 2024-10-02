<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Vite Tailwind CSS -->
  @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-gray-100 text-gray-900">

  <!-- Main Container -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Main Content Area -->
    <div class="py-12">
      @include('landingPage.content.slider')
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