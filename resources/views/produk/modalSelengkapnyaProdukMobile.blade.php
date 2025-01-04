<!-- Button untuk membuka modal -->
<button onclick="openModal('paketModalMobile-{{ $prod->id_produk }}')"
    class="text-sm font-bold text-red-600 mt-2 font-telkomsel cursor-pointer hover:underline">
    Informasi Selengkapnya...
</button>

<!-- Modal Dialog -->
<dialog id="paketModalMobile-{{ $prod->id_produk }}" class="modal p-0 rounded-lg shadow-xl"
    style="max-width: 50rem; width: 90%; height: 60vh; overflow: hidden;">
    <div class="bg-white rounded-lg shadow-lg w-full h-full flex flex-col">
        <div class="bg-gradient-to-r from-[#D10A3C] to-[#FF0038] text-white rounded-t-lg relative p-6 flex-shrink-0">
            <button onclick="closeModal('paketModalMobile-{{ $prod->id_produk }}')"
                class="absolute top-2 right-2 text-white text-2xl font-bold hover:bg-white/20 rounded-full w-10 h-10 flex items-center justify-center">
                &times;
            </button>

            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center">
                        <h1 class="text-3xl font-bold font-telkomsel mr-4">{{ $prod->nama_produk }}</h1>

                        @if($prod->diskon > 0)
                            <span class="bg-white text-red-600 px-2 py-1 rounded-full text-sm font-bold">
                                Diskon {{ $prod->diskon }}%
                            </span>
                        @endif
                    </div>

                    @php
                        $hargaDiskon = $prod->harga_produk - ($prod->harga_produk * $prod->diskon / 100);
                        $hargaFormatted = number_format($hargaDiskon, 0, ',', '.');
                        $hargaAsli = number_format($prod->harga_produk, 0, ',', '.');
                    @endphp

                    <!-- Harga -->
                    @if($prod->diskon > 0)
                        <p class="text-white text-lg line-through text-left">Rp{{ $hargaAsli }}</p>
                        <p class="text-2xl lg:text-3xl font-bold font-telkomsel mb-2 text-white text-left">
                            Rp{{ substr($hargaFormatted, 0, 3) }}<span
                                class="text-sm">{{ substr($hargaFormatted, 3) }}/Bulan</span>
                        </p>
                    @else
                        <p class="text-2xl lg:text-3xl font-bold font-telkomsel text-white text-left">
                            Rp{{ substr($hargaAsli, 0, 3) }}<span class="text-sm">{{ substr($hargaAsli, 3) }}/Bulan</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Konten modal -->
        <div class="bg-white p-6 overflow-y-auto flex-grow">
            <div class="flex justify-between items-center border-b border-gray-300 pb-4 font-telkomsel">
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
                    <p class="text-sm font-semibold">Streaming</p>
                    <p class="text-lg font-bold">
                        @if($prod->benefit && is_array(json_decode($prod->benefit)) && count(json_decode($prod->benefit)) > 0)
                            {{ count(json_decode($prod->benefit)) }} Aplikasi
                        @else
                            Tidak ada
                        @endif
                    </p>
                </div>
                <div class="text-center">
                    <i class="fas fa-tachometer-alt text-red-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Kecepatan</p>
                    <p class="text-lg font-bold">{{ $prod->kecepatan }} Mbps</p>
                </div>
            </div>

            <div class="pt-4">
                <h2 class="text-red-500 font-bold mb-2 font-telkomsel">Deskripsi Paket:</h2>
                @if($prod->deskripsi)
                    <p class="text-sm text-gray-700 mb-3 ml-4">
                        {{ $prod->deskripsi }}
                    </p>
                @endif

                @if($prod->benefit && is_array(json_decode($prod->benefit)) && count(json_decode($prod->benefit)) > 0)
                    <h2 class="text-red-500 font-bold mb-2 font-telkomsel">Benefit Aplikasi:</h2>
                    <ol class="list-decimal list-inside text-sm ml-4">
                        @foreach(json_decode($prod->benefit) as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>

        <!-- Footer modal -->
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
        max-width: 42rem;
        width: 100%;
        padding: 0;
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>