<section class="bg-white ">
  <div class="container mx-auto px-4 relative">
    <div class="flex justify-center items-center mb-8">
      <h2 class="text-3xl font-telkomsel font-bold text-gray-800">Blog Terbaru</h2>
    </div>

    <div class="blog-carousel-container overflow-hidden relative">
      <div id="blog-carousel" class="flex transition-transform duration-500 ease-in-out">
        @foreach($blogs as $blog)
        <div class="blog-card flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-6 mb-6">
        <a href="{{ route('isiBlog', ['slug' => $blog->slug]) }}"
        class="block bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="relative h-64 overflow-hidden">
          @if($blog->gambar_cover)
        <img src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="{{ $blog->judul_blog }}"
        class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-300">
        @else
        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
        Tidak ada gambar
        </div>
      @endif
        </div>

        <div class="p-5">
          <h3 class="text-red-500 text-xs font-bold uppercase font-telkomsel">{{ strtoupper($blog->kategori) }}</h3>
          <h3 class="text-lg font-telkomsel font-bold mb-2 text-gray-800 line-clamp-2">
          {{ Str::limit(strip_tags($blog->judul_blog), 40) }}
          </h3>
          <p class="text-gray-600 text-sm mb-4 line-clamp-3">
          {{ Str::limit(str_replace(['&nbsp;', '&#160;'], ' ', strip_tags($blog->isi_blog)), 40) }}
          </p>
          <div class="flex justify-between items-center">
          <span class="text-xs text-gray-500">
          {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
          </span>
          <span class="text-red-500 font-telkomsel hover:underline text-sm">
          Baca Selengkapnya
          </span>
          </div>
        </div>
        </a>
        </div>
    @endforeach
      </div>
    </div>

    <!-- Navigasi Carousel -->
    <button type="button"
      class="absolute top-1/2 left-4 lg:left-18 transform -translate-y-1/2 z-5 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl"
      id="prevBlogBtn">
      <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 19l-7-7 7-7"></path>
      </svg>
    </button>
    
    <!-- Tombol Navigasi Next -->
    <button type="button"
      class="absolute top-1/2 right-4 lg:right-18 transform -translate-y-1/2 z-5 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl"
      id="nextBlogBtn">
      <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7"></path>
      </svg>
    </button>

    <div class="container mx-auto px-4">
      <a href="{{ route('tampilBlog') }}"
        class="text-red-500 hover:underline hover:text-red-600 flex items-center font-telkomsel">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
            clip-rule="evenodd" />
        </svg>
        Lihat Semua Blog
      </a>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('blog-carousel');
    const prevBtn = document.getElementById('prevBlogBtn');
    const nextBtn = document.getElementById('nextBlogBtn');
    const cards = document.querySelectorAll('.blog-card');

    let currentIndex = 0;
    let cardsPerView = 3;

    // Fungsi untuk mendapatkan lebar card
    function getCardWidth() {
      return cards[0].getBoundingClientRect().width +
        parseFloat(window.getComputedStyle(cards[0]).marginLeft) +
        parseFloat(window.getComputedStyle(cards[0]).marginRight);
    }

    // Fungsi update cards per view
    function updateCardsPerView() {
      const windowWidth = window.innerWidth;
      if (windowWidth < 768) {
        cardsPerView = 1;
      } else if (windowWidth < 1024) {
        cardsPerView = 2;
      } else {
        cardsPerView = 3;
      }
    }

    // Fungsi update carousel
    function updateCarousel() {
      const cardWidth = getCardWidth();
      const offset = -currentIndex * cardWidth;
      carousel.style.transform = `translateX(${offset}px)`;
    }

    // Navigasi Next
    function navigateNext() {
      const maxIndex = cards.length - cardsPerView;
      if (currentIndex < maxIndex) {
        currentIndex++;
      } else {
        currentIndex = 0; // Loop back to the start
      }
      updateCarousel();
    }

    // Navigasi Previous
    function navigatePrev() {
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = cards.length - cardsPerView; // Loop back to the end
      }
      updateCarousel();
    }

    // Event Listeners
    nextBtn.addEventListener('click', navigateNext);
    prevBtn.addEventListener('click', navigatePrev);

    // Resize Handler
    window.addEventListener('resize', () => {
      updateCardsPerView();
      updateCarousel();
    });

    // Touch/Swipe Support
    let touchStartX = 0;
    let touchEndX = 0;

    carousel.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].clientX;
    });

    carousel.addEventListener('touchmove', (e) => {
      touchEndX = e.touches[0].clientX;
    });

    carousel.addEventListener('touchend', () => {
      const diffX = touchStartX - touchEndX;

      if (Math.abs(diffX) > 50) {  // Minimal swipe jarak 50px
        if (diffX > 0) {
          navigateNext();
        } else {
          navigatePrev();
        }
      }
    });

    // Initial Setup
    updateCardsPerView();
    updateCarousel();
  });
</script>