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
</head>


<body class="bg-gray-100">
  <!-- Step Indicator -->
  <div class="top-40 w-full bg-white z-48 py-10 ">
    <div class="container mx-auto max-w-4xl px-4 flex justify-center">
      <ol class="flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">1</span>
          <span>
            <h3 class="font-bold font-telkomsel text-gray-500 leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm text-gray-500">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-red-400">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight text-gray-500 leading-tight">Isi Data Diri</h3>
            <p class="text-sm dark:text-red-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
          </span>
        </li>
        <li class="flex items-center gradient-text space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-gray-400">3</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Selesai</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tunggu Di Hubungi Call Center</p>
          </span>
        </li>
      </ol>
    </div>
  </div>

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
        <a href="https://t.me/6281370304777" target="_blank" rel="noopener noreferrer"
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
      <div class="h-24">
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>