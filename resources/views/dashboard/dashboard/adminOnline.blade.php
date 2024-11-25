<a href="#"
  class="block w-full h-full p-4 border border-gray-200 rounded-lg shadow bg-white flex items-center space-x-4 min-h-[120px]">
  <!-- Ikon -->
  <svg class="w-12 h-12 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
  </svg>

  <!-- Teks -->
  <div>
    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Admin Online</h5>
  @if ($onlineCount)
    <span class="px-3 py-1 text-xs text-black bg-gray-200 rounded-full dark:bg-gray-800 dark:text-red-400">Admin Sedang Online Ada <b>{{$onlineCount}}</b></span>
  @endif
  </div>
</a>
