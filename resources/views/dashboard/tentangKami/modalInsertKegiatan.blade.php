<button onclick="openModal('createModalKegiatan')" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>

<!-- Modal for creating kegiatan -->
<dialog id="createModalKegiatan" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Tambah Kegiatan Baru</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('createModalKegiatan')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-start gap-6">
          <!-- Foto Kegiatan -->
          <div class="flex flex-col items-center justify-center mb-4">
            <!-- Preview Container -->
            <div id="preview-container" class="mt-4">
              <img id="preview-image-insert-kegiatan" src="#" alt="Preview Gambar Kegiatan"
                class="hidden w-64 h-auto border rounded shadow-md bg-gray-200" />
            </div>

            <label for="gambar" class="block text-sm font-medium text-gray-700 mt-3">Unggah Gambar Kegiatan</label>
            <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-10"
              onchange="previewImageKegiatan(event)" required>
              <p class="mt-2 text-xs text-red-600 w-full max-w-full break-words">
                *Pastikan gambar yang anda upload berukuran <b>1416x780px</b> <br> dan maksimal size <b>2mb</b>
                bila tidak akan otomatis terpotong.
              </p>
          </div>

          <!-- Nama dan Deskripsi Kegiatan -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500" style="word-wrap: break-word; white-space: normal;">
              Anda dapat menambahkan kegiatan baru dengan nama, deskripsi, dan gambar. Pastikan untuk memasukkan
              informasi terbaru agar data selalu akurat.
            </p>

            <!-- Nama Kegiatan -->
            <div class="mb-4">
              <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Kegiatan</label>
              <input type="text" name="nama" id="nama"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-[85%] p-2.5"
                placeholder="Nama Kegiatan" required>
            </div>

            <!-- Deskripsi Kegiatan -->
            <div class="mb-4">
              <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Kegiatan</label>
              <textarea name="keterangan" id="keterangan" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-[85%] p-2.5"
                placeholder="Deskripsi Kegiatan" required></textarea>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
            Tambah Kegiatan
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
  function previewImageKegiatan(event) {
    const input = event.target;
    const previewImage = document.getElementById('preview-image-insert-kegiatan');

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the image source
        previewImage.classList.remove('bg-gray-200'); // Remove background color
      };
      reader.readAsDataURL(input.files[0]); // Read the file
    } else {
      previewImage.src = "#"; // Reset the image source
      previewImage.classList.add('bg-gray-200'); // Show background color if no image
    }
  }

</script>