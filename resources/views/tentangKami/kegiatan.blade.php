<div class="container mx-auto p-6 rounded-lg bg-white">
  <!-- Header Section -->
  <div class="container mx-auto p-6 bg-gray-50 rounded-lg bg-white mb-[-20]">
    <h1 class="text-3xl font-bold text-gray-800 text-left ml-6 font-telkomsel mt-20">Foto Kegiatan PT Abrisam Bintan
      Indonesia</h1>
    <p class="ml-6">Kami membangun tim sales force yang unggul melalui pengembangan individu dan kolaborasi antar
      departemen. Berikut adalah dokumentasi foto kegiatan kami yang mencerminkan semangat dan kerja keras dalam
      mencapainya. Setiap kegiatan yang kami lakukan bertujuan untuk menciptakan atmosfer yang mendukung pertumbuhan
      pribadi dan profesional bagi seluruh anggota tim kami.</p>
  </div>


  <!-- Carousel Wrapper -->
  <div id="gallery" class="relative w-full px-12 py-0" data-carousel="slide">
    <!-- Carousel Wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
      <!-- Carousel Items -->
      <div class="flex transition-transform duration-1000 ease-in-out" id="carousel-inner">
        @foreach ($kegiatan as $index => $item)
      <div class="carousel-item w-full flex-shrink-0 h-56 md:h-96 relative">
        <!-- Gambar -->
        <img src="{{ asset('uploads/kegiatan/' . $item->gambar) }}" class="w-full h-full object-cover"
        alt="Gambar Kegiatan">
        <!-- Overlay hitam dan teks -->
        <div
        class="overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 flex items-center justify-center text-white transition-all duration-300 ease-in-out">
        <div class="text-center px-4 py-2">
          <h3 class="text-xl font-semibold">{{ $item->nama }}</h3>
          <p class="mt-2">{{ $item->keterangan }}</p>
        </div>
        </div>
      </div>
    @endforeach
      </div>
    </div>

    <!-- Slider Controls -->
    <button type="button"
      class="absolute top-1/2 left-10 z-30 flex items-center justify-center h-10 w-10 transform -translate-y-1/2 px-6 cursor-pointer group focus:outline-none"
      id="prev-btn">
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
      class="absolute top-1/2 right-10 z-30 flex items-center justify-center h-10 w-10 transform -translate-y-1/2 px-6 cursor-pointer group focus:outline-none"
      id="next-btn">
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

  <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-10 ">
    @foreach ($kegiatan->take(3) as $index => $item) <!-- Ambil hanya 3 gambar pertama -->
    <div class="relative group">
      <img id="kegiatan" class="h-56 w-full rounded-lg" src="{{ asset('uploads/kegiatan/' . $item->gambar) }}" alt="">
      <!-- Overlay hitam dan teks -->
      <div
      class="overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 flex items-center justify-center text-white transition-all duration-300 ease-in-out">
      <div class="text-center px-4 py-2">
      <h3 class="text-xl font-semibold">{{ $item->nama }}</h3>
      <p class="mt-2">{{ $item->keterangan }}</p>
      </div>
      </div>
    </div>
    @endforeach
  </div>

  <style>
    .carousel-item {
      position: relative;
    }

    .carousel-item img {
      transition: opacity 0.3s ease-in-out;
    }

    .carousel-item .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      /* Overlay hitam dengan transparansi */
      opacity: 0;
      /* Sembunyikan overlay secara default */
      display: flex;
      justify-content: center;
      align-items: center;
      transition: opacity 0.3s ease-in-out;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      /* Overlay hitam dengan transparansi */
      opacity: 0;
      /* Sembunyikan overlay secara default */
      display: flex;
      justify-content: center;
      align-items: center;
      transition: opacity 0.3s ease-in-out;
      /* Transisi untuk overlay */
    }

    .group:hover .overlay {
      opacity: 1;
      /* Overlay muncul ketika hover pada parent */
    }

    /* Animasi overlay */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      /* Overlay hitam dengan transparansi */
      opacity: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: opacity 0.3s ease-in-out;
    }

    .group:hover .overlay {
      opacity: 1;
      /* Overlay muncul ketika hover pada parent */
    }
  </style>

