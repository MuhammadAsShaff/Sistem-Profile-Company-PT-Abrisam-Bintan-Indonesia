<a href="{{route('inventoryKeluar')}}"
  class="block w-full h-full p-4 shadow-md rounded-lg shadow bg-white flex items-center space-x-4 min-h-[120px]">
  <!-- Ikon -->
  <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
    height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8" />
  </svg>

  <!-- Teks -->
  <div>
    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Inventory Keluar</h5>
  @if ($totalInventoryKeluar !== null)
    <span class="px-3 py-1 text-xs text-black bg-gray-200 rounded-full dark:bg-gray-800 dark:text-red-400">Produk Yang
    Terjual <b>{{$totalInventoryKeluar}}</b></span>
  @endif
  </div>
</a>