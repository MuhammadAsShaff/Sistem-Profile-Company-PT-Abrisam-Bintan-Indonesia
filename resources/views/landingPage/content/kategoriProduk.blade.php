<section class="bg-white">
  <div class="container mx-auto px-4 relative">
    <div class="flex justify-center items-center mt-12 mb-6">
      <h2 class="text-3xl font-telkomsel font-bold text-gray-800 text-center px-4">
        Produk Yang Ada Di PT Abrisam Bintan Indonesia
      </h2>
    </div>

    <div class="produk-carousel-container overflow-hidden relative">
      <div id="produk-carousel" class="flex transition-transform duration-500 ease-in-out">
        @foreach($kategori as $index => $item)
          <div class="produk-card flex-shrink-0 w-full sm:w-1/2 md:w-1/3 px-6 mb-6">
            <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 flex flex-col h-full">
              <div class="flex items-start sm:items-center space-x-4 sm:space-x-6 mb-4">
                <img alt="{{ $item->nama_kategori }}" class="w-20 h-20 sm:w-32 sm:h-32 object-cover rounded-lg"
                  src="{{ asset('uploads/kategori/' . $item->gambar_kategori) }}" />
                <div>
                  <h3 class="text-xl sm:text-2xl font-bold font-telkomsel text-red-600 mb-1 sm:mb-2">
                    {{ $item->nama_kategori }}
                  </h3>
                  <p class="text-gray-600 text-sm sm:text-base mb-2">
                    {{ Str::limit($item->deskripsi, 100) }}
                  </p>
                </div>
              </div>
              @php
  $syaratKetentuan = is_string($item->syarat_ketentuan)
    ? json_decode($item->syarat_ketentuan, true)
    : $item->syarat_ketentuan;
              @endphp
              @if(!empty($syaratKetentuan) && is_array($syaratKetentuan))
                <div class="mt-auto">
                  <h4 class="font-bold text-sm sm:text-lg font-telkomsel mb-1 sm:mb-2">Syarat dan Ketentuan:</h4>
                  <ul class="list-disc pl-4 space-y-1 text-xs sm:text-sm text-gray-700">
                    @foreach(array_slice($syaratKetentuan, 0, 2) as $syarat)
                      <li>{{ $syarat }}</li>
                    @endforeach
                  </ul>
                  @if(count($syaratKetentuan) > 2)
                    @include('landingPage.content.modalSelengkapnyaProduk')
                  @endif
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <!-- Tombol Navigasi -->
      <button type="button"
        class="absolute top-1/2 left-4 lg:left-12 transform -translate-y-1/2 z-5 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl"
        id="prevProdukBtn">
        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>
      
      <!-- Tombol Navigasi Next -->
      <button type="button"
        class="absolute top-1/2 right-4 lg:right-12 transform -translate-y-1/2 z-5 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl"
        id="nextProdukBtn">
        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

    </div>

  </div>
</section>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('produk-carousel');
    const prevBtn = document.getElementById('prevProdukBtn');
    const nextBtn = document.getElementById('nextProdukBtn');
    const cards = document.querySelectorAll('.produk-card');

    let currentIndex = 0;
    let cardsPerView = 3;

    function getCardWidth() {
      return cards[0].getBoundingClientRect().width +
        parseFloat(window.getComputedStyle(cards[0]).marginLeft) +
        parseFloat(window.getComputedStyle(cards[0]).marginRight);
    }

    function updateCardsPerView() {
      const windowWidth = window.innerWidth;
      if (windowWidth < 640) {
        cardsPerView = 1;
      } else if (windowWidth < 768) {
        cardsPerView = 2;
      } else {
        cardsPerView = 3;
      }
    }

    function updateCarousel() {
      const cardWidth = getCardWidth();
      const offset = -currentIndex * cardWidth;
      carousel.style.transform = `translateX(${offset}px)`;
    }

    function navigateNext() {
      const maxIndex = cards.length - cardsPerView;
      if (currentIndex < maxIndex) {
        currentIndex++;
        updateCarousel();
      }
    }

    function navigatePrev() {
      if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
      }
    }

    nextBtn.addEventListener('click', navigateNext);
    prevBtn.addEventListener('click', navigatePrev);

    window.addEventListener('resize', () => {
      updateCardsPerView();
      updateCarousel();
    });

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

      if (Math.abs(diffX) > 50) {
        if (diffX > 0) {
          navigateNext();
        } else {
          navigatePrev();
        }
      }
    });

    updateCardsPerView();
    updateCarousel();
  });

  function goToSlide(index) {
      currentIndex = index;
      updateCarousel();
    }

    // Update the updateCarousel function to highlight the active indicator
    function updateCarousel() {
      const cardWidth = getCardWidth();
      const offset = -currentIndex * cardWidth;
      carousel.style.transform = `translateX(${offset}px)`;

      // Update indicators
      const indicators = document.querySelectorAll('.flex.justify-center .bg-gray-400');
      indicators.forEach((indicator, idx) => {
        indicator.classList.toggle('bg-red-600', idx === currentIndex);
        indicator.classList.toggle('bg-gray-400', idx !== currentIndex);
      });
    }
</script>