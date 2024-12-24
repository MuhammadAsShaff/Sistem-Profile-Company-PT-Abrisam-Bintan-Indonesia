<!-- Form Utama untuk Create/Update -->
<form action="{{ isset($tentangKami) ? route('tentangKami.update', $tentangKami->id) : route('tentangKami.store') }}"
  method="POST" enctype="multipart/form-data">
  @csrf
  @if(isset($tentangKami))
    @method('PUT')
  @endif

  <!-- Form Fields -->
  <div class="mb-4">
    <label for="deskripsi_perusahaan" class="block text-gray-700 font-medium">Deskripsi Perusahaan</label>
    <textarea name="deskripsi_perusahaan" id="deskripsi_perusahaan" class="w-full border-gray-300 rounded p-2" rows="3"
      required
      oninput="autoResize(this)">{{ isset($tentangKami) ? $tentangKami->deskripsi_perusahaan : old('deskripsi_perusahaan') }}</textarea>
  </div>

  <div class="mb-4">
    <label for="visi" class="block text-gray-700 font-medium">Visi</label>
    <textarea name="visi" id="visi" class="w-full border-gray-300 rounded p-2" rows="2" required
      oninput="autoResize(this)">{{ isset($tentangKami) ? $tentangKami->visi : old('visi') }}</textarea>
  </div>

  <div class="mb-4">
    <label for="misi" class="block text-gray-700 font-medium">Misi</label>
    <textarea name="misi" id="misi" class="w-full border-gray-300 rounded p-2" rows="2" required
      oninput="autoResize(this)">{{ isset($tentangKami) ? $tentangKami->misi : old('misi') }}</textarea>
  </div>

  <div class="mb-4">
    <!-- Preview Container -->
    <div id="preview-container" class="mt-4">
      @if(isset($tentangKami) && $tentangKami->fotoPerusahaan)
      <!-- Jika ada gambar yang sudah tersimpan -->
      <img id="preview-image" src="{{ asset('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan) }}"
      alt="Foto Perusahaan" class="w-64 h-auto border rounded shadow-md" />
    @else
      <!-- Jika belum ada gambar -->
      <img id="preview-image" src="#" alt="Preview Foto Perusahaan"
      class="hidden w-64 h-auto border rounded shadow-md" />
    @endif
    </div>
    <label for="fotoPerusahaan" class="block text-gray-700 font-medium">Foto Perusahaan</label>
    <input type="file" name="fotoPerusahaan" id="fotoPerusahaan" class="w-full border-gray-300 rounded p-2"
      accept="image/*" onchange="previewImage(event)" />
    <p class="mt-2 text-xs text-red-600 w-full max-w-full break-words">
      *Pastikan gambar yang anda upload berukuran <b>1350x1020px</b> <br> dan maksimal size <b>10mb</b>
      bila tidak akan otomatis terpotong.
    </p>
  </div>
  <!-- Submit and Delete Buttons -->
  <div class="flex items-center gap-4">
    <!-- Button Create/Update -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
      {{ isset($tentangKami) ? 'Perbarui' : 'Tambah' }}
    </button>
  </div>
</form>

@if(isset($tentangKami))
  @include('dashboard.tentangKami.modalHapusDeskripsi')
@endif

<script>
  // Function to automatically resize the textarea based on content
  function autoResize(textarea) {
    textarea.style.height = 'auto';  // Reset height to calculate new height
    textarea.style.height = textarea.scrollHeight + 'px';  // Set new height based on content
  }
  // Function to preview the uploaded image
  function previewImage(event) {
    const input = event.target;
    const previewImage = document.getElementById('preview-image');

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the image source
        previewImage.classList.remove('hidden'); // Show the image
      };
      reader.readAsDataURL(input.files[0]); // Read the file
    } else {
      previewImage.src = "#"; // Reset the image source
      previewImage.classList.add('hidden'); // Hide the image
    }
  }
</script>