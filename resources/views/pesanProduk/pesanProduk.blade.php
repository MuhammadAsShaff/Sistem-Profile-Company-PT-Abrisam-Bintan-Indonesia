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
  <style>
    /* Pastikan desktop step indicator selalu tampil di desktop */
    @media (min-width: 768px) {
      .desktop-step-indicator {
        display: flex !important;
      }

      .mobile-step-indicator {
        display: none !important;
      }
    }

    /* Pastikan mobile step indicator selalu tampil di mobile */
    @media (max-width: 767px) {
      .desktop-step-indicator {
        display: none !important;
      }

      .mobile-step-indicator {
        display: flex !important;
      }
    }

       @media (max-width: 767px) {
      .desktop-view {
        display: none !important;
      }
    }
  
    @media (min-width: 768px) {
      .mobile-view {
        display: none !important;
      }
    }
  </style>
</head>

<body class="bg-gray-100">
  @include('loading')
  <!-- Step Indicator -->
  <div class="fixed w-full bg-white z-48 py-4 md:py-10">
    <div class="container mx-auto max-w-4xl px-4 ">
      <!-- Step Desktop -->
      <ol class="desktop-step-indicator hidden md:flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center gradient-text space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">1</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight gradient-text leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm dark:text-red-400">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Isi Data Diri</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi
              Data Anda</p>
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

      <!-- Step Mobile -->
      <div class="mobile-step-indicator block md:hidden flex justify-between items-center">
        <!-- Step 1 -->
        <span class="flex flex-col items-center gradient-text">
          <div class="w-8 h-8 flex items-center justify-center border border-red-500 rounded-full">1</div>
          <p class="text-xs font-bold font-telkomsel">Pilih Lokasi</p>
          <p class="text-[10px] gradient-text text-center">Lokasi dan Paket</p>
        </span>

        <!-- Line Separator -->
        <div class="w-8 border-t-2 border-gray-300"></div>

        <!-- Step 2 -->
        <span class="flex flex-col items-center text-gray-500">
          <div class="w-8 h-8 flex items-center justify-center border border-gray-500 rounded-full">2</div>
          <p class="text-xs font-bold font-telkomsel">Isi Data</p>
          <p class="text-[10px] text-gray-500 text-center">Konfirmasi Data</p>
        </span>

        <!-- Line Separator -->
        <div class="w-8 border-t-2 border-gray-300"></div>

        <!-- Step 3 -->
        <span class="flex flex-col items-center text-gray-500">
          <div class="w-8 h-8 flex items-center justify-center border border-gray-500 rounded-full">3</div>
          <p class="text-xs font-bold font-telkomsel">Selesai</p>
          <p class="text-[10px] text-gray-500 text-center">Tunggu Call Center</p>
        </span>
      </div>
    </div>
  </div>
  <br><br><br><br class="hidden md:block">

  <!-- Form & Peta -->
  <div class="container mx-auto max-w-4xl mt-20 md:mt-20 p-4 md:p-5 bg-white shadow-2xl rounded-lg">
    <h2 class="text-center text-lg md:text-2xl font-bold mb-4 md:mb-6 font-telkomsel">Cari Lokasi untuk Pemasangan</h2>

    <!-- Peta -->
    <div id="map" class="w-full h-64 md:h-64 rounded-lg mb-4 md:mb-6"></div>
    <button id="getCurrentLocationBtn"
      class="w-full p-2 md:p-3 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-lg hover:bg-red-600">
      Gunakan Lokasi Saya
    </button>

    <!-- Input Pencarian Lokasi -->
    <div class="space-y-2 md:space-y-4 mt-4">
      <div class="flex">
        <input id="searchBox" type="text" placeholder="Cari lokasi..."
          class="w-full p-2 md:p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500" />
        <button id="searchBtn"
          class="p-2 md:p-3 ml-2 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-lg hover:bg-red-600">
          Cari
        </button>
      </div>

      <!-- Container untuk autocomplete suggestions -->
      <div id="autocomplete-list" class="bg-white shadow rounded-lg overflow-y-auto max-h-40 mt-4"></div>

      <!-- Alamat lengkap -->
      <form id="locationForm" action="{{ route('simpanAlamat') }}" method="POST">
        @csrf
        <div>
          <div>
            <!-- Input untuk alamat lengkap -->
            <textarea id="alamatLengkap" name="alamatLengkap" placeholder="Masukkan alamat lengkap" rows="2"
              class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('alamatLengkap') }}</textarea>
          </div>

          <!-- Input untuk latitude -->
          <input id="lat" name="lat" type="hidden" placeholder="Latitude" value="{{ old('lat') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk longitude -->
          <input id="lon" name="lon" type="hidden" placeholder="Longitude" value="{{ old('lon') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk kelurahan -->
          <input id="village" name="village" type="hidden" placeholder="Kelurahan" value="{{ old('village') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk kota -->
          <input id="city" name="city" type="hidden" placeholder="Kota" value="{{ old('city') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk kecamatan -->
          <input id="district" name="district" type="hidden" placeholder="Kecamatan" value="{{ old('district') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk provinsi -->
          <input id="state" name="state" type="hidden" placeholder="Provinsi" value="{{ old('state') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk kode pos -->
          <input id="postcode" name="postcode" type="hidden" placeholder="Kode Pos" value="{{ old('postcode') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk negara -->
          <input id="country" name="country" type="hidden" placeholder="Negara" value="{{ old('country') }}"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

          <!-- Input untuk country_code (hidden) -->
          <input id="country_code" name="country_code" type="hidden" value="{{ old('country_code') }}">
      </form>

    </div>
  </div>
  
  <!-- Versi Desktop -->
  <div class="desktop-view fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="flex items-center">
        <div
          class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-8 p-8">
          <!-- Menampilkan Kecepatan Produk -->
          @if(isset($produk) && !empty($produk))
        <span class="font-telkomsel text-lg">{{ $produk['kecepatan'] }} Mbps</span>
      @else
      <span class="font-telkomsel text-lg">Kecepatan Tidak Tersedia</span>
    @endif
        </div>
        <div class="ml-4">
          <!-- Menampilkan Nama dan Harga Produk -->
          @if(isset($produk) && !empty($produk))
        <!-- Nama Produk -->
        <h4 class="text-lg font-bold font-telkomsel">{{ $produk['nama_produk'] }}</h4>

        <!-- Menampilkan Harga Produk Asli dan Harga Setelah Diskon -->
        <div class="flex justify-between items-center">
        <p class="text-gray-400 text-sm font-telkomsel">
          <span class="line-through">Rp{{ $produk['harga_produk'] }}</span> (Harga Asli)
        </p>

        <!-- Diskon -->
        <p class="text-sm text-red-600 font-semibold font-telkomsel">
          {{ $produk['diskon'] }}% Diskon
        </p>
        </div>

        <p class="text-red-600 font-semibold font-telkomsel">
        Rp{{ number_format($produk['harga_produk'] - ($produk['harga_produk'] * $produk['diskon'] / 100), 0, ',', '.') }}
        (Harga Setelah Diskon)
        </p>
      @else
      <h4 class="text-lg font-bold font-telkomsel">Produk Belum Dipilih</h4>
    @endif
        </div>
      </div>
      <div class="flex">
        <a id="selectLocationBtn" href="#" class="w-full p-3 bg-gray-500 text-white rounded-lg cursor-not-allowed"
          onclick="submitForm(event)">
          Lanjut Isi Data Diri
        </a>
      </div>
    </div>
  </div>
  
  <!-- Versi Mobile -->
  <div class="mobile-view fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="flex items-center">
        <div
          class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-4 p-6">
          <!-- Menampilkan Kecepatan Produk -->
          @if(isset($produk) && !empty($produk))
        <span class="font-telkomsel text-sm">{{ $produk['kecepatan'] }} Mbps</span>
      @else
      <span class="font-telkomsel text-sm">N/A</span>
    @endif
        </div>
        <div>
          <!-- Menampilkan Nama dan Harga Produk -->
          @if(isset($produk) && !empty($produk))
        <h4 class="text-sm font-bold font-telkomsel">{{ $produk['nama_produk'] }}</h4>
        <p class="text-xs text-red-600 font-telkomsel">
        Rp{{ number_format($produk['harga_produk'] - ($produk['harga_produk'] * $produk['diskon'] / 100), 0, ',', '.') }}
        </p>
      @else
      <h4 class="text-sm font-bold font-telkomsel">Produk Belum Dipilih</h4>
    @endif
        </div>
      </div>
      <div class="flex">
        <a id="selectLocationMobileBtn" href="#" class="w-full p-3 bg-gray-500 text-white rounded-lg cursor-not-allowed"
          onclick="submitForm(event)">
          Lanjut Isi Data Diri
        </a>
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

      // Mengupdate nilai input lat dan lon
      document.getElementById('lat').value = lat; // Menampilkan latitude
      document.getElementById('lon').value = lng; // Menampilkan longitude

      // Melakukan reverse geocoding dengan API LocationIQ untuk mendapatkan alamat berdasarkan lat, lng
      fetch(`https://us1.locationiq.com/v1/reverse.php?key=${locationIQApiKey}&lat=${lat}&lon=${lng}&format=json`)
        .then(response => response.json()) // Mengambil hasil API dalam format JSON
        .then(data => {
          console.log(data); // Debugging: Cek data yang diterima
          document.getElementById('alamatLengkap').value = data.display_name || "Alamat tidak ditemukan";

          // Mengupdate input lainnya berdasarkan data dari API
          document.getElementById('village').value = data.address.village || "";
          document.getElementById('city').value = data.address.city || "";
          document.getElementById('district').value = data.address.district || "";
          document.getElementById('state').value = data.address.state || "";
          document.getElementById('postcode').value = data.address.postcode || "";
          document.getElementById('country').value = data.address.country || "";
          document.getElementById('country_code').value = data.address.country_code || "";

          // Jika alamat ditemukan, aktifkan tombol dan ubah tampilannya
          if (data.display_name) {
            enableLocationBtn(); // Mengaktifkan tombol
          } else {
            disableLocationBtn(); // Menonaktifkan tombol jika alamat tidak ditemukan
          }
        })
        .catch(error => {
          console.error('Error:', error);
          disableLocationBtn(); // Menonaktifkan tombol jika error terjadi
        });
    }

   // Fungsi untuk mengaktifkan tombol
    function enableLocationBtn() {
      // Tombol Desktop
      const btnDesktop = document.getElementById('selectLocationBtn');
      if (btnDesktop) {
        btnDesktop.removeAttribute("disabled");
        btnDesktop.classList.remove("bg-gray-500", "cursor-not-allowed");
        btnDesktop.classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
      }

      // Tombol Mobile
      const btnMobile = document.getElementById('selectLocationMobileBtn');
      if (btnMobile) {
        btnMobile.removeAttribute("disabled");
        btnMobile.classList.remove("bg-gray-500", "cursor-not-allowed");
        btnMobile.classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
      }
    }

    // Fungsi untuk menonaktifkan tombol
    function disableLocationBtn() {
      // Tombol Desktop
      const btnDesktop = document.getElementById('selectLocationBtn');
      if (btnDesktop) {
        btnDesktop.setAttribute("disabled", true);
        btnDesktop.classList.add("bg-gray-500", "cursor-not-allowed");
        btnDesktop.classList.remove("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
      }

      // Tombol Mobile
      const btnMobile = document.getElementById('selectLocationMobileBtn');
      if (btnMobile) {
        btnMobile.setAttribute("disabled", true);
        btnMobile.classList.add("bg-gray-500", "cursor-not-allowed");
        btnMobile.classList.remove("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
      }
    }

    // Fungsi untuk mengirimkan form
    function submitForm(event) {
      event.preventDefault(); // Mencegah default action dari link (misalnya redirect)

      // Ambil form
      const form = document.getElementById('locationForm');

      // Periksa status tombol desktop atau mobile
      const btnDesktop = document.getElementById('selectLocationBtn');
      const btnMobile = document.getElementById('selectLocationMobileBtn');

      // Jika salah satu tombol dalam keadaan aktif, submit form
      if ((btnDesktop && !btnDesktop.hasAttribute("disabled")) ||
        (btnMobile && !btnMobile.hasAttribute("disabled"))) {
        form.submit(); // Mengirim form
      }
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