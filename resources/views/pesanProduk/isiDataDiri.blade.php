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
  <style>
    /* Pastikan desktop step indicator selalu tampil di desktop */
    @media (min-width: 768px) {
      .desktop-step-indicator {
        display: flex !important;
      }

      .mobile-step-indicator {
        display: none !important;
      }
    }

    /* Pastikan mobile step indicator selalu tampil di mobile */
    @media (max-width: 767px) {
      .desktop-step-indicator {
        display: none !important;
      }

      .mobile-step-indicator {
        display: flex !important;
      }
    }

    @media (max-width: 767px) {
      .desktop-view {
        display: none !important;
      }

      .mobile-view {
        display: block !important;
      }
    }

    @media (min-width: 768px) {
      .mobile-view {
        display: none !important;
      }

      .desktop-view {
        display: block !important;
      }
    }
  </style>
</head>


<body class="bg-gray-100">
  @include('loading')
  <!-- Step Indicator -->
  <div class="fixed w-full bg-white z-48 py-4 md:py-10">
    <div class="container mx-auto max-w-4xl px-4">
      <!-- Step Desktop -->
      <ol class="desktop-step-indicator hidden md:flex items-center space-x-4 rtl:space-x-reverse">
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0">1</span>
          <span>
            <h3 class="font-bold font-telkomsel text-gray-500 leading-tight">Pilih Lokasi & Paket</h3>
            <p class="text-sm text-gray-500">Tentukan lokasi pemasangan kamu dan pilih paket Internet</p>
          </span>
        </li>
        <li class="flex items-center gradient-text space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-red-500 rounded-full shrink-0">2</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight gradient-text">Isi Data Diri</h3>
            <p class="text-sm text-red-400">Siapkan identitas, isi data diri dan Lakukan Konfirmasi Data Anda</p>
          </span>
        </li>
        <li class="flex items-center text-gray-500 space-x-2 rtl:space-x-reverse">
          <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0">3</span>
          <span>
            <h3 class="font-bold font-telkomsel leading-tight">Selesai</h3>
            <p class="text-sm text-gray-500">Tunggu Di Hubungi Call Center</p>
          </span>
        </li>
      </ol>

      <!-- Step Mobile -->
      <div class="mobile-step-indicator block md:hidden flex justify-between items-center">
        <!-- Step 1 -->
        <span class="flex flex-col items-center text-gray-500">
          <div class="w-8 h-8 flex items-center justify-center border border-gray-500 rounded-full">1</div>
          <p class="text-xs font-bold font-telkomsel">Pilih Lokasi</p>
          <p class="text-[10px] text-gray-500 text-center">Lokasi dan Paket</p>
        </span>

        <!-- Line Separator -->
        <div class="w-8 border-t-2 border-gray-300"></div>

        <!-- Step 2 -->
        <span class="flex flex-col items-center gradient-text">
          <div class="w-8 h-8 flex items-center justify-center border border-red-500 rounded-full">2</div>
          <p class="text-xs font-bold font-telkomsel gradient-text">Isi Data</p>
          <p class="text-[10px] gradient-text text-center">Konfirmasi Data</p>
        </span>

        <!-- Line Separator -->
        <div class="w-8 border-t-2 border-gray-300"></div>

        <!-- Step 3 -->
        <span class="flex flex-col items-center text-gray-500">
          <div class="w-8 h-8 flex items-center justify-center border border-gray-500 rounded-full">3</div>
          <p class="text-xs font-bold font-telkomsel">Selesai</p>
          <p class="text-[10px] text-gray-500 text-center">Tunggu Call Center</p>
        </span>
      </div>
    </div>
  </div>
  <br><br><br><br><br class="hidden md:block"><br class="hidden md:block">

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

      <p class="mt-2 text-sm md:text-sm text-red-600 mb-4 md:text-sm text-[10px]">* Sesuaikan Kembali Data Alamat Anda
        Di
        Bawah Ini Yang Sudah Anda Pilih
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


        <p class="mt-2 text-sm md:text-sm text-red-600 mb-4 md:text-sm text-[10px]">* Anda Menyetujui Data Yang Anda
          Inputkan Akan Kami Gunakan Untuk
          Pendaftaran
          Paket Internet.</p>
      </div>
    </form>
  </div>

  <!-- Versi Desktop -->
  <div
    class="desktop-view fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50 hidden md:block">
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

  <!-- Versi Mobile -->
  <div
    class="mobile-view fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-50 block md:hidden">
    <div class="container mx-auto max-w-4xl flex items-center justify-between p-4">
      <div class="flex items-center">
        <div
          class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold rounded-lg mr-4 p-6">
          <!-- Menampilkan Kecepatan Produk -->
          @if(isset($produk) && !empty($produk))
        <span class="font-telkomsel text-sm">{{ $produk['kecepatan'] }} Mbps</span>
      @else
      <span class="font-telkomsel text-sm">N/A</span>
    @endif
        </div>
        <div>
          <!-- Menampilkan Nama dan Harga Produk -->
          @if(isset($produk) && !empty($produk))
        <h4 class="text-sm font-bold font-telkomsel">{{ $produk['nama_produk'] }}</h4>
        <p class="text-xs text-red-600 font-telkomsel">
        Rp{{ number_format($produk['harga_produk'] - ($produk['harga_produk'] * $produk['diskon'] / 100), 0, ',', '.') }}
        </p>
      @else
      <h4 class="text-sm font-bold font-telkomsel">Produk Belum Dipilih</h4>
    @endif
        </div>
      </div>
      <div class="flex">
        <a id="simpanDataDiriMobile" class="w-full p-3 bg-gray-500 text-white rounded-lg cursor-not-allowed"
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

        // Cek apakah tombol desktop atau mobile yang aktif
        const desktopBtn = document.getElementById('simpanDataDiri');
        const mobileBtn = document.getElementById('simpanDataDiriMobile');

        // Jika salah satu tombol dalam keadaan aktif, submit form
        if ((desktopBtn && !desktopBtn.hasAttribute("disabled")) ||
          (mobileBtn && !mobileBtn.hasAttribute("disabled"))) {
          form.submit(); // Mengirim form
        }
      }

      // Fungsi untuk mengecek apakah semua input terisi
      function validateForm() {
        const form = document.getElementById('formDataDiri');
        const desktopBtn = document.getElementById('simpanDataDiri');
        const mobileBtn = document.getElementById('simpanDataDiriMobile');
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
      function enableLocationBtn(type = 'both') {
        if (type === 'desktop' || type === 'both') {
          const desktopBtn = document.getElementById('simpanDataDiri');
          if (desktopBtn) {
            desktopBtn.removeAttribute("disabled");
            desktopBtn.classList.remove("bg-gray-500", "cursor-not-allowed");
            desktopBtn.classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
          }
        }

        if (type === 'mobile' || type === 'both') {
          const mobileBtn = document.getElementById('simpanDataDiriMobile');
          if (mobileBtn) {
            mobileBtn.removeAttribute("disabled");
            mobileBtn.classList.remove("bg-gray-500", "cursor-not-allowed");
            mobileBtn.classList.add("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
          }
        }
      }

      // Fungsi untuk menonaktifkan tombol
      function disableLocationBtn(type = 'both') {
        if (type === 'desktop' || type === 'both') {
          const desktopBtn = document.getElementById('simpanDataDiri');
          if (desktopBtn) {
            desktopBtn.setAttribute("disabled", true);
            desktopBtn.classList.add("bg-gray-500", "cursor-not-allowed");
            desktopBtn.classList.remove("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
          }
        }

        if (type === 'mobile' || type === 'both') {
          const mobileBtn = document.getElementById('simpanDataDiriMobile');
          if (mobileBtn) {
            mobileBtn.setAttribute("disabled", true);
            mobileBtn.classList.add("bg-gray-500", "cursor-not-allowed");
            mobileBtn.classList.remove("bg-gradient-to-r", "from-[#D10A3C]", "to-[#FF0038]", "hover:opacity-90");
          }
        }
      }

      // Fungsi inisialisasi event listener
      function initFormValidation() {
        // Menambahkan event listener untuk setiap input untuk memeriksa validitas
        const inputs = document.querySelectorAll('#formDataDiri input, #formDataDiri select');
        inputs.forEach(input => {
          input.addEventListener('input', validateForm);
        });

        // Panggil fungsi validateForm saat pertama kali load halaman untuk memeriksa status awal
        validateForm();
      }

      // Pastikan DOM sudah selesai dimuat sebelum menjalankan script
      document.addEventListener('DOMContentLoaded', function () {
        initFormValidation();
      });
  </script>
</body>

</html>