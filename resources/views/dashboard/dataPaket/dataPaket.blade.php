@extends('dashboard.layoutDashboard')

@section('Paket')
<section class="container px-4 mx-auto">
  <section class="container px-4 mx-auto">
    <!-- Baris Pertama: Judul Halaman -->
    <div class="mb-3 mt-8">
      <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Paket yang Terdaftar pada Sistem</h2>
    </div>

    <!-- Baris Kedua: Penjelasan Singkat -->
    <div class="mb-6">
      <p class="text-sm text-gray-600 dark:text-gray-300">
        Halaman ini menampilkan <b>Informasi Paket</b> yang tersedia di sistem, termasuk gambar, nama, dan deskripsi
        paket.
        Anda dapat menambah, memperbarui, atau menghapus paket sesuai kebutuhan.
      </p>
    </div>

    <!-- Baris Ketiga: Search Bar dan Tombol Tambah Paket -->
    <div class="flex justify-between items-center gap-x-3">
      <div class="flex items-center gap-x-3">
        <span class="px-3 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
          {{ $paketCount }} Paket
        </span>
      </div>

      <!-- Search Bar -->
      <div class="flex items-center space-x-2 w-full max-w-lg">
        <div class="flex-grow">
          @include('dashboard.dataPaket.searchBar')
        </div>
        <!-- Tombol Tambah Paket -->
        @include('dashboard.dataPaket.modalInsertPaket')
      </div>
    </div>
  </section>

  <!-- Table Paket -->
  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>
                <th scope="col"
                  class="w-1/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Nomor
                </th>
                <th scope="col"
                  class="w-2/12 px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Nama Paket
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar Paket
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Jumlah Produk
                </th>
                <th scope="col"
                  class="w-4/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Deskripsi Paket
                </th>
                <th scope="col"
                  class="w-2/12 py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @foreach ($pakets as $paket)
              <tr>
              <!-- Nomor Urutan -->
              <td class="w-1/12 px-4 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
              {{ ($pakets->currentPage() - 1) * $pakets->perPage() + $loop->iteration }}
              </td>

              <!-- Nama Paket -->
              <td class="w-2/12 px-12 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
              {{ $paket->nama_paket }}
              </td>

              <!-- Gambar Paket -->
              <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              @if($paket->gambar_paket)
            <img class="object-cover w-16 h-16 rounded-lg"
            src="{{ asset('uploads/paket/' . $paket->gambar_paket) }}" alt="Gambar Paket">
            @else
            <span class="text-xs text-gray-400">Tidak ada gambar</span>
            @endif
              </td>

              <!-- Jumlah Produk -->
              <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              <span
              class="px-3 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
              {{ $paket->produk_count }} Produk
              </span>
              @include('dashboard.dataPaket.modalJumlahProduk')
              </td>

              <!-- Deskripsi Paket -->
              <td class="w-4/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              {{ Str::limit($paket->deskripsi, 100) }}
              </td>

              <!-- Aksi -->
              <td class="w-2/12 px-4 py-4 text-sm whitespace-nowrap">
              <div class="flex items-center gap-x-6">
              <!-- Edit Button -->
              @include('dashboard.dataPaket.modalPerbaruiPaket')

              <!-- Delete Button -->
              @include('dashboard.dataPaket.modalHapusPaket')
              </div>
              </td>
              </tr>
      @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  @include('dashboard.dataPaket.pagination')
</section>
@endsection
