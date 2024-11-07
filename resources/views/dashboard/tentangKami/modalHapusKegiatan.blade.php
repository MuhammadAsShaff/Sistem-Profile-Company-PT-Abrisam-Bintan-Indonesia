<!-- Modal Delete Kegiatan -->
<dialog id="deleteModalKegiatan-{{ $item->id }}" class="modal rounded-lg shadow-lg modal-hide"
  style="transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-xl shadow p-6 text-center w-80">
    <!-- Close Button -->
    <button type="button" onclick="closeModal('deleteModalKegiatan-{{ $item->id }}')"
      class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
      <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1l6 6m0 0l6 6M7 7L1 1m0 12L7 7m6 6L7 7" />
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