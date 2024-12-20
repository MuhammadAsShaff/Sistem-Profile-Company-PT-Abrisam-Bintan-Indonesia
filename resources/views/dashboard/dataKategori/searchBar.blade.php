<form method="GET" action="{{ route('dashboard.dataKategori.dataKategori') }}" class="max-w-lg mx-auto">
  <div class="flex">

    <!-- Search Input for Category Name -->
    <div class="relative w-full">
      <input type="search" id="search-dropdown" name="search" value="{{ request('search') }}"
        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-400 focus:border-red-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-red-500"
        placeholder="Cari Nama Kategori..." />

      <!-- Search Button -->
      <button type="submit"
        class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-red-500 rounded-lg border border-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
        <span class="sr-only">Cari</span>
      </button>

      <!-- Clear/Search Reset Button -->
      @if(request('search'))
      <a href="{{ route('dashboard.dataKategori.dataKategori') }}"
        class="absolute top-0 right-10 p-2.5 text-sm font-medium h-full text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span class="sr-only">Reset</span>
      </a>
      @endif

    </div>
  </div>
</form>