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

  <div class="flex flex-col md:flex-row w-screen">
    <!-- Sidebar Filter -->
    <div class="md:w-1/5 p-4"> <!-- Ubah lebar sidebar menjadi 1/5 -->
      @include('produk.filterSide')
    </div>
  
    <!-- Main Content Area -->
    <div class="md:w-4/5 py-12 px-4 mt-8"> <!-- Ubah lebar konten utama menjadi 4/5 -->
      <!-- Filter Kategori -->
      @include('produk.filterKategori')
  
      <!-- Produk Section -->
      <div id="produk-container" class="rounded-bl-[5rem] rounded-tr-[5rem] bg-gray-100 p-16 mt-4 mx-14">
        @include('produk.produk')
      </div>
    </div>
  </div>

    <!-- Footer Section -->
    <footer class=" py-6 ">
      @include('landingPage.footer')
    </footer>
  </div>

  <!-- Vite JS -->
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>