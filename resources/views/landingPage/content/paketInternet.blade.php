<div class="container mx-auto px-4 md:px-10 lg:px-20 py-6">
  <div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
      <div>
        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold mb-1">Berlangganan Sekarang</h2>
        <p class="text-gray-600">
          Penawaran ini berlaku untuk semua yang ingin menikmati internet cepat. <br>Dapatkan promo menarik dan harga
          terjangkau sekarang juga. <br>Jangan lewatkan potongan harga spesial!
        </p>
      </div>

      <!-- Filter Options -->
      <div class="mt-4 md:mt-0 flex space-x-3">
        <select id="kategori-filter" name="kategori" class="border border-gray-300 rounded-lg px-4 py-2">
          <option value="">Semua Kategori</option>
          @foreach($kategori as $kat)
        <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
        {{ $kat->nama_kategori }}
        </option>
      @endforeach
        </select>
      </div>
    </div>
  </div>

  <!-- Tab Navigation -->
  <div class="flex flex-wrap justify-center space-x-4 border-b mb-4">
    @foreach($paket as $pk)
    <button
      class="px-4 py-2 font-semibold paket-button {{ request('paket') == $pk->id_paket ? 'text-white bg-red-600 active' : 'text-gray-700' }} rounded-tl-lg rounded-tr-lg"
      data-id-paket="{{ $pk->id_paket }}">
      {{ $pk->nama_paket }}
    </button>
  @endforeach
  </div>

  <!-- Cards Section -->
  <div id="produk-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
    <!-- Produk akan dimuat secara dinamis -->
  </div>

  <!-- View All Button -->
  <div class="text-center mt-6">
    <button id="toggle-produk-button" class="text-red-500" style="display: none;">Tampilkan Semua Produk</button>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    var produk = @json($produk); // Produk data dari backend
    var tampilkanSemua = false; // Status untuk tombol tampilkan semua atau lebih sedikit

    // Fungsi untuk menampilkan produk
    function updateProduk() {
      var produkContainer = $('#produk-container');
      produkContainer.empty(); // Hapus produk yang ada

      var produkToShow = tampilkanSemua ? produk : produk.slice(0, 3); // Tampilkan semua atau hanya 3

      $.each(produkToShow, function (index, prod) {
        var hargaDiskon = (prod.harga_produk - (prod.harga_produk * prod.diskon / 100));
        var hargaFormatted = new Intl.NumberFormat('id-ID').format(hargaDiskon);
        var hargaAsli = new Intl.NumberFormat('id-ID').format(prod.harga_produk);

        var biayaPasang = new Intl.NumberFormat('id-ID').format(prod.biaya_pasang); // Format biaya pasang
        var html = `
        <div class="max-w-sm bg-white shadow-2xl shadow-gray-400 rounded-lg p-6 relative h-full">
          ${prod.diskon ? `<div class="absolute top-0 right-0 bg-red-600 text-white text-sm px-3 py-1 rounded-tr-lg rounded-bl-lg">Diskon ${prod.diskon}%</div>` : ''}
          <h3 class="font-bold text-xl md:text-2xl lg:text-4xl mb-2">${prod.nama_produk}</h3>
          ${prod.diskon > 0 ? `
          <p class="text-gray-500 text-lg line-through">Rp${hargaAsli}</p>
          <p class="text-2xl lg:text-3xl font-bold mb-2 text-red-600">
            Rp${hargaFormatted.slice(0, 3)}<span class="text-sm">${hargaFormatted.slice(3)}/Bulan</span>
          </p>` : `
          <p class="text-3xl font-bold text-red-600">
            Rp${hargaAsli.slice(0, 3)}<span class="text-sm">${hargaAsli.slice(3)}/Bulan</span>
          </p>`}
          <ul class="mb-4 text-gray-700 space-y-2">
            <li><i class="fas fa-tachometer-alt text-black-500"></i> Kecepatan Internet Up to <b>${prod.kecepatan}</b> Mbps</li>
            <li class="flex items-center"><i class="fas fa-database text-black-500"></i> <span class="ml-2">${prod.kuota === 0 || prod.kuota === null ? 'Unlimited' : `${prod.kuota} GB`}</span></li>
            <li class="flex items-center"><i class="fas fa-money-bill-wave text-black-500"></i> <span class="ml-2">Biaya Pasang <b>${prod.biaya_pasang === 0 || prod.biaya_pasang === null ? 'Gratis' : `Rp${biayaPasang}`}</b></span></li>
            <div style="min-height: 50px;"> <!-- Tambahkan min-height untuk menjaga ukuran -->
              ${prod.benefit !== null && prod.benefit.length > 0
                    ? prod.benefit.map(b => `<li class="flex items-center"><i class="fas fa-gift text-black-500"></i> <span class="ml-2">${b}</span></li>`).join('')
                    : ''}
            </div>
          </ul>
          <button class="bg-red-600 text-white py-2 px-4 rounded-lg w-full">Pilih Paket</button>
        </div>
        `;
        produkContainer.append(html);
      });

      // Tampilkan atau sembunyikan tombol 'Tampilkan Semua Produk'
      if (produk.length > 3) {
        $('#toggle-produk-button').show(); // Jika produk lebih dari 3, tampilkan tombol
      } else {
        $('#toggle-produk-button').hide(); // Jika produk 3 atau kurang, sembunyikan tombol
      }
    }

    // Update produk saat halaman pertama kali dimuat
    updateProduk();

    // Fungsi toggle untuk tombol tampilkan semua atau lebih sedikit
    $('#toggle-produk-button').click(function () {
      tampilkanSemua = !tampilkanSemua;
      updateProduk(); // Update produk sesuai dengan status tampilkanSemua

      // Ubah teks tombol
      $(this).text(tampilkanSemua ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Semua Produk');
    });

    // Ketika kategori dipilih
    $('#kategori-filter').change(function () {
      var kategori = $(this).val();

      // Reset paket yang dipilih setiap kali kategori berubah
      $('.paket-button').removeClass('active text-white bg-red-600').addClass('text-gray-700');

      // Ajax request untuk mendapatkan produk dan paket sesuai kategori
      $.ajax({
        url: "{{ route('landingPage.layoutLandingPage') }}",
        method: 'GET',
        data: {
          kategori: kategori,
          paket: '' // Reset paket ke kosong agar semua paket kategori muncul
        },
        success: function (response) {
          produk = response.produk; // Update produk berdasarkan kategori
          updateProduk(); // Tampilkan produk sesuai kategori yang dipilih
          updatePaket(response.paket, kategori); // Update paket sesuai kategori
        }
      });
    });

    // Ketika paket dipilih
    $(document).on('click', '.paket-button', function () {
      var paket = $(this).data('id-paket');
      var kategori = $('#kategori-filter').val(); // Get the selected category if any

      // Hapus class 'active' dan 'bg-red-600' dari semua tombol paket
      $('.paket-button').removeClass('active text-white bg-red-600');
      $('.paket-button').addClass('text-gray-700');

      // Tambahkan class 'active', 'bg-red-600', dan 'text-white' ke tombol yang dipilih
      $(this).addClass('active text-white bg-red-600');
      $(this).removeClass('text-gray-700');

      // Ajax request untuk filter produk berdasarkan paket (dan kategori jika dipilih)
      $.ajax({
        url: "{{ route('landingPage.layoutLandingPage') }}",
        method: 'GET',
        data: {
          kategori: kategori,
          paket: paket
        },
        success: function (response) {
          produk = response.produk; // Update produk berdasarkan paket
          updateProduk(); // Tampilkan produk sesuai paket yang dipilih
        }
      });
    });

    // Function to update the paket buttons
    function updatePaket(pakets, kategori) {
      var paketContainer = $('.flex-wrap'); // Kontainer paket

      paketContainer.empty(); // Clear the existing paket buttons

      // Jika kategori tidak dipilih, tampilkan semua paket
      if (!kategori) {
        pakets = {!! json_encode($paket) !!}; // Jika kategori tidak dipilih, gunakan semua paket
      }

      // Append the new paket buttons
      $.each(pakets, function (index, pk) {
        var html = `
        <button class="px-4 py-2 font-semibold paket-button text-gray-700 rounded-tl-lg rounded-tr-lg" data-id-paket="${pk.id_paket}">
          ${pk.nama_paket}
        </button>
      `;
        paketContainer.append(html);
      });
    }
  });
</script>