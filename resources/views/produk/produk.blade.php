<div class="container mx-auto -mt-4 px-4 md:px-10 lg:px-1">
  @foreach($paket as $p)
    @if($p->produk->isNotEmpty()) <!-- Cek apakah paket memiliki produk -->
    <!-- Nama Paket -->
    <h3 class="text-2xl md:text-3xl lg:text-3xl font-semibold text-gray-800 mb-4">{{ $p->nama_paket }}</h3>

    <!-- Grid untuk Produk di dalam Paket -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($p->produk as $prod)
    <!-- Card Produk -->
    <div class="max-w-sm bg-white shadow-2xl shadow-gray-400 rounded-lg p-6 relative h-full">
      <!-- Bagian untuk menampilkan diskon jika ada -->
      @if($prod->diskon)
      <div
      class="absolute top-0 right-0 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white text-sm px-3 py-1 rounded-tr-lg rounded-bl-lg">
      Diskon {{ $prod->diskon }}%
      </div>
    @endif

      <!-- Nama Produk -->
      <h3 class="font-bold text-xl md:text-2xl lg:text-3xl mb-2 mt-4 text-left">{{ $prod->nama_produk }}</h3>

      <!-- Perhitungan Harga -->
      @php
      $hargaDiskon = $prod->harga_produk - ($prod->harga_produk * $prod->diskon / 100);
      $hargaFormatted = number_format($hargaDiskon, 0, ',', '.');
      $hargaAsli = number_format($prod->harga_produk, 0, ',', '.');
      $biayaPasang = number_format($prod->biaya_pasang, 0, ',', '.');
  @endphp

      <!-- Harga Produk -->
      @if($prod->diskon > 0)
      <p class="text-gray-500 text-lg line-through text-left">Rp{{ $hargaAsli }}</p>
      <p class="text-2xl lg:text-3xl font-bold mb-2 text-red-600 text-left">
      Rp{{ substr($hargaFormatted, 0, 3) }}<span class="text-sm">{{ substr($hargaFormatted, 3) }}/Bulan</span>
      </p>
    @else
      <p class="text-3xl font-bold text-red-600 text-left">
      Rp{{ substr($hargaAsli, 0, 3) }}<span class="text-sm">{{ substr($hargaAsli, 3) }}/Bulan</span>
      </p>
    @endif

      <!-- Spesifikasi Produk -->
      <ul class="mb-4 text-gray-700 space-y-2 text-left">
      <li><i class="fas fa-tachometer-alt" style="color: #001637;"></i> Kecepatan Internet Up to
      <b>{{ $prod->kecepatan }}</b> Mbps
      </li>
      <li class="flex items-center"><i class="fas fa-database" style="color: #001637;"></i>
      <span
      class="ml-2">{{ $prod->kuota === 0 || is_null($prod->kuota) ? 'Unlimited' : $prod->kuota . ' GB' }}</span>
      </li>
      <li class="flex items-center"><i class="fas fa-money-bill-wave" style="color: #001637;"></i>
      <span class="ml-2">Biaya Pasang
      <b>{{ $prod->biaya_pasang === 0 || is_null($prod->biaya_pasang) ? 'Gratis' : 'Rp' . $biayaPasang }}</b></span>
      </li>

      <!-- Benefit Produk -->
      <div style="min-height: 50px;" class="text-left">
      @if($prod->benefit && is_array(json_decode($prod->benefit)) && count(json_decode($prod->benefit)) > 0)
      <i class="fas fa-gift" style="color: #001637;"></i> {{ implode(', ', json_decode($prod->benefit)) }}
    @else
      <span style="visibility:hidden;">No benefit</span>
    @endif
      </div>
      </ul>

      <!-- Tombol Aksi -->
      <button class="bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white py-2 px-4 rounded-lg w-full mt-auto">Pilih
      Paket</button>
    </div>


  @endforeach
    </div><br><br>
  @endif
  @endforeach
</div>