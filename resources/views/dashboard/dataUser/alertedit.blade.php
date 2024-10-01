<!-- Modal toggle -->
<button type="button" onclick="openModal('crypto_modal_edit')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Main modal -->
<dialog id="crypto_modal_edit" class="modal rounded-lg shadow-lg">
  <div class="relative bg-white rounded-xl shadow dark:bg-gray-700 p-4 md:p-5 text-center">

    <!-- Close button -->
    <button type="button" onclick="closeModal('crypto_modal_edit')"
      class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
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
      <b>online</b>. Anda <b>tidak dapat melakukan perubahan data</b> pada {{ $admin->nama_admin }} yang sedang aktif.
    </h3>

    <!-- Modal footer -->
    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
      <button type="button" onclick="closeModal('crypto_modal_edit')"
        class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tutup</button>
    </div>
  </div>
</dialog>
