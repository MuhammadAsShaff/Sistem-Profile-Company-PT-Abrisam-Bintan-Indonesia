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


<body class="bg-gray-100">
  <!-- Step Indicator -->
  <div class="p-32 w-full bg-white z-48 py-10">
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
  <div class="container mx-auto max-w-4xl mt-6 p-5 bg-gray-100  rounded-lg">

    <form id="formDataDiri" method="POST" action="{{ route('simpanDataDiri') }}"
      class="bg-white shadow-2xl shadow-gray-400 rounded-lg p-8">
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
        <input type="number" id="nomorHandphone" name="nomorHandphone" required
          placeholder="Masukkan nomor handphone Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>

      <p class="mt-2 text-sm text-red-600 mb-4">* Sesuaikan Kembali Data Alamat Anda Di Bawah Ini Yang Sudah Anda Pilih
        Lokasi Sebelumnya.</p>
      <!-- Provinsi -->
      <div class="mb-4">
        <label for="provinsi" class="block text-sm font-semibold text-gray-700">Provinsi</label>
        <input type="text" id="provinsi" name="provinsi" required placeholder="Masukkan provinsi Anda"
          value="{{ $state }}"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>

      <!-- Kota -->
      <div class="mb-4">
        <label for="kota" class="block text-sm font-semibold text-gray-700">Kota</label>
        <input type="text" id="kota" name="kota" required placeholder="Masukkan kota Anda" value="{{ $city }}"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>

      <!-- Kecamatan -->
      <div class="mb-4">
        <label for="kecamatan" class="block text-sm font-semibold text-gray-700">Kecamatan</label>
        <input type="text" id="kecamatan" name="kecamatan" required placeholder="Masukkan kecamatan Anda"
          value="{{ $district }}"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>

      <!-- Kelurahan -->
      <div class="mb-4">
        <label for="kelurahan" class="block text-sm font-semibold text-gray-700">Kelurahan</label>
        <input type="text" id="kelurahan" name="kelurahan" required placeholder="Masukkan kelurahan Anda"
          value="{{ $village }}"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>

      <!-- Kode Post -->
      <div class="mb-4">
        <label for="kodepos" class="block text-sm font-semibold text-gray-700">Kode Post</label>
        <input type="text" id="kodepos" name="kodepos" required placeholder="Masukkan kode pos Anda"
          value="{{ $postcode }}"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
      </div>

      <!-- ID Produk -->
      <input type="hidden" id="idProduk" name="idProduk" required placeholder="Masukkan ID Produk"
        value="{{ $produk['id_produk'] ?? '' }}"
        class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">

      <!-- Alamat -->
      <div class="mb-4">

        <label for="alamat" class="block text-sm font-semibold text-gray-700">Alamat</label>
        <textarea id="alamat" name="alamat" rows="4" required placeholder="Masukkan alamat lengkap Anda"
          class="w-full mt-2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
          style="box-sizing: border-box;">
            {{ $alamat }}
        </textarea>


        <p class="mt-2 text-sm text-red-600">* Anda Menyetujui Data Yang Anda Inputkan Akan Kami Gunakan Untuk
          Pendaftaran
          Paket Internet.</p>
      </div>
    </form>
  </div>

  <!-- Fixed Bottom Bar -->
  <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="flex items-center">
        <div
          class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-8 p-8">
          <!-- Menampilkan Kecepatan Produk -->
          @if(isset($produk) && !empty($produk))
        <span class="font-telkomsel text-lg">{{ $produk['kecepatan'] }} Mbps</span>
      @else
      <span class="font-telkomsel text-lg">Kecepatan Tidak Tersedia</span>
    @endif
        </div>
        <div class="ml-4">
          <!-- Menampilkan Nama dan Harga Produk -->
          @if(isset($produk) && !empty($produk))
        <!-- Nama Produk -->
        <h4 class="text-lg font-bold font-telkomsel">{{ $produk['nama_produk'] }}</h4>

        <!-- Menampilkan Harga Produk Asli dan Harga Setelah Diskon -->
        <div class="flex justify-between items-center">
        <p class="text-gray-400 text-sm font-telkomsel">
          <span class="line-through">Rp{{ $produk['harga_produk'] }}</span> (Harga Asli)
        </p>

        <!-- Diskon -->
        <p class="text-sm text-red-600 font-semibold font-telkomsel">
          {{ $produk['diskon'] }}% Diskon
        </p>
        </div>

        <p class="text-red-600 font-semibold font-telkomsel">
        Rp{{ number_format($produk['harga_produk'] - ($produk['harga_produk'] * $produk['diskon'] / 100), 0, ',', '.') }}
        (Harga Setelah Diskon)
        </p>
      @else
      <h4 class="text-lg font-bold font-telkomsel">Produk Belum Dipilih</h4>
    @endif
        </div>
      </div>
      <div class="flex">
        <a id="simpanDataDiri" class="w-full p-3 bg-gray-500 text-white rounded-lg cursor-not-allowed"
          onclick="submitForm(event)">
          Daftar
        </a>
      </div>
    </div>
    
  </div>


  <br><br><br><br><br>
  <script>
    // Fungsi untuk mengirimkan form
    function submitForm(event) {
      event.preventDefault(); // Mencegah default action dari link (misalnya redirect)

      // Ambil form
      const form = document.getElementById('formDataDiri');

      // Jika tombol dalam keadaan aktif, submit form
      if (!document.getElementById('simpanDataDiri').hasAttribute("disabled")) {
        form.submit(); // Mengirim form
      }
    }

    // Fungsi untuk mengecek apakah semua input terisi
    function validateForm() {
      const form = document.getElementById('formDataDiri');
      const kirimOtpBtn = document.getElementById('simpanDataDiri');
      const inputs = form.querySelectorAll('input, select');

      // Cek apakah semua input sudah terisi
      let allFilled = true;
      inputs.forEach(input => {
        if (!input.value.trim()) {
          allFilled = false;
        }
      });

      // Aktifkan tombol jika semua input terisi
      if (allFilled) {
        enableLocationBtn();
      } else {
        disableLocationBtn();
      }
    }

    // Fungsi untuk mengaktifkan tombol
    function enableLocationBtn() {
      const btn = document.getElementById('simpanDataDiri');
      btn.removeAttribute("disabled"); // Mengaktifkan tombol
      btn.classList.remove("bg-gray-500", "cursor-not-allowed"); // Menghapus kelas disabled
      btn.classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90"); // Menambahkan kelas aktif
    }

    // Fungsi untuk menonaktifkan tombol
    function disableLocationBtn() {
      const btn = document.getElementById('simpanDataDiri');
      btn.setAttribute("disabled", true); // Menonaktifkan tombol
      btn.classList.add("bg-gray-500", "cursor-not-allowed"); // Menambahkan kelas disabled
      btn.classList.remove("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90"); // Menghapus kelas aktif
    }

    // Menambahkan event listener untuk setiap input untuk memeriksa validitas
    document.querySelectorAll('#formDataDiri input, #formDataDiri select').forEach(input => {
      input.addEventListener('input', validateForm); // Setiap kali ada perubahan input, cek form
    });

    // Panggil fungsi validateForm saat pertama kali load halaman untuk memeriksa status awal
    validateForm();


  </script>
</body>

</html>