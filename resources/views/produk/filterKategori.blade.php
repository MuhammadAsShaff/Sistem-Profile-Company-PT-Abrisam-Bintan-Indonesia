<div class="container mx-auto px-2 md:px-10 lg:px-16 py-10">
  <!-- Header Section -->
  <h1 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-gray-800 mb-6">Pilihan Paket Produk Internet Yang Kami
    Sediakan</h1>

  <!-- Paket Sesuai Area Section -->
  <div class="bg-gradient-to-r from-[#001a41] to-[#0e336c] p-6 rounded-lg shadow-lg">
    <!-- Flexbox wrapper untuk mengatur elemen -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
      <!-- Bagian Kiri -->
      <div>
        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-white mb-4">Cari Berdasarkan Kategori</h2>
        <p class="text-white mb-4">Temukan Pilihan Paket Internet Dengan Kebutuhan Yang Anda Inginkan</p>
      </div>

      <!-- Bagian Kanan (Dropdown) -->
      <div class="relative w-full md:w-1/3 lg:w-1/4 md:ml-4"> <!-- Menambahkan margin kiri pada screen md ke atas -->
        <select id="kategori-filter" name="kategori"
          class="block w-full bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none transition-all duration-200 ease-in-out">
          <option value="all" selected>Semua Kategori</option> <!-- Opsi untuk menampilkan semua kategori -->
          @foreach($kategori as $kat)
        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
      @endforeach
        </select>
        <!-- Ikon panah bawah -->
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
  document.getElementById('kategori-filter').addEventListener('change', function () {
    var kategoriId = this.value;

    // Kirim permintaan AJAX
    $.ajax({
      url: "{{ route('produk.filter') }}",
      method: "GET",
      data: {
        kategori: kategoriId
      },
      success: function (response) {
        console.log("Response dari server:", response);
        $('#produk-container').html(response); // Update produk sesuai dengan respons
      },
      error: function (error) {
        console.error("Error in AJAX request: ", error);
        alert("Terjadi kesalahan saat mengirim permintaan AJAX.");
      }
    });
  });
</script>