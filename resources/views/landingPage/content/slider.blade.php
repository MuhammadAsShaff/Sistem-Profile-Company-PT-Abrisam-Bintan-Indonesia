<!-- Carousel Container -->
<div id="default-carousel"
  class="relative w-full max-w-full mx-auto py-5 px-4 sm:px-8 md:px-16 lg:px-60 bg-white rounded-lg overflow-hidden h-auto md:h-[50vh] lg:h-[66vh]"
  data-carousel="slide">

  <!-- Carousel Wrapper -->
  <div id="carousel-inner"
    class="relative flex items-center space-x-5 transition-transform duration-1000 ease-in-out hide-scrollbar"
    style="transform: translateX(0);">

    @if (count($promos) > 0)
    <!-- Duplicate Last Slide at the Beginning for Infinite Loop Effect -->
    <div class="min-w-full flex-shrink-0 h-[20vh] md:h-[50vh] lg:h-[60vh] w-full overflow-hidden rounded-lg p-3">
      <img src="{{ asset('uploads/promos/' . $promos[count($promos) - 1]->gambar_promo) }}"
      class="w-full h-full object-cover rounded-lg" alt="Duplicate Last Slide">
    </div>                                                                                                                                                                             

    <!-- Original Slides -->
    @foreach($promos as $key => $promo)
    <div class="min-w-full flex-shrink-0 h-[20vh] md:h-[50vh] lg:h-[60vh] w-full overflow-hidden rounded-lg p-3">
      <img src="{{ asset('uploads/promos/' . $promo->gambar_promo) }}" class="w-full h-full object-cover rounded-lg"
      alt="{{ $promo->nama_promo }}">
    </div>
    @endforeach

    <!-- Duplicate First Slide at the End for Infinite Loop Effect -->
    <div class="min-w-full flex-shrink-0 h-[20vh] md:h-[50vh] lg:h-[60vh] w-full overflow-hidden rounded-lg p-3">
      <img src="{{ asset('uploads/promos/' . $promos[0]->gambar_promo) }}" class="w-full h-full object-cover rounded-lg"
      alt="Duplicate First Slide">
    </div>
    @endif
  </div>

<!-- Slider Indicators -->
<div class="absolute z-10 bottom-5 lg:bottom-3 left-1/2 flex space-x-2 transform -translate-x-1/2"
  style="margin-top: 50px;">
  @foreach($promos as $key => $promo)
  <button type="button"
  class="w-10 h-1 lg:h-[1vh] md:w-10 md:h-1 rounded-full bg-gray-300 hover:bg-[#D30E4C] transition duration-300 indicator"
  data-slide-to="{{ $key }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
  aria-label="Slide {{ $key + 1 }}"></button>
  @endforeach
</div>


 <!-- Tombol Prev -->
<button type="button"
  class="absolute top-1/2 left-[5%] lg:left-[12%] transform -translate-y-1/2 z-5 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl"
  id="prev-btn">
  <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
    xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 19l-7-7 7-7"></path>
  </svg>
</button>

<!-- Tombol Next -->
<button type="button"
  class="absolute top-1/2 right-[5%] lg:right-[12%] transform -translate-y-1/2 z-5 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl"
  id="next-btn">
  <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
    xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7"></path>
  </svg>
</button>


</div>

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

    // Autoplay interval (in milliseconds)
    const autoplayInterval = 3000; // 3 seconds

    // Function to move to the next slide automatically (right to left)
    function autoplay() {
      currentIndex++; // Increment the index to move right (from right to left)
      updateCarousel(currentIndex);
    }

    // Start autoplay
    let autoplayTimer = setInterval(autoplay, autoplayInterval);

    // Stop autoplay on user interaction (prev/next buttons or indicators)
    function stopAutoplay() {
      clearInterval(autoplayTimer);
      autoplayTimer = setInterval(autoplay, autoplayInterval); // Restart autoplay
    }

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
        indicator.classList.toggle('bg-[#001A41]', i === (index - 1 + visibleSlides) % visibleSlides);
        indicator.classList.toggle('bg-gray-300', i !== (index - 1 + visibleSlides) % visibleSlides);
      });
    }

    // Next Slide Function (move left, index increases)
    nextButton.addEventListener('click', () => {
      currentIndex++;
      updateCarousel(currentIndex);
      stopAutoplay(); // Stop autoplay when user interacts
    });

    // Previous Slide Function (move right, index decreases)
    prevButton.addEventListener('click', () => {
      currentIndex--;
      updateCarousel(currentIndex);
      stopAutoplay(); // Stop autoplay when user interacts
    });

    // Indicator Click Function
    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        currentIndex = index + 1;
        updateCarousel(currentIndex);
        stopAutoplay(); // Stop autoplay when user interacts
      });
    });

    // Initialize Carousel
    updateCarousel(currentIndex);
  });
</script>