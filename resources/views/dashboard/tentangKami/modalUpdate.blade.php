<!-- Modal for Editing Node -->
<dialog id="editNodeDialog" class="modal rounded-lg shadow-lg w-full max-w-md overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal Header -->
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-4">
      <h3 class="text-lg font-semibold text-gray-900">Edit Node</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="closeModal('editNodeDialog')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="modal-body">
      <form id="editNodeForm" enctype="multipart/form-data">
        <div class="flex flex-col gap-4">
          <!-- Name Input -->
          <div class="form-group">
            <label for="editNodeName" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="editNodeName" name="name"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="Masukkan Nama" required>
          </div>
          <!-- Title Input -->
          <div class="form-group">
            <label for="editNodeTitle" class="block text-sm font-medium text-gray-700">Jabatan</label>
            <input type="text" id="editNodeTitle" name="title"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="Masukkan Jabatan" required>
          </div>
          <!-- Image Upload Input -->
          <div class="form-group">
            <label for="editNodeImage" class="block text-sm font-medium text-gray-700">Unggah Gambar Baru
              (opsional)</label>
            <input type="file" id="editNodeImage" name="img_file"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              accept="image/*">
          </div>
        </div>
      </form>
    </div>

    <!-- Modal Footer -->
    <div class="flex justify-end p-4 border-t border-gray-200">
      <button type="button" id="confirmEditButton"
        class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
        Simpan Perubahan
      </button>
    </div>
  </div>
</dialog>