@extends('dashboard.layoutDashboard')

@section('datauser') 
<section class="container px-4 mx-auto">
    <section class="container px-4 mx-auto">
        <!-- Baris Pertama: Judul Halaman -->
        <div class="mb-3 mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Admin Yang Terdaftar Pada Sistem</h2>
        </div>

        <!-- Baris Kedua: Penjelasan Singkat -->
        <div class="mb-6">
            <p class="text-sm text-gray-600 dark:text-gray-300">
                Halaman Ini Menampilkan <b>Informasi Tim Admin</b>, Termasuk Status Terkini Dan Detail Lainnya.
                Anda Dapat Dengan Mudah Melihat Siapa Yang Sedang <b>Online</b>,<b>Offline</b>, Serta Melihat Statistik
                Anggota.
            </p>
        </div>

        <!-- Baris Ketiga: Jumlah User, Online, dan Offline -->
        <div class="flex justify-between items-center gap-x-3">
            <div class="flex items-center gap-x-3">
                <!-- Jumlah User -->
                <span
                    class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
                    {{ $adminCount }} users
                </span>

                <!-- Jumlah Online -->
                <span
                    class="px-3 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:bg-gray-800 dark:text-green-400">
                    {{ $onlineCount }} online
                </span>

                <!-- Jumlah Offline -->
                <span class="px-3 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
                    {{ $offlineCount }} offline
                </span>
            </div>

            <!-- Search Bar -->
            <div class="flex items-center space-x-2 w-full max-w-lg">
                <!-- Search Bar -->
                <div class="flex-grow">
                    @include('dashboard.dataUser.searchBar')
                </div>

                <!-- Tombol Tambah Admin -->
                @include('dashboard.dataUser.modalInsertData')
            </div>
        </div>
    </section>

    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400 w-1/6">
                                    <div class="flex items-center gap-x-3">
                                        <input type="checkbox"
                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                        <span>Name</span>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400 w-1/6">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400 w-1/6">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400 w-1/6">
                                    Email address
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400 w-1/4">
                                    Terakhir Terlihat
                                </th>
                                <th scope="col" class="relative py-3.5 px-4 w-1/12">
                                    <span class="sr-only">Esadsadit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-x-3">
                                            <input type="checkbox"
                                                class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                            <div class="flex items-center gap-x-2">
                                                <img class="object-cover w-10 h-10 rounded-full"
                                                    src="{{ $admin->foto_admin ? asset('uploads/admins/' . $admin->foto_admin) : asset('images/blankProfile.jpg') }}"
                                                    alt="Avatar">

                                                <div>
                                                    <h2 class="font-medium text-gray-800 dark:text-white">
                                                        {{ $admin->nama_admin }}
                                                    </h2>
                                                    <p class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                        {{ $admin->email_admin }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div
                                            class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 
                                                                                                                                                                        @if($admin->status == 'Online') bg-emerald-100/60 dark:bg-gray-800 @else bg-red-100/60 dark:bg-gray-800 @endif">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full 
                                                                                                                                                                        @if($admin->status == 'Online') bg-emerald-500 @else bg-red-500 @endif">
                                            </span>
                                            <h2
                                                class="text-sm font-normal 
                                                                                                                                                                        @if($admin->status == 'Online') text-emerald-500 @else text-red-500 @endif">
                                                {{ $admin->status == 'Online' ? 'Online' : 'Offline' }}
                                            </h2>
                                        </div>


                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ $admin->posisi }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ $admin->email_admin }}
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">

                                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2">
                                            <!-- Menampilkan "Sedang online" jika status adalah Online -->
                                            @if($admin->status == 'Online')
                                                <span
                                                    class="ml-2 px-3 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:bg-gray-800 dark:text-green-400">
                                                    Sedang online
                                                </span>
                                            @else
                                                <!-- Menampilkan Last seen jika status bukan Online -->
                                                <span
                                                    class="ml-2 px-3 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:bg-gray-800 dark:text-red-400">
                                                    Terakhir Terlihat :
                                                    @if($admin->updated_at->isToday())
                                                        {{ 'Hari ini' }} {{ $admin->updated_at->format('H:i') }}
                                                    @else
                                                        {{ $admin->updated_at->format('d M Y, H:i') }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>

                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-x-6">
                                            @if ($admin->status == 'Offline')
                                                @include('dashboard.dataUser.modalPerbaruiData')
                                                @include('dashboard.dataUser.modalHapusData')
                                            @else
                                                @include('dashboard.dataUser.alertedit')
                                                @include('dashboard.dataUser.alertdelet')
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Tambahkan baris lain seperti di atas -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.dataUser.pagination')
</section>

@endsection