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
    <button id="getCurrentLocationBtn" class="w-full p-3 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-lg hover:bg-red-600">
      Gunakan Lokasi Saya Saat Ini
    </button>
  
    <!-- Input Pencarian Lokasi -->
    <div class="space-y-4">
      <!-- Input dan tombol pencarian -->
      <div class="flex">
        <input id="searchBox" type="text" placeholder="Cari nama jalan, kelurahan, gedung, dsb..."
          class="w-full p-3 mt-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
        <button id="searchBtn" class="p-3 mt-4 ml-2 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-lg hover:bg-red-600">
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
        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-8 p-8">
          <span class="font-telkomsel text-lg">20 Mbps</span>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-bold font-telkomsel">Orbit Star N1 + Philips Smart Lamp</h4>
          <p class="text-gray-500">Rp 644.000</p>
        </div>
      </div>
      <div class="flex">
        <button id="selectLocationBtn" class="w-full p-3 bg-gray-400 text-white rounded-lg cursor-not-allowed"
        disabled>Selanjutnya</button>
      </div>
    </div>
  </div>
  

  <script>
    const locationIQApiKey = "{{ $locationIQApiKey }}"; // Ambil kunci API dari controller

    // Inisialisasi peta
    var map = L.map('map').setView([0.507068, 101.447779], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);
    var centerMarker = L.marker(map.getCenter(), { draggable: false }).addTo(map);

    function updateAddressFromMapCenter() {
      var center = map.getCenter();
      var lat = center.lat;
      var lng = center.lng;

      fetch(`https://us1.locationiq.com/v1/reverse.php?key=${locationIQApiKey}&lat=${lat}&lon=${lng}&format=json`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('alamatLengkap').value = data.display_name || "Alamat tidak ditemukan";
          document.getElementById('selectLocationBtn').disabled = false;
          document.getElementById('selectLocationBtn').classList.remove("bg-gray-400", "cursor-not-allowed");
          document.getElementById('selectLocationBtn').classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");

        })
        .catch(error => console.error('Error:', error));
    }

    map.on('move', function () {
      centerMarker.setLatLng(map.getCenter());
    });
    map.on('moveend', updateAddressFromMapCenter);

    // Fungsi untuk mencari lokasi berdasarkan input pencarian
    document.getElementById('searchBox').addEventListener('input', function () {
      const query = this.value;
      if (query.length < 3) {
        clearSuggestions();
        return;
      }

      fetch(`https://us1.locationiq.com/v1/search.php?key=${locationIQApiKey}&q=${query}&format=json`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            showSuggestions(data);
          } else {
            clearSuggestions();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          clearSuggestions();
        });
    });

    // Menangani pencarian ketika tombol Cari diklik atau ketika Enter ditekan
    document.getElementById('searchBtn').addEventListener('click', performSearch);
    document.getElementById('searchBox').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        performSearch();
      }
    });

    function performSearch() {
      const query = document.getElementById('searchBox').value;
      if (query.length < 3) {
        alert("Masukkan minimal 3 karakter untuk pencarian.");
        return;
      }

      fetch(`https://us1.locationiq.com/v1/search.php?key=${locationIQApiKey}&q=${query}&format=json`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            var lat = data[0].lat;
            var lon = data[0].lon;
            map.setView([lat, lon], 16);
            document.getElementById('alamatLengkap').value = data[0].display_name;
          } else {
            document.getElementById('alamatLengkap').value = "Alamat tidak ditemukan";
          }
          clearSuggestions();
        })
        .catch(error => console.error('Error:', error));
    }

    // Menampilkan saran pencarian
    function showSuggestions(suggestions) {
      clearSuggestions();
      const suggestionBox = document.getElementById('autocomplete-list');

      suggestions.forEach(item => {
        const suggestionItem = document.createElement('div');
        suggestionItem.innerHTML = `
          <i class="autocomplete-icon">📍</i>
          <span>${item.display_name}</span>
        `;
        suggestionItem.addEventListener('click', function () {
          document.getElementById('searchBox').value = item.display_name;
          map.setView([item.lat, item.lon], 16);
          document.getElementById('alamatLengkap').value = item.display_name;
          updateAddressFromMapCenter();
          clearSuggestions();
        });
        suggestionBox.appendChild(suggestionItem);
      });
    }

    // Menghapus saran pencarian
    function clearSuggestions() {
      const suggestionBox = document.getElementById('autocomplete-list');
      suggestionBox.innerHTML = '';
    }

    document.getElementById('getCurrentLocationBtn').addEventListener('click', function () {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          map.setView([lat, lng], 18);
          updateAddressFromMapCenter();
        }, function (error) {
          console.error('Error mendapatkan lokasi: ' + error.message);
        });
      } else {
        console.error('Geolocation tidak didukung oleh browser ini.');
      }
    });
  </script>
</body>

</html>