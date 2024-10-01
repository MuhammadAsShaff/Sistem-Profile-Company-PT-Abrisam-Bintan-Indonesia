@extends('dashboard.layoutDashboard')

@section('kategori') 
<section class="container px-4 mx-auto">
  <!-- Baris Pertama: Judul Halaman -->
  <div class="mb-3 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Kategori yang Terdaftar pada Sistem</h2>
  </div>

  <!-- Baris Kedua: Penjelasan Singkat -->
  <div class="mb-6">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Halaman ini menampilkan <b>Informasi Kategori</b> yang tersedia di sistem, termasuk nama kategori.
      Anda dapat menambah, memperbarui, atau menghapus kategori sesuai kebutuhan.
    </p>
  </div>

  <!-- Baris Ketiga: Search Bar dan Tombol Tambah Kategori -->
  <div class="flex justify-between items-center gap-x-3">
    <div class="flex items-center gap-x-3">
      <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
        {{ $kategoriCount }} Kategori
      </span>
    </div>

    <!-- Search Bar dan Tombol Tambah Kategori -->
    <div class="flex items-center space-x-2 w-full max-w-lg">
      <div class="flex-grow">
        @include('dashboard.dataKategori.searchBar')
      </div>
      @include('dashboard.dataKategori.modalInsertKategori')
    </div>
  </div>

  <!-- Table Kategori -->
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
                  Nama Kategori
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar Kategori
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Jumlah Produk
                </th>
                <th scope="col"
                  class="w-4/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Deskripsi Kategori
                </th>
                <th scope="col"
                  class="w-2/12 py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @foreach ($kategoris as $kategori)
            <tr>
            <!-- Nomor Urutan -->
            <td class="w-1/12 px-4 py-4 text-sm font-medium text-gray-700 dark:text-white">
            {{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration }}
            </td>

            <!-- Nama Kategori -->
            <td class="w-2/12 px-12 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
            {{ $kategori->nama_kategori }}
            </td>

            <!-- Gambar Kategori -->
            <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            @if($kategori->gambar_kategori)
          <img class="object-cover w-16 h-16 rounded-lg"
          src="{{ asset('uploads/kategori/' . $kategori->gambar_kategori) }}" alt="Gambar Kategori">
          @else
          <span class="text-xs text-gray-400">Tidak ada gambar</span>
          @endif
            </td>

            <!-- Jumlah Produk -->
            <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
              {{ $kategori->produk_count }} Produk
            </span>
            @include('dashboard.dataKategori.modalJumlahProduk')
            </td>

            <!-- Deskripsi Kategori -->
            <td class="w-4/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}
            </td>

            <!-- Aksi -->
            <td class="px-4 py-4 text-sm whitespace-nowrap">
            <div class="flex items-center gap-x-6">
            @include('dashboard.dataKategori.modalPerbaruiKategori')
            @include('dashboard.dataKategori.modalHapusKategori')
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
  @include('dashboard.dataKategori.pagination')
</section>
@endsection