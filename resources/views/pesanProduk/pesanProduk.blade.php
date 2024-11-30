<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')

  <!-- Tambahkan Leaflet CSS dan JavaScript -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>

<body class="bg-gray-100">
  <!-- Step Indicator -->
  <div class="fixed w-full bg-white z-48 py-10 ">
    <div class="container mx-auto max-w-4xl px-4 flex justify-center">
      <ol class="flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-red-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-gray-400">1</span>
          <span>
            <h3 class="font-bold font-telkomsel gradient-text leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm gradient-text">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-red-400">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Isi Data Diri</h3>
            <p class="text-sm dark:text-red-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">3</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Selesai</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tunggu Di Hubungi Call Center</p>
          </span>
        </li>
      </ol>
    </div>
  </div>
  <br><br>

  <div class="container mx-auto max-w-4xl mt-32 p-5 bg-white shadow-2xl shadow-gray-400 rounded-lg ">
    <h2 class="text-center text-2xl font-bold mb-6 font-telkomsel">Cari Lokasi untuk Pemasangan IndiHome</h2>

    <!-- Peta -->
    <div id="map" class="w-full h-64 rounded-lg mb-6"></div>
    <button id="getCurrentLocationBtn"
      class="w-full p-3 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-lg hover:bg-red-600">
      Gunakan Lokasi Saya Saat Ini
    </button>

    <!-- Input Pencarian Lokasi -->
    <div class="space-y-4">
      <!-- Input dan tombol pencarian -->
      <div class="flex">
        <input id="searchBox" type="text" placeholder="Cari nama jalan, kelurahan, gedung, dsb..."
          class="w-full p-3 mt-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
        <button id="searchBtn"
          class="p-3 mt-4 ml-2 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-lg hover:bg-red-600">
          Cari
        </button>
      </div>

      <!-- Container untuk autocomplete suggestions -->
      <div id="autocomplete-list" class="bg-white shadow rounded-lg overflow-y-auto max-h-40 mt-2"></div>

      <!-- Alamat lengkap -->
      <textarea id="alamatLengkap" placeholder="Masukkan alamat lengkap" rows="2"
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>

    </div>
  </div>

  <!-- Fixed Bottom Bar -->
  <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="flex items-center">
        <div
          class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-8 p-8">
          <!-- Menampilkan Kecepatan Produk -->
          @if(session('selected_product'))
        <span class="font-telkomsel text-lg">{{ session('selected_product')->kecepatan }} Mbps</span>
      @else
      <span class="font-telkomsel text-lg">Kecepatan Tidak Tersedia</span>
    @endif
        </div>
        <div class="ml-4">
          <!-- Menampilkan Nama dan Harga Produk -->
          @if(session('selected_product'))

            <!-- Nama Produk -->
            <h4 class="text-lg font-bold font-telkomsel">{{ session('selected_product')->nama_produk }}</h4>

            <!-- Menampilkan Harga Produk Asli dan Harga Setelah Diskon -->
            @php
  $hargaDiskon = session('selected_product')->harga_produk - (session('selected_product')->harga_produk * session('selected_product')->diskon / 100);
  $hargaFormatted = number_format($hargaDiskon, 0, ',', '.');
  $hargaAsli = number_format(session('selected_product')->harga_produk, 0, ',', '.');
        @endphp

            <div class="flex justify-between items-center">
            <p class="text-gray-400 text-sm font-telkomsel">
              <span class="line-through">Rp{{ $hargaAsli }}</span> (Harga Asli)
            </p>

            <!-- Diskon -->
            <p class="text-sm text-red-600 font-semibold font-telkomsel">
              {{ session('selected_product')->diskon }}% Diskon
            </p>

            </div>

            <p class="text-red-600 font-semibold font-telkomsel">
            Rp{{ $hargaFormatted }} (Harga Setelah Diskon)
            </p>
      @else
      <h4 class="text-lg font-bold font-telkomsel">Produk Belum Dipilih</h4>
    @endif
        </div>


      </div>
      <div class="flex">
        @include('pesanProduk.modalKirimOTP')
      </div>
    </div>
  </div>
  </div>


  <script>
    // Mendapatkan kunci API LocationIQ dari controller untuk digunakan dalam permintaan API
    const locationIQApiKey = "{{ $locationIQApiKey }}"; // Ambil kunci API dari controller

    // Inisialisasi peta menggunakan Leaflet, dengan titik pusat di koordinat (0.507068, 101.447779) dan zoom level 16
    var map = L.map('map').setView([0.507068, 101.447779], 16);

    // Menambahkan tile peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    // Menggunakan gambar sebagai icon marker
      var redIcon = L.icon({
        iconUrl: '{{ asset('images/kordinat.png') }}',  // URL relatif ke gambar
        iconSize: [41, 55], // Ukuran icon (sesuaikan dengan ukuran gambar Anda)
        iconAnchor: [16, 32], // Titik anchor (pusat icon)
        popupAnchor: [0, -32] // Offset popup jika diperlukan
      });

      // Membuat marker dengan icon merah
      var centerMarker = L.marker(map.getCenter(), { icon: redIcon }).addTo(map);




    // Fungsi untuk memperbarui alamat berdasarkan posisi tengah peta (setiap kali peta bergerak)
    function updateAddressFromMapCenter() {
      var center = map.getCenter(); // Mendapatkan koordinat pusat peta
      var lat = center.lat;
      var lng = center.lng;

      // Melakukan reverse geocoding dengan API LocationIQ untuk mendapatkan alamat berdasarkan lat, lng
      fetch(`https://us1.locationiq.com/v1/reverse.php?key=${locationIQApiKey}&lat=${lat}&lon=${lng}&format=json`)
        .then(response => response.json()) // Mengambil hasil API dalam format JSON
        .then(data => {
          // Menampilkan alamat pada kolom input dengan id 'alamatLengkap'
          document.getElementById('alamatLengkap').value = data.display_name || "Alamat tidak ditemukan";
          // Mengaktifkan tombol setelah alamat ditemukan
          document.getElementById('selectLocationBtn').disabled = false;
          document.getElementById('selectLocationBtn').classList.remove("bg-gray-400", "cursor-not-allowed");
          document.getElementById('selectLocationBtn').classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
        })
        .catch(error => console.error('Error:', error)); // Menangani error jika API gagal
    }

    // Event listener untuk pergerakan peta
    map.on('move', function () {
      centerMarker.setLatLng(map.getCenter()); // Memindahkan marker ke posisi tengah peta
    });

    // Event listener untuk setelah pergerakan peta selesai, akan memperbarui alamat
    map.on('moveend', updateAddressFromMapCenter);

    // Fungsi untuk mencari lokasi berdasarkan input dari user (dengan minimal 3 karakter)
    document.getElementById('searchBox').addEventListener('input', function () {
      const query = this.value; // Mendapatkan nilai input pencarian
      if (query.length < 3) {
        clearSuggestions(); // Menghapus saran jika input kurang dari 3 karakter
        return;
      }

      // Melakukan pencarian lokasi menggunakan LocationIQ API
      fetch(`https://us1.locationiq.com/v1/search.php?key=${locationIQApiKey}&q=${query}&format=json`)
        .then(response => response.json()) // Mengambil hasil API dalam format JSON
        .then(data => {
          if (data && data.length > 0) {
            showSuggestions(data); // Menampilkan saran pencarian jika ditemukan hasil
          } else {
            clearSuggestions(); // Menghapus saran jika tidak ada hasil
          }
        })
        .catch(error => {
          console.error('Error:', error); // Menangani error API
          clearSuggestions();
        });
    });

    // Menangani pencarian ketika tombol Cari diklik atau ketika tombol Enter ditekan
    document.getElementById('searchBtn').addEventListener('click', performSearch);
    document.getElementById('searchBox').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') { // Jika Enter ditekan, melakukan pencarian
        e.preventDefault(); // Mencegah form dikirim
        performSearch();
      }
    });

    // Fungsi untuk melakukan pencarian lokasi dan memperbarui peta serta alamat
    function performSearch() {
      const query = document.getElementById('searchBox').value; // Mendapatkan input pencarian
      if (query.length < 3) { // Validasi minimal 3 karakter
        alert("Masukkan minimal 3 karakter untuk pencarian.");
        return;
      }

      // Melakukan pencarian menggunakan API LocationIQ
      fetch(`https://us1.locationiq.com/v1/search.php?key=${locationIQApiKey}&q=${query}&format=json`)
        .then(response => response.json()) // Mengambil hasil API
        .then(data => {
          if (data && data.length > 0) {
            var lat = data[0].lat;
            var lon = data[0].lon;
            map.setView([lat, lon], 16); // Memindahkan peta ke lokasi yang ditemukan
            document.getElementById('alamatLengkap').value = data[0].display_name; // Menampilkan alamat pada kolom input
          } else {
            document.getElementById('alamatLengkap').value = "Alamat tidak ditemukan"; // Jika alamat tidak ditemukan
          }
          clearSuggestions(); // Menghapus saran setelah pencarian selesai
        })
        .catch(error => console.error('Error:', error)); // Menangani error pencarian
    }

    // Fungsi untuk menampilkan saran pencarian berdasarkan hasil API
    function showSuggestions(suggestions) {
      clearSuggestions(); // Menghapus saran sebelumnya
      const suggestionBox = document.getElementById('autocomplete-list'); // Mendapatkan elemen untuk menampilkan saran

      suggestions.forEach(item => {
        // Membuat elemen baru untuk setiap saran pencarian
        const suggestionItem = document.createElement('div');
        suggestionItem.innerHTML = `
        <i class="autocomplete-icon">📍</i>
        <span>${item.display_name}</span>
      `;
        // Menambahkan event listener untuk memilih saran
        suggestionItem.addEventListener('click', function () {
          document.getElementById('searchBox').value = item.display_name; // Mengisi input dengan saran yang dipilih
          map.setView([item.lat, item.lon], 16); // Memindahkan peta ke lokasi saran
          document.getElementById('alamatLengkap').value = item.display_name; // Menampilkan alamat pada kolom input
          updateAddressFromMapCenter(); // Memperbarui alamat berdasarkan koordinat peta
          clearSuggestions(); // Menghapus saran setelah dipilih
        });
        suggestionBox.appendChild(suggestionItem); // Menambahkan saran ke dalam box
      });
    }

    // Fungsi untuk menghapus semua saran pencarian
    function clearSuggestions() {
      const suggestionBox = document.getElementById('autocomplete-list');
      suggestionBox.innerHTML = ''; // Menghapus konten dalam suggestion box
    }

    // Event listener untuk mendapatkan lokasi pengguna saat tombol 'getCurrentLocationBtn' diklik
    document.getElementById('getCurrentLocationBtn').addEventListener('click', function () {
      if (navigator.geolocation) {
        // Menggunakan Geolocation API untuk mendapatkan lokasi pengguna
        navigator.geolocation.getCurrentPosition(function (position) {
          var lat = position.coords.latitude; // Mendapatkan latitude pengguna
          var lng = position.coords.longitude; // Mendapatkan longitude pengguna
          map.setView([lat, lng], 18); // Memindahkan peta ke lokasi pengguna
          updateAddressFromMapCenter(); // Memperbarui alamat berdasarkan posisi pengguna
        }, function (error) {
          console.error('Error mendapatkan lokasi: ' + error.message); // Menangani error jika geolocation gagal
        });
      } else {
        console.error('Geolocation tidak didukung oleh browser ini.'); // Menangani jika browser tidak mendukung geolocation
      }
    });
  </script>

</body>

</html>