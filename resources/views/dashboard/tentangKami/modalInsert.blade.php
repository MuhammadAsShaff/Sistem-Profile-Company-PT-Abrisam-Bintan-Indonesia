<!-- Modal for Adding Node -->
<dialog id="addNodeDialog" class="modal rounded-lg shadow-lg w-full max-w-md overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal Header -->
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-4">
      <h3 class="text-lg font-semibold text-gray-900">Tambah Node Baru</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="closeModal('addNodeDialog')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="modal-body">
      <form id="addNodeForm">
        <div class="flex flex-col gap-4">
          <!-- Name Input -->
          <div class="form-group">
            <label for="nodeName" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              id="nodeName" placeholder="Masukkan Nama" required>
          </div>

          <!-- Title Input -->
          <div class="form-group">
            <label for="nodeTitle" class="block text-sm font-medium text-gray-700">Jabatan</label>
            <input type="text"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              id="nodeTitle" placeholder="Masukkan Jabatan" required>
          </div>

          <!-- Image File Input -->
          <div class="form-group">
            <label for="img_file" class="block text-sm font-medium text-gray-700">Unggah Gambar</label>
            <input type="file" name="img_file" id="img_file" accept="image/*"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          </div>

          <input type="hidden" id="parentId">
        </div>
      </form>
    </div>

    <!-- Modal Footer -->
    <div class="flex justify-end p-4 border-t border-gray-200">
      <button type="button"
        class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300"
        id="saveNodeButton">Simpan</button>
    </div>
  </div>
</dialog>
