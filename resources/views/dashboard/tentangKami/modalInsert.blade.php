<!-- Modal for Adding Node -->
<dialog id="addNodeDialog" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
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
        <div class="flex items-start gap-6">
          <!-- Image Preview Section -->
          <div class="flex flex-col items-center justify-center mb-4">
            <!-- Image Preview -->
            <div id="preview-container" class="mt-4">
              <img id="preview-image-insert-node" src="#" alt="Preview Gambar Node"
                class="hidden w-64 h-auto border rounded shadow-md bg-gray-200" />
            </div>

            <label for="img_file" class="block text-sm font-medium text-gray-700 mt-3">Unggah Gambar Bagan</label>
            <input type="file" name="img_file" id="img_file" accept="image/*" class="mt-10"
              onchange="previewImageNode(event)" required>
              <p class="mt-2 text-xs text-red-600 w-full max-w-full break-words">
                *Pastikan gambar yang anda upload berukuran <b>1080x1080px</b> <br> dan maksimal size <b>10mb</b>
                bila tidak akan otomatis terpotong.
              </p>
          </div>

          <!-- Node Details -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500" style="word-wrap: break-word; white-space: normal;">
              Anda dapat menambahkan bagan baru dengan nama, jabatan, dan gambar. Pastikan untuk memasukkan
              informasi yang akurat.
            </p>

            <!-- Node Name -->
            <div class="mb-4">
              <label for="nodeName" class="block mb-2 text-sm font-medium text-gray-900">Nama bagan</label>
              <input type="text" name="nodeName" id="nodeName"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                placeholder="Nama Node" required>
            </div>

            <!-- Node Title -->
            <div class="mb-4">
              <label for="nodeTitle" class="block mb-2 text-sm font-medium text-gray-900">Jabatan</label>
              <input type="text" name="nodeTitle" id="nodeTitle"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                placeholder="Jabatan" required>
            </div>

            <input type="hidden" id="parentId">
          </div>
        </div>
      </form>
    </div>

    <!-- Modal Footer -->
    <div class="flex justify-end p-4 border-t border-gray-200">
      <button type="button"
        class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
        id="saveNodeButton">Simpan</button>
    </div>
  </div>
</dialog>

<script>
  // Image Preview Function
  function previewImageNode(event) {
    const previewImage = document.getElementById('preview-image-insert-node');
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function () {
      previewImage.src = reader.result;
      previewImage.classList.remove('hidden');
    };
    if (file) {
      reader.readAsDataURL(file);
    }
  }
</script>