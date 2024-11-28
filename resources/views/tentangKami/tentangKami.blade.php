<div class="container mx-auto mt-8 p-6 bg-white rounded-lg ">
    <!-- Header Section -->
    <div class="container mx-auto  bg-gray-50 rounded-lg bg-white mb-[-20]">
    <h1 class="text-3xl font-bold text-gray-800 text-left ml-6 font-telkomsel mt-20">PT Abrisam Bintan Indonesia</h1>
    <p class="ml-6">
      {{$tentangKami->deskripsi_perusahaan}}
    </p>

    </div>

    <!-- Content Section -->
    <div class="flex flex-col md:flex-row items-center gap-10 mt-8">
    <!-- Image Section -->
    <div class="image-section md:w-1/2 flex justify-start ml-6">
      <img src="{{ asset('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan) }}"
      class="rounded-lg shadow-md w-full max-w-md object-cover" />
    </div>

    <!-- Text Section -->
    <div class="text-section md:w-1/2 space-y-8">
      <!-- Visi -->
      <div class="details">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2 font-telkomsel">
        <i class="fas fa-bullseye text-red-500 "></i> Visi
      </h2>
      <p class="text-gray-600 leading-relaxed">
        {{$tentangKami->visi}}
      </p>
      </div>

      <!-- Misi -->
      <div class="details">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2 font-telkomsel">
        <i class="fas fa-lightbulb text-yellow-500"></i> Misi
      </h2>
      <p class="text-gray-600 leading-relaxed">
        {{$tentangKami->misi}}
      </p>
      </div>
    </div>
    </div>
</div>