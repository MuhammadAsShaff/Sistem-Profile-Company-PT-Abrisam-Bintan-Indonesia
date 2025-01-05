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
  <!-- Navbar (tetap sama) -->
  @include('landingPage.navbar')

  <div class="flex flex-col md:flex-row w-screen">
    <!-- Sidebar Filter Desktop -->
    <div class="hidden md:block md:w-1/5 p-4">
      @include('produk.filterSide')
    </div>

    

    <!-- Main Content Area -->
    <div class="md:w-4/5 py-12 px-4 mt-8">
      <!-- Filter Kategori Desktop -->
      <div class="hidden md:block">
        @include('produk.filterKategori')
      </div>

      <!-- Filter Kategori Mobile -->
      <div class="block md:hidden">
        @include('produk.filter-kategori-mobile')
      </div>

      <!-- Produk Section Desktop -->
      <div id="produk-container"
        class="hidden md:block rounded-bl-[5rem] rounded-tr-[5rem] bg-gray-100 p-16 mt-4 mx-14">
        @include('produk.produk')
      </div>

      <!-- Produk Section Mobile -->
      <div id="produk-container-mobile" class="block md:hidden px-4 rounded-bl-[5rem] rounded-tr-[5rem] bg-gray-100">
        @include('produk.produk-mobile')
      </div>
    </div>
  </div>

  <!-- Footer (tetap sama) -->
  <footer class="text-white py-6">
    @include('landingPage.footer')
  </footer>

  <!-- Vite JS -->
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- CSS untuk kontrol responsif -->
  <style>
    @media (max-width: 767px) {
      #produk-container-desktop {
        display: none !important;
      }

      #produk-container-mobile {
        display: block !important;
      }

      .md\:w-1\/5 {
        display: none !important;
      }

      .md\:w-4\/5 {
        width: 100% !important;
      }
    }

    @media (min-width: 768px) {
      #produk-container-desktop {
        display: block !important;
      }

      #produk-container-mobile {
        display: none !important;
      }
    }
  </style>
</body>

</html>