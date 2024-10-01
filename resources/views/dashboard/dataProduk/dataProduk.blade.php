@extends('dashboard.layoutDashboard')

@section('dataProduk') 
<section class="container px-4 mx-auto">
  <section class="container px-4 mx-auto">
    <!-- Baris Pertama: Judul Halaman -->
    <div class="mb-3 mt-8">
      <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Produk Yang Terdaftar Pada Sistem</h2>
    </div>

    <!-- Baris Kedua: Penjelasan Singkat -->
    <div class="mb-6">
      <p class="text-sm text-gray-600 dark:text-gray-300">
        Halaman Ini Menampilkan <b>Informasi Produk</b>, Termasuk Detail Produk Dan Gambar.
        Anda Dapat Menambah, Memperbarui, Atau Menghapus Produk Melalui Halaman Ini.
      </p>
    </div>

    <!-- Baris Ketiga: Jumlah Produk dan Filter -->
    <div class="flex justify-between items-center gap-x-3">
      <div class="flex items-center gap-x-3">
        <!-- Jumlah Produk -->
        <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
          {{ $produks->count() }} produk
        </span>
      </div>

      <!-- Search Bar -->
      <div class="flex items-center space-x-2 w-full max-w-lg">
        <!-- Search Bar -->
        <div class="flex-grow">
          @include('dashboard.dataProduk.searchBar')
        </div>

        <!-- Tombol Tambah Produk -->
        @include('dashboard.dataProduk.modalInsertProduk')
      </div>
    </div>
  </section>

  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>
                <th scope="col"
                  class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400 w-1/12">
                  Nomor
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Nama Produk
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Harga
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Diskon
                </th> <!-- Tambahkan kolom Diskon -->
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Deskripsi
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Kecepatan
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Benefit
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Kategori
                </th>
                <th scope="col" class="px-6 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Paket
                </th>
                <th scope="col" class="relative py-3.5 px-4 w-1/12">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @foreach ($produks as $produk)
          <tr>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ ($produks->currentPage() - 1) * $produks->perPage() + $loop->iteration }}
          </td>
          <td class="px-6 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
            {{ $produk->nama_produk }}
          </td>
          <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            @if($produk->gambar_produk)
        <img class="object-cover w-10 h-10 rounded-full"
        src="{{ asset('uploads/produk/' . $produk->gambar_produk) }}" alt="Gambar Produk">
      @else
    <span class="text-xs text-gray-400">Tidak ada gambar</span>
  @endif
          </td>
          <td class="px-6 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
            @if($produk->diskon > 0)
        <!-- Harga Normal Dicoret -->
        <span class="line-through">Rp.{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
        <!-- Harga Setelah Diskon --><br>Setelah Diskon:
        <br>
        <span
        class="text-red-500">Rp.{{ number_format($produk->harga_produk - ($produk->harga_produk * $produk->diskon / 100), 0, ',', '.') }}</span>
      @else
    <!-- Harga Normal Tanpa Diskon -->
    <span>Rp.{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
  @endif
          </td>
          <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $produk->diskon > 0 ? number_format($produk->diskon, 0) . '%' : 'Tidak ada diskon' }}
          </td>
          <td class="px-6 py-4 text-sm font-normal text-gray-600 dark:text-gray-400">
            {{ $produk->deskripsi }}
          </td>
          <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $produk->kecepatan }} Mbps
          </td>
          <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $produk->benefit }}
          </td>
          <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $produk->kategori->nama_kategori }}
          </td>
          <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $produk->paket->nama_paket }}
          </td>
          <td class="px-4 py-4 text-sm whitespace-nowrap">
            <div class="flex items-center gap-x-6">
            @include('dashboard.dataProduk.modalPerbaruiProduk')
            @include('dashboard.dataProduk.modalHapusProduk')
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
  @include('dashboard.dataProduk.pagination')
</section>
@endsection