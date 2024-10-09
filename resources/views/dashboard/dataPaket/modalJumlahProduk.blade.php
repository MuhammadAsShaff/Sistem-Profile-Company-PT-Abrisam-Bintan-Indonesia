<!-- Tombol untuk membuka modal produk -->
<button
  class="ml-2 text-sm font-medium text-red-600 hover:text-red-900 transition-colors duration-200 focus:outline-none"
  onclick="openModal('produkModal-{{ $paket->id_paket }}')">
  Lihat Produk
</button>

<!-- Modal Produk -->
<dialog id="produkModal-{{ $paket->id_paket }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%); height: 80vh;">
  <div class="relative bg-white rounded-lg shadow-lg p-6 h-full" id="modalContent" style="overflow-y: auto;">
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Daftar Produk di paket {{ $paket->nama_paket }}</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="closeModal('produkModal-{{ $paket->id_paket }}')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
      <!-- Tabel Produk -->
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="w-3/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>

            <th class="w-2/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
            <th class="w-1/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diskon (%)</th>
            <th class="w-2/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya Pasang</th>
            <th class="w-2/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kecepatan (Mbps)</th>
            <th class="w-1/12 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @if (isset($paket->produk) && count($paket->produk) > 0)
        @foreach ($paket->produk as $produk)
      <tr>
      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $produk->nama_produk }}</td>
      <td class="px-6 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
        @if($produk->diskon > 0)
      <!-- Harga Normal Dicoret -->
      <span class="line-through">Rp.{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
      <!-- Harga Setelah Diskon --><br>Setelah Diskon:
      <br>
      <span
      class="text-red-500">Rp.{{ number_format($produk->harga_produk - ($produk->harga_produk * $produk->diskon / 100), 0, ',', '.') }}</span>
    @else
    <!-- Harga Normal Tanpa Diskon -->
    <span>Rp.{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
  @endif
      </td>
      <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
        {{ $produk->diskon > 0 ? number_format($produk->diskon, 0, ',', '.') . '%' : 'Tidak ada diskon' }}
      </td>

      <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
        {{ $produk->biaya_pasang ? 'Rp. ' . number_format($produk->biaya_pasang, 0, ',', '.') : 'Gratis' }}
      </td>

      <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
        {{ $produk->kecepatan }} Mbps
      </td>

      <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
        {{ $produk->kuota !== null && $produk->kuota != 0 ? $produk->kuota . ' GB' : 'Unlimited' }}
      </td>
      
      </tr>
    @endforeach
      @else
      <tr>
      <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">Produk tidak ditemukan</td>
      </tr>
    @endif
        </tbody>
      </table>
    </div>
  </div>
</dialog>