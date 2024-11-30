<!-- Button to trigger the modal -->
<button id="kirimOtpBtn" class="w-full p-3 bg-gray-500 text-white rounded-lg hover:bg-red-600 cursor-not-allowed"
  @if(!session('selected_product')) disabled @endif>Kirim OTP</button>

<!-- Modal Structure -->
<dialog id="otpModal" class="rounded-lg shadow-2xl shadow-gray-400 w-full max-w-md p-6 modal-hide">
  <div class="bg-white p-8 rounded-lg relative">
    <!-- Modal header with close button -->
    <button id="closeModalButton" type="button"
      class="absolute top-4 right-4 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
      onclick="closeOtpModal()">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>

    <h2 class="text-xl font-bold text-center text-gray-800 mb-4">Verifikasi OTP</h2>
    <p class="text-sm text-center text-gray-600 mb-6">
      Kami telah mengirimkan kode OTP ke email <span class="font-semibold">as22si@mahasiswa.pcr.ac.id</span>.
      Silakan masukkan kode tersebut untuk melanjutkan.
    </p>
    <div class="flex justify-center gap-4 mb-6">
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
      <input type="text" maxlength="1"
        class="w-12 h-12 text-center border-2 border-gray-300 rounded-md focus:border-red-500 focus:ring focus:ring-red-200 outline-none text-lg font-semibold text-gray-800" />
    </div>
    <button
      class="w-full py-3 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-semibold text-lg rounded-md hover:bg-red-600 transition-all duration-300">
      Kirim
    </button>
    <div class="text-sm text-center text-gray-600 mt-6">
      Tidak menerima kode? <button class="text-red-500 font-medium hover:text-red-700 transition underline">Kirim ulang
        kode</button>
    </div>
    <p class="text-xs text-center text-gray-400 mt-2">
      Anda dapat mengirim ulang kode dalam <span class="font-semibold text-gray-500">00:29</span>.
    </p>
  </div>
</dialog>

<!-- JavaScript to toggle the modal visibility -->
<script>
  // Ambil tombol dan modal dialog
  const kirimOtpBtn = document.getElementById('kirimOtpBtn');
  const otpModal = document.getElementById('otpModal');

  // Fungsi untuk membuka modal dengan animasi
  function openOtpModal() {
    otpModal.classList.remove('modal-hide'); // Hapus kelas modal-hide
    otpModal.classList.add('modal-show'); // Tambahkan kelas modal-show untuk animasi masuk
    otpModal.showModal(); // Fungsi showModal() untuk membuka dialog
  }

  // Fungsi untuk menutup modal dengan animasi
  function closeOtpModal() {
    otpModal.classList.remove('modal-show'); // Hapus kelas modal-show
    otpModal.classList.add('modal-hide'); // Tambahkan kelas modal-hide untuk animasi keluar
    setTimeout(() => {
      otpModal.close(); // Menutup modal setelah animasi selesai
    }, 300); // Waktu tunda sesuai durasi animasi
  }

  // Event listener untuk membuka modal saat tombol "Kirim OTP" diklik
  kirimOtpBtn.addEventListener('click', function () {
    if (!kirimOtpBtn.disabled) {
      openOtpModal(); // Menampilkan modal OTP
    }
  });

  // Menutup modal jika tombol 'X' di klik
  const closeModalButton = document.getElementById('closeModalButton');
  closeModalButton.addEventListener('click', closeOtpModal);
</script>