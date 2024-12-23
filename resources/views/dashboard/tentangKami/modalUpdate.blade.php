<!-- Modal for Editing Node -->
<dialog id="editNodeDialog" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal Header -->
    <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
      <h3 class="text-lg font-semibold text-gray-900">Edit Node</h3>
      <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center" onclick="closeModal('editNodeDialog')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="modal-body p-4">
      <form id="editNodeForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div class="flex items-start gap-6">
          <!-- Node Image Preview Section -->
          <div class="flex flex-col items-center justify-center">
            <!-- Image Preview -->
            <img id="preview-image-update-node" class="w-64 h-auto border rounded shadow-md object-cover"
              src="img_file" alt="Preview Gambar Node" name="img_file" id="editNodeImage" />
            <label for="editNodeImage" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar Bagan</label>
            <input type="file" name="img_file" id="editNodeImage" accept="image/*" class="mt-10" onchange="previewImageNodeUpdate(event)">
          </div>

          <!-- Node Details Section -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500">
              Anda dapat mengedit node ini dengan mengganti nama node atau gambar node di bawah. Pastikan untuk memasukkan informasi terbaru agar data selalu akurat.
            </p>
            <!-- Node Name -->
            <div class="mb-4">
              <label for="editNodeName" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
              <input type="text" name="nodeName" id="editNodeName" value=""
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                placeholder="Nama Node" required>
            </div>

            <!-- Node Title -->
            <div class="mb-4">
              <label for="editNodeTitle" class="block mb-2 text-sm font-medium text-gray-900">Jabatan</label>
              <input type="text" name="nodeTitle" id="editNodeTitle" value=""
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                placeholder="Jabatan" required>
            </div>
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

<script>
  // Image Preview Function for Editing Node
  function previewImageNodeUpdate(event) {
    const previewImage = document.getElementById('preview-image-update-node');
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
