<!-- dashboard.layout -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-white border-r">
      @include('dashboard.sidebar')
    </div>
    <!-- Main Content -->
    <div class="flex-1 p-6">
      @yield('report')
      @yield('dataProduk')
      @yield('Paket')
      @yield('Promo')
      @yield('dataPelanggan')
      @yield('kategori')
      @yield('blog') 
      @yield('editBlog')
      @yield('tambahBlog')
      @yield('FaQ')
      @yield('datauser') 
    </div>
  </div>
  <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if (session('success'))
    <script>
    Swal.fire({
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      icon: 'success',
      timer: 1500,  // Waktu dalam milidetik (3 detik)
      showConfirmButton: false,  // Sembunyikan tombol OK
      willClose: () => {
      // Aksi opsional jika diperlukan setelah alert ditutup
      console.log('Alert closed');
      }
    });
    </script>
  @endif

  <script>
    // Fungsi untuk membuka modal dengan animasi
    function openModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.showModal(); // Menggunakan showModal() untuk dialog
      modal.classList.remove('modal-hide'); // Hapus kelas modal-hide jika ada
      modal.classList.add('modal-show'); // Tambahkan kelas modal-show
    }

    // Fungsi untuk menutup modal dengan animasi
    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.classList.remove('modal-show'); // Hapus kelas modal-show
      modal.classList.add('modal-hide'); // Tambahkan kelas modal-hide

      // Tunggu hingga animasi selesai (300ms), lalu tutup modal
      setTimeout(() => {
        modal.close(); // Menggunakan close() untuk dialog
      }, 300); // Sesuaikan durasi dengan durasi animasi (300ms)
    }

    // Fungsi untuk format angka ke dalam format ribuan dengan titik
    function formatCurrency(input) {
      // Hapus karakter selain angka
      let inputVal = input.value.replace(/[^0-9]/g, '');

      if (inputVal === '') {
        input.value = '';
        return;
      }

      // Format angka dengan pemisah ribuan
      input.value = new Intl.NumberFormat('id-ID').format(inputVal);
    }

    // Saat submit, hapus titik sebelum dikirim ke server
    const form = document.querySelector('form');
    form.addEventListener('submit', function () {
      const hargaInput = document.getElementById('harga_produk');
      const biayaPasangInput = document.getElementById('biaya_pasang');

      // Menghapus semua titik dari input sebelum mengirim ke server
      hargaInput.value = hargaInput.value.replace(/\./g, '');
      biayaPasangInput.value = biayaPasangInput.value.replace(/\./g, '');
    });
  </script>


  @if ($errors->any())
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      // SweetAlert untuk menampilkan error dengan icon silang
      Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '{{ $errors->first() }}',
      showConfirmButton: true,
      confirmButtonText: 'OK'
      });
    });
    </script>
  @endif
</body>

</html>