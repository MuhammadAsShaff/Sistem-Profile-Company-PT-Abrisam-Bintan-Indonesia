<button type="button" onclick="openModal('deleteModalDeskripsi-{{ $tentangKami->id }}')"
  class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
  Hapus
</button>

<!-- Modal using dialog element -->
<dialog id="deleteModalDeskripsi-{{ $tentangKami->id }}" class="modal rounded-lg shadow-lg modal-hide"
  style=" transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-xl shadow dark:bg-gray-700 p-4 md:p-5 text-center">

    <!-- Close button -->
    <button type="button" onclick="closeModal('deleteModalDeskripsi-{{ $tentangKami->id }}')"
      class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
      <span class="sr-only">Close modal</span>
    </button>

    <!-- Modal content -->
    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus deskripsi perusahaan?</h3>

    <!-- Form to delete the admin -->
    <form action="{{ route('tentangKami.delete', $tentangKami->id) }}" method="POST" class="inline">
      @csrf
      @method('DELETE')
      <button type="submit"
        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
        Ya, Hapus
      </button>
    </form>

    <button type="button" onclick="closeModal('deleteModalDeskripsi-{{ $tentangKami->id }}')"
      class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
      Tidak, Batalkan
    </button>

  </div>
</dialog>