</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      // Ambil elemen dengan ID kegiatan
      const kegiatanImg = document.getElementById('kegiatan');

      // Daftar gambar yang ingin diganti (diambil dari Blade)
      const gambarList = @json($kegiatan->pluck('gambar')); // Ambil nama gambar dari Blade

      let currentIndex = 0;
      const totalImages = gambarList.length;

      // Fungsi untuk mengganti gambar
      function changeImage() {
        if (kegiatanImg) {
          // Hitung indeks gambar berikutnya
          const nextIndex = (currentIndex + 1) % totalImages;

          // Update atribut src elemen gambar
          kegiatanImg.src = `{{ asset('uploads/kegiatan/') }}/${gambarList[nextIndex]}`;

          // Update indeks saat ini
          currentIndex = nextIndex;
        }
      }

      // Panggil fungsi changeImage setiap 5 detik
      setInterval(changeImage, 5000);
    });


  document.addEventListener("DOMContentLoaded", function () {
    const carouselItems = document.querySelectorAll('.carousel-item'); // Ambil semua item carousel

    carouselItems.forEach(item => {
      const image = item.querySelector('img'); // Ambil gambar
      const overlay = item.querySelector('.overlay'); // Ambil overlay

      // Event listener ketika mouse mendekat
      item.addEventListener('mouseenter', () => {
        overlay.style.opacity = 1; // Menampilkan overlay saat hover
      });

      // Event listener ketika mouse meninggalkan
      item.addEventListener('mouseleave', () => {
        overlay.style.opacity = 0; // Menyembunyikan overlay saat keluar
      });
    });
  });


  document.addEventListener('DOMContentLoaded', function () {
    const carouselInner = document.getElementById('carousel-inner');
    const slides = carouselInner.children;
    const prevButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');
    const totalSlides = slides.length;
    const slideWidth = carouselInner.clientWidth; // Slide width + gap value
    let currentIndex = 0; // Start from the first actual slide

    // Clone first and last items to create the infinite effect
    const firstClone = slides[0].cloneNode(true);
    const lastClone = slides[slides.length - 1].cloneNode(true);
    carouselInner.appendChild(firstClone); // Add the first item at the end
    carouselInner.insertBefore(lastClone, slides[0]); // Add the last item at the beginning

    // Set the initial position to show the first image correctly (not clone)
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

    // Stop autoplay on user interaction (prev/next buttons)
    function stopAutoplay() {
      clearInterval(autoplayTimer);
      autoplayTimer = setInterval(autoplay, autoplayInterval); // Restart autoplay
    }

    // Update Carousel Function
    function updateCarousel(index) {
      carouselInner.style.transition = 'transform 1s ease-in-out';
      carouselInner.style.transform = `translateX(-${index * slideWidth}px)`;

      // If the first or last image clone is reached, reset to real slide position
      if (index === slides.length - 1) {
        setTimeout(() => {
          carouselInner.style.transition = 'none'; // Remove transition
          currentIndex = 1; // Skip to the first actual slide
          carouselInner.style.transform = `translateX(-${currentIndex * slideWidth}px)`; // Move to first
        }, 1000);
      } else if (index === 0) {
        setTimeout(() => {
          carouselInner.style.transition = 'none'; // Remove transition
          currentIndex = slides.length - 2; // Skip to the last actual slide
          carouselInner.style.transform = `translateX(-${currentIndex * slideWidth}px)`; // Move to last
        }, 1000);
      }
    }

    // Next Slide Function (move right, index increases)
    nextButton.addEventListener('click', () => {
      currentIndex++;
      updateCarousel(currentIndex);
      stopAutoplay(); // Stop autoplay when user interacts
    });

    // Previous Slide Function (move left, index decreases)
    prevButton.addEventListener('click', () => {
      currentIndex--;
      updateCarousel(currentIndex);
      stopAutoplay(); // Stop autoplay when user interacts
    });

    // Initialize Carousel
    updateCarousel(currentIndex);
  });


</script>