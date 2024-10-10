<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('editBlogModal-{{ $blog->id_blog }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal -->
<dialog id="editBlogModal-{{ $blog->id_blog }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
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
          <div class="flex flex-col items-center">
            <label for="gambar_cover" class="block text-sm font-medium text-gray-700">Ubah Gambar Cover</label>
            <input type="file" name="gambar_cover" accept="image/png, image/jpeg, image/jpg" class="mt-2">

            <label for="gambar_ilustrasi" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar
              Ilustrasi</label>
            <input type="file" name="gambar_ilustrasi" accept="image/png, image/jpeg, image/jpg" class="mt-2">
          </div>

          <div class="flex-1">
            <div class="mb-4">
              <label for="judul_blog" class="block mb-2 text-sm font-medium text-gray-900">Judul Blog</label>
              <input type="text" name="judul_blog" value="{{ $blog->judul_blog }}" class="w-full p-2 border rounded-md"
                required>
            </div>

            <div class="mb-4">
              <label for="isi_blog" class="block mb-2 text-sm font-medium text-gray-900">Isi Blog</label>
              <textarea name="isi_blog" rows="5" class="w-full p-2 border rounded-md"
                required>{{ $blog->isi_blog }}</textarea>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md">Simpan Perubahan</button>
        </div>
      </form>

    </div>
  </div>
</dialog> 