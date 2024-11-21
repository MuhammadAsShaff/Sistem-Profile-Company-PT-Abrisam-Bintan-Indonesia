<!-- Tombol untuk membuka modal syarat ketentuan -->
<button
  class="ml-2 text-sm font-medium text-red-500 hover:text-red-900 transition-colors duration-200 focus:outline-none"
  onclick="document.getElementById('daftarProduk-{{ $item->id_inventoryMasuk }}').showModal();">
  Lihat Daftar Produk
</button>

<!-- Modal Syarat dan Ketentuan -->
<dialog id="daftarProduk-{{ $item->id_inventoryMasuk }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden"
  style="position: fixed; top: 10%; left: 50%; transform: translate(-50%, 0%); height: 80vh;">
  <div class="relative bg-white rounded-lg shadow-lg p-6 h-full" style="overflow-y: auto;">
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Daftar Produk Yang Masuk</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="document.getElementById('daftarProduk-{{ $item->id_inventoryMasuk }}').close();">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
      <div class="flex items-center space-x-2 mb-4">
        <!-- Input Nomor Produk -->
        <input type="text" id="inputNomorProduk"
          class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
          placeholder="Masukkan Nomor Produk" />

        <!-- Input Keterangan -->
        <input type="text" id="inputKeterangan"
          class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          placeholder="Masukkan Keterangan" />

        <!-- Tombol Tambah -->
        <button type="button"
          class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-md"
          onclick="tambahNomorProduk()">
          Tambah
        </button>
      </div>
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="w-2/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor</th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Produk</th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @php
$filteredStocks = $stok->where('id_inventoryMasuk', $item->id_inventoryMasuk);
      @endphp
          @forelse ($filteredStocks as $index => $stockItem)
      <tr>
      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stockItem->nomorProduk }}</td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stockItem->keterangan ?? '-' }}</td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"></td>
      </tr>
      @empty
      <tr>
      <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500">
        Tidak ada data produk untuk inventory ini.
      </td>
      </tr>
    @endforelse
        </tbody>
      </table>
    </div>
  </div>
</dialog>