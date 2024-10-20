<div class="container mx-auto px-2 md:px-10 lg:px-14 py-10">
  <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold font-telkomsel text-gray-800 mb-6">Pilihan Paket Produk Internet Yang Kami Sediakan</h1>

  <div class="bg-gradient-to-r from-[#001a41] to-[#0e336c] p-6 rounded-2xl shadow-lg">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
      <div>
        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold font-telkomsel text-white mb-4">Cari Berdasarkan Kategori</h2>
        <p class="text-white mb-4">Temukan Pilihan Paket Internet Dengan Kebutuhan Yang Anda Inginkan</p>
      </div>

      <div class="relative w-full md:w-1/3 lg:w-1/4 md:ml-4 font-telkomsel">
        <select id="kategori-filter" name="kategori"
          class="block w-full bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none transition-all duration-200 ease-in-out">
          <option value="all" selected>Semua Kategori</option>
          @foreach($kategori as $kat)
            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
          @endforeach
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to filter products based on category, price range, kecepatan, and kuota
  function filterProduk() {
    let minValue = parseInt(rangeMin.value);  // Get minimum price value
    let maxValue = parseInt(rangeMax.value);  // Get maximum price value
    let selectedKecepatan = [];  // Array to hold selected speed options
    let selectedKuota = [];  // Array to hold selected quota options

    // Collect selected kecepatan checkboxes
    document.querySelectorAll('input[name="kecepatan[]"]:checked').forEach(function (el) {
      selectedKecepatan.push(el.value);  // Add selected speeds to array
    });

    // Collect selected kuota checkboxes
    document.querySelectorAll('input[name="kuota[]"]:checked').forEach(function (el) {
      selectedKuota.push(el.value);  // Add selected quotas to array
    });

    let kategori = document.getElementById('kategori-filter').value;  // Get selected category

    // AJAX request to send filter data
    $.ajax({
      url: "{{ route('produk.filter') }}",  // Route to filter products
      method: "GET",
      data: {
        kategori: kategori,  // Selected category
        min_harga: minValue,  // Minimum price
        max_harga: maxValue,  // Maximum price
        kecepatan: selectedKecepatan,  // Selected speeds
        kuota: selectedKuota  // Selected quotas
      },
      success: function (response) {
        $('#produk-container').html(response);  // Update products in the page
      },
      error: function (error) {
        console.error("Error in AJAX request: ", error);
        alert("Terjadi kesalahan saat mengirim permintaan filter.");
      }
    });
  }

  // Event listeners to call filter function when there are changes in filters
  document.getElementById('kategori-filter').addEventListener('change', filterProduk);  // Filter when category changes

  // Listen to price range changes
  rangeMin.addEventListener('input', filterProduk);  // Filter when minimum price changes
  rangeMax.addEventListener('input', filterProduk);  // Filter when maximum price changes

  // Listen to changes in checkboxes for kecepatan
  document.querySelectorAll('input[name="kecepatan[]"]').forEach(function (el) {
    el.addEventListener('change', filterProduk);  // Filter when speed checkbox changes
  });

  // Listen to changes in checkboxes for kuota
  document.querySelectorAll('input[name="kuota[]"]').forEach(function (el) {
    el.addEventListener('change', filterProduk);  // Filter when quota checkbox changes
  });
</script>

