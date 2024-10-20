<div class="w-full md:w-full bg-white shadow-lg rounded-lg p-10 mt-32 ml-8">
  <!-- Filter Header -->
  <div class="flex justify-between items-center pb-4 border-b font-telkomsel">
    <h2 class="font-semibold text-lg flex items-center">
      <svg class="inline w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 4a1 1 0 00-1 1v3a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1H3zM4 8v2a2 2 0 002 2h12a2 2 0 002-2V8H4zm-1 6h16m-7 6v-6m-2 6v-6" />
      </svg>
      Filter
    </h2>
    <button class="text-red-500 focus:outline-none font-telkomsel">Reset</button>
  </div>

  <!-- Filter Section: Harga (Accordion) -->
  <div class="py-4 border-b ">
    <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('harga')">
      <h3 class="font-semibold text-gray-700 font-telkomsel">Harga</h3>
      <svg id="arrow-harga" class="w-5 h-5 text-red-500 transform rotate-180 transition-transform"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>
    <div id="content-harga" class="mt-4" style="display: block;"> <!-- Default terbuka -->
      <p class="text-sm text-gray-500">Geser untuk menentukan kisaran harga minimum dan maksimum</p>

      <!-- Double Range Slider -->
      <div class="relative py-4 font-telkomsel">
        <!-- Background track (gray line behind the slider) -->
        <div class="absolute top-1/2 transform-translate-y-1/2 w-full h-1 bg-gray-200 rounded-lg"></div>
        <!-- Garis bayangan di belakang -->

        <!-- Track Progress (red line) -->
        <div id="range-track" class="absolute top-1/2 transform-translate-y-1/2 h-2 bg-red-500 rounded-lg"></div>
        <!-- Garis merah -->

        <!-- Input Mulai -->
        <input id="range-min" type="range" min="0" max="1000000" step="50000" value="0"
          class="absolute range-slider w-full h-2 bg-transparent cursor-pointer z-20" oninput="updateRange()">

        <!-- Input Hingga -->
        <input id="range-max" type="range" min="0" max="1000000" step="50000" value="1000000"
          class="absolute range-slider w-full h-2 bg-transparent cursor-pointer z-10" oninput="updateRange()">
      </div>

      <!-- Label Mulai dan Hingga -->
      <div class="mt-4 flex justify-between text-sm font-telkomsel">
        <span>Mulai <br> <b id="label-min">Rp 0</b></span>
        <span>Hingga <br> <b id="label-max">Rp 1.000.000</b></span>
      </div>
    </div>
  </div>

  <!-- Filter Section: Kecepatan (Accordion) -->
<!-- Filter Section: Kecepatan (Accordion) -->
<div class="py-4 ">
  <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('kecepatan')">
    <div>
      <h3 class="font-semibold text-gray-700 font-telkomsel">Kecepatan</h3>
    </div>
    <svg id="arrow-kecepatan" class="w-5 h-5 text-red-500 transform rotate-180 transition-transform"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </div>
  <div id="content-kecepatan" class="mt-4" style="display: block;"><!-- Default terbuka -->
      <p class="text-sm text-gray-500 mb-4">Anda Dapat Memilih Produk Berdasarkan Kecepatan Internet</p> 
    <div class="space-y-2">
      @foreach($kecepatanProduk as $kecepatan)
      <label class="flex items-center space-x-2">
      <input type="checkbox" name="kecepatan[]" class="form-checkbox h-5 w-5 text-red-500 rounded"
        value="{{ $kecepatan->kecepatan }}">
      <span class="text-gray-700 font-telkomsel">{{ $kecepatan->kecepatan }} Mbps</span>
      </label>
    @endforeach
    </div>
  </div>
</div>


  <div class="py-4">
    <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('kuota')">
      <div>
        <h3 class="font-semibold text-gray-700 font-telkomsel">Kuota</h3>
      </div>
      <svg id="arrow-kuota" class="w-5 h-5 text-red-500 transform rotate-180 transition-transform"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>
    <div id="content-kuota" class="mt-4" style="display: block;"> <!-- Default terbuka -->
      <p class="text-sm text-gray-500 mb-4">Anda Dapat Memilih Produk Berdasarkan Kuota Internet</p>
      <div class="space-y-2">
      @foreach($kuota as $kuo)
      <label class="flex items-center space-x-2">
      <input type="checkbox" name="kuota[]" class="form-checkbox h-5 w-5 text-red-500 rounded "
        value="{{ $kuo->kuota === null ? 'Unlimited' : $kuo->kuota }}">
      <span class="text-gray-700 font-telkomsel">{{ $kuo->kuota === null ? 'Unlimited' : $kuo->kuota . ' GB' }}</span>
      </label>
    @endforeach
      </div>
    </div>
  </div>

</div>

<!-- Custom Script untuk range slider -->
<script>
  const rangeMin = document.getElementById('range-min');
  const rangeMax = document.getElementById('range-max');
  const labelMin = document.getElementById('label-min');
  const labelMax = document.getElementById('label-max');
  const track = document.getElementById('range-track');
  const MIN_GAP = 50000; // Jarak minimal antara kedua slider

  function updateRange() {
    let minValue = parseInt(rangeMin.value);
    let maxValue = parseInt(rangeMax.value);

    // Ensure that minValue is not greater than maxValue - MIN_GAP
    if (minValue >= maxValue - MIN_GAP) {
      rangeMin.value = maxValue - MIN_GAP; // Berikan jarak minimum
    }

    // Ensure that maxValue is not less than minValue + MIN_GAP
    if (maxValue <= minValue + MIN_GAP) {
      rangeMax.value = minValue + MIN_GAP; // Berikan jarak minimum
    }

    // Update labels
    labelMin.textContent = `Rp ${minValue.toLocaleString('id-ID')}`;
    labelMax.textContent = `Rp ${maxValue.toLocaleString('id-ID')}`;

    // Adjust track style to show progress between min and max
    const minPercent = (minValue / rangeMin.max) * 100;
    const maxPercent = (maxValue / rangeMax.max) * 100;

    track.style.left = `${minPercent}%`;
    track.style.width = `${maxPercent - minPercent}%`;
  }

  // Fungsi untuk toggle accordion
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
  updateRange();
</script>

<!-- CSS Custom untuk Styling Range Slider -->
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
    /* Ukuran dot slider lebih kecil */
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
    /* Ukuran dot slider lebih kecil */
    height: 16px;
    background: red;
    border-radius: 50%;
    cursor: pointer;
    pointer-events: all;
    position: relative;
    z-index: 1;
  }

  #range-track {
    background-color: red;
    height: 5px;
    /* Ukuran sama dengan background track */
    border-radius: 5px;
    position: absolute;
    z-index: 0;
  }
</style>