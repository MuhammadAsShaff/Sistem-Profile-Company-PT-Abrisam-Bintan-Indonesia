<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>


<body>
  <!-- Step Indicator -->
  <div class="top-40 w-full bg-white z-48 py-4 mt-12">
    <div class="container mx-auto max-w-4xl px-4 flex justify-center">
      <ol class="flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">1</span>
          <span>
            <h3 class="font-bold font-telkomsel text-gray-500 leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm text-gray-500">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>
        <li class="flex items-center gradient-text space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0 dark:border-red-400">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight gradient-text leading-tight">Isi Data Diri</h3>
            <p class="text-sm dark:text-red-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
          <span
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">3</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Selesai</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tunggu Di Hubungi Call Center</p>
          </span>
        </li>
      </ol>
    </div>
  </div>

  <!-- Formulir Data Diri -->
  <div class="container mx-auto max-w-4xl mt-6 p-5 bg-white  rounded-lg">

    <form id="formDataDiri" method="POST" class="bg-white shadow-md rounded-lg p-8">
      @csrf
      <h2 class="text-center text-2xl font-bold font-telkomsel mb-4">Masukkan Data Diri Anda</h2>
    
      <!-- NIK -->
      <div class="mb-4">
        <label for="nik" class="block text-sm font-semibold text-gray-700">NIK</label>
        <input type="number" id="nik" name="nik" required placeholder="Masukkan NIK Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>
    
      <!-- Nama Lengkap -->
      <div class="mb-4">
        <label for="namaLengkap" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
        <input type="text" id="namaLengkap" name="namaLengkap" required placeholder="Masukkan nama lengkap Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>
    
      <!-- Jenis Kelamin -->
      <div class="mb-4">
        <label for="jenisKelamin" class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
        <select id="jenisKelamin" name="jenisKelamin" required
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
          <option value="" disabled selected>Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
    
      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-semibold text-gray-700">E-mail</label>
        <input type="email" id="email" name="email" required placeholder="Masukkan email Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>
    
      <!-- Nomor Handphone -->
      <div class="mb-4">
        <label for="nomorHandphone" class="block text-sm font-semibold text-gray-700">Nomor Handphone</label>
        <input type="number" id="nomorHandphone" name="nomorHandphone" required placeholder="Masukkan nomor handphone Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>
    
      <!-- Kota -->
      <div class="mb-4">
        <label for="kota" class="block text-sm font-semibold text-gray-700">Kota</label>
        <input type="text" id="kota" name="kota" required placeholder="Masukkan kota Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>
    
      <!-- Provinsi -->
      <div class="mb-4">
        <label for="provinsi" class="block text-sm font-semibold text-gray-700">Provinsi</label>
        <input type="text" id="provinsi" name="provinsi" required placeholder="Masukkan provinsi Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>
    
      <!-- Alamat -->
      <div class="mb-4">
        <label for="alamat" class="block text-sm font-semibold text-gray-700">Alamat</label>
        <textarea id="alamat" name="alamat" rows="4" required placeholder="Masukkan alamat lengkap Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"></textarea>
      </div>
    </form>

  </div>
  <!-- Fixed Bottom Bar -->
  <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="flex items-center">
        <div
          class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-8 p-8">
          <span class="font-telkomsel text-lg">20 Mbps</span>
        </div>
        <div class="ml-4">
          <h4 class="text-lg font-bold font-telkomsel">Orbit Star N1 + Philips Smart Lamp</h4>
          <p class="text-gray-500">Rp 644.000</p>
        </div>
      </div>
      <div class="flex">
        <button id="kirimOtpBtn" class="w-full p-3 bg-gray-500 text-white rounded-lg hover:bg-red-600">
          Kirim OTP
        </button>
      </div>
    </div>
  </div>

  <br><br><br><br><br>
  <script>
    document.getElementById('kirimOtpBtn').addEventListener('click', function () {
      document.getElementById('formDataDiri').submit(); // Kirim form
    });

    // Ambil elemen-elemen input
    const form = document.getElementById('formDataDiri');
    const kirimOtpBtn = document.getElementById('kirimOtpBtn');
    const inputs = form.querySelectorAll('input, select, textarea');

    // Fungsi untuk mengecek apakah semua input terisi
    function validateForm() {
      let allFilled = true;
      inputs.forEach(input => {
        if (!input.value.trim() || (input.tagName === 'SELECT' && input.value === "")) {
          allFilled = false;
        }
      });

      if (allFilled) {
        kirimOtpBtn.disabled = false;
        kirimOtpBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        kirimOtpBtn.classList.add('bg-gradient-to-r', 'from-[#D10A3C]', 'to-[#FF0038]', 'hover:opacity-90');
      } else {
        kirimOtpBtn.disabled = true;
        kirimOtpBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        kirimOtpBtn.classList.remove('bg-gradient-to-r', 'from-[#D10A3C]', 'to-[#FF0038]', 'hover:opacity-90');
      }
    }

    // Tambahkan event listener untuk setiap input
    inputs.forEach(input => {
      input.addEventListener('input', validateForm);
    });

    // Panggil fungsi validasi awal untuk memastikan tombol disabled
    validateForm();
  </script>
</body>

</html>