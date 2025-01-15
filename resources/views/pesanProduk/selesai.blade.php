<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <style>
    /* Pastikan desktop step indicator selalu tampil di desktop */
    @media (min-width: 768px) {
      .desktop-step-indicator {
        display: flex !important;
      }

      .mobile-step-indicator {
        display: none !important;
      }
    }

    /* Pastikan mobile step indicator selalu tampil di mobile */
    @media (max-width: 767px) {
      .desktop-step-indicator {
        display: none !important;
      }

      .mobile-step-indicator {
        display: flex !important;
      }
    }
  </style>
</head>


<body class="bg-gray-100">
  @include('loading')
  <!-- Step Indicator -->
  <div class="fixed top-0 left-0 right-0 w-full bg-white z-50 py-4 md:py-10">
    <div class="container mx-auto max-w-4xl px-4">
      <!-- Step Desktop -->
      <ol class="desktop-step-indicator hidden md:flex items-center justify-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0">1</span>
          <span>
            <h3 class="font-bold font-telkomsel text-gray-500 leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm text-gray-500">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0">2</span>
          <span>
            <h3 class="font-bold font-telkomsel text-gray-500 leading-tight">Isi Data Diri</h3>
            <p class="text-sm text-gray-500">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
          </span>
        </li>
        <li class="flex items-center gradient-text space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0">3</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight gradient-text">Selesai</h3>
            <p class="text-sm text-red-400">Tunggu Di Hubungi Call Center</p>
          </span>
        </li>
      </ol>
  
      <!-- Step Mobile -->
      <div class="mobile-step-indicator block md:hidden flex justify-between items-center">
        <!-- Step 1 -->
        <span class="flex flex-col items-center text-gray-500">
          <div class="w-8 h-8 flex items-center justify-center border border-gray-500 rounded-full">1</div>
          <p class="text-xs font-bold font-telkomsel mt-1">Pilih Lokasi</p>
          <p class="text-[10px] text-gray-500 text-center">Lokasi dan Paket</p>
        </span>
  
        <!-- Line Separator -->
        <div class="w-8 border-t-2 border-gray-300"></div>
  
        <!-- Step 2 -->
        <span class="flex flex-col items-center text-gray-500">
          <div class="w-8 h-8 flex items-center justify-center border border-gray-500 rounded-full">2</div>
          <p class="text-xs font-bold font-telkomsel mt-1">Isi Data</p>
          <p class="text-[10px] text-gray-500 text-center">Konfirmasi Data</p>
        </span>
  
        <!-- Line Separator -->
        <div class="w-8 border-t-2 border-gray-300"></div>
  
        <!-- Step 3 -->
        <span class="flex flex-col items-center gradient-text">
          <div class="w-8 h-8 flex items-center justify-center border border-red-500 rounded-full">3</div>
          <p class="text-xs font-bold font-telkomsel">Selesai</p>
          <p class="text-[10px] text-red-500 text-center">Tunggu Call Center</p>
        </span>
      </div>
    </div>
  </div>
  <br><br class="hidden md:block"><br class="hidden md:block"><br class="hidden md:block"><br class="hidden md:block">
  <!-- Card Container -->
  <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-32">

    <!-- Gambar Selesai -->
    <img src="{{ asset('images/selesai.png') }}" alt="Selesai" class="w-32 h-32 object-cover mx-auto mt-8">

    <!-- Konten Teks -->
    <div class="mt-6">

      <!-- Registrasi Kartu di Proses -->
      <p class="text-center text-lg font-semibold text-gray-800">Pemesanan Produk Anda Berhasil</p>

      <!-- Harap tunggu 2-5 menit untuk aktivasi -->
      <p class="text-center text-sm text-gray-600 mt-2">Anda Akan Segera Dihubungi Oleh Call Centre Kami.</p>

      <!-- Garis Horizontal -->
      <hr class="my-4 border-t-2 border-gray-300">
      <!-- Nomor Transaksi -->
      <div class="flex justify-center items-center mt-4 mb-4">
        <p class="text-sm text-gray-800 font-semibold">Anda Dapat Menghubungi Kami Melalui:
        </p>
      </div>

      <!-- Keterangan Registrasi Kartu dan Sedang Di Proses -->
      <div class="flex justify-center gap-4 items-center">
        <a href="https://www.instagram.com/indihomeabrisambintanindonesia" target="_blank" rel="noopener noreferrer"
          class="text-gray-800 dark:text-white hover:text-red-500" aria-label="Instagram">
          <i class="fa-brands fa-instagram fa-2x"></i>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/6281370304777" target="_blank" rel="noopener noreferrer"
          class="text-gray-800 dark:text-white hover:text-red-500" aria-label="WhatsApp">
          <i class="fa-brands fa-whatsapp fa-2x"></i>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/+6281370304777" target="_blank" rel="noopener noreferrer"
          class="text-gray-800 dark:text-white hover:text-red-500" aria-label="Telegram">
          <i class="fa-brands fa-telegram fa-2x"></i>
        </a>

        <!-- tiktok -->
        <a href="https://www.tiktok.com/@indihomeabi?_t=8qMdOV3DiGQ&_r=1" target="_blank" rel="noopener noreferrer"
          class="text-gray-800 dark:text-white hover:text-red-500" aria-label="Telegram">
          <i class="fa-brands fa-tiktok fa-2x"></i>
        </a>
      </div>

    </div>

    <!-- Tombol Kembali ke Home -->
    <div class="mt-6 flex justify-center">
      <a href="{{ route('landingPage.layoutLandingPage') }}"
        class="inline-block px-6 py-3 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-semibold text-sm rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
        Kembali ke Home
      </a>
    </div>
  </div>



  <!-- Fixed Bottom Bar -->
  <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
        <!-- Versi Mobile -->
        <div class="block md:hidden h-4 bg-gray-200">
        </div>
        
        <!-- Versi Desktop -->
        <div class="hidden md:block h-24 bg-gray-300">
        </div>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>