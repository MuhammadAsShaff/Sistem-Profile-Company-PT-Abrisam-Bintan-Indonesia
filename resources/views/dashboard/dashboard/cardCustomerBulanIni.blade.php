<a href="{{route('dashboard.dataPelanggan.dataPelanggan')}}"
  class="block w-full h-full p-4 border border-gray-200 rounded-lg shadow bg-white flex items-center space-x-4 min-h-[120px]">
  <!-- Ikon -->
  <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24" fill="none">
    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
      d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
  </svg>

  <!-- Teks -->
  <div>
    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Customer Bulan Ini</h5>
    <span
      class="px-3 py-1 text-xs text-black bg-gray-200 rounded-full dark:bg-gray-800 dark:text-red-400">Cutomer Bulan Ini Ada <b>{{$customerCountThisMonth}}</b></span>
  </div>
</a>