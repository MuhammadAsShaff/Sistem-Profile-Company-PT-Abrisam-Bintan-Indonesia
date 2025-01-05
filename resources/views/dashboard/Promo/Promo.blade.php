@extends('dashboard.layoutDashboard')

@section('Promo')
<section class="container px-4 mx-auto">
  <section class="container px-4 mx-auto">
    <!-- Baris Pertama: Judul Halaman -->
    <div class="mb-3 mt-8">
      <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Promo yang Terdaftar pada Sistem</h2>
    </div>

    <!-- Baris Kedua: Penjelasan Singkat -->
    <div class="mb-6">
      <p class="text-sm text-gray-600 dark:text-gray-300">
        Halaman ini menampilkan <b>Informasi Promo</b> yang tersedia di sistem, termasuk gambar, nama promo, dan
        deskripsi. Anda dapat menambah, memperbarui, atau menghapus promo sesuai kebutuhan.
      </p>
    </div>

    <!-- Baris Ketiga: Jumlah Promo dan Search Bar -->
    <div class="flex justify-between items-center gap-x-3">
      <!-- Jumlah Promo -->
      <div class="flex items-center gap-x-3">
        <span class="px-3 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
          {{ $promoCount }} Promo
        </span>
      </div>

      <!-- Search Bar -->
      <div class="flex items-center space-x-2 w-full max-w-lg">
        <div class="flex-grow">
          @include('dashboard.Promo.searchBar')
        </div>

        <!-- Tombol Tambah Promo -->
        @include('dashboard.Promo.modalInsertPromo')
      </div>
    </div>
  </section>

  <!-- Table Promo -->
  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>
                <th scope="col"
                  class="w-1/12 py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Nomor
                </th>
                <th scope="col"
                  class="w-2/12 px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Nama Promo
                </th>
                <th scope="col"
                  class="w-3/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar Promo
                </th>
                <th scope="col"
                  class="w-4/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Deskripsi Promo
                </th>
                <th scope="col"
                  class="w-2/12 relative py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @forelse ($promos as $promo)
              <tr>
              <!-- Nomor Promo -->
              <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
              {{ ($promos->currentPage() - 1) * $promos->perPage() + $loop->iteration }}
              </td>

              <!-- Nama Promo -->
              <td class="px-12 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
              {{ $promo->nama_promo }}
              </td>

              <!-- Gambar Promo -->
              <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              @if($promo->gambar_promo)
        <img class="w-32 h-auto object-cover rounded-md"
        src="{{ asset('uploads/promos/' . $promo->gambar_promo) }}" alt="Gambar Promo">
      @else
          <span class="text-xs text-gray-400">Tidak ada gambar</span>
          @endif
              </td>

              <!-- Deskripsi Promo -->
              <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              {{ Str::limit($promo->deskripsi, 100) }}
              </td>

              <!-- Aksi -->
              <td class="px-4 py-4 text-sm whitespace-nowrap">
              <div class="flex items-center gap-x-6">
              <!-- Edit Button -->
              @include('dashboard.Promo.modalPerbaruiPromo')

              <!-- Delete Button -->
              @include('dashboard.Promo.modalHapusPromo')
              </div>
              </td>
              </tr>
      @empty
        <tr>
        <td colspan="12" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
          Tidak ada data Promo.
        </td>
        </tr>
      @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  @include('dashboard.Promo.pagination')
</section>

@endsection