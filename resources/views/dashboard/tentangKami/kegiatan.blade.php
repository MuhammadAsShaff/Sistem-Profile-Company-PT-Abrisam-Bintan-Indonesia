<section class="bg-white dark:bg-gray-900">
  <div class="container px-4 py-10 mx-auto">
    <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl">Foto Kegiatan</h1>
    <p class="text-gray-500">Kegiatan dan dokumentasi dari berbagai acara kami.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-8 xl:mt-12 xl:gap-12">
      @if($kegiatan->isEmpty())
      <!-- Gambar default jika tidak ada data kegiatan -->
      <div class="flex items-center justify-center bg-gray-300 rounded-lg h-32">
      <span class="text-gray-500 font-semibold">Tidak Ada Gambar</span>
      </div>
    @else
      <!-- Looping untuk menampilkan gambar kegiatan jika ada -->
      @include('dashboard.tentangKami.modalUpdateKegiatan')
    @endif
    </div>
    <!-- Button to open the create modal positioned at the bottom left -->
    <div class="flex justify-start mt-8">
      <button onclick="openModal('createModalKegiatan')"
        class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
      @include('dashboard.tentangKami.modalInsertKegiatan')
    </div>
  </div>
</section>

