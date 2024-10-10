@extends('dashboard.layoutDashboard')

@section('blog') 
<section class="container px-4 mx-auto">
  <!-- Baris Pertama: Judul Halaman -->
  <div class="mb-3 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Blog yang Terdaftar pada Sistem</h2>
  </div>

  <!-- Baris Kedua: Penjelasan Singkat -->
  <div class="mb-6">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Halaman ini menampilkan <b>Informasi Blog</b> yang tersedia di sistem, termasuk judul blog dan deskripsi.
      Anda dapat menambah, memperbarui, atau menghapus Blog sesuai kebutuhan.
    </p>
  </div>

  <!-- Baris Ketiga: Search Bar dan Tombol Tambah Blog -->
  <div class="flex justify-between items-center gap-x-3">
    <div class="flex items-center gap-x-3">
      <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
        {{ $blogCount }} Blog
      </span>
    </div>

    <!-- Search Bar dan Tombol Tambah Blog -->
    <div class="flex items-center space-x-2 w-full max-w-lg">
      <div class="flex-grow">
        @include('dashboard.blog.searchBar')
      </div>
      @include('dashboard.blog.modalInsertBlog')
    </div>
  </div>

  <!-- Table Blog -->
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
                  Judul Blog
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar Cover
                </th>
                <th scope="col" class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar Ilustrasi
                </th>
                <th scope="col"
                  class="w-4/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Isi Blog
                </th>
                <th scope="col"
                  class="w-2/12 py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Tanggal Penulisan
                </th>
                <th scope="col"
                  class="w-2/12 py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              @foreach ($blogs as $blog)
              <tr>
              <!-- Nomor Urutan -->
              <td class="w-1/12 px-4 py-4 text-sm font-medium text-gray-700 dark:text-white">
              {{ ($blogs->currentPage() - 1) * $blogs->perPage() + $loop->iteration }}
              </td>

              <!-- Judul Blog -->
              <td class="w-2/12 px-12 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">
              {{ $blog->judul_blog }}
              </td>

              <!-- Gambar Blog -->
              <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              @if($blog->gambar_cover)
            <img class="object-cover w-16 h-16 rounded-lg"
            src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="Gambar Blog">
            @else
          <span class="text-xs text-gray-400">Tidak ada gambar</span>
          @endif
              </td>

              <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              @if($blog->gambar_ilustrasi)
          <img class="object-cover w-16 h-16 rounded-lg" src="{{ asset('uploads/blogs/' . $blog->gambar_ilustrasi) }}"
          alt="Gambar Blog">
        @else
        <span class="text-xs text-gray-400">Tidak ada gambar</span>
      @endif
              </td>

              <!-- Isi Blog -->
              <td class="w-4/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              {{ \Illuminate\Support\Str::limit($blog->isi_blog, 100) ?? 'Tidak ada isi' }}
              </td>

              <!-- Tanggal Penulisan -->
              <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
              {{ $blog->tanggal_penulisan }}
              </td>

              <!-- Aksi -->
              <td class="px-4 py-4 text-sm whitespace-nowrap">
              <div class="flex items-center gap-x-6">
              @include('dashboard.blog.modalPerbaruiBlog', ['blog' => $blog])
              @include('dashboard.blog.modalHapusBlog', ['blog' => $blog])
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
  @include('dashboard.blog.pagination')
</section>
@endsection