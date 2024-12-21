<div class="container mx-auto px-4 py-6 mb-12">
  <!-- Wrapper utama -->
  <div
    class="bg-gradient-to-r from-[#D10A3C] to-[#FF0038] rounded-bl-[3rem] rounded-tr-[3rem] p-10 flex flex-col md:flex-row items-center justify-between min-h shadow-l">
    <!-- Teks utama -->
    <br class="block md:hidden">
    <div
      class="bg-white rounded-bl-[4rem] rounded-tr-[4rem] h-32 flex items-center p-4 space-x-4 w-full mb-12 mt-12 md:hidden ">
      <img class="rounded-bl-[0.5rem] rounded-tr-[0.5rem] w-full h-auto mb-12" alt=""
        src="{{ asset('images/gambarSectionKontak.webp') }}">
    </div>

    <div class="mb-6 md:mb-0">
      <h2 class="text-white text-3xl font-bold font-telkomsel mb-2">Untuk Informasi Yang Lebih Lengkap</h2>
      <p class="text-white mb-6">Anda dapat menghubungi kami pada kontak yang berada di kolom kontak <br>atau klik
        button di bawah ya...</p>
      <a href="{{route('tampilKontak')}}"
        class="bg-white text-red-600 font-semibold font-telkomsel py-2 px-4 rounded-full">
        Kontak Perusahaan
      </a>
    </div>
    <!-- Input dan tombol -->
    <div
      class="bg-white rounded-bl-[3rem] rounded-tr-[3rem] h-64 flex items-center p-4 space-x-4 w-full hidden md:flex md:w-1/3">
      <img class="rounded-bl-[0.5rem] rounded-tr-[0.5rem] w-full h-auto" alt=""
        src="{{ asset('images/gambarSectionKontak.webp') }}">
    </div>
  </div>
</div>