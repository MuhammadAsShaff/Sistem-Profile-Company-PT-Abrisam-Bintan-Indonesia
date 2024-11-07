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

  <!-- Submit and Delete Buttons -->
  <div class="flex items-center gap-4">
    <!-- Button Create/Update -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
      {{ isset($tentangKami) ? 'Update' : 'Create' }}
    </button>

    <!-- Button Delete (Conditional) -->
    @if(isset($tentangKami))
    <button type="button" onclick="openModal('deleteModalDeskripsi')" class="bg-red-500 text-white px-4 py-2 rounded">
      Hapus
    </button>
    @include('dashboard.tentangKami.modalHapusDeskripsi')
  @endif
  </div>
</form>

<script>
  // Function to automatically resize the textarea based on content
  function autoResize(textarea) {
    textarea.style.height = 'auto';  // Reset height to calculate new height
    textarea.style.height = textarea.scrollHeight + 'px';  // Set new height based on content
  }
</script>