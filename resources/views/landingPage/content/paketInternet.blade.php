

<div class="container mx-auto px-20 py-6">
  <div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-2xl font-bold mb-1">Berlangganan Sekarang</h2>
        <p class="text-gray-600">
          Penawaran ini berlaku untuk semua yang ingin menikmati internet cepat. <br>Dapatkan promo menarik dan harga
          terjangkau
          sekarang juga. <br>Jangan lewatkan potongan harga spesial!
        </p>
      </div>

      <!-- Filter Options -->
      <div class="flex space-x-3">
        <form action="{{ route('landingPage.layoutLandingPage') }}" method="GET">
          <select name="kategori" class="border border-gray-300 rounded-lg px-4 py-2" onchange="this.form.submit()">
            <option value="">Pilih Kategori</option>
            @foreach($kategori as $kat)
        <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
          {{ $kat->nama_kategori }}
        </option>
      @endforeach
          </select>
        </form>
      </div>
    </div>
  </div>

    <!-- Tab Navigation -->
    <div class="flex justify-center space-x-4 border-b mb-4">
      <button class="px-4 py-2 font-semibold text-white bg-red-600 rounded-t-lg">Paket JITU</button>
      <button class="px-4 py-2 font-semibold text-gray-700">Paket 2P Inet Telp</button>
      <button class="px-4 py-2 font-semibold text-gray-700">Paket 2P Inet TV</button>
      <button class="px-4 py-2 font-semibold text-gray-700">Paket 3P Inet TV Telp</button>
    </div>

  <!-- Cards Section -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($produk as $prod)
    <div class="max-w-sm bg-white shadow-2xl shadow-gray-400 rounded-lg p-6 relative">
      <!-- Promo Badge -->
      @if($prod->diskon)
      <div class="absolute top-0 right-0 bg-red-600 text-white text-sm px-3 py-1 rounded-tr-lg rounded-bl-lg">
      Diskon {{ $prod->diskon }}%
      </div>
    @endif

      <!-- Image -->
      <!-- <img src="{{ asset('uploads/produk/' . $prod->gambar_produk) }}" alt="Produk Image"
      class="w-full h-32 object-cover rounded-t-lg mb-4"> -->

      <!-- Card Content -->
      <h3 class="font-bold text-4xl mb-2">{{ $prod->nama_produk }}</h3>

      <!-- Harga Produk -->
      @if($prod->diskon > 0)
      <!-- Harga Normal Dicoret -->
      <p class="text-gray-500 text-xl line-through">Rp{{ number_format($prod->harga_produk, 0, ',', '.') }}</p>
      <!-- Harga Setelah Diskon -->
      <p class="text-4xl font-bold mb-2 text-red-600">
      Rp{{ substr(number_format($prod->harga_produk - ($prod->harga_produk * $prod->diskon / 100), 0, ',', '.'), 0, 3) }}<span
      class="text-sm">{{ substr(number_format($prod->harga_produk - ($prod->harga_produk * $prod->diskon / 100), 0, ',', '.'), 3) }}/Bulan</span>
      </p>

    @else
      <!-- Harga Normal Tanpa Diskon -->
      <p class="text-4xl font-bold mb-2 text-gray-900">Rp{{ number_format($prod->harga_produk, 0, ',', '.') }}
      <span class="text-sm">/Bulan</span>
      </p>
    @endif

      <!-- Features List -->
      <ul class="mb-4 text-gray-700 space-y-2">
      <li>
        <i class="fas fa-tachometer-alt text-black-500"></i>
        Kecepatan Internet Up to <b>{{ $prod->kecepatan }}</b> Mbps
      </li>

      <li class="flex items-center">
        <i class="fas fa-gift text-black-500"></i> <!-- Ikon benefit -->
        <span class="ml-2">{{ $prod->benefit }}</span>
      </li>

      @if($prod->paket)
      <li class="flex items-center">
      <i class="fas fa-tag text-black-500"></i> <!-- Ikon paket -->
      <span class="ml-2">{{ $prod->paket->nama_paket }}</span>
      </li>

    @endif
      </ul>

      <!-- Button -->
      <button class="bg-red-600 text-white py-2 px-4 rounded-lg w-full">Pilih Paket</button>
    </div>
  @endforeach
  </div>

  <!-- View All Button -->
  <div class="text-center mt-6">
    <a href="#" class="text-blue-600">Tampilkan Semua Produk</a>
  </div>
</div>