<!-- Content Wrapper -->
<div class="container mx-auto p-6 rounded-lg bg-white">
  <!-- Header Section -->
  <div class="container mx-auto p-6 bg-gray-50 rounded-lg bg-white mb-[-20]">
    <h1 class="text-3xl font-bold text-gray-800 text-left ml-6 font-telkomsel mt-20">Foto Kegiatan PT Abrisam Bintan
      Indonesia</h1>
    <p class="ml-6">Kami membangun tim sales force yang unggul melalui pengembangan individu dan kolaborasi...</p>
  </div>

  <!-- Carousel Wrapper -->
  <div id="gallery" class="relative w-full p-10" data-carousel="slide">
    <!-- Carousel Wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
      <!-- Carousel Items -->
      <div class="flex transition-transform duration-700 ease-in-out" id="carousel-inner">
        @foreach ($kegiatan as $index => $item)
      <div class="w-full flex-shrink-0 h-56 md:h-96">
        <img src="{{ asset('uploads/kegiatan/' . $item->gambar) }}" class="w-full h-full object-cover"
        alt="Gambar Kegiatan">
      </div>
    @endforeach
      </div>
    </div>

    <!-- Slider Controls -->
    <button type="button"
      class="absolute top-1/2 left-10 z-30 flex items-center justify-center h-10 w-10 transform -translate-y-1/2 px-4 cursor-pointer group focus:outline-none"
      id="prev-button">
      <span
        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 17 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10.5 1l-6 4.5 6 4.5"></path>
        </svg>
      </span>
    </button>
    <button type="button"
      class="absolute top-1/2 right-10 z-30 flex items-center justify-center h-10 w-10 transform -translate-y-1/2 px-4 cursor-pointer group focus:outline-none"
      id="next-button">
      <span
        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 17 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6.5 1l6 4.5-6 4.5"></path>
        </svg>
      </span>
    </button>
  </div>
  <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-10">
    @foreach ($kegiatan as $index => $item)
    <div>
      <img class="h-56 w-full rounded-lg" src="{{ asset('uploads/kegiatan/' . $item->gambar) }}" alt="">
    </div>
  @endforeach
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const carouselInner = document.getElementById("carousel-inner");
    const prevButton = document.getElementById("prev-button");
    const nextButton = document.getElementById("next-button");
    const items = document.querySelectorAll("#carousel-inner > div");
    let currentIndex = 0;

    // Function to go to the next item
    function goToNext() {
      if (currentIndex < items.length - 1) {
        currentIndex++;
      } else {
        currentIndex = 0; // Loop back to the first item
      }
      updateCarousel();
    }

    // Function to go to the previous item
    function goToPrev() {
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = items.length - 1; // Loop back to the last item
      }
      updateCarousel();
    }

    // Update the carousel slide
    function updateCarousel() {
      const offset = -currentIndex * 100; // 100% slide per item
      carouselInner.style.transform = `translateX(${offset}%)`;
    }

    // Event listeners for buttons
    nextButton.addEventListener("click", goToNext);
    prevButton.addEventListener("click", goToPrev);

  });

</script>