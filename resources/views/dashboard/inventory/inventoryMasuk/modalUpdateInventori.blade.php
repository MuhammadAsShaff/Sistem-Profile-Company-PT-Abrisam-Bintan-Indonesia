<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('updateInventoryModal-{{ $item->id_inventoryMasuk }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal -->
<dialog id="updateInventoryModal-{{ $item->id_inventoryMasuk }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Update Inventori Masuk</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('updateInventoryModal-{{ $item->id_inventoryMasuk }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('inventoryMasuk.update', $item->id_inventoryMasuk) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex items-start gap-6">
          <!-- Form Inputs -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500" style="word-wrap: break-word; white-space: normal;">
              Anda dapat memperbarui informasi inventori masuk ini dengan kategori produk yang relevan.<br> Pastikan
              informasi akurat dan terkini.
            </p>

            <!-- Kategori Produk -->
            <div class="mb-4">
              <label for="kategoriProduk" class="block mb-2 text-sm font-medium text-gray-900">Kategori Produk</label>
              <input type="text" name="kategoriProduk" id="kategoriProduk" value="{{ $item->kategoriProduk }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-[85%] p-2.5"
                placeholder="Masukkan kategori produk" required oninput="syncKategoriProduk(this)">
            </div>

            <!-- Input Tersembunyi untuk Inventory Keluar -->
            <input type="hidden" name="kategoriProdukKeluar" id="kategoriProdukKeluar"
              value="{{ $item->kategoriProduk }}">
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
            Update Inventori Masuk & Keluar
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
  // Fungsi untuk menyinkronkan input kategoriProduk ke input tersembunyi
  function syncKategoriProduk(input) {
    document.getElementById('kategoriProdukKeluar').value = input.value;
  }
</script>