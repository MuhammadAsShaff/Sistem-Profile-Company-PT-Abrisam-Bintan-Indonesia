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
  
    <!-- Peta Google -->
    <div id="map" class="w-full rounded-lg mb-6"></div>
  
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
      let map;
      let marker;
      let geocoder;
      let searchBox;
      let selectedLocation = {};

      function initMap() {
        // Inisialisasi peta
        map = new google.maps.Map(document.getElementById('map'), {
          center: { lat: 0.5071, lng: 101.4478 }, // Jakarta default
          zoom: 12
        });

        // Inisialisasi Geocoder
        geocoder = new google.maps.Geocoder();

        // Inisialisasi SearchBox
        searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));

        // Event listener ketika user memilih dari hasil pencarian
        searchBox.addListener('places_changed', () => {
          const places = searchBox.getPlaces();
          if (places.length == 0) return;

          const place = places[0];
          const location = place.geometry.location;

          // Pindahkan peta ke lokasi yang dipilih
          map.setCenter(location);
          map.setZoom(15);

          // Pindahkan atau buat marker pada lokasi
          if (marker) {
            marker.setPosition(location);
          } else {
            marker = new google.maps.Marker({
              position: location,
              map: map,
              draggable: true // marker dapat dipindahkan
            });
          }

          // Set detail lokasi terpilih
          selectedLocation = {
            lat: location.lat(),
            lng: location.lng(),
            address: place.formatted_address || place.name
          };

          // Tampilkan alamat di text area
          document.getElementById('alamatLengkap').value = selectedLocation.address;

          // Enable button
          const selectButton = document.getElementById('selectLocationBtn');
          selectButton.disabled = false;
          selectButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
          selectButton.classList.add('bg-blue-500', 'hover:bg-blue-700', 'cursor-pointer');
        });

        // Listener untuk event ketika marker dipindahkan
        marker.addListener('dragend', function () {
          const position = marker.getPosition();
          selectedLocation = {
            lat: position.lat(),
            lng: position.lng()
          };

          // Reverse Geocoding untuk mendapatkan alamat
          geocoder.geocode({ location: selectedLocation }, function (results, status) {
            if (status === 'OK') {
              if (results[0]) {
                document.getElementById('alamatLengkap').value = results[0].formatted_address;
                selectedLocation.address = results[0].formatted_address;
              }
            }
          });
        });
      }

      // Panggil fungsi inisialisasi peta
      window.onload = initMap;

      // Fungsi untuk memilih lokasi yang ditandai
      document.getElementById('selectLocationBtn').addEventListener('click', function () {
        alert('Lokasi Terpilih:\nLatitude: ' + selectedLocation.lat + '\nLongitude: ' + selectedLocation.lng + '\nAlamat: ' + selectedLocation.address);
      });
    </script>
</body>

</html>