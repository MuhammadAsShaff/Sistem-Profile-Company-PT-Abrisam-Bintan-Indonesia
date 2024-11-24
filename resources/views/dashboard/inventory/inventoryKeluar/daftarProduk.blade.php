<!-- Tombol untuk membuka modal daftar produk -->
<button
  class="ml-2 text-sm font-medium text-red-500 hover:text-red-900 transition-colors duration-200 focus:outline-none"
  onclick="document.getElementById('daftarProduk-{{ $item->id_inventoryKeluar }}').showModal();">
  Lihat Daftar Produk
</button>

<!-- Modal Daftar Produk -->
<dialog id="daftarProduk-{{ $item->id_inventoryKeluar }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden"
  style="position: fixed; top: 0%; left: 50%; transform: translate(-50%, 0%); height: 80vh;">
  <div class="relative bg-white rounded-lg shadow-lg p-6 h-full" style="overflow-y: auto;">
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Daftar Produk Yang Keluar</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="document.getElementById('daftarProduk-{{ $item->id_inventoryKeluar }}').close();">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Form untuk Hapus Massal -->
    <form method="POST" action="{{ route('stock.pindahkan.keluar') }}">
      @csrf
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="w-2/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              <input type="checkbox" id="selectAllCheckboxKeluar" onclick="toggleSelectAllKeluar()"> Pilih Semua
            </th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Produk</th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @php
      $filteredStocksKeluar = $stok->where('id_inventoryKeluar', $item->id_inventoryKeluar);
      @endphp

          @if($filteredStocksKeluar->count() > 0)
        @foreach ($filteredStocksKeluar as $stockItem)
      <tr>
      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        <input type="checkbox" name="ids[]" class="checkbox-item-keluar" value="{{ $stockItem->id_stock }}">
      </td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stockItem->nomorProduk }}</td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stockItem->keterangan ?? '-' }}</td>
      </tr>
    @endforeach
      @else
      <tr>
      <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500">
        Belum ada stock keluar.
      </td>
      </tr>
    @endif
        </tbody>
      </table>

      <!-- Tombol Hapus Massal -->
      @if($filteredStocksKeluar->count() > 0)
      <div class="mt-4 text-right">
      <button type="submit"
        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-md">
        Hapus Terpilih
      </button>
      </div>
    @endif
    </form>

  </div>
</dialog>

<script>
  // Fungsi untuk memilih semua checkbox
  function toggleSelectAllKeluar() {
    const selectAllCheckbox = document.getElementById('selectAllCheckboxKeluar');
    const checkboxes = document.querySelectorAll('.checkbox-item-keluar');
    checkboxes.forEach(checkbox => {
      checkbox.checked = selectAllCheckbox.checked;
    });
  }
</script>