<button onclick="openModal('editKegiatanModal-{{ $item->id }}')" class="bg-blue-500 text-white px-4 py-2 rounded">
  Perbarui
</button>
<!-- Modal for Editing Kegiatan -->
<dialog id="editKegiatanModal-{{ $item->id }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
        <h3 class="text-lg font-semibold text-gray-900">Edit Kegiatan</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editKegiatanModal-{{ $item->id }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('kegiatan.update', $item->id) }}" method="POST" enctype="multipart/form-data"
        class="p-4 space-y-6">
        @csrf
        @method('PUT')

        <div class="flex items-start gap-6">

          <!-- Gambar Kegiatan -->
          <div class="flex flex-col items-center justify-center">
            <img id="preview-image-update-kegiatan-{{ $item->id }}"
              class="w-64 h-auto border rounded shadow-md object-cover"
              src="{{ $item->gambar ? asset('uploads/kegiatan/' . $item->gambar) : asset('images/blankImage.jpg') }}"
              alt="Gambar Kegiatan" />
            <label for="gambar-{{ $item->id }}" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar
              Kegiatan</label>
            <input id="gambar-{{ $item->id }}" name="gambar" type="file" accept="image/png, image/jpeg, image/jpg"
              onchange="previewImageUpdateKegiatan(event, {{ $item->id }})" class="mt-10">
          </div>

          <!-- Deskripsi untuk Edit -->
          <div class="flex-1">
            <p class="mb-4 text-sm text-gray-500">
              Anda dapat mengedit data kegiatan ini dengan mengganti nama kegiatan atau mengganti gambar kegiatan di
              bawah. Pastikan untuk memasukkan informasi terbaru agar data selalu akurat.
            </p>
            <!-- Nama Kegiatan -->
            <div class="mb-4">
              <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Kegiatan</label>
              <input type="text" name="nama" id="nama" value="{{ $item->nama }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Nama Kegiatan" required>
            </div>

            <!-- Keterangan Kegiatan -->
            <div class="mb-4">
              <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
              <textarea name="keterangan" id="keterangan" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Keterangan Kegiatan">{{ $item->keterangan }}</textarea>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-500 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
  function previewImageUpdateKegiatan(event, kegiatanId) {
    const input = event.target;
    const previewImage = document.getElementById('preview-image-update-kegiatan-' + kegiatanId);

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the image source to the uploaded image
      };
      reader.readAsDataURL(input.files[0]); // Read the file
    }
  }

</script>