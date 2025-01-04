<!-- Button untuk membuka modal -->
<button onclick="openModal('modalSelengkapnya-{{ $item->id_kategori }}')"
    class="text-sm font-bold text-red-600 mt-2 font-telkomsel cursor-pointer hover:underline">
    Lihat Selengkapnya
</button>

<!-- Modal Dialog -->
<dialog id="modalSelengkapnya-{{ $item->id_kategori }}"
    class="modal custom-modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
    style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%); height: 80vh;">
    <div class="relative bg-white rounded-lg shadow-lg p-6 h-full w-full" id="modalContent" style="overflow-y: auto;">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
            <h3 class="text-lg font-semibold text-gray-900">{{ $item->nama_kategori }}</h3>
            <button type="button"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
                onclick="closeModal('modalSelengkapnya-{{ $item->id_kategori }}')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
            <!-- Gambar -->
            <div class="flex flex-col items-center justify-start mb-4 md:flex-row md:items-start">
                <img src="{{ asset('uploads/kategori/' . $item->gambar_kategori) }}" alt="Gambar Kategori"
                    class="w-48 h-48 object-cover rounded-lg mb-4 md:mb-0 md:mr-4">
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <h2 class="text-lg font-bold text-red-600 mb-2">Deskripsi</h2>
                <p class="text-gray-700">{{ $item->deskripsi }}</p>
            </div>

            <!-- Syarat dan Ketentuan -->
            <div class="mb-4">
                <h2 class="text-lg font-bold text-red-600 mb-3">Syarat dan Ketentuan</h2>

                @php
                    $syaratKetentuan = is_string($item->syarat_ketentuan) ? json_decode($item->syarat_ketentuan, true) : $item->syarat_ketentuan;
                @endphp

                @if (isset($syaratKetentuan) && is_array($syaratKetentuan) && count($syaratKetentuan) > 0)
                    <ul class="list-decimal list-inside space-y-2 text-gray-700">
                        @foreach ($syaratKetentuan as $syarat)
                            <li class="pl-2">{{ $syarat }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center">Tidak ada syarat dan ketentuan yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</dialog>

<style>
    /* Efek animasi masuk */
    @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Efek animasi keluar */
    @keyframes modalOut {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.9);
        }
    }

    /* Modal muncul dengan animasi */
    .modal-show {
        animation: modalIn 0.3s forwards;
    }

    /* Modal menghilang dengan animasi */
    .modal-hide {
        animation: modalOut 0.3s forwards;
    }

    /* Style khusus untuk modal */
    .custom-modal ol,
    .custom-modal ul {
        list-style-position: outside;
        margin-left: 1.5em;
        color: #000;
        padding-left: 0;
        margin-bottom: 1em;
    }

    .custom-modal ol {
        list-style-type: decimal;
    }

    .custom-modal ul {
        list-style-type: disc;
    }

    .custom-modal li {
        margin-bottom: 0.5em;
        line-height: 1.5;
    }
</style>

<script>
    // Fungsi untuk membuka modal dengan animasi
    function openModal(modalId) {
        const modal = document.getElementById(modalId);

        if (modal) {
            // Tambahkan event listener untuk mencegah penutupan
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            // Buka modal
            modal.showModal();

            // Hapus kelas modal-hide jika ada
            modal.classList.remove('modal-hide');

            // Tambahkan kelas modal-show
            modal.classList.add('modal-show');

            // Nonaktifkan scroll body
            document.body.style.overflow = 'hidden';
        }
    }

    // Fungsi untuk menutup modal dengan animasi
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);

        if (modal) {
            // Hapus kelas modal-show
            modal.classList.remove('modal-show');

            // Tambahkan kelas modal-hide
            modal.classList.add('modal-hide');

            // Tunggu hingga animasi selesai, lalu tutup modal
            setTimeout(() => {
                modal.close();

                // Aktifkan kembali scroll body
                document.body.style.overflow = 'auto';
            }, 300);
        }
    }

    // Event listener untuk tombol ESC
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const openModals = document.querySelectorAll('dialog[open]');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
</script>