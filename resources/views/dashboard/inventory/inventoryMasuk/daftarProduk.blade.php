<!-- Tombol untuk membuka modal syarat ketentuan -->
<button
  class="ml-2 text-sm font-medium text-red-500 hover:text-red-900 transition-colors duration-200 focus:outline-none"
  onclick="document.getElementById('daftarProduk-{{ $item->id_inventoryMasuk }}').showModal();">
  Lihat Daftar Produk
</button>

<!-- Modal Syarat dan Ketentuan -->
<dialog id="daftarProduk-{{ $item->id_inventoryMasuk }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden"
  style="position: fixed; top: 0%; left: 50%; transform: translate(-50%, 0%); height: 80vh;">
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

    <div class="modal-body">
      <form id="formTambahProduk-{{ $item->id_inventoryMasuk }}" class="flex flex-col space-y-4 mb-4 w-full"
        method="POST" action="{{ route('stock.store') }}">
        @csrf
        <input type="hidden" name="id_inventoryMasuk" value="{{ $item->id_inventoryMasuk }}" />
        <input type="hidden" name="kategoriProduk" value="{{ $item->kategoriProduk }}" />

        <!-- Form Input Produk -->
        <div id="inputProdukContainer-{{ $item->id_inventoryMasuk }}" class="space-y-2 w-full">
          <div class="produkInput flex space-x-2 w-full">
            <input type="text" name="nomorProduk[]"
              class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
              placeholder="Masukkan Nomor Produk" required />
            <input type="text" name="keterangan[]"
              class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan Keterangan" />
          </div>
        </div>

        <!-- Tombol untuk menambah input baru -->
        <div class="flex items-center justify-end space-x-2 mt-4">
          <button type="button" onclick="tambahInputProduk('{{ $item->id_inventoryMasuk }}')"
            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 shadow-md">
            Tambah Inputan
          </button>

          <button type="submit"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-md">
            Tambah Stock
          </button>
        </div>
      </form>
    </div>

    <!-- Form untuk Hapus Massal -->
    <form method="POST" action="{{ route('stock.pindahkan.massal') }}">
      @csrf
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="w-2/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
              <input type="checkbox" id="selectAllCheckbox" onclick="toggleSelectAll()"> Pilih Semua
            </th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Produk</th>
            <th class="w-5/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @php
$filteredStocks = $stok->where('id_inventoryMasuk', $item->id_inventoryMasuk);
      @endphp

          @if($filteredStocks->count() > 0)
        @foreach ($filteredStocks as $index => $stockItem)
      <tr data-id="{{ $stockItem->id_stock }}">
      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        <input type="checkbox" name="ids[]" class="checkbox-item" value="{{ $stockItem->id_stock }}">
      </td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stockItem->nomorProduk }}</td>
      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stockItem->keterangan ?? '-' }}</td>
      </tr>
    @endforeach
      @else
      <tr>
      <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500">
        Belum ada stock masuk
      </td>
      </tr>
    @endif
        </tbody>
      </table>

      <!-- Tombol Hapus Massal -->
      @if($filteredStocks->count() > 0)
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
  // Fungsi untuk menambah form input baru secara dinamis
  function tambahInputProduk(id) {
      // Cari container input berdasarkan ID modal
      const inputContainer = document.getElementById(`inputProdukContainer-${id}`);
      if (!inputContainer) return; // Jika container tidak ditemukan, hentikan

      // Buat elemen input baru
      const newInput = document.createElement('div');
      newInput.classList.add('produkInput');
      newInput.innerHTML = `
       <div class="produkInput flex space-x-2 w-full">
            <input type="text" name="nomorProduk[]"
              class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
              placeholder="Masukkan Nomor Produk" required />
            <input type="text" name="keterangan[]"
              class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan Keterangan" />
          </div>
    `;

      // Tambahkan input baru ke container yang sesuai
      inputContainer.appendChild(newInput);
    }


  function toggleSelectAll() {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('.checkbox-item');
    checkboxes.forEach(checkbox => {
      checkbox.checked = selectAllCheckbox.checked;
    });
  }
</script>