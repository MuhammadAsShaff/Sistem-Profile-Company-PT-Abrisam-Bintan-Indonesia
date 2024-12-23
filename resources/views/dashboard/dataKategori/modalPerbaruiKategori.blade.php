<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('editCategoryModal-{{ $kategori->id_kategori }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal Update Kategori -->
<dialog id="editCategoryModal-{{ $kategori->id_kategori }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <div class="relative bg-white rounded-lg">
      <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
        <h3 class="text-lg font-semibold text-gray-900">Edit Kategori</h3>
        <button type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editCategoryModal-{{ $kategori->id_kategori }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" enctype="multipart/form-data"
        id="kategoriUpdateForm-{{ $kategori->id_kategori }}" class="p-4 space-y-6">
        @csrf
        @method('PUT')
        <div class="flex items-start gap-6">
          <!-- Gambar Kategori -->
          <div class="flex flex-col items-center justify-center">
            <!-- Menampilkan gambar kategori jika ada, atau gambar default jika tidak ada -->
            <img id="preview-image-update-{{ $kategori->id_kategori }}" class="w-32 h-32 object-cover rounded-lg"
              src="{{ $kategori->gambar_kategori ? asset('uploads/kategori/' . $kategori->gambar_kategori) : asset('images/blankImage.jpg') }}"
              alt="Gambar Kategori">

            <!-- Label untuk input file gambar -->
            <label for="gambar_kategori" class="block text-sm font-medium text-gray-700 mt-3">Ubah Gambar
              Kategori</label>

            <!-- Input file untuk memilih gambar -->
            <input id="gambar_kategori-{{ $kategori->id_kategori }}" name="gambar_kategori" type="file"
              accept="image/png, image/jpeg, image/jpg" class="mt-10"
              onchange="previewImageKategoriUpdate(event, {{ $kategori->id_kategori }})">
          </div>

          <div class="flex-1">
            <div class="mb-4">
              <label for="nama_kategori" class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
              <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Nama Kategori" required>
            </div>

            <div class="mb-4">
              <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Kategori</label>
              <textarea name="deskripsi" id="deskripsi" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Deskripsi Kategori">{{ $kategori->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
              <!-- Textarea Syarat dan Ketentuan -->
              <label for="syarat_ketentuan-{{ $kategori->id_kategori }}"
                class="block mb-2 text-sm font-medium text-gray-900">
                Syarat dan Ketentuan
              </label>
              @php
$syaratKetentuan = is_string($kategori->syarat_ketentuan) ? json_decode($kategori->syarat_ketentuan, true) : $kategori->syarat_ketentuan;
$syaratKetentuanWithNumbers = '';
if ($syaratKetentuan) {
  foreach ($syaratKetentuan as $index => $syarat) {
    $syaratKetentuanWithNumbers .= ($index + 1) . '. ' . $syarat . "\n";
  }
}
      @endphp
              <textarea name="syarat_ketentuan[]" id="syarat_ketentuan-{{ $kategori->id_kategori }}" rows="3"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-5/6 p-2.5"
                placeholder="Syarat dan Ketentuan Kategori">{{ $syaratKetentuanWithNumbers }}</textarea>

            </div>
          </div>
        </div>

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

<script>

   // Fungsi untuk memperbarui preview gambar saat file dipilih
    function previewImageKategoriUpdate(event, kategoriId) {
      const file = event.target.files[0]; // Ambil file yang dipilih
      const preview = document.getElementById('preview-image-update-' + kategoriId); // Ambil elemen <img> untuk preview

      if (file) {
        // Membuat URL sementara untuk file yang dipilih
        const reader = new FileReader();

        reader.onload = function (e) {
          // Set src dari <img> ke URL sementara yang dibuat
          preview.src = e.target.result;
        };

        reader.readAsDataURL(file); // Membaca file sebagai data URL
      } else {
        // Jika tidak ada file yang dipilih, set gambar default
        preview.src = "{{ asset('images/blankImage.jpg') }}";
      }
    }
  // Fungsi untuk otomatis menambahkan nomor pada textarea dan menjaga kursor di posisi akhir
  function updateSyaratKetentuan(id_kategori) {
    const textarea = document.getElementById('syarat_ketentuan-' + id_kategori);
    const lines = textarea.value.split('\n');

    // Tambahkan nomor untuk setiap baris yang tidak kosong
    const numberedLines = lines.map((line, index) => {
      const cleanLine = line.replace(/^\d+\.\s*/, ''); // Bersihkan nomor lama jika ada
      return (cleanLine.trim() !== '') ? (index + 1) + '. ' + cleanLine : ''; // Tambahkan nomor baru
    });

    textarea.value = numberedLines.join('\n'); // Update isi textarea

    // Set kursor di akhir isi textarea
    textarea.focus();
    textarea.setSelectionRange(textarea.value.length, textarea.value.length); // Memastikan kursor di akhir teks
  }

  // Update setiap kali ada input di textarea
  document.getElementById('syarat_ketentuan-{{ $kategori->id_kategori }}').addEventListener('input', function () {
    updateSyaratKetentuan('{{ $kategori->id_kategori }}');
  });

  document.getElementById('kategoriUpdateForm-{{ $kategori->id_kategori }}').addEventListener('submit', function (e) {
    const textarea = document.getElementById('syarat_ketentuan-{{ $kategori->id_kategori }}');

    // Ambil setiap baris dari textarea, hapus nomor yang ada, dan simpan sebagai array
    const lines = textarea.value.split('\n').map(line => line.replace(/^\d+\.\s*/, '').trim()).filter(line => line !== '');

    // Buat hidden input untuk mengirimkan array
    lines.forEach((line, index) => {
      const hiddenInput = document.createElement('input');
      hiddenInput.type = 'hidden';
      hiddenInput.name = `syarat_ketentuan[${index}]`;
      hiddenInput.value = line;  // Setiap baris sebagai elemen array
      this.appendChild(hiddenInput);
    });
  });

</script>