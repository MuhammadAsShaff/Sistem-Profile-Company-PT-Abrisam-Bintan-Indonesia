<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
        <li class="flex items-center gradient-text space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight gradient-text leading-tight">Isi Data Diri</h3>
            <p class="text-sm dark:text-red-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">3</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Selesai</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tunggu Di Hubungi Call Center</p>
          </span>
        </li>
      </ol>
    </div>
  </div>

<div class="container bg-white mx-auto max-w-md p-6 rounded-lg shadow-2xl shadow-gray-400 mt-32">
  <div class="bg-white p-8 rounded-lg ">
    <h2 class="text-xl font-bold text-center text-gray-800 mb-4">Verifikasi OTP</h2>
    <p class="text-sm text-center text-gray-600 mb-6">
      Kami telah mengirimkan kode OTP ke email <span class="font-semibold">as22si@mahasiswa.pcr.ac.id</span>.
      Silakan masukkan kode tersebut untuk melanjutkan.
    </p>
    <div class="flex justify-center gap-4 mb-6">
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
    </div>
    <button
      class="w-full py-3 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-semibold text-lg rounded-md hover:bg-red-600 transition-all duration-300">
      Kirim
    </button>
    <div class="text-sm text-center text-gray-600 mt-6">
      Tidak menerima kode? <button class="text-red-500 font-medium hover:text-red-700 transition underline">Kirim
        ulang kode</button>
    </div>
    <p class="text-xs text-center text-gray-400 mt-2">
      Anda dapat mengirim ulang kode dalam <span class="font-semibold text-gray-500">00:29</span>.
    </p>
  </div>
</div>



  <!-- Fixed Bottom Bar -->
  <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="h-24">
      </div>
    </div>
  </div>
</body>

</html>