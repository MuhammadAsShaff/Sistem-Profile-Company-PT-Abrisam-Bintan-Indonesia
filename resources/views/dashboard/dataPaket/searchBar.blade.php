<form method="GET" action="{{ route('dashboard.dataPaket.dataPaket') }}" class="max-w-lg mx-auto">
  <div class="flex">
    <!-- Dropdown Filter for Paket (if any, like status or type) -->
    <button id="dropdown-button" data-dropdown-toggle="dropdown"
      class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
      type="button">
      {{ request('filter') ? request('filter') : 'Semua Paket' }}
      <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
      </svg>
    </button>

    <!-- Dropdown Menu for Paket Filter (if needed) -->
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
        <li>
          <button type="submit" name="filter" value=""
            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Semua Paket
          </button>
        </li>
        <!-- Add more filters if needed -->
        <li>
          <button type="submit" name="filter" value="Popular"
            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Popular
          </button>
        </li>
        <li>
          <button type="submit" name="filter" value="New"
            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            New
          </button>
        </li>
      </ul>
    </div>

    <!-- Search Input for Paket Name -->
    <div class="relative w-full">
      <input type="search" id="search-dropdown" name="search" value="{{ request('search') }}"
        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
        placeholder="Cari Nama Paket..." />

      <!-- Search Button -->
      <button type="submit"
        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-red-500 rounded-e-lg border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
        <span class="sr-only">Cari</span>
      </button>

      <!-- Clear/Search Reset Button -->
      @if(request('search'))
      <a href="{{ route('dashboard.dataPaket.dataPaket') }}"
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
