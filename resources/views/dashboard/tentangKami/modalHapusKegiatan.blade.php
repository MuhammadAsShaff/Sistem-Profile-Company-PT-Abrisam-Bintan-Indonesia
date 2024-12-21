<!-- Modal Delete Kegiatan -->
<dialog id="deleteModalKegiatan-{{ $item->id }}" class="modal rounded-lg shadow-lg modal-hide"
  style="transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-xl shadow p-6 text-center w-80">
    <!-- Close Button -->
    <button type="button" onclick="closeModal('deleteModalKegiatan-{{ $item->id }}')"
      class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>

    <h3 class="mb-4 text-lg font-semibold text-gray-800">Hapus Kegiatan</h3>
    <p class="text-gray-500">Apakah Anda yakin ingin menghapus kegiatan ini?</p>

    <!-- Form Delete Kegiatan -->
    <form action="{{ route('kegiatan.delete', $item->id) }}" method="POST" id="deleteForm-{{ $item->id }}">
      @csrf
      @method('DELETE')

      <!-- Confirm and Cancel Buttons -->
      <div class="flex justify-center mt-4">
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Ya, Hapus</button>
        <button type="button" onclick="closeModal('deleteModalKegiatan-{{ $item->id }}')"
          class="bg-gray-200 text-gray-700 px-4 py-2 rounded ml-2">
          Batal
        </button>
      </div>
    </form>
  </div>
</dialog>