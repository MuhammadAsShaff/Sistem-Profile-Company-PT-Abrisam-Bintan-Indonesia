<!-- Button untuk membuka modal -->
<button onclick="openModal('modalSelengkapnya-{{ $item->id_kategori }}')"
    class="text-sm font-bold text-red-600 mt-2 font-telkomsel cursor-pointer hover:underline">
    Lihat Selengkapnya
</button>

<!-- Modal Dialog -->
<dialog id="modalSelengkapnya-{{ $item->id_kategori }}" class="modal p-0 rounded-lg shadow-xl backdrop:bg-black/50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div
            class="bg-gradient-to-r from-red-500 to-pink-500 text-white p-4 rounded-t-lg flex justify-between items-center">
            <div>
                <h1 id="modal-nama-kategori" class="text-lg font-bold">{{ $item->nama_kategori }}</h1>
            </div>
            <button onclick="closeModal('modalSelengkapnya-{{ $item->id_kategori }}')"
                class="text-white text-2xl font-bold">&times;
            </button>
        </div>

        <div class="bg-white p-4">
            <div class="mb-4">
                <img id="modal-gambar-kategori" src="{{ asset('uploads/kategori/' . $item->gambar_kategori) }}"
                    alt="Gambar Kategori" class="w-full h-48 object-cover rounded-lg mb-4">

                <div class="bg-gray-100 rounded-lg p-4 mb-4">
                    <h2 class="text-lg font-bold text-red-600 mb-2">Deskripsi</h2>
                    <p id="modal-deskripsi-lengkap" class="text-gray-700">
                        {{ $item->deskripsi }}
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                @php
                    // Cek apakah syarat_ketentuan masih berupa string JSON
                    $syaratKetentuan = is_string($item->syarat_ketentuan)
                        ? json_decode($item->syarat_ketentuan, true)
                        : $item->syarat_ketentuan;
                @endphp

                <h3 class="text-lg font-bold text-red-600 mb-3">Syarat dan Ketentuan</h3>

                @if (isset($syaratKetentuan) && is_array($syaratKetentuan) && count($syaratKetentuan) > 0)
                    <div class="grid grid-cols-1 gap-3">
                        @foreach ($syaratKetentuan as $index => $syarat)
                            <div class="bg-gray-50 p-3 rounded-lg shadow-sm">
                                <div class="flex items-start">
                                    <span
                                        class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 flex-shrink-0">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-gray-700 flex-grow px-2">
                                        {{ $syarat }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Tidak ada syarat dan ketentuan yang tersedia.</p>
                @endif
            </div>
        </div>

        <div class="bg-gray-100 p-4 rounded-b-lg flex justify-between items-center">
            <button class="bg-red-500 text-white font-bold py-2 px-6 rounded-full hover:bg-red-600 transition">
                Konsultasi Sekarang
            </button>
        </div>
    </div>
</dialog>

<script>
    // Fungsi untuk membuka modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.showModal();
        }
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.close();
        }
    }

    // Event listener untuk menutup modal saat mengklik di luar area
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('dialog');
        modals.forEach(modal => {
            modal.addEventListener('click', function (event) {
                // Pastikan klik di luar area modal
                if (event.target === this) {
                    this.close();
                }
            });
        });
    });
</script>

