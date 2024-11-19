@extends('dashboard.layoutDashboard')

@section('dataPelanggan') 
<section class="container px-4 mx-auto">
  <!-- Baris Pertama: Judul Halaman -->
  <div class="mb-3 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Data Pelanggan</h2>
  </div>

  <!-- Baris Kedua: Penjelasan Singkat -->
  <div class="mb-6">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Halaman ini menampilkan <b>Data Pelanggan</b> yang tersedia di sistem, termasuk hal yang berkaitan.
    </p>
  </div>

  <!-- Baris Ketiga: Search Bar dan Tombol Tambah Blog -->
  <div class="flex justify-between items-center gap-x-3">
    <div class="flex items-center gap-x-3">
      <span class="px-3 py-1 text-xs text-red-500 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
        Pelanggan
      </span>
    </div>

    <!-- Search Bar dan Tombol Tambah Blog -->
    <div class="flex items-center space-x-2 w-full max-w-lg">
      <div class="flex-grow">
        @include('dashboard.dataPelanggan.searchBar')
      </div>
      
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
                  Nama 
                </th>
                <th scope="col"
                  class="w-3/12 px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                 Alamat 
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Nomor Hp
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Email
                </th>
                <th scope="col"
                  class="w-2/12 px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                Status
                </th>
              
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
           
          <tr>
          <!-- Nomor Urutan -->
          <td class="w-1/12 px-4 py-4 text-sm font-medium text-gray-700 dark:text-white">
           
          </td>

          <!-- Judul Blog -->
          <td
            class="w-2/12 px-12 py-4 text-sm font-medium text-gray-700 dark:text-white whitespace-normal line-clamp">
         
          </td>


          <!-- Gambar Blog -->
          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
            <div class="object-cover w-32 h-18 ">
    
      

  
            </div>
          </td>

          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
          
          </td>

          <!-- Isi Blog -->
          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
          
          </td>

          <!-- Tanggal Penulisan -->
          <td class="w-2/12 px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
         
          </td>

          <!-- Aksi -->
          <td class="px-4 py-4 text-sm whitespace-nowrap">
            <div class="flex items-center gap-x-6">
            <!-- Button to trigger modal -->
            

            
            </div>
          </td>
          </tr>
      
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  @include('dashboard.dataPelanggan.pagination')
</section>
@endsection