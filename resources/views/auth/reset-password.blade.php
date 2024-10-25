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
                    <span
                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">1</span>
                    <span>
                        <h3 class="font-bold font-telkomsel leading-tight">Masukkan Email</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan email yang terdaftar</p>
                    </span>
                </li>

                <li class="flex items-center text-red-500 dark:text-red-400 space-x-2 rtl:space-x-reverse">
                    <span
                        class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">2</span>
                    <span>
                        <h3 class="font-bold font-telkomsel leading-tight text-red-500 dark:text-red-400">Reset Password</h3>
                        <p class="text-sm text-red-500 dark:text-red-400">Buat kata sandi baru</p>
                    </span>
                </li>
                <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
                    <span
                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">3</span>
                    <span>
                        <h3 class="font-bold font-telkomsel leading-tight">Selesai</h3>
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
                <img class="w-auto h-12 sm:h-16" src="{{ asset('images/logoAbi.png') }}"
                    alt="Logo PT Abrisam Bintan Indonesia">
            </div>

            <!-- Judul dan Deskripsi -->
            <div class="text-center">
                <h1 class="text-3xl font-bold font-telkomsel tracking-wide text-gray-800 capitalize md:text-4xl dark:text-white">
                    Reset Password Anda
                </h1>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 max-w-xl mx-auto">
                    Masukkan email Anda untuk menerima link reset password. Kami akan mengirimkan tautan untuk mereset
                    kata sandi Anda melalui email.
                </p>
            </div>

            <!-- Form Reset Password -->
            <div class="w-full max-w-md mx-auto">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Input Email -->
                    <div class="relative">
                        <label for="email_admin"
                            class="block mb-2 text-sm font-bold font-telkomsel text-gray-600 dark:text-gray-200">Email:</label>
                        <input type="email" name="email_admin" id="email_admin"
                            class="block w-full pl-3 pr-10 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-red-400 dark:focus:border-red-400 focus:ring-red-400 focus:outline-none focus:ring focus:ring-opacity-40"
                            placeholder="Masukkan email Anda..." required>
                        @error('email_admin')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Password Baru -->
                    <div class="relative">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Password
                            Baru:</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="block w-full pl-3 pr-10 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-red-400 dark:focus:border-red-400 focus:ring-red-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                placeholder="Buat password baru..." required>
                            <button type="button" id="togglePassword"
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="w-6 h-6 mx-4 text-gray-400 transition-opacity duration-300">
                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd"
                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg id="eyeSlashIcon" class="hidden" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 mx-4 text-gray-400 transition-opacity duration-300">
                                    <path fill-rule="evenodd"
                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                        clip-rule="evenodd" />
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="relative">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Konfirmasi
                            Password:</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="block w-full pl-3 pr-10 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-red-400 dark:focus:border-red-400 focus:ring-red-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                placeholder="Ulangi password baru Anda..." required>
                            <button type="button" id="toggleConfirmationPassword"
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 focus:outline-none">
                                <svg id="eyeIconConf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="w-6 h-6 mx-4 text-gray-400 transition-opacity duration-300">
                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd"
                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg id="eyeSlashIconConf" class="hidden" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 mx-4 text-gray-400 transition-opacity duration-300">
                                    <path fill-rule="evenodd"
                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                        clip-rule="evenodd" />
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Reset Password -->
                    <button type="submit"
                        class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-500 rounded-lg hover:bg-red-400 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-50">
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

    <!-- JavaScript untuk Toggle Password -->
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // Toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Toggle the eye icon
            const eyeIcon = document.querySelector("#eyeIcon");
            const eyeSlashIcon = document.querySelector("#eyeSlashIcon");

            if (type === "text") {
                eyeIcon.classList.add("opacity-50");
                eyeSlashIcon.classList.remove("opacity-50");
            } else {
                eyeIcon.classList.remove("opacity-50");
                eyeSlashIcon.classList.add("opacity-50");
            }
        });

        const toggleConfirmationPassword = document.querySelector("#toggleConfirmationPassword");
        const confirmationPassword = document.querySelector("#password_confirmation");

        toggleConfirmationPassword.addEventListener("click", function () {
            // Toggle the type attribute
            const type = confirmationPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmationPassword.setAttribute("type", type);

            // Toggle the eye icon
            const eyeIconConf = document.querySelector("#eyeIconConf");
            const eyeSlashIconConf = document.querySelector("#eyeSlashIconConf");

            if (type === "text") {
                eyeIconConf.classList.add("opacity-50");
                eyeSlashIconConf.classList.remove("opacity-50");
            } else {
                eyeIconConf.classList.remove("opacity-50");
                eyeSlashIconConf.classList.add("opacity-50");
            }
        });
    </script>
</body>

</html>