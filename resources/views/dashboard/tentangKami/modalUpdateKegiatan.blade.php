
  <!-- Modal for Editing Kegiatan -->
  <dialog id="editKegiatanModal-{{ $item->id }}" class="modal rounded-lg shadow-lg w-full max-w-4xl modal-hide">
    <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal Header -->
    <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
      <h3 class="text-lg font-semibold text-gray-900">Edit Kegiatan</h3>
      <button type="button" onclick="closeModal('editKegiatanModal-{{ $item->id }}')"
      class="text-gray-400 hover:text-gray-600">
      <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
      </button>
    </div>

    <!-- Modal Body with Form -->
    <form action="{{ route('kegiatan.update', $item->id) }}" method="POST" enctype="multipart/form-data"
      class="p-4 space-y-6">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-2 gap-6">
      <!-- Gambar Section -->
      <div class="col-span-2 flex items-center space-x-4">
        <img class="object-cover w-16 h-16 rounded-full"
        src="{{ $item->gambar ? asset('uploads/kegiatan/' . $item->gambar) : asset('images/blankProfile.jpg') }}"
        alt="Gambar Kegiatan">
        <div>
        <h4 class="text-lg font-medium text-gray-900">Edit Kegiatan - {{ $item->nama }}</h4>
        <p class="text-sm text-gray-600">Update details as needed.</p>
        </div>
      </div>

      <!-- Nama Kegiatan -->
      <div class="col-span-2"> <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama
        Kegiatan</label>
        <input type="text" name="nama" id="nama" value="{{ $item->nama }}"
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
        placeholder="Nama Kegiatan" required>
        @error('nama')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
      </div>

      <!-- Keterangan Kegiatan -->
      <div class="col-span-2">
        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
        <textarea name="keterangan" id="keterangan" rows="3" class="shadow-sm bg-gray-50 border border-gray-300
    text-gray-900 text-sm rounded-lg block w-full p-2.5"
        placeholder="Keterangan Kegiatan">{{ $item->keterangan }}</textarea>
        @error('keterangan')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
      </div>

      <!-- Update Gambar -->
      <div class="col-span-2">
        <label for="gambar" class="block text-sm font-medium text-gray-700">Ubah Gambar Kegiatan</label>
        <div class="flex items-center justify-center w-full">
        <label for="gambar"
          class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
          <input id="gambar" name="gambar" type="file" accept="image/png, image/jpeg, image/jpg">
        </label>
        </div>
      </div>
      </div>

      <!-- Modal Footer -->
      <div class="flex justify-end p-4 border-t border-gray-200">
      <button type="submit"
        class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-500 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300">
        Simpan Perubahan
      </button>
      </div>
    </form>
    </div>
  </dialog>
