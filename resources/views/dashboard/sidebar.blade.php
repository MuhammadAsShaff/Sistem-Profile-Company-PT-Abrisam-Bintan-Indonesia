<aside class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto bg-white border-r">
  <!-- Logo -->
  <a href="#" class="mx-auto">
    <img class="w-auto h-14" src="{{ asset('images/logoAbi.png') }}" alt="Logo Abi">
  </a>

  <!-- Admin Profile -->
  <div class="flex flex-col items-center mt-6">
    @if ($admin)
      @include('profile.slideProfile')
      <h3 class="font-medium text-gray-800 mt-2"><b>{{ $admin->nama_admin }}</b></h3>
      <p class="text-sm font-medium text-gray-600">{{ $admin->email_admin }}</p>
  @endif
  </div>

  <!-- Navigation Links -->
  <div class="flex flex-col justify-between flex-1 mt-6">
    <nav>
      <!-- Dashboard -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{ route('dashboard.dashboard.index') }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 15v4m6-6v6m6-4v4m6-6v6M3 11l6-5 6 5 5.5-5.5" />
        </svg>
        <span class="mx-4 font-medium">Dashboard</span>
      </a>

      <!-- Promo dan Iklan -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard/promo') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{ route('dashboard.Promo.Promo') }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8.891 15.107 15.11 8.89m-5.183-.52h.01m3.089 7.254h.01M14.08 3.902a2.849 2.849 0 0 0 2.176.902 2.845 2.845 0 0 1 2.94 2.94 2.849 2.849 0 0 0 .901 2.176 2.847 2.847 0 0 1 0 4.16 2.848 2.848 0 0 0-.901 2.175 2.843 2.843 0 0 1-2.94 2.94 2.848 2.848 0 0 0-2.176.902 2.847 2.847 0 0 1-4.16 0 2.85 2.85 0 0 0-2.176-.902 2.845 2.845 0 0 1-2.94-2.94 2.848 2.848 0 0 0-.901-2.176 2.848 2.848 0 0 1 0-4.16 2.849 2.849 0 0 0 .901-2.176 2.845 2.845 0 0 1 2.941-2.94 2.849 2.849 0 0 0 2.176-.901 2.847 2.847 0 0 1 4.159 0Z" />
        </svg>
        <span class="mx-4 font-medium">Promo Dan Iklan</span>
      </a>

      <!-- Data Pelanggan -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard/dataPelanggan') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{route('dashboard.dataPelanggan.dataPelanggan')}}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-width="2"
            d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
        </svg>
        <span class="mx-4 font-medium">Data Pelanggan</span>
      </a>

      <!-- Data Produk -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard/produk') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{route('dashboard.dataProduk.dataProduk')}}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
        </svg>
        <span class="mx-4 font-medium">Data Produk</span>
      </a>

      <!-- Data Paket -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard/dataPaket') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{route('dashboard.dataPaket.dataPaket')}}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z" />
        </svg>
        <span class="mx-4 font-medium">Data Paket</span>
      </a>

      <!-- Data Kategori -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard/dataKategori') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{ route('dashboard.dataKategori.dataKategori') }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7.111 20A3.111 3.111 0 0 1 4 16.889v-12C4 4.398 4.398 4 4.889 4h4.444a.89.89 0 0 1 .89.889v12A3.111 3.111 0 0 1 7.11 20Zm0 0h12a.889.889 0 0 0 .889-.889v-4.444a.889.889 0 0 0-.889-.89h-4.389a.889.889 0 0 0-.62.253l-3.767 3.665a.933.933 0 0 0-.146.185c-.868 1.433-1.581 1.858-3.078 2.12Zm0-3.556h.009m7.933-10.927 3.143 3.143a.889.889 0 0 1 0 1.257l-7.974 7.974v-8.8l3.574-3.574a.889.889 0 0 1 1.257 0Z" />
        </svg>
        <span class="mx-4 font-medium">Data Kategori</span>
      </a>

      <!-- Data Admin -->
      <a class="flex items-center px-4 py-2 mb-4 text-gray-600 rounded-lg transition-colors duration-300 {{ Request::is('dashboard/datauser') ? 'bg-gray-100 border-l-4 border-red-500 text-blue-600' : 'hover:bg-gray-100 hover:text-gray-700' }}"
        href="{{ route('dashboard.dataUser.datauser') }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
        </svg>
        <span class="mx-4 font-medium">Data Admin</span>
      </a>
    </nav>

    <!-- Logout Button -->
    <div class="mt-10">
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit"
          class="flex items-center px-4 py-2 text-gray-600 transition-colors duration-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
          </svg>
          <span class="mx-4 font-medium">Logout</span>
        </button>
      </form>
    </div>
  </div>
</aside>
