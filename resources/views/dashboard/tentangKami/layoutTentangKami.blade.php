@extends('dashboard.layoutDashboard')

@section('tentangKami')
<section class="container px-4 mx-auto">
  <!-- Judul Halaman -->
  <div class="mb-3 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Pengaturan Tentang Kami</h2>
  </div>

  <!-- Penjelasan Singkat -->
  <div class="mb-6">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Halaman ini menampilkan <b>Informasi Tentang Kami</b> yang tersedia di sistem. Anda dapat menambah, memperbarui,
      atau menghapus Tentang Kami sesuai kebutuhan.
    </p>
  </div>


  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden  dark:border-gray-700 md:rounded-lg">

          <!-- Section for Deskripsi Perusahaan -->
          <div class="mb-8 border border-gray-200 p-4">
            @include('dashboard.tentangKami.deskripsiPerusahaan')
          </div>

          <!-- Section for Bagan Organisasi -->
          <div class="mb-8 border border-gray-200 p-4">
            @include('dashboard.tentangKami.kegiatan')
          </div>

          <!-- Section for Bagan Organisasi -->
          <div class="mb-8 border border-gray-200 p-4">
            @include('dashboard.tentangKami.baganOrganisasi')
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Pagination -->

</section>
@endsection