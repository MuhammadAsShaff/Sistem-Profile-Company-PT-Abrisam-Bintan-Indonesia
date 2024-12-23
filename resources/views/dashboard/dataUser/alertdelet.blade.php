<!-- Button to trigger modal -->
<button type="button" onclick="openModal('crypto_modal_delet')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
  </svg>
</button>

<!-- Main modal -->
<dialog id="crypto_modal_delet" class="modal rounded-lg shadow-lg">
  <div class="relative bg-white rounded-xl shadow dark:bg-gray-700 p-4 md:p-5 text-center">

    <!-- Close button -->
    <button type="button" onclick="closeModal('crypto_modal_delet')"
      class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
      <span class="sr-only">Close modal</span>
    </button>

    <!-- Modal content -->
    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Maaf, {{ $admin->nama_admin }} saat ini sedang
      <b>online</b>. <br> Anda <b>tidak dapat melakukan penghapusan data</b> pada {{ $admin->nama_admin }} yang sedang
      aktif.
    </h3>

    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
      <button type="button" onclick="closeModal('crypto_modal_delet')"
        class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Tutup
      </button>
    </div>

  </div>
</dialog>