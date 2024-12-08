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
        {{$customerCount}} Pelanggan
      </span>
      <span class="px-3 py-1 text-xs text-green-500 bg-green-100 rounded-full dark:bg-gray-800 dark:text-green-400">
        {{$sudahDihubungiCount}} Sudah Di Hubungi
      </span>
      <span class="px-3 py-1 text-xs text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
        {{$belumDihubungiCount}} Belum Di Hubungi
      </span>
    </div>

    <!-- Search Bar dan Tombol Tambah Blog -->
    <div class="flex items-center space-x-2 w-full max-w-lg">
      <div class="flex-grow">
        @include('dashboard.dataPelanggan.searchBar')
      </div>
      <a href="{{ route('customers.export') }}"
        class="inline-flex items-center space-x-2 px-3 py-2.5 bg-green-500 text-sm font-medium text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 shadow-md transition duration-150 ease-in-out">
        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v9.293l-2-2a1 1 0 0 0-1.414 1.414l.293.293h-6.586a1 1 0 1 0 0 2h6.586l-.293.293A1 1 0 0 0 18 16.707l2-2V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
            clip-rule="evenodd" />
        </svg>
        <span>Excel</span>
      </a>
    </div>
  </div>

  <!-- Table Blog -->
  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
              <tr>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">NIK
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Nama
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Paket
                  Internet</th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Tanggal
                  Pendaftaran</th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Alamat
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Kontak
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                  Kordinat</th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Status
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
              <tr>
                @foreach ($customers as $customer)
            <tr>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">{{ $customer->nik }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">{{ $customer->nama_customer }}</td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">@foreach ($customer->produk as $produk)
          <span class="block">{{ $produk->nama_produk }}</span>
        @endforeach
            </td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
              {{ \Carbon\Carbon::parse($customer->created_at)->translatedFormat('j F Y') }}</td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $customer->alamat_customer }}</td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300"><a
              href="https://wa.me/{{ '62' . substr($customer->nomor_hp_customer, 1) }}" target="_blank"
              class="text-red-600 dark:text-red-400 hover:underline">
              {{ $customer->nomor_hp_customer }}
              </a>
              <a href="mailto:{{ $customer->email_customer }}?subject=Inquiry%20about%20product&body=Hello%20{{ $customer->nama_customer }},%20I%20would%20like%20to%20inquire%20about%20your%20product."
              class="text-red-600 dark:text-blue-400 hover:underline">
              {{ $customer->email_customer }}
              </a>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300"><a
              href="https://www.google.com/maps?q={{ $customer->latitude }},{{ $customer->longitude }}"
              target="_blank" class="text-red-600 dark:text-blue-400 hover:underline">
              {{ $customer->latitude }}, {{ $customer->longitude }}
              </a>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
              <form id="statusForm_{{ $customer->id_customer }}"
              action="{{ route('updateStatus', $customer->id_customer) }}" method="POST" style="display: inline;">
              @csrf
              @method('PUT')
              <select name="status_customer" id="status_customer_{{ $customer->id_customer }}"
                class="bg-gray-50 dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Belum dihubungi" {{ $customer->status_customer == 'Belum dihubungi' ? 'selected' : '' }}>Belum
                dihubungi</option>
                <option value="Sudah dihubungi" {{ $customer->status_customer == 'Sudah dihubungi' ? 'selected' : '' }}>Sudah
                dihubungi</option>
                <option value="Dihubungi kembali" {{ $customer->status_customer == 'Dihubungi kembali' ? 'selected' : '' }}>Dihubungi
                kembali</option>
              </select>
              </form>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
              @include('dashboard.dataPelanggan.modalHapusPelanggan')
            </td>
            </tr>
          @endforeach
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Ketika status diubah
      $('select[id^="status_customer_"]').on('change', function () {
        var customerId = $(this).attr('id').split('_')[2];  // Ambil ID customer dari ID elemen
        var status = $(this).val();  // Ambil status yang dipilih

        // Ambil form yang sesuai dengan ID customer
        var form = $('#statusForm_' + customerId);

        // Kirim data menggunakan AJAX
        $.ajax({
          url: form.attr('action'),  // Ambil URL form action
          method: 'POST',
          data: form.serialize(),  // Serialize data form
          success: function (response) {
            // Tidak melakukan apa-apa setelah sukses
          },
          error: function (xhr, status, error) {
            // Tidak melakukan apa-apa jika error
          }
        });
      });
    });
  </script>

  <!-- Pagination -->
  @include('dashboard.dataPelanggan.pagination')
</section>
@endsection