<div class="w-full md:w-full bg-white shadow-lg rounded-lg p-10 mt-32 ml-8">
  <!-- Filter Header -->
  <div class="flex justify-between items-center pb-4 border-b">
    <h2 class="font-semibold text-lg flex items-center">
      <svg class="inline w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 4a1 1 0 00-1 1v3a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1H3zM4 8v2a2 2 0 002 2h12a2 2 0 002-2V8H4zm-1 6h16m-7 6v-6m-2 6v-6" />
      </svg>
      Filter
    </h2>
    <button class="text-red-500 focus:outline-none">Reset</button>
  </div>

  <!-- Filter Section: Harga (Accordion) -->
  <div class="py-4 border-b">
    <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('harga')">
      <h3 class="font-semibold text-gray-700">Harga</h3>
      <svg id="arrow-harga" class="w-5 h-5 text-red-500 transform transition-transform"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>
    <div id="content-harga" class="mt-4">
      <p class="text-sm text-gray-500">Geser untuk menentukan kisaran harga minimum dan maksimum</p>
      <input type="range" min="0" max="1000000" value="500000"
        class="w-full h-2 bg-red-200 rounded-lg cursor-pointer mt-4">
      <div class="flex justify-between text-sm mt-2">
        <span>Rp 0</span>
        <span>Rp 1.000.000</span>
      </div>
      <div class="mt-2 flex justify-between text-sm">
        <span>Mulai <br> <b>Rp 0</b></span>
        <span>Hingga <br> <b>Rp 1.000.000</b></span>
      </div>
    </div>
  </div>

  <!-- Filter Section: Kecepatan (Accordion) -->
  <div class="py-4">
    <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('kecepatan')">
      <h3 class="font-semibold text-gray-700">Kecepatan</h3>
      <svg id="arrow-kecepatan" class="w-5 h-5 text-red-500 transform transition-transform"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>
    <div id="content-kecepatan" class="mt-4">
      <div class="space-y-2">
        <label class="flex items-center space-x-2">
          <input type="checkbox" class="form-checkbox h-5 w-5 text-red-500 rounded">
          <span class="text-gray-700">30 Mbps</span>
        </label>
        <label class="flex items-center space-x-2">
          <input type="checkbox" class="form-checkbox h-5 w-5 text-red-500 rounded" checked>
          <span class="text-gray-700">50 Mbps</span>
        </label>
        <label class="flex items-center space-x-2">
          <input type="checkbox" class="form-checkbox h-5 w-5 text-red-500 rounded" checked>
          <span class="text-gray-700">100 Mbps</span>
        </label>
        <label class="flex items-center space-x-2">
          <input type="checkbox" class="form-checkbox h-5 w-5 text-red-500 rounded" checked>
          <span class="text-gray-700">300 Mbps</span>
        </label>
      </div>
    </div>
  </div>
</div>

<script>
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
</script>