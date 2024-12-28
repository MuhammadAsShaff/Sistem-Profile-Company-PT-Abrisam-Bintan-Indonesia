<!-- Button to Open Modal -->
<button id="openModalButton" onclick="openModal('addPromoModal')"
  class="flex items-center justify-center text-white bg-red-500 rounded-lg w-10 h-10 hover:bg-red-600 focus:ring-4 focus:ring-red-300 focus:outline-none dark:focus:ring-red-800 transition ease-in-out duration-200">
  <svg class="w-4 h-4 transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
    viewBox="0 0 18 18" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 1v16M1 9h16" />
  </svg>
</button>

<dialog id="addPromoModal" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 25%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Tambah Promo</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('addPromoModal')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('promo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-start gap-6">
          <!-- Foto Promo -->
          <div class="flex flex-col items-center justify-center mb-4">
            <!-- Preview Container -->
            <div id="preview-container" class="mt-4">
              <img id="preview-image" src="#" alt="Preview Gambar Promo"
                class="hidden w-64 h-auto border rounded shadow-md" />
            </div>

            <label for="dropzone-file" class="block text-sm font-medium text-gray-700 mt-3">Unggah Gambar Promo</label>
            <input id="dropzone-file" type="file" name="gambar_promo" accept="image/png, image/jpeg, image/jpg"
              class="mt-10" onchange="previewImage(event)">
            <p class="mt-2 text-xs text-red-600 w-full max-w-full break-words">
              *Pastikan gambar yang anda upload berukuran <b>1400x500px</b> <br> dan maksimal size <b>2mb</b>
              bila tidak akan otomatis terpotong.
            </p>
          </div>

          <!-- Nama dan Deskripsi Promo -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500" style="word-wrap: break-word; white-space: normal;">
              Anda dapat menambahkan promo baru dengan nama, deskripsi, dan gambar. Pastikan untuk memasukkan
              informasi terbaru agar data selalu akurat.
            </p>

            <!-- Nama Promo -->
            <div class="mb-4">
              <label for="nama_promo" class="block mb-2 text-sm font-medium text-gray-900">Nama Promo</label>
              <input type="text" name="nama_promo" id="nama_promo"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-[85%] p-2.5"
                placeholder="Nama Promo" required>
            </div>

            <!-- Deskripsi Promo -->
            <div class="mb-4">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Promo</label>
              <textarea name="deskripsi" id="deskripsi" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-[85%] p-2.5"
                placeholder="Deskripsi Promo" required></textarea>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
            Tambah Promo
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
  function previewImage(event) {
    const input = event.target;
    const previewImage = document.getElementById('preview-image');

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the image source
        previewImage.classList.remove('hidden'); // Show the image
      };
      reader.readAsDataURL(input.files[0]); // Read the file
    } else {
      previewImage.src = "#"; // Reset the image source
      previewImage.classList.add('hidden'); // Hide the image
    }
  }

</script>