<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('editUserModal-{{ $admin->id }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal -->
<dialog id="editUserModal-{{ $admin->id }}" class="modal rounded-lg shadow-lg w-full max-w-screen-lg modal-hide">
  <div class="relative bg-white rounded-lg shadow-lg p-6 w-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
        <h3 class="text-lg font-semibold text-gray-900">Edit User</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editUserModal-{{ $admin->id }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data"
        class="p-4 space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-6">
          <!-- Foto Profile dan Teks Samping -->
          <div class="col-span-2 flex items-center space-x-4">
            <img class="object-cover w-16 h-16 rounded-full"
              src="{{ $admin->foto_admin ? asset('uploads/admins/' . $admin->foto_admin) : asset('images/blankProfile.jpg') }}"
              alt="avatar">
            <div>
              <h4 class="text-lg font-medium text-gray-900">Hallo, {{ $admin->nama_admin }}!</h4>
              <p class="text-sm text-gray-600">Anda dapat mengganti dan menyesuaikan dengan kebutuhan</p>
            </div>
          </div>

          <!-- Nama Admin -->
          <div class="col-span-2">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $admin->nama_admin }}"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
              placeholder="Nama" required>
            <!-- Pesan error untuk nama -->
            @error('nama')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <!-- Baris Kedua: Email dan Posisi -->
          <div class="col-span-1">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input type="email" name="email" id="email" value="{{ $admin->email_admin }}"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
              placeholder="example@company.com" required>
            <!-- Pesan error untuk email -->
            @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <div class="col-span-1">
            <label for="posisi" class="block mb-2 text-sm font-medium text-gray-900">Posisi</label>
            <input type="text" name="posisi" id="posisi" value="{{ $admin->posisi }}"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
              placeholder="Posisi" required>
            <!-- Pesan error untuk posisi -->
            @error('posisi')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
          </div>

          <!-- Status Admin -->
          <div class="col-span-2">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
            <input type="text" name="status" id="status" value="{{ $admin->status }}"
              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
              readonly>
          </div>

          <!-- Foto Admin -->
          <div class="col-span-2">
            <label for="foto_admin" class="block text-sm font-medium text-gray-700">Foto Profil</label>
            <div class="flex items-center justify-center w-full">
              <label for="foto_admin"
                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                <input id="foto_admin" name="foto_admin" type="file" accept="image/png, image/jpeg, image/jpg">
              </label>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
            Save all
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

