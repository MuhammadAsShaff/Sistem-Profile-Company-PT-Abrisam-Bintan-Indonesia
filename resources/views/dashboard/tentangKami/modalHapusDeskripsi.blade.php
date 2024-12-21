<dialog id="deleteModalDeskripsi-{{ $tentangKami->id }}" class="modal rounded-lg shadow-lg modal-hide"
  style="transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-xl shadow p-4 text-center">
    <!-- Tombol Close -->
    <button type="button" onclick="closeModal('deleteModalDeskripsi')"
      class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>

    <!-- Icon dan Judul Modal -->
    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none"
      viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin menghapus data ini?</h3>

    <!-- Form Delete -->
    <form action="{{ route('tentangKami.delete', $tentangKami->id) }}" method="POST"
      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
      @csrf
      @method('DELETE') <!-- Spoofing method DELETE -->
      <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
    </form>


    <!-- Tombol Batalkan -->
    <button type="button" onclick="closeModal('deleteModal')"
      class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">
      Tidak, Batalkan
    </button>
  </div>
</dialog>