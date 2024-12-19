<!-- Tombol Buka Filter -->
<div class="block md:hidden">
  <button type="button" onclick="document.getElementById('filter-dialog').showModal()"
    class="bg-white/20 text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:bg-white/30 transition-colors duration-300">
    <i class="fas fa-filter text-white"></i>
    <span>Filter</span>
  </button>
</div>

<!-- Filter Dialog Mobile -->
<dialog id="filter-dialog" class="modal p-0 m-0 w-full h-full max-w-full max-h-full bg-transparent">
  <div class="fixed inset-0 z-50 overflow-hidden bg-black bg-opacity-50 flex justify-start">
    <div class="w-80 h-full bg-white shadow-lg overflow-y-auto transform transition-transform">
      <!-- Filter Header -->
      <div class="flex justify-between items-center pb-4 border-b px-4 pt-4">
        <h2 class="font-semibold text-lg flex items-center">
          <svg class="inline w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 4a1 1 0 00-1 1v3a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1H3zM4 8v2a2 2 0 002 2h12a2 2 0 002-2V8H4zm-1 6h16m-7 6v-6m-2 6v-6" />
          </svg>
          Filter
        </h2>

        <div class="flex items-center space-x-2">
          <button type="button" onclick="document.getElementById('filter-dialog').close()"
            class="text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Filter Section: Harga (Accordion) -->
      <div class="py-4 border-b px-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('harga-mobile')">
          <h3 class="font-semibold text-gray-700">Harga</h3>
          <svg id="arrow-harga-mobile" class="w-5 h-5 text-red-500 transform rotate-180 transition-transform"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
        <div id="content-harga-mobile" class="mt-4">
          <p class="text-sm text-gray-500">Geser untuk menentukan kisaran harga minimum dan maksimum</p>

          <div class="relative py-4">
            <div class="absolute top-1/2 transform-translate-y-1/2 w-full h-1 bg-gray-200 rounded-lg"></div>
            <div id="range-track-mobile" class="absolute top-1/2 transform-translate-y-1/2 h-2 bg-red-500 rounded-lg">
            </div>

            <input id="range-min-mobile" type="range" min="0" max="1000000" step="50000" value="0"
              class="absolute range-slider w-full h-2 bg-transparent cursor-pointer z-20" oninput="updateRangeMobile()">

            <input id="range-max-mobile" type="range" min="0" max="1000000" step="50000" value="1000000"
              class="absolute range-slider w-full h-2 bg-transparent cursor-pointer z-10" oninput="updateRangeMobile()">
          </div>

          <div class="mt-8 flex justify-between text-sm">
            <span>Mulai <br> <b id="label-min-mobile">Rp 0</b></span>
            <span>Hingga <br> <b id="label-max-mobile">Rp 1.000.000</b></span>
          </div>
        </div>
      </div>

      <!-- Filter Section: Kecepatan (Accordion) -->
      <div class="py-4 border-b px-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('kecepatan-mobile')">
          <h3 class="font-semibold text-gray-700">Kecepatan</h3>
          <svg id="arrow-kecepatan-mobile" class="w-5 h-5 text-red-500 transform rotate-180 transition-transform"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
        <div id="content-kecepatan-mobile" class="mt-4">
          <p class="text-sm text-gray-500 mb-4">Pilih Produk Berdasarkan Kecepatan Internet</p>
          <div class="space-y-2">
            @foreach($kecepatanProduk as $kecepatan)
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="kecepatan[]" class="form-checkbox h-5 w-5 text-red-500 rounded"
          value="{{ $kecepatan->kecepatan }}">
          <span>{{ $kecepatan->kecepatan }} Mbps</span>
        </label>
      @endforeach
          </div>
        </div>
      </div>

      <!-- Filter Section: Kuota (Accordion) -->
      <div class="py-4 border-b px-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('kuota-mobile')">
          <h3 class="font-semibold text-gray-700">Kuota</h3>
          <svg id="arrow-kuota-mobile" class="w-5 h-5 text-red-500 transform rotate-180 transition-transform"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
        <div id="content-kuota-mobile" class="mt-4">
          <p class="text-sm text-gray-500 mb-4">Pilih Produk Berdasarkan Kuota Internet</p>
          <div class="space-y-2">
            @foreach($kuota->sortByDesc(function ($kuo) {
  return $kuo->kuota === null ? PHP_INT_MAX : $kuo->kuota;
}) as $kuo)
              <label class="flex items-center space-x-2">
                <input type="checkbox" name="kuota[]" class="form-checkbox h-5 w-5 text-red-500 rounded"
                value="{{ $kuo->kuota === null ? 'Unlimited' : $kuo->kuota }}">
                <span>{{ $kuo->kuota === null ? 'Unlimited' : $kuo->kuota . ' GB' }}</span>
              </label>
      @endforeach
          </div>
        </div>
      </div>

      <!-- Tombol Terapkan Filter -->
      <div class="p-4 flex space-x-4">
        <button type="button" class="flex-1 text-red-600 border border-red-500 py-2 rounded-lg"
          onclick="resetFiltersMobile()">
          Reset
        </button>
      </div>
    </div>
  </div>
