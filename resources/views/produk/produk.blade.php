
 @if($paket->isNotEmpty())
 @foreach($paket as $p)
    @if($p->produk->isNotEmpty()) <!-- Cek apakah paket memiliki produk -->
    <h3 class="text-2xl md:text-3xl lg:text-3xl font-semibold text-gray-800 mb-4 font-telkomsel">{{ $p->nama_paket }}</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($p->produk as $prod)
    <div class="max-w-sm bg-white shadow-xl rounded-lg p-6 relative h-full min-h-[450px]"> <!-- min-h ditambahkan untuk konsistensi tinggi -->
    @if($prod->diskon)
    <div
    class="absolute top-0 right-0 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white text-sm px-3 py-1 rounded-tr-lg rounded-bl-lg font-telkomsel">
    Diskon {{ $prod->diskon }}%
    </div>
    @endif

    <h3 class="font-bold font-telkomsel text-xl md:text-2xl lg:text-3xl mb-2 mt-4 text-left">{{ $prod->nama_produk }}</h3>

    @php
        $hargaDiskon = $prod->harga_produk - ($prod->harga_produk * $prod->diskon / 100);
        $hargaFormatted = number_format($hargaDiskon, 0, ',', '.');
        $hargaAsli = number_format($prod->harga_produk, 0, ',', '.');
        $biayaPasang = number_format($prod->biaya_pasang, 0, ',', '.');
    @endphp

    @if($prod->diskon > 0)
    <p class="text-gray-500 text-lg line-through text-left">Rp{{ $hargaAsli }}</p>
    <p class="text-2xl lg:text-3xl font-bold font-telkomsel mb-2 text-red-600 text-left">
    Rp{{ substr($hargaFormatted, 0, 3) }}<span class="text-sm">{{ substr($hargaFormatted, 3) }}/Bulan</span>
    </p>
  @else
    <p class="text-3xl font-bold font-telkomsel text-red-600 text-left">
    Rp{{ substr($hargaAsli, 0, 3) }}<span class="text-sm">{{ substr($hargaAsli, 3) }}/Bulan</span>
    </p>
    @endif

    <ul class="mb-4 text-gray-700 space-y-2 text-left">
      <li><i class="fas fa-tachometer-alt" style="color: #001637;"></i> Kecepatan Internet Up to
      <b>{{ $prod->kecepatan }}</b> Mbps</li>
      <li class="flex items-center">
      <i class="fas fa-database" style="color: #001637;"></i>
      <span class="ml-2">Kuota
      <b>{{ $prod->kuota === 0 || is_null($prod->kuota) ? 'Unlimited' : $prod->kuota . ' GB' }}</b></span>
      </li>
      <li class="flex items-center">
      <i class="fas fa-money-bill-wave" style="color: #001637;"></i>
      <span class="ml-2">Biaya Pasang
      <b>{{ $prod->biaya_pasang === 0 || is_null($prod->biaya_pasang) ? 'Gratis' : 'Rp' . number_format($prod->biaya_pasang, 0, ',', '.') }}</b></span>
      </li>
      <div style="min-height: 50px;" class="text-left">
      @if($prod->benefit && is_array(json_decode($prod->benefit)) && count(json_decode($prod->benefit)) > 0)
      <i class="fas fa-gift" style="color: #001637;"></i>
      {{ implode(', ', json_decode($prod->benefit)) }}
      @else
      <span style="visibility:hidden;">No benefit</span>
      @endif
      </div>
    </ul>

    <button class="bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white py-2 px-4 rounded-lg w-full mt-auto font-telkomsel">Pilih
    Paket</button>
    </div>
  @endforeach
    </div>
    <br><br>
  @endif
  @endforeach
@else
  <p>Produk tidak ditemukan.</p>
@endif