<!-- Navbar -->
<nav id="navbar" class="fixed w-full z-50 top-0 bg-transparent shadow-md">
  <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">

    <!-- Logo & Brand -->
    <div class="flex items-center space-x-3">
      <!-- Mobile Menu Button -->
      <button id="mobile-menu-button" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>

      <a href="{{ route('landingPage.layoutLandingPage') }}" class="flex items-center space-x-2">
        <img class="w-auto h-10" src="{{ asset('images/logoAbi.png') }}" alt="Logo Abi">
        <span class="self-center text-xl sm:text-2xl font-semibold text-black dark:text-white">PT Abrisam Bintan
          Indonesia</span>
      </a>
    </div>

    <!-- Navbar Links -->
    <div class="hidden w-full md:block md:w-auto z-50" id="navbar-default">
      <ul
        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
        <li>
          <a href="{{ route('landingPage.layoutLandingPage') }}"
            class="block py-2 px-3 rounded md:p-0 
      {{ Route::is('landingPage.layoutLandingPage') ? 'text-red-500 md:text-red-500 dark:text-red-500' : 'text-gray-900 hover:text-red-500 dark:text-white md:dark:hover:text-red-500' }}"
            aria-current="page">Beranda</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 rounded md:p-0 
      {{ Route::is('produk') ? 'text-red-500 md:text-red-500 dark:text-red-500' : 'text-gray-900 hover:text-red-500 dark:text-white md:dark:hover:text-red-500' }}">Produk</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 rounded md:p-0 
      {{ Route::is('blog') ? 'text-red-500 md:text-red-500 dark:text-red-500' : 'text-gray-900 hover:text-red-500 dark:text-white md:dark:hover:text-red-500' }}">Blog</a>
        </li>
        <li>
          <a href="{{ route('tampilKontak') }}"
            class="block py-2 px-3 rounded md:p-0 
      {{ Route::is('tampilKontak') ? 'text-red-500 md:text-red-500 dark:text-red-500' : 'text-gray-900 hover:text-red-500 dark:text-white md:dark:hover:text-red-500' }}">Kontak</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 rounded md:p-0 
      {{ Route::is('tentangKami') ? 'text-red-500 md:text-red-500 dark:text-red-500' : 'text-gray-900 hover:text-red-500 dark:text-white md:dark:hover:text-red-500' }}">Tentang
            Kami</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 rounded md:p-0 
      {{ Route::is('tanyaJawab') ? 'text-red-500 md:text-red-500 dark:text-red-500' : 'text-gray-900 hover:text-red-500 dark:text-white md:dark:hover:text-red-500' }}">Tanya
            Jawab</a>
        </li>
      </ul>

    </div>
  </div>

  <!-- Mobile Dropdown Menu -->
  <div id="mobile-menu" class="hidden md:hidden flex flex-col space-y-4 bg-gray-100 p-4">
    <a href="{{ route('landingPage.layoutLandingPage') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-200">Beranda</a>
    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-200">Produk</a>
    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-200">Blog</a>
    <a href="{{ route('tampilKontak') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-200">Kontak</a>
    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-200">Tentang Kami</a>
    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-200">Tanya Jawab</a>
  </div>
</nav>

<!-- Scroll effect and toggle script -->
<script>
  // Change navbar background on scroll
  window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 10) {
      navbar.classList.add("color-active");
    } else {
      navbar.classList.remove("color-active");
    }
  });

  // Toggle mobile menu
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");

  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });
</script>

<!-- Styles for Navbar -->
<style>
  .color-active {
    background-color: rgba(255, 255, 255, 0.9);
    transition: background-color 0.3s ease-in-out;
  }

  .space-x-8>*:not(:last-child) {
    margin-right: 2rem;
  }

  @media (min-width: 1024px) {
    .md\:space-x-8>*:not(:last-child) {
      margin-right: 2rem;
    }
  }

  @media (max-width: 768px) {
    #navbar-default {
      display: none;
      /* Menyembunyikan navbar default di layar kecil */
    }
  }
</style>