</dialog>

<!-- Custom Script untuk range slider mobile -->
<script>

  const rangeMinMobile = document.getElementById('range-min-mobile');
  const rangeMaxMobile = document.getElementById('range-max-mobile');
  const labelMinMobile = document.getElementById('label-min-mobile');
  const labelMaxMobile = document.getElementById('label-max-mobile');
  const trackMobile = document.getElementById('range-track-mobile');
  const MIN_GAP_MOBILE = 50000; // Jarak minimal antara kedua slider

  function updateRangeMobile() {
    let minValue = parseInt(rangeMinMobile.value);
    let maxValue = parseInt(rangeMaxMobile.value);

    // Ensure that minValue is not greater than maxValue - MIN_GAP
    if (minValue >= maxValue - MIN_GAP_MOBILE) {
      rangeMinMobile.value = maxValue - MIN_GAP_MOBILE; // Berikan jarak minimum
      minValue = maxValue - MIN_GAP_MOBILE;
    }

    // Ensure that maxValue is not less than minValue + MIN_GAP
    if (maxValue <= minValue + MIN_GAP_MOBILE) {
      rangeMaxMobile.value = minValue + MIN_GAP_MOBILE; // Berikan jarak minimum
      maxValue = minValue + MIN_GAP_MOBILE;
    }

    // Update labels
    labelMinMobile.textContent = `Rp ${minValue.toLocaleString('id-ID')}`;
    labelMaxMobile.textContent = `Rp ${maxValue.toLocaleString('id-ID')}`;

    // Adjust track style to show progress between min and max
    const minPercent = (minValue / rangeMinMobile.max) * 100;
    const maxPercent = (maxValue / rangeMaxMobile.max) * 100;

    trackMobile.style.left = `${minPercent}%`;
    trackMobile.style.width = `${maxPercent - minPercent}%`;
  }

  // Fungsi untuk toggle accordion mobile
  function toggleAccordion(section) {
    const content = document.getElementById(`content-${section}`);
    const arrow = document.getElementById(`arrow-${section}`);

    // Toggle visibility of content
    if (content.style.display === "none" || content.style.display === "") {
      content.style.display = "block";
      arrow.classList.add("rotate-180");  // Rotate arrow 180 degrees
    } else {
      content.style.display = "none";
      arrow.classList.remove("rotate-180");  // Reset rotation
    }
  }

  // Initialize range display
  function initRangeMobile() {
    updateRangeMobile();
  }

  function resetFiltersMobile() {
    // Reset checkbox filters
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
      checkbox.checked = false;
    });

    // Reset range sliders
    rangeMinMobile.value = 0;
    rangeMaxMobile.value = 1000000;

    labelMinMobile.textContent = 'Rp 0';
    labelMaxMobile.textContent = 'Rp 1.000.000';

    trackMobile.style.left = '0%';
    trackMobile.style.width = '100%';

    // Panggil fungsi untuk reload produk (gunakan AJAX)
    loadProductsMobile();
  }

  function applyFiltersMobile() {
    // Kumpulkan data filter
    const minPrice = rangeMinMobile.value;
    const maxPrice = rangeMaxMobile.value;

    const selectedKecepatan = Array.from(
      document.querySelectorAll('input[name="kecepatan[]"]:checked')
    ).map(el => el.value);

    const selectedKuota = Array.from(
      document.querySelectorAll('input[name="kuota[]"]:checked')
    ).map(el => el.value);

    // Kirim data filter melalui AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('produk.filter') }}', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById('produk-container-mobile').innerHTML = xhr.responseText;
        // Tutup drawer setelah filter diterapkan
        closeFilterDrawer();
      }
    };

    xhr.send(JSON.stringify({
      min_price: minPrice,
      max_price: maxPrice,
      kecepatan: selectedKecepatan,
      kuota: selectedKuota
    }));
  }

  function loadProductsMobile() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '{{ route('produk.filter') }}', true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById('produk-container-mobile').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', initRangeMobile);
</script>

<!-- CSS Custom untuk Styling Range Slider Mobile -->
<style>
  .range-slider {
    -webkit-appearance: none;
    appearance: none;
    background: none;
    position: absolute;
    pointer-events: none;
  }

  input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 16px;
    height: 16px;
    background: red;
    border-radius: 50%;
    cursor: pointer;
    pointer-events: all;
    position: relative;
    z-index: 1;
  }

  input[type="range"]::-moz-range-thumb {
    width: 16px;
    height: 16px;
    background: red;
    border-radius: 50%;
    cursor: pointer;
    pointer-events: all;
    position: relative;
    z-index: 1;
  }

  #range-track-mobile {
    background-color: red;
    height: 5px;
    border-radius: 5px;
    position: absolute;
    z-index: 0;
  }
</style>