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
                <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
                    <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">1</span>
                    <span>
                        <h3 class="font-medium leading-tight">Masukkan Email</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan email yang terdaftar</p>
                    </span>
                </li>

                <li class="flex items-center text-red-500 dark:text-red-400 space-x-2 rtl:space-x-reverse">
                    <span class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">2</span>
                    <span>
                        <h3 class="font-medium leading-tight text-red-500 dark:text-red-400">Reset Password</h3>
                        <p class="text-sm text-red-500 dark:text-red-400">Buat kata sandi baru</p>
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
    <section class="w-full flex items-center justify-center flex-grow pt-20 mt-20">
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
                    Masukkan email Anda untuk menerima link reset password. Kami akan mengirimkan tautan untuk mereset kata sandi Anda melalui email.
                </p>
            </div>

            <!-- Form Reset Password -->
            <div class="w-full max-w-md mx-auto">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Input Email -->
                    <div class="relative">
                        <label for="email_admin" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Email:</label>
                        <div class="relative">
                            <svg class="absolute w-4 h-4 ml-3 mt-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                            </svg>
                            <input type="email" name="email_admin" id="email_admin" class="block w-full pl-10 pr-4 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-red-400 dark:focus:border-red-400 focus:ring-red-400 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Masukkan email Anda..." required>
                        </div>
                        @error('email_admin')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Password Baru -->
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Password Baru:</label>
                        <input type="password" name="password" id="password" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buat password baru..." required>
                        @error('password')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="relative">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Konfirmasi Password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ulangi password baru Anda..." required>
                    </div>

                    <!-- Tombol Reset Password -->
                    <button type="submit" class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-500 rounded-lg hover:bg-red-400 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-50">
                        Reset Password
                    </button>
                </form>

                <!-- Pesan Status (jika ada) -->
                @if(session('status'))
                <div class="mt-4 text-center text-sm font-medium text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
    </section>
</body>

</html>
