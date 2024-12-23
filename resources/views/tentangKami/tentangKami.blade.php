@if ($tentangKami)
  <div class="container mx-auto mt-20 p-6 bg-white rounded-lg">
    <!-- Header Section -->
    <div class="rounded-lg mb-4 "> <!-- Menambahkan padding untuk header -->
    <h1 class="text-3xl font-bold text-gray-800 text-left font-telkomsel mt-4">PT Abrisam Bintan Indonesia</h1>
    <p class="mt-2 text-gray-600 text-justify"> <!-- Justify untuk mobile, rata kiri untuk desktop -->
      {{$tentangKami->deskripsi_perusahaan}}
    </p>
    </div>

    <!-- Content Section -->
    <div class="flex flex-col md:flex-row items-center gap-10 mt-8">
    <!-- Image Section -->
    <div class="image-section md:w-1/2 flex justify-center md:justify-start">
      <img src="{{ asset('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan) }}"
      class="rounded-lg shadow-md w-full max-w-md object-cover" />
    </div>

    <!-- Text Section -->
    <div class="text-section md:w-1/2 space-y-6"> <!-- Mengurangi jarak antar elemen -->
      <!-- Visi -->
      <div class="details">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2 font-telkomsel">
        <i class="fas fa-arrow-right text-red-500"></i> Visi
      </h2>
      <p class="text-gray-600 leading-relaxed text-justify ">
        <!-- Justify untuk mobile, rata kiri untuk desktop -->
        {{$tentangKami->visi}}
      </p>
      </div>

      <!-- Misi -->
      <div class="details">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2 font-telkomsel">
        <i class="fas fa-arrow-right text-red-500"></i> Misi
      </h2>
      <p class="text-gray-600 leading-relaxed text-justify ">
        <!-- Justify untuk mobile, rata kiri untuk desktop -->
        {{$tentangKami->misi}}
      </p>
      </div>
    </div>
    </div>
  </div>
@endif