<!-- Button untuk membuka modal -->
<button id="openModalBtn" class="text-sm font-bold text-red-600 mt-2 font-telkomsel cursor-pointer hover:underline">
    Selengkapnya
</button>

<!-- Modal Dialog -->
<dialog id="paketModal" class="modal p-0 rounded-lg shadow-xl backdrop:bg-black/50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white p-4 rounded-t-lg flex justify-between items-center">
            <div>
                <h1 class="text-lg font-bold">Movie Complete</h1>
                <p class="text-3xl font-bold">Rp 399.000</p>
            </div>
            <div class="bg-white text-red-500 rounded-full px-3 py-1 text-sm font-semibold">Hingga 30Mbps</div>
            <button id="closeModalBtn" class="text-white text-2xl font-bold">&times;</button>
        </div>
        <div class="bg-white p-4">
            <div class="flex justify-between items-center border-b border-gray-300 pb-4">
                <div class="text-center">
                    <i class="fas fa-tools text-blue-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Biaya pasang</p>
                    <p class="text-lg font-bold">Gratis</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-mobile-alt text-blue-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Benefit</p>
                    <p class="text-lg font-bold">13 Aplikasi</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-tag text-blue-500 text-2xl"></i>
                    <p class="text-sm font-semibold">Mulai dari</p>
                    <p class="text-lg font-bold">Rp399.000</p>
                </div>
            </div>
            <div class="pt-4">
                <h2 class="text-red-500 font-bold">Deskripsi paket:</h2>
                <ol class="list-decimal list-inside text-sm">
                    <li>Harga berlaku per zona dengan detail:
                        <ul class="list-disc list-inside pl-4">
                            <li>Area 1: Rp419.000</li>
                            <li>Area 2 & 3 (Jawa, Bali): Rp399.000</li>
                            <li>Area 3 (Nusa Tenggara) & Area 4: Rp429.000</li>
                        </ul>
                    </li>
                    <li>Benefit aplikasi: Catchplay, Disney+ Hotstar, Fita, Genflix, Kuncie, Lionsgate Play, Netflix, Prime, Sushiroll, Vidio, Viu, WeTV, IndiHome TV.</li>
                </ol>
            </div>
        </div>
        <div class="bg-gray-100 p-4 rounded-b-lg flex justify-center">
            <button class="bg-red-500 text-white font-bold py-2 px-8 rounded-full">Beli</button>
        </div>
    </div>
</dialog>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('paketModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // Tombol untuk membuka modal
    openModalBtn.addEventListener('click', () => {
        modal.showModal();
    });

    // Tombol untuk menutup modal (silang)
    closeModalBtn.addEventListener('click', () => {
        modal.close();
    });

    // Menutup modal jika mengklik di luar area modal
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.close();
        }
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