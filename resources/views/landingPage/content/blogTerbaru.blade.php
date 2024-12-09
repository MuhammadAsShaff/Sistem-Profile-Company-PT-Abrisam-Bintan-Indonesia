<section class="bg-white py-12">
  <div class="container mx-auto px-4 relative">
    <div class="flex justify-center items-center mb-8">
      <h2 class="text-3xl font-telkomsel font-bold text-gray-800">Blog Terbaru</h2>
    </div>

    <div class="blog-carousel-container overflow-hidden relative">
      <div id="blog-carousel" class="flex transition-transform duration-500 ease-in-out">
        @foreach($blogs as $blog)
      <div class="blog-card flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
        <a href="{{ route('isiBlog', ['slug' => $blog->slug]) }}"
        class="block bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="relative h-48 overflow-hidden">
          @if($blog->gambar_cover)
        <img src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="{{ $blog->judul_blog }}"
        class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-300">
      @else
      <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
      Tidak ada gambar
      </div>
    @endif
          <div class="absolute ml-4 top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
          {{ strtoupper($blog->kategori) }}
          </div>
        </div>

        <div class="p-5">
          <h3 class="text-lg font-bold mb-2 text-gray-800 line-clamp-2">
          {{ $blog->judul_blog }}
          </h3>
          <p class="text-gray-600 text-sm mb-4 line-clamp-3">
          {{ Str::limit(strip_tags($blog->isi_blog), 100) }}
          </p>
          <div class="flex justify-between items-center">
          <span class="text-xs text-gray-500">
            {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
          </span>
          <span class="text-red-500 hover:underline text-sm">
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
    <div class="absolute top-1/2 transform -translate-y-1/2 w-full flex justify-between">
      <button id="prevBlogBtn" class="bg-white shadow-md rounded-full p-2 z-10 -ml-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button id="nextBlogBtn" class="bg-white shadow-md rounded-full p-2 z-10 -mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <div class="container mx-auto px-4">
      <a href="{{ route('tampilBlog') }}" class="text-red-500 hover:underline hover:text-red-600 flex items-center">
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
        updateCarousel();
      }
    }

    // Navigasi Previous
    function navigatePrev() {
      if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
      }
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

<style>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  #blog-carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
    will-change: transform;
  }

  .blog-card {
    flex-shrink: 0;
    margin-right: 12px;
    margin-left: 12px;
  }
</style>