@extends('dashboard.layoutDashboard')

@section('FaQ')
<section class="container px-4 mx-auto">
  <!-- Judul Halaman -->
  <div class="mb-3 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Daftar FAQ</h2>
  </div>

  <!-- Penjelasan Singkat -->
  <div class="mb-6">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Halaman ini menampilkan <b>Informasi FAQ</b> yang tersedia di sistem. Anda dapat menambah, memperbarui, atau
      menghapus FAQ sesuai kebutuhan.
    </p>
  </div>

  <!-- Search Bar dan Tombol Tambah FAQ -->
  <div class="flex justify-between items-center gap-x-3">
    <div class="flex items-center gap-x-3">
      <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
        {{ $faqs->total() }} FAQ
      </span>
    </div>

    <!-- Search Bar -->
    <div class="flex items-center space-x-2 w-full max-w-lg">
      <div class="flex-grow">
        @include('dashboard.FaQ.searchBar')
      </div>
      @include('dashboard.FaQ.modalInsertFaQ')
    </div>
  </div>

  <!-- Tabel FAQ -->
  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>
                <th class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Nomor</th>
                <th class="px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Judul FAQ</th>
                <th class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Isi FAQ</th>
                <th class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @foreach ($faqs as $faq)
          <tr>
          <!-- Nomor -->
          <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-white">
            {{ ($faqs->currentPage() - 1) * $faqs->perPage() + $loop->iteration }}
          </td>

          <!-- Judul FAQ -->
          <td class="px-12 py-4 text-sm font-medium text-gray-700 dark:text-white break-words">
            {{ $faq->judul_faq }}
          </td>


          <!-- Isi FAQ -->
          <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ \Illuminate\Support\Str::limit($faq->isi_faq, 100) }}
          </td>

          <!-- Aksi -->
          <td class="px-4 py-4 text-sm whitespace-nowrap">
            <div class="flex items-center gap-x-6">
            @include('dashboard.FaQ.modalPerbaruiFaQ', ['faq' => $faq])
            @include('dashboard.FaQ.modalHapusFaQ', ['faq' => $faq])
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
  @include('dashboard.FaQ.pagination')
</section>
@endsection