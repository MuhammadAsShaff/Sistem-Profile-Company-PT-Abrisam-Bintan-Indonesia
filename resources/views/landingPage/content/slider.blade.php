<!-- Carousel Container -->
<div id="default-carousel" class="relative w-full max-w-7xl mx-auto p-4 bg-white rounded-lg shadow-lg overflow-hidden"
  data-carousel="slide">
  <!-- Carousel Wrapper -->
  <div id="carousel-inner"
    class="relative flex items-center space-x-4 transition-transform duration-1000 ease-in-out hide-scrollbar"
    style="transform: translateX(0);">
    <!-- Duplicate Last Slide at the Beginning for Infinite Loop Effect -->
    <div class="min-w-full flex-shrink-0 h-56 md:h-96 overflow-hidden rounded-lg shadow-md bg-gray-200 p-2">
      <img src="{{ asset('uploads/promos/' . $promos[count($promos) - 1]->gambar_promo) }}"
        class="w-full h-full object-cover rounded-lg" alt="Duplicate Last Slide">
    </div>

    <!-- Original Slides -->
    @foreach($promos as $key => $promo)
    <div class="min-w-full flex-shrink-0 h-56 md:h-96 overflow-hidden rounded-lg shadow-md bg-gray-200 p-2">
      <img src="{{ asset('uploads/promos/' . $promo->gambar_promo) }}" class="w-full h-full object-cover rounded-lg"
      alt="{{ $promo->nama_promo }}">
    </div>
  @endforeach

    <!-- Duplicate First Slide at the End for Infinite Loop Effect -->
    <div class="min-w-full flex-shrink-0 h-56 md:h-96 overflow-hidden rounded-lg shadow-md bg-gray-200 p-2">
      <img src="{{ asset('uploads/promos/' . $promos[0]->gambar_promo) }}" class="w-full h-full object-cover rounded-lg"
        alt="Duplicate First Slide">
    </div>
  </div>

  <!-- Slider indicators -->
  <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
    @foreach($promos as $key => $promo)
    <button type="button" class="w-4 h-4 rounded-full bg-gray-300 hover:bg-white transition duration-300 indicator"
      data-slide-to="{{ $key }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
      aria-label="Slide {{ $key + 1 }}"></button>
  @endforeach
  </div>

  <!-- Slider controls -->
  <button type="button"
    class="absolute top-1/2 left-4 transform -translate-y-1/2 z-30 text-white bg-black/50 rounded-full w-12 h-12 flex items-center justify-center focus:outline-none hover:bg-black/70 transition duration-300"
    id="prev-btn">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
  </button>
  <button type="button"
    class="absolute top-1/2 right-4 transform -translate-y-1/2 z-30 text-white bg-black/50 rounded-full w-12 h-12 flex items-center justify-center focus:outline-none hover:bg-black/70 transition duration-300"
    id="next-btn">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
  </button>
</div>

<!-- JavaScript for Carousel Functionality -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const carouselInner = document.getElementById('carousel-inner');
    const slides = carouselInner.children;
    const prevButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');
    const indicators = document.querySelectorAll('.indicator');
    const totalSlides = slides.length;
    const visibleSlides = totalSlides - 2; // Total original slides (excluding duplicates)
    const slideWidth = carouselInner.clientWidth + 16; // Slide width + gap value
    let currentIndex = 1; // Start from the first actual slide

    // Set initial offset to show the first slide
    carouselInner.style.transform = `translateX(-${slideWidth}px)`;

    // Update Carousel Function
    function updateCarousel(index) {
      carouselInner.style.transition = 'transform 1s ease-in-out';
      carouselInner.style.transform = `translateX(-${index * slideWidth}px)`;

      // Reset position without animation when at clone slides
      if (index === totalSlides - 1) {
        setTimeout(() => {
          carouselInner.style.transition = 'none';
          currentIndex = 1;
          carouselInner.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }, 1000);
      }
      if (index === 0) {
        setTimeout(() => {
          carouselInner.style.transition = 'none';
          currentIndex = visibleSlides;
          carouselInner.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }, 1000);
      }

      // Update indicator active state
      indicators.forEach((indicator, i) => {
        indicator.classList.toggle('bg-white', i === (index - 1 + visibleSlides) % visibleSlides);
        indicator.classList.toggle('bg-gray-300', i !== (index - 1 + visibleSlides) % visibleSlides);
      });
    }

    // Next Slide Function
    nextButton.addEventListener('click', () => {
      currentIndex--; // Decrement index to move to the left
      updateCarousel(currentIndex);
    });

    // Previous Slide Function
    prevButton.addEventListener('click', () => {
      currentIndex++; // Increment index to move to the right
      updateCarousel(currentIndex);
    });

    // Indicator Click Function
    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        currentIndex = index + 1; // Adjust for duplicate first slide
        updateCarousel(currentIndex);
      });
    });

    // Initialize Carousel
    updateCarousel(currentIndex);
  });
</script>

<style>
  /* Custom Scrollbar Hiding */
  .hide-scrollbar::-webkit-scrollbar {
    display: none;
  }

  .hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style>