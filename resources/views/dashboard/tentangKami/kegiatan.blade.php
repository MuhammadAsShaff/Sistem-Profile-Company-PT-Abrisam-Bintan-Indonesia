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
      @foreach($kegiatan as $item)
      <div class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer">
      <img src="{{ asset('uploads/kegiatan/' . $item->gambar) }}" alt="Gambar Kegiatan"
      class="w-full h-60 object-cover">
      <div class="p-4">
      <h2 class="text-lg font-semibold text-gray-800 capitalize">{{ $item->nama }}</h2>
      <p class=" text-gray-600 text-sm">{{ $item->keterangan }}</p>
      <button onclick="openModal('editKegiatanModal-{{ $item->id }}')"
      class="bg-blue-500 text-white px-4 py-2 rounded">
      Edit
      </button>
      <button type="button" onclick="openModal('deleteModalKegiatan-{{ $item->id }}')"
      class="bg-red-500 text-white px-4 py-2 rounded">Hapus
      </button>
      </div>
      </div>
      <!-- Looping untuk menampilkan gambar kegiatan jika ada -->
      @include('dashboard.tentangKami.modalUpdateKegiatan')
      @include('dashboard.tentangKami.modalHapusKegiatan')
    @endforeach
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