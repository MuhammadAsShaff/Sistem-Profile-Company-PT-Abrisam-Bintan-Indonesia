<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>Password Reset Selesai</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>

<body>
  <!-- Step Indicator -->
  <div class="fixed top-10 w-full bg-white z-50 py-4">
    <div class="container mx-auto max-w-4xl px-4 flex justify-center">
      <ol class="flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">1</span>
          <span>
            <h3 class="font-medium leading-tight text-gray-500 dark:text-gray-400">Masukkan Email</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan email yang terdaftar</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">2</span>
          <span>
            <h3 class="font-medium leading-tight">Reset Password</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Buat kata sandi baru</p>
          </span>
        </li>
        <li class="flex items-center text-red-500 dark:text-red-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">3</span>
          <span>
            <h3 class="font-medium leading-tight text-red-500 dark:text-red-400">Selesai</h3>
            <p class="text-sm text-red-500 dark:text-red-400">Proses reset selesai</p>
          </span>
        </li>
      </ol>
    </div>
  </div>

  <!-- Section Utama -->
  <section class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center py-12">
    <div class="container flex flex-col items-center justify-center px-6 mx-auto space-y-8">
      <!-- Logo -->
      <div class="flex justify-center mx-auto mb-4">
        <img class="w-auto h-12 sm:h-16" src="{{ asset('images/logoAbi.png') }}" alt="Logo PT Abrisam Bintan Indonesia">
      </div>

      <!-- Judul dan Deskripsi -->
      <div class="text-center">
        <h1 class="text-3xl font-bold tracking-wide text-gray-800 capitalize md:text-4xl dark:text-white">Reset Password
          Berhasil!</h1>
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 max-w-xl mx-auto">Password Anda telah berhasil direset.
          Anda sekarang dapat menggunakan password baru untuk login.</p>
        <a href="{{ route('admin.login') }}"
          class="inline-flex items-center px-6 py-3 mt-6 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-500 rounded-lg hover:bg-red-400 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-50">Kembali
          ke Login</a>
      </div>
    </div>
  </section>
</body>

</html>