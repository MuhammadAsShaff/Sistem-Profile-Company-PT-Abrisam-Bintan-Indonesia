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
      <button id="openModalButton" onclick="window.location.href='{{ route('blog.insert') }}'"
        class="flex items-center justify-center text-white bg-red-500 rounded-lg w-10 h-10 hover:bg-red-600 focus:ring-4 focus:ring-red-300 focus:outline-none dark:focus:ring-red-800 transition ease-in-out duration-200">
        <svg class="w-4 h-4 transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 18 18" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 1v16M1 9h16" />
        </svg>
      </button>
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
                  class="w-3/12 px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Judul Blog
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Gambar Cover
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Kategori
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
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
          <td
            class="w-2/12 px-12 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-normal line-clamp">
            {{ $blog->judul_blog }}
          </td>


          <!-- Gambar Blog -->
          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            <div class="object-cover w-32 h-18 ">
            @if($blog->gambar_cover)
        <img class="w-full h-full" src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="Gambar Blog">
      @else
    <span class="text-xs text-gray-400">Tidak ada gambar</span>
  @endif
            </div>
          </td>

          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{$blog->kategori}}
          </td>

          <!-- Isi Blog -->
          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            @include('dashboard.blog.modalIsiBlog')
          </td>

          <!-- Tanggal Penulisan -->
          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            {{ $blog->tanggal_penulisan }}
          </td>

          <!-- Aksi -->
          <td class="px-4 py-4 text-sm whitespace-nowrap">
            <div class="flex items-center gap-x-6">
            <!-- Button to trigger modal -->
            <button id="openModalButton"
              onclick="window.location.href='{{ route('blog.edit', $blog->id_blog) }}'"
              class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </svg>
            </button>

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