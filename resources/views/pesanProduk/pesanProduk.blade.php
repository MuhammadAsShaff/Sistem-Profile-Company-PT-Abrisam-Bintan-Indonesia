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


<body>
  <!-- Step Indicator -->
  <div class="fixed top-10 w-full bg-white z-48 py-4">
    <div class="container mx-auto max-w-4xl px-4 flex justify-center">
      <ol class="flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-red-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-gray-400">1</span>
          <span>
            <h3 class="font-bold font-telkomsel text-red-500 leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm text-red-500 ">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>

        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-red-400">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Isi Data Diri</h3>
            <p class="text-sm  dark:text-red-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
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

  <div class="container mx-auto max-w-4xl mt-32 p-5 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-2xl font-bold mb-6">Cari Lokasi untuk Pemasangan IndiHome</h2>
  
    <!-- Peta -->
    <div id="map" class="w-full h-64 rounded-lg mb-6"></div>
  
    <!-- Input Pencarian Lokasi -->
    <div class="space-y-4">
      <input id="searchBox" type="text" placeholder="Cari nama jalan, kelurahan, gedung, dsb..."
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
  
      <!-- Alamat lengkap -->
      <textarea id="alamatLengkap" placeholder="Masukkan alamat lengkap" rows="4"
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
  
      <!-- Tombol Pilih Lokasi -->
      <button id="selectLocationBtn" class="w-full p-3 bg-gray-400 text-white rounded-lg cursor-not-allowed"
        disabled>Pilih lokasi ini</button>
    </div>
  </div>
  
  <script>
    // Inisialisasi peta dengan koordinat awal di Pekanbaru
    var map = L.map('map').setView([0.507068, 101.447779], 13);

    // Tambahkan peta ubin dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    // Marker untuk menandai lokasi yang dipilih
    var marker = L.marker([0.507068, 101.447779], { draggable: true }).addTo(map);

    // Fungsi untuk memperbarui posisi marker dan alamat berdasarkan koordinat
    function updateAddress(lat, lng) {
      // Panggil API LocationIQ dengan koordinat yang diberikan
      fetch(`https://us1.locationiq.com/v1/reverse.php?key=YOUR_LOCATIONIQ_API_KEY&lat=${lat}&lon=${lng}&format=json`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('alamatLengkap').value = data.display_name;
          document.getElementById('selectLocationBtn').disabled = false;
          document.getElementById('selectLocationBtn').classList.remove("bg-gray-400", "cursor-not-allowed");
          document.getElementById('selectLocationBtn').classList.add("bg-blue-500", "hover:bg-blue-600");
        })
        .catch(error => console.error('Error:', error));
    }

    // Update alamat ketika marker dipindahkan
    marker.on('dragend', function (e) {
      var position = marker.getLatLng();
      updateAddress(position.lat, position.lng);
    });

    // Tambahkan event listener pada search box (opsional)
    document.getElementById('searchBox').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        var query = document.getElementById('searchBox').value;

        // Panggil API LocationIQ untuk mencari lokasi berdasarkan query
        fetch(`https://us1.locationiq.com/v1/search.php?key=YOUR_LOCATIONIQ_API_KEY&q=${query}&format=json`)
          .then(response => response.json())
          .then(data => {
            if (data && data.length > 0) {
              var lat = data[0].lat;
              var lon = data[0].lon;
              map.setView([lat, lon], 13);
              marker.setLatLng([lat, lon]);
              updateAddress(lat, lon);
            }
          })
          .catch(error => console.error('Error:', error));
      }
    });
  </script>

    
</body>

</html>