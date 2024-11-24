@extends('dashboard.layoutDashboard')

@section('produkMasuk')
<section class="container px-4 mx-auto">
  <!-- Judul Halaman -->
  <div class="mb-3 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Inventory Masuk</h2>
  </div>

  <!-- Penjelasan Singkat -->
  <div class="mb-6">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Halaman ini menampilkan <b>Inventory Masuk</b> yang tersedia di sistem. Anda dapat menambah, memperbarui, atau
      menghapus data sesuai kebutuhan.
    </p>
  </div>

  <!-- Statistik Jumlah Inventory -->
  <div class="flex justify-between items-center gap-x-3">
    <div class="flex items-center gap-x-3">
      <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
        Total: {{ $jumlahStockMasukPerKategori->sum('jumlah') }} Inventory Masuk
      </span>
    </div>

    <!-- Search Bar -->
    <div class="flex items-center space-x-2 w-full max-w-lg">
      <div class="flex-grow">
        @include('dashboard.inventory.inventoryMasuk.searchBar')
      </div>
      @include('dashboard.inventory.inventoryMasuk.modalInsertInventori')
      <!-- Tombol Export -->
      <a href="{{ route('export.inventoryMasuk') }}"
        class="inline-flex items-center space-x-2 px-3 py-2.5 bg-green-500 text-sm font-medium text-white rounded-lg hover:bg-green-500 focus:outline-none focus:ring focus:ring-green-300">
        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v9.293l-2-2a1 1 0 0 0-1.414 1.414l.293.293h-6.586a1 1 0 1 0 0 2h6.586l-.293.293A1 1 0 0 0 18 16.707l2-2V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
            clip-rule="evenodd" />
        </svg>
        <span>Excel</span>
      </a>
    </div>
  </div>

  <!-- Tabel Inventory Masuk -->
  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>
                <th class="px-4 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Nomor</th>
                <th class="px-12 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Kategori Produk
                </th>
                <th class="px-4 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Jumlah Stok</th>
                <th class="px-4 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Lihat Produk</th>
                <th class="px-4 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @forelse ($inventoryMasuk as $index => $item)
                <tr>
                <!-- Nomor -->
                <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-white">
                  {{ ($inventoryMasuk->currentPage() - 1) * $inventoryMasuk->perPage() + $loop->iteration }}
                </td>

                <!-- Kategori Produk -->
                <td class="px-12 py-4 text-sm font-medium text-gray-700 dark:text-white">
                  {{ $item->kategoriProduk }}
                </td>

                <!-- Jumlah Stok -->
                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                  @php
            $jumlah = $jumlahStockMasukPerKategori->firstWhere('kategoriProduk', $item->kategoriProduk)->jumlah ?? 0;
          @endphp
                  {{ $jumlah }}
                </td>

                <!-- Lihat Produk -->
                <td class="px-2 py-4 text-sm text-gray-500 dark:text-gray-300">
                  @include('dashboard.inventory.inventoryMasuk.daftarProduk')
                </td>

                <!-- Aksi -->
                <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
                  @include('dashboard.inventory.inventoryMasuk.modalUpdateInventori')
                  @include('dashboard.inventory.inventoryMasuk.modalHapusInventori')
                </td>
                </tr>
        @empty
        <tr>
        <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
          Tidak ada data Inventory Masuk.
        </td>
        </tr>
      @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection