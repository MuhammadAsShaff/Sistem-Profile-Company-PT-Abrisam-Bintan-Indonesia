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

<body>
  <!-- Step Indicator -->
  <div class="fixed top-10 w-full bg-white z-50 py-4">
    <div class="container mx-auto max-w-4xl px-4 flex justify-center">
      <ol class="flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-red-500 dark:text-red-400 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">1</span>
          <span>
            <h3 class="font-medium leading-tight text-red-500 dark:text-red-400">Masukkan Email</h3>
            <p class="text-sm text-red-500 dark:text-red-400">Masukkan email yang terdaftar</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">2</span>
          <span>
            <h3 class="font-medium leading-tight">Reset Password</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Buat kata sandi baru</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">3</span>
          <span>
            <h3 class="font-medium leading-tight">Selesai</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Proses reset selesai</p>
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
        <h1 class="text-3xl font-bold tracking-wide text-gray-800 capitalize md:text-4xl dark:text-white">
          Reset Password Anda
        </h1>
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 max-w-xl mx-auto">
          Masukkan email Anda untuk menerima link reset password. Kami akan mengirimkan tautan untuk mereset kata sandi
          Anda melalui email.
        </p>
      </div>

      <!-- Form Reset Password -->
      <div class="w-full max-w-md mx-auto">
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
          @csrf
          <div>
            <label for="default-email" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Email:</label>
            <div class="relative">
              <svg class="absolute w-4 h-4 ml-3 mt-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
              </svg>
              <input type="email" name="email_admin" id="default-email" class="block w-full pl-10 pr-4 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-red-400 dark:focus:border-red-400 focus:ring-red-400 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Masukkan email Anda..." required>
            </div>
            @error('email_admin')
              <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
            @enderror
          </div>

          <!-- Tombol Kirim -->
          <button type="submit" class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-500 rounded-lg hover:bg-red-400 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-50">
            Kirim Link Reset
          </button>

          <!-- Pesan Status (jika ada) -->
          @if(session('status'))
        <span id="badge-dismiss-red"
        class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300 mt-4">
        {{ session('status') }}
        <button type="button"
          class="inline-flex items-center p-1 ms-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300"
          data-dismiss-target="#badge-dismiss-red" aria-label="Remove">
          <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Remove badge</span>
        </button>
        </span>
      @endif
        </form>
      </div>
    </div>

    
  </section>
</body>

</html>
