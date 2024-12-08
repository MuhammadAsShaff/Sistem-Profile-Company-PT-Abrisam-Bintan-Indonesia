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
        Halaman Ini Menampilkan <b>Informasi Produk</b>, Termasuk Detail Produk dan Kuota.
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

  <!-- Tabel Data Produk -->
  <div class="flex flex-col mt-6">
    <div class="overflow-x-auto"> <!-- Hapus kelas yang menyebabkan overflow di luar batas layar -->
      <div class="inline-block min-w-full py-2 align-middle">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">
            <!-- Tambahkan table-fixed -->
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Nomor</th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Nama Produk
                </th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Harga</th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Diskon</th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Deskripsi
                </th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Kecepatan
                </th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Aplikasi
                  Streaming</th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Kuota</th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Biaya Pasang
                </th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Kategori
                </th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Paket</th>
                <th scope="col"
                  class="px-4 py-3.5 w-1/12 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Aksi
                </th>
              </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @foreach ($produks as $produk)
          <tr>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
            {{ ($produks->currentPage() - 1) * $produks->perPage() + $loop->iteration }}
          </td>
          <td class="px-4 py-4 text-sm font-medium text-gray-700">{{ $produk->nama_produk }}</td>
          <td class="px-4 py-4 text-sm font-medium text-gray-700">
            @if($produk->diskon > 0)
        <span class="line-through">Rp.{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
        <br>Setelah Diskon:<br><span
        class="text-red-500">Rp.{{ number_format($produk->harga_produk - ($produk->harga_produk * $produk->diskon / 100), 0, ',', '.') }}</span>
      @else
    <span>Rp.{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
  @endif
          </td>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
            {{ $produk->diskon > 0 ? number_format($produk->diskon, 0) . '%' : 'Tidak ada diskon' }}
          </td>
          <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $produk->deskripsi }}</td>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $produk->kecepatan }} Mbps</td>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
            {{ is_array(json_decode($produk->benefit)) && count(json_decode($produk->benefit)) > 0 ? implode(', ', json_decode($produk->benefit)) : 'Tidak ada benefit' }}
          </td>
          </td>

          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
            {{ $produk->kuota !== null && $produk->kuota != 0 ? $produk->kuota . ' GB' : 'Unlimited' }}
          </td>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
            {{ $produk->biaya_pasang ? 'Rp. ' . number_format($produk->biaya_pasang, 0, ',', '.') : 'Gratis' }}
          </td>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $produk->kategori->nama_kategori }}
          </td>
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $produk->paket->nama_paket }}</td>
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