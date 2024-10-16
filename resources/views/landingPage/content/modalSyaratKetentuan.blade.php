<!-- Tombol untuk membuka modal syarat ketentuan -->
<button
  class="ml-2 text-sm font-medium text-red-500 hover:text-red-900 transition-colors duration-200 focus:outline-none"
  onclick="openModal('syaratModal-{{ $kategori->id_kategori }}')">
  Lihat Syarat <br> dan Ketentuan
</button>

<!-- Modal Syarat dan Ketentuan -->
<dialog id="syaratModal-{{ $kategori->id_kategori }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%); height: 80vh;">
  <div class="relative bg-white rounded-lg shadow-lg p-6 h-full" id="modalContent" style="overflow-y: auto;">
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Syarat dan Ketentuan Kategori {{ $kategori->nama_kategori }}</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="closeModal('syaratModal-{{ $kategori->id_kategori }}')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
      <!-- Paragraf Syarat dan Ketentuan -->
      @php
    // Cek apakah syarat_ketentuan masih berupa string JSON
    $syaratKetentuan = is_string($kategori->syarat_ketentuan) ? json_decode($kategori->syarat_ketentuan, true) : $kategori->syarat_ketentuan;
    @endphp

      @if (isset($syaratKetentuan) && is_array($syaratKetentuan) && count($syaratKetentuan) > 0)
      @foreach ($syaratKetentuan as $index => $syarat)
      <p class="text-sm text-gray-900 mb-4">
      <strong>Syarat {{ $index + 1 }}:</strong> {{ $syarat }}
      </p>
    @endforeach
    @endif
    </div>
  </div>
</dialog>