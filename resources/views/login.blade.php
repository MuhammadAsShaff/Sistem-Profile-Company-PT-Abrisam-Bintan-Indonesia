<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
  <div class="bg-white">
    <div class="flex justify-center h-screen">
      <div class="hidden bg-cover lg:block lg:w-2/3"
        style="background-image: url('https://images.unsplash.com/photo-1616763355603-9755a640a287?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80')">
        <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
          <div>
            <h2 class="text-3xl font-bold text-white sm:text-4xl">PT Abrisam Bintan Indonesia</h2>
            <p class="max-w-xl mt-4 text-gray-300">Selalu semangat bekerja! Jaga kesehatan agar tetap optimal dalam
              menjalankan kewajiban kita. Semangat!</p>
          </div>
        </div>
      </div>

      <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
        <div class="flex-1">
          <div class="text-center">
            <div class="flex justify-center mx-auto">
              <img class="w-auto h-20 sm:h-20" src="{{ asset('images/logoAbi.png') }}" alt="Logo Abi">
            </div>
            <p class="mt-4 text-gray-500">Masuk untuk mengakses akun Anda</p>
          </div>

          <div class="mt-8">
            <form method="POST" action="{{ route('admin.login') }}">
              @csrf

              <!-- Danger Alert untuk email atau password salah -->
              @if ($errors->has('login'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                  role="alert">
                  <span class="font-medium">Email atau password yang Anda masukkan salah.</span> Silakan coba lagi.
                </div>
              @endif

              <!-- Field Email -->
              <div class="mb-4">
                <label for="email_admin" class="block text-sm text-gray-500 dark:text-gray-300">Email Address</label>
                <input type="email" name="email_admin" id="email_admin" placeholder="john@example.com" required
                  value="{{ old('email_admin') }}"
                  class="block w-full py-2.5 text-gray-700 placeholder-gray-400/70 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-opacity-40
                  @error('email_admin') border-red-400 focus:border-red-400 focus:ring-red-300 dark:border-red-400 dark:focus:border-red-300 @enderror">
              </div>

              <!-- Field Password -->
              <div class="mb-4">
                <label for="password" class="block text-sm text-gray-500 dark:text-gray-300">Password</label>
                <div class="relative flex items-center">
                  <input type="password" name="password" id="password" placeholder="********" required
                    class="block w-full py-2.5 text-gray-700 placeholder-gray-400/70 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-opacity-40
                    @error('password') border-red-400 focus:border-red-400 focus:ring-red-300 dark:border-red-400 dark:focus:border-red-300 @enderror">
                  <button type="button" id="togglePassword"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 focus:outline-none">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                      class="w-6 h-6 mx-4 text-gray-400 transition-opacity duration-300">
                      <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                      <path fill-rule="evenodd"
                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                        clip-rule="evenodd" />
                    </svg>
                    <svg id="eyeSlashIcon" class="hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                      fill="currentColor" class="w-6 h-6 mx-4 text-gray-400 transition-opacity duration-300">
                      <path fill-rule="evenodd"
                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                        clip-rule="evenodd" />
                      <path
                        d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Button Login -->
              <div class="mt-6">
                <button
                  class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-red-500 rounded-lg hover:bg-red-400 focus:outline-none focus:bg-red-400 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                  Masuk
                </button>
              </div>
            </form>

            <p class="mt-6 text-sm text-center text-gray-400">
              Lupa Password Anda?
              <a href="{{ route('password.request') }}"
                class="text-red-500 focus:outline-none focus:underline hover:underline">Klik Di Sini</a>.
            </p>

          </div>
        </div>
      </div>
    </div>

    <!-- Alert untuk Rate Limiter -->
    @if (session('warning'))
    <div x-data="{ countdown: {{ session('seconds') ?? 60 }}, show: true }" x-init="
      const interval = setInterval(() => {
      if (countdown > 0) {
      countdown--;
      } else {
      clearInterval(interval);
      show = false;
      }
      }, 1000)" x-show="show"
      class="fixed bottom-4 right-4 z-50 max-w-xs w-full p-4 bg-white rounded-lg shadow-md border-l-4 border-yellow-500 dark:bg-gray-800 flex items-start space-x-3"
      role="alert">
      <div class="flex items-center justify-center w-5 h-5 bg-yellow-500 rounded-full">
      <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
        <path
        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
      </svg>
      </div>

      <div class="pl-3">
      <div class="text-sm font-semibold text-yellow-700 dark:text-yellow-300">Warning</div>
      <p class="text-sm text-gray-600 dark:text-gray-200 mt-1">
        Terlalu banyak percobaan login. Coba lagi dalam <span x-text="countdown"></span> detik.
      </p>
      </div>

      <button @click="show = false"
      class="ml-auto bg-white text-yellow-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 p-1 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
      </button>
    </div>
    @endif

    <!-- JavaScript untuk Toggle Password -->
    <script>
      const togglePassword = document.querySelector("#togglePassword");
      const password = document.querySelector("#password");

      togglePassword.addEventListener("click", function () {
        // Toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // Toggle the eye icon
        const eyeIcon = this.querySelector("#eyeIcon");
        const eyeSlashIcon = this.querySelector("#eyeSlashIcon");
        
        if (type === "text") {
          eyeIcon.classList.add("opacity-50");
          eyeSlashIcon.classList.remove("opacity-50");
        } else {
          eyeIcon.classList.remove("opacity-50");
          eyeSlashIcon.classList.add("opacity-50");
        }
      });
    </script>
  </div>
</body>

</html>
