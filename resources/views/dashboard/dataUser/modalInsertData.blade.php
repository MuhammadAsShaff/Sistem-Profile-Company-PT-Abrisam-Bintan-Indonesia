<!-- Button to Open Modal -->
<button id="openModalButton" onclick="openModal('addAdminModal')"
  class="flex items-center justify-center text-white bg-red-500 rounded-lg w-10 h-10 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none dark:focus:ring-red-700 transition ease-in-out duration-200">
  <svg class="w-4 h-4 transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
    viewBox="0 0 18 18" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 1v16M1 9h16" />
  </svg>
</button>

<!-- Modal Tambah Admin -->
<dialog id="addAdminModal" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 25%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t">
        <h3 class="text-lg font-semibold text-gray-900">Tambah Admin</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('addAdminModal')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-8">
          <!-- Nama Admin -->
          <div class="col-span-1">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Admin</label>
            <input type="text" name="nama" id="nama"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Nama Lengkap" required>
          </div>

          <!-- Email Admin -->
          <div class="col-span-1">
            <label for="email_admin" class="block text-sm font-medium text-gray-700">Email Admin</label>
            <input type="email" name="email_admin" id="email_admin"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="example@company.com" required>
          </div>

          <!-- Dropdown Posisi -->
          <div class="col-span-1">
            <label for="posisi" class="block text-sm font-medium text-gray-700">Posisi</label>
            <select name="posisi" id="posisi" required
              class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option value="">Pilih Posisi</option>
              <option value="Manager">Manager</option>
              <option value="Admin Support">Admin Support</option>
              <option value="Designer">Designer</option>
              <option value="Sales">Sales</option>
            </select>
          </div>

          <!-- Password Admin -->
          <div class="col-span-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Password" required minlength="8">
          </div>

          <!-- Foto Admin -->
          <div class="col-span-2">
            <label for="dropzone-file" class="block text-sm font-medium text-gray-700">Foto Profil</label>
            <div class="flex items-center justify-center w-full">
              <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                  </svg>
                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk
                      unggah</span> atau seret dan lepaskan</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (MAX. 800x400px)</p>
                </div>
                <input id="dropzone-file" type="file" name="foto_admin" />
              </label>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-blue-800">
            Tambah Admin
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

