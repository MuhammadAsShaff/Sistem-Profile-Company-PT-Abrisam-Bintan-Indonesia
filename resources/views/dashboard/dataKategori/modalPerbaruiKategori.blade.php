<!-- Button to trigger modal -->
<button id="openModalButton"
  onclick="openModal('editCategoryModal-{{ $kategori->id_kategori }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal -->
<dialog id="editCategoryModal-{{ $kategori->id_kategori }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
        <h3 class="text-lg font-semibold text-gray-900">Edit Kategori</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editCategoryModal-{{ $kategori->id_kategori }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" enctype="multipart/form-data"
        class="p-4 space-y-6">
        @csrf
        @method('PUT')
        <div class="flex items-start gap-6">
          <!-- Gambar Kategori -->
          <div class="flex flex-col items-center justify-center">
            <img class="w-32 h-32 object-cover rounded-lg"
              src="{{ $kategori->gambar_kategori ? asset('uploads/kategori/' . $kategori->gambar_kategori) : asset('images/blankImage.jpg') }}"
              alt="Gambar Kategori">
            <label for="gambar_kategori" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar
              Kategori</label>
            <input id="gambar_kategori" name="gambar_kategori" type="file" accept="image/png, image/jpeg, image/jpg"
              class="mt-10">
          </div>

          <!-- Deskripsi untuk Edit -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500">
              Anda dapat mengedit data kategori ini dengan mengganti nama kategori<br>atau mengganti gambar kategori di
              bawah. Pastikan untuk memasukkan<br>informasi terbaru agar data selalu akurat.
            </p>
            <!-- Nama Kategori -->
            <div class="mb-4">
              <label for="nama_kategori" class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
              <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Nama Kategori" required>
            </div>

            <!-- Deskripsi Kategori -->
            <div class="mb-4">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Kategori</label>
              <textarea name="deskripsi" id="deskripsi" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Deskripsi Kategori">{{ $kategori->deskripsi }}</textarea>
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
