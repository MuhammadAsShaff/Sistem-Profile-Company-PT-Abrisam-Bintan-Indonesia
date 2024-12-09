<section class="bg-white">
  <div class="relative flex">
    <div class="min-h-screen lg:w-2/3"></div>
    <div class="hidden w-3/4 min-h-screen lg:block"></div>

    <!-- Bagian Container yang akan ngeslide -->
    <div class="container flex flex-col justify-center w-full px-6 py-10 mx-auto lg:absolute lg:inset-x-0">
      <h1
        class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white text-center font-telkomsel">
        Produk Yang Kami Sediakan
      </h1>

      <!-- Wrapper Produk -->
      <div id="produk-wrapper" class="relative mt-10 flex items-center p-10 bg-gray-100 rounded-3xl">
        <div class="flex items-center space-x-6">
          <img id="produk-gambar" class="object-cover object-center w-82 lg:w-[8rem] rounded-lg h-48 lg:h-[12rem]"
            src="" alt="Produk">

          <div>
            <h1 id="produk-nama" class="text-xl font-semibold text-gray-800 lg:w-72">
              Nama Produk
            </h1>
            <p id="produk-deskripsi" class="max-w-lg mt-6 text-gray-500">
              Deskripsi Produk
            </p>
            <div id="syarat-ketentuan" class="mt-4"></div>
          </div>
        </div>
      </div>

      <!-- Navigasi -->
      <div class="flex items-center justify-center mt-8 space-x-4">
        <button id="prevBtn" class="p-2 bg-white rounded-full w-10 h-10 flex items-center justify-center 
                       focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            stroke-width="4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <!-- Indikator Slide -->
        <div id="slide-indicators" class="flex space-x-2">
          <!-- Indikator akan dihasilkan secara dinamis -->
        </div>

        <button id="nextBtn" class="p-2 bg-white rounded-full w-10 h-10 flex items-center justify-center 
                       focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            stroke-width="4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>

<script>
  // Data produk generated from PHP
  const produkData = [
    <?php foreach ($kategori as $produk): ?>
  {
      gambar_kategori: "<?= $produk->gambar_kategori ?>",
      nama_kategori: "<?= $produk->nama_kategori ?>",
      deskripsi: "<?= $produk->deskripsi ?>",
      syarat_ketentuan: <?= $produk->syarat_ketentuan ?> // Pastikan ini adalah JSON valid
    },
    <?php endforeach; ?>
  ];

  let currentIndex = 0;
  const slideIndicators = document.getElementById('slide-indicators');

  function buatIndikator() {
    slideIndicators.innerHTML = ''; // Bersihkan indikator sebelumnya
    produkData.forEach((_, index) => {
      const indicator = document.createElement('button');
      indicator.classList.add(
        'w-3', 'h-3', 'rounded-full',
        index === currentIndex ? 'bg-red-500' : 'bg-gray-300'
      );
      indicator.addEventListener('click', () => {
        currentIndex = index;
        tampilkanProduk(currentIndex);
      });
      slideIndicators.appendChild(indicator);
    });
  }

  function tampilkanProduk(index) {
    const produk = produkData[index];

    // Tampilkan gambar, nama, dan deskripsi
    document.getElementById('produk-gambar').src = "/uploads/kategori/" + produk.gambar_kategori;
    document.getElementById('produk-nama').textContent = produk.nama_kategori;
    document.getElementById('produk-deskripsi').textContent = produk.deskripsi;

    // Tampilkan syarat & ketentuan
    const syaratKetentuan = JSON.parse(produk.syarat_ketentuan);
    const syaratKetetuanContainer = document.getElementById('syarat-ketentuan');

    // Bersihkan kontainer sebelumnya
    syaratKetetuanContainer.innerHTML = '';

    // Tambahkan syarat & ketentuan dengan nomor urut
    syaratKetentuan.forEach((syarat, idx) => {
      const syaratItem = document.createElement('div');
      syaratItem.classList.add('flex', 'items-start', 'mb-2');

      syaratItem.innerHTML = `
      <span class="mr-2 font-bold text-red-500">${idx + 1}.</span>
      <p class="text-gray-600">${syarat}</p>
    `;

      syaratKetetuanContainer.appendChild(syaratItem);
    });

    // Update indikator
    buatIndikator();
  }

  // Tombol navigasi
  document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % produkData.length;
    tampilkanProduk(currentIndex);
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + produkData.length) % produkData.length;
    tampilkanProduk(currentIndex);
  });

  // Tampilkan produk pertama saat halaman dimuat
  tampilkanProduk(currentIndex);
  buatIndikator();

  // Geser otomatis setiap 5 detik
  setInterval(() => {
    currentIndex = (currentIndex + 1) % produkData.length;
    tampilkanProduk(currentIndex);
  }, 5000);
</script>