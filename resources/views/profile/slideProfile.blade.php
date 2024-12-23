<!-- Trigger for the Drawer (Profile Image) -->
<div class="relative inline-block">
    <img class="object-cover w-24 h-24 rounded-full cursor-pointer transition-transform duration-300 hover:scale-105"
        src="{{ $admin->foto_admin ? asset('uploads/admins/' . $admin->foto_admin) : asset('images/blankProfile.jpg') }}"
        alt="Avatar" data-drawer-target="drawer-form" data-drawer-show="drawer-form" aria-controls="drawer-form" />
    <div
        class="absolute bottom-0 right-0 bg-red-500 text-white p-1 rounded-full shadow-lg transition-transform duration-200 hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536M9 11l3.232-3.232m0 0l7.071 7.071M12 3h8.486a1 1 0 011 1v8.486a1 1 0 01-.293.707L11.707 20.293a1 1 0 01-.707.293H3a1 1 0 01-1-1v-8.486a1 1 0 01.293-.707L11.293 3.293A1 1 0 0112 3z" />
        </svg>
    </div>
</div>

<!-- Drawer Component -->
<div id="drawer-form"
    class="fixed top-0 left-0 z-40 h-full p-4 overflow-hidden transition-transform transform -translate-x-full bg-white w-full md:w-1/2 dark:bg-gray-800 shadow-lg"
    tabindex="-1" aria-labelledby="drawer-label">
    <h5 id="drawer-label"
        class="inline-flex items-center mb-6 text-lg font-semibold text-gray-900 uppercase dark:text-gray-400">
        <svg class="w-8 h-8 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path
                d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z" />
        </svg>Edit Profile
    </h5>

    <!-- Close Drawer Button -->
    <button type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white transition duration-300">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close drawer</span>
    </button>

    <!-- Drawer Form Content -->
    <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST" enctype="multipart/form-data"
        class="p-4 space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Foto Profile dan Teks Samping -->
            <div class="col-span-2 flex items-center p-4 border border-gray-300 rounded-lg space-x-6">
                <!-- Foto Profil -->
                <div class="w-24 h-24 flex-shrink-0">
                    <img id="fotoPreview" class="object-cover w-full h-full rounded-full shadow-lg"
                        src="{{ $admin->foto_admin ? asset('uploads/admins/' . $admin->foto_admin) : asset('images/blankProfile.jpg') }}"
                        alt="avatar">
                </div>

                <!-- Informasi Admin -->
                <div class="flex-1">
                    <div class="flex items-center space-x-2">
                        <!-- Status Admin -->
                        <span
                            class="px-4 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:bg-gray-800 dark:text-green-400">
                            {{ $admin->status }}
                        </span>
                    </div>
                    <!-- Nama Admin -->
                    <h4 class="mt-2 text-xl font-semibold text-gray-800">Hallo, {{ $admin->nama_admin }}!</h4>
                    <!-- Deskripsi -->
                    <p class="mt-1 text-sm text-gray-500">Anda dapat mengganti dan menyesuaikan dengan kebutuhan. Ayo
                        atur profil Anda sekarang!</p>
                </div>
            </div>

            <!-- Nama Admin -->
            <div class="col-span-2">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ $admin->nama_admin }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                    placeholder="Nama" required>
                <input type="hidden" name="user-id" value="{{ $admin->id }}">
            </div>

            <!-- Email dan Posisi Admin -->
            <div class="col-span-1">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" value="{{ $admin->email_admin }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                    placeholder="example@company.com" required>
            </div>
            <div class="col-span-1">
                <label for="posisi" class="block mb-2 text-sm font-medium text-gray-900">Posisi</label>
                <input type="text" name="posisi" id="posisi" value="{{ $admin->posisi }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                    placeholder="Posisi" required>
            </div>

            <!-- Foto Admin Upload -->
            <div class="col-span-2">
                <label for="foto_admin" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                <div class="flex items-center justify-start h-full w-full">
                    <input id="foto_admin" name="foto_admin" type="file" accept="image/png, image/jpeg, image/jpg"
                        onchange="previewFoto(event)">
                </div>
            </div>

        </div>

        <!-- Submit Button -->
        <div class="flex justify-end p-10 border-t border-gray-200">
            <button type="submit"
                class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 transition-transform duration-200 hover:scale-105">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <!-- Lupa Password Link -->
    <p class="mt-6 text-sm text-center text-gray-400">
        Lupa Password Anda?
        <a href="{{ route('password.request') }}"
            class="text-red-500 focus:outline-none focus:underline hover:underline">Klik Di Sini</a>.
    </p>
</div>

<script>
    function previewFoto(event) {
        const input = event.target;
        const preview = document.querySelector('#fotoPreview'); // Ambil elemen gambar untuk preview

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result; // Set src ke hasil file yang diunggah
            };
            reader.readAsDataURL(input.files[0]); // Baca file sebagai Data URL
        }
    }
</script>