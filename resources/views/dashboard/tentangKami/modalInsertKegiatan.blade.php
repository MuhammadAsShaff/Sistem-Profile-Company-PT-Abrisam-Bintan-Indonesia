<dialog id="createModalKegiatan" class="modal rounded-lg shadow-lg modal-hide" style="transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-xl shadow p-6 w-full max-w-md">
    <!-- Close Button -->
    <button type="button" onclick="closeModal('createModalKegiatan')"
      class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8">
      <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1l6 6m0 0l6 6M7 7L1 1m0 12L7 7m6 6L7 7" />
      </svg>
    </button>

    <!-- Modal Title -->
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Kegiatan Baru</h3>

    <!-- Form to add new kegiatan -->
    <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label for="nama" class="block text-gray-700">Nama Kegiatan</label>
        <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded p-2" required>
      </div>

      <div class="mb-4">
        <label for="keterangan" class="block text-gray-700">Keterangan</label>
        <textarea name="keterangan" id="keterangan" class="w-full border border-gray-300 rounded p-2" rows="3"
          required></textarea>
      </div>

      <div class="mb-4">
        <label for="gambar" class="block text-gray-700">Gambar Kegiatan</label>
        <input type="file" name="gambar" id="gambar" class="w-full border border-gray-300 rounded p-2" accept="image/*"
          required>
      </div>

      <!-- Submit button -->
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Tambah Kegiatan</button>
    </form>
  </div>
</dialog>