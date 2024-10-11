<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('editBlogModal-{{ $blog->id_blog }}')"
  class="flex items-center justify-center text-white bg-red-500 rounded-lg w-10 h-10 hover:bg-red-600 focus:ring-4 focus:ring-red-300 focus:outline-none dark:focus:ring-red-800 transition ease-in-out duration-200">
  <svg class="w-4 h-4 transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
    viewBox="0 0 18 18" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 1v16M1 9h16" />
  </svg>
</button>

<!-- Modal Edit Blog -->
<dialog id="editBlogModal-{{ $blog->id_blog }}" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Edit Blog</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editBlogModal-{{ $blog->id_blog }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('blog.update', $blog->id_blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex items-start gap-6">
          <!-- Gambar Blog -->
          <div class="flex flex-col items-center justify-center">
            <label for="gambar_cover" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar Cover</label>
            <input id="gambar_cover" type="file" name="gambar_cover" accept="image/png, image/jpeg, image/jpg"
              class="mt-2">
            <label for="gambar_ilustrasi" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar Ilustrasi</label>
            <input id="gambar_ilustrasi" type="file" name="gambar_ilustrasi" accept="image/png, image/jpeg, image/jpg"
              class="mt-2">
          </div>

          <!-- Nama dan Isi Blog -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500">
              Anda dapat memperbarui blog dengan judul, isi, dan gambar. <br> Pastikan untuk selalu memperbarui data.
            </p>

            <!-- Judul Blog -->
            <div class="mb-4">
              <label for="judul_blog" class="block mb-2 text-sm font-medium text-gray-900">Judul Blog</label>
              <input type="text" name="judul_blog" id="judul_blog"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-[85%] p-2.5"
                value="{{ $blog->judul_blog }}" required>
            </div>

            <!-- Isi Blog -->
            <div class="mb-4">
              <label for="isi_blog" class="block mb-2 text-sm font-medium text-gray-900">Isi Blog</label>
              <textarea name="isi_blog" id="isi_blog" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-[85%] p-2.5"
                required>{{ $blog->isi_blog }}</textarea>
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
