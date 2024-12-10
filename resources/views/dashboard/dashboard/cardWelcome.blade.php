<div class="flex items-center space-x-4 p-4 bg-white shadow-md rounded-lg shadow">
  <!-- Gambar di sebelah kiri -->
  <div class="w-auto">
    <img src="{{ asset('images/welcomeIlustrasi.png') }}" alt="Welcome Illustration" class="w-48 h-auto rounded-lg">
  </div>

  <!-- Teks di sebelah kanan -->
  <div class="flex-1 text-left ml-4">
    @if ($admin)
    <h5 class=" text-3xl font-bold text-gray-900 dark:text-white">Welcome {{ $admin->nama_admin }}</h5>
    <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
      Kerja keras kita hari ini adalah fondasi untuk membangun PT Abrisam Bintan Indonesia yang lebih kuat dan lebih baik
    </p>

    <div class="flex items-center space-y-8 sm:space-y-0 sm:space-x-4">
      <!-- Tombol atau elemen tambahan lainnya bisa ditempatkan di sini -->
    </div>
    @endif
  </div>
</div>