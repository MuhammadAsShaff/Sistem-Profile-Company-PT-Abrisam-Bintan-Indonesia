<!-- Button untuk membuka modal -->
<button onclick="openModal('paketModal-{{ $prod->id_produk }}')"
    class="text-sm font-bold text-red-600 mt-2 font-telkomsel cursor-pointer hover:underline">
    Selengkapnya
</button>

<!-- Modal Dialog -->
<dialog id="paketModal-{{ $prod->id_produk }}" class="modal p-0 rounded-lg shadow-xl backdrop:bg-black/50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div
            class="bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white p-4 rounded-t-lg flex justify-between items-center">
            <div>
                <h1 class="text-lg font-bold">{{ $prod->nama_produk }}</h1>
                <p class="text-3xl font-bold">
                    @php
                        $hargaDiskon = $prod->harga_produk - ($prod->harga_produk * $prod->diskon / 100);
                        $hargaFormatted = number_format($hargaDiskon, 0, ',', '.');
                    @endphp
                    Rp{{ $hargaFormatted }}
                </p>
            </div>
            <div class="bg-white text-red-500 rounded-full px-3 py-1 text-sm font-semibold">
                Hingga {{ $prod->kecepatan }} Mbps
            </div>
            <button onclick="closeModal('paketModal-{{ $prod->id_produk }}')"
                class="text-white text-2xl font-bold">&times;</button>
        </div>
        <div class="bg-white p-4">
            <div class="flex justify-between items-center border-b border-gray-300 pb-4">
                <div class="text-center">
                    <i class="fas fa-tools text-red-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Biaya pasang</p>
                    <p class="text-lg font-bold">
                        {{ $prod->biaya_pasang === 0 || is_null($prod->biaya_pasang) ? 'Gratis' : 'Rp' . number_format($prod->biaya_pasang, 0, ',', '.') }}
                    </p>
                </div>
                <div class="text-center">
                    <i class="fas fa-mobile-alt text-red-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Kuota</p>
                    <p class="text-lg font-bold">
                        {{ $prod->kuota === 0 || is_null($prod->kuota) ? 'Unlimited' : $prod->kuota . ' GB' }}
                    </p>
                </div>
                <div class="text-center">
                    <i class="fas fa-tag text-red-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Benefit</p>
                    <p class="text-lg font-bold">
                        @if($prod->benefit && is_array(json_decode($prod->benefit)) && count(json_decode($prod->benefit)) > 0)
                            {{ count(json_decode($prod->benefit)) }} Aplikasi
                        @else
                            Tidak ada
                        @endif
                    </p>
                </div>
            </div>
            <div class="pt-4">
                <h2 class="text-red-500 font-bold mb-2">Deskripsi Paket:</h2>
                @if($prod->deskripsi)
                    <p class="text-sm text-gray-700 mb-3">
                        {{ $prod->deskripsi }}
                    </p>
                @endif

                @if($prod->benefit && is_array(json_decode($prod->benefit)) && count(json_decode($prod->benefit)) > 0)
                    <ol class="list-decimal list-inside text-sm">
                        <li>Benefit Aplikasi:
                            <ul class="list-disc list-inside pl-4">
                                @foreach(json_decode($prod->benefit) as $benefit)
                                    <li>{{ $benefit }}</li>
                                @endforeach
                            </ul>
                        </li>
                    </ol>
                @endif
            </div>
        </div>
        <div class="bg-gray-100 p-4 rounded-b-lg flex justify-center">
            <form action="{{ route('showLocation') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $prod->id_produk }}">
                <button type="submit"
                    class="bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white font-bold py-2 px-8 rounded-full">
                    Pilih Paket
                </button>
            </form>
        </div>
    </div>
</dialog>

<script>
    // Fungsi untuk membuka modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);

        if (modal) {
            modal.showModal();
            document.body.style.overflow = 'hidden';
        }
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);

        if (modal) {
            modal.close();
            document.body.style.overflow = 'auto';
        }
    }

    // Event listener untuk menutup modal saat klik di luar area
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('dialog');

        modals.forEach(modal => {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.close();
                    document.body.style.overflow = 'auto';
                }
            });
        });
    });
</script>

<style>
    /* Styling tambahan untuk dialog */
    dialog::backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }

    dialog {
        max-width: 28rem;
        width: 90%;
        padding: 0;
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>