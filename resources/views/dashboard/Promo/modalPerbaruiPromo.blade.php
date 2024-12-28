<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('editCategoryModal-{{ $promo->id_promo }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal -->
<dialog id="editCategoryModal-{{ $promo->id_promo }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
        <h3 class="text-lg font-semibold text-gray-900">Edit promo</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editCategoryModal-{{ $promo->id_promo }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('promo.update', $promo->id_promo) }}" method="POST" enctype="multipart/form-data"
        class="p-4 space-y-6">
        @csrf
        @method('PUT')
        <div class="flex items-start gap-6">
          <!-- Gambar promo -->
          <div class="flex flex-col items-center justify-center">
            <img id="preview-image-promo-{{ $promo->id_promo }}"
              class="w-64 h-auto border rounded shadow-md object-cover"
              src="{{ $promo->gambar_promo ? asset('uploads/promos/' . $promo->gambar_promo) : asset('images/blankImage.jpg') }}"
              alt="Gambar promo" />
            <label for="gambar_promo_{{ $promo->id_promo }}" class="block text-sm font-medium text-gray-700 mt-3">Ubah
              Gambar
              promo</label>
            <input id="gambar_promo_{{ $promo->id_promo }}" name="gambar_promo" type="file"
              accept="image/png, image/jpeg, image/jpg" onchange="previewImagePromo(event, {{ $promo->id_promo }})"
              class="mt-10">
            <p class="mt-2 text-xs text-red-600 w-full max-w-full break-words">
              *Pastikan gambar yang anda upload berukuran <b>1400x500px</b> <br> dan maksimal size <b>2mb</b>
              bila tidak akan otomatis terpotong.
            </p>
          </div>

          <!-- Deskripsi untuk Edit -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500">
              Anda dapat mengedit data promo ini dengan mengganti nama promo<br>atau mengganti gambar promo di
              bawah. Pastikan untuk memasukkan<br>informasi terbaru agar data selalu akurat.
            </p>
            <!-- Nama promo -->
            <div class="mb-4">
              <label for="nama_promo" class="block mb-2 text-sm font-medium text-gray-900">Nama promo</label>
              <input type="text" name="nama_promo" id="nama_promo" value="{{ $promo->nama_promo }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Nama promo" required>
            </div>

            <!-- Deskripsi promo -->
            <div class="mb-4">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi promo</label>
              <textarea name="deskripsi" id="deskripsi" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Deskripsi promo">{{ $promo->deskripsi }}</textarea>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
  function previewImagePromo(event, promoId) {
    const input = event.target;
    const previewImage = document.getElementById('preview-image-promo-' + promoId);

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the image source to the uploaded image
      };
      reader.readAsDataURL(input.files[0]); // Read the file
    }
  }

</script>