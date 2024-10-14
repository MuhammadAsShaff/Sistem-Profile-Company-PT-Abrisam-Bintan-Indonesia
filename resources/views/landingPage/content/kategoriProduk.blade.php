<section class="bg-white">
  <div class="relative flex ">
    <div class="min-h-screen lg:w-2/3"></div>
    <div class="hidden w-3/4 min-h-screen lg:block"></div>

    <!-- Bagian Container yang akan ngeslide -->
    <div class="container flex flex-col justify-center w-full min-h-screen px-6 py-10 mx-auto lg:absolute lg:inset-x-0">
      <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">
        Produk Yang Kami Sediakan
      </h1>

      <!-- Wrapper Produk -->
      <div id="produk-wrapper"
        class="mt-5 lg:mt-10 lg:flex lg:items-center transition-all duration-700 ease-in-out shadow-2xl shadow-gray-400 p-10 bg-white rounded-lg">
        <img id="produk-gambar" class="object-cover object-center w-full lg:w-[32rem] rounded-lg h-96" src=""
          alt="Produk">

        <div class="mt-8 lg:px-10 lg:mt-0">
          <h1 id="produk-nama" class="text-2xl font-semibold text-gray-800 lg:w-72">
            Nama Produk
          </h1>

          <p id="produk-deskripsi" class="max-w-lg mt-6 text-gray-500">
            Deskripsi Produk
          </p>

          <h3 class="mt-6 text-lg font-medium text-red-500">Syarat Dan Ketentuan</h3>
          <p class="text-gray-600">Anda Dapat Berlangganan Sesuai Dengan Syarat Dan Ketentuan</p>
        </div>
      </div>

      <div class="flex items-center justify-between mt-5 lg:justify-center">
        <button id="prevBtn" title="left arrow"
          class="p-2 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" stroke-width="4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <button id="nextBtn" title="right arrow"
          class="p-2 text-black bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center focus:outline-none hover:bg-gray-200 transition duration-300 shadow-xl lg:mx-6">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" stroke-width="4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>

<script>
  // Data produk menggunakan PHP
  const produkData = [
    <?php foreach ($kategori as $produk): ?>
    {
      gambar_kategori: "<?= $produk->gambar_kategori ?>",
      nama_kategori: "<?= $produk->nama_kategori ?>",
      deskripsi: "<?= $produk->deskripsi ?>"
    },
    <?php endforeach; ?>
  ];

  let currentIndex = 0;

  // Fungsi untuk menampilkan produk berdasarkan index
  function tampilkanProduk(index) {
    const produk = produkData[index];
    document.getElementById('produk-gambar').src = "/uploads/kategori/" + produk.gambar_kategori;
    document.getElementById('produk-nama').textContent = produk.nama_kategori;
    document.getElementById('produk-deskripsi').textContent = produk.deskripsi;
  }

  // Tombol navigasi
  document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % produkData.length; // Geser ke produk berikutnya
    tampilkanProduk(currentIndex);
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + produkData.length) % produkData.length; // Geser ke produk sebelumnya
    tampilkanProduk(currentIndex);
  });

  // Tampilkan produk pertama saat halaman dimuat
  tampilkanProduk(currentIndex);

  // Fungsi untuk geser otomatis setiap 5 detik
  setInterval(() => {
    currentIndex = (currentIndex + 1) % produkData.length;
    tampilkanProduk(currentIndex);
  }, 5000); // Interval 5000ms (5 detik)
</script>