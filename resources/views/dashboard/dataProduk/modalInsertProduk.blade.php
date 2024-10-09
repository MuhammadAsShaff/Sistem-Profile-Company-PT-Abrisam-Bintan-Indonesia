<!-- Button to Open Modal -->
<button id="openModalButton" onclick="openModal('addProdukModal')"
  class="flex items-center justify-center text-white bg-red-500 rounded-lg w-10 h-10 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none dark:focus:ring-red-700 transition ease-in-out duration-200">
  <svg class="w-4 h-4 transition-transform group-hover:rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
    viewBox="0 0 18 18" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 1v16M1 9h16" />
  </svg>
</button>

<!-- Modal -->
<dialog id="addProdukModal" class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 25%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6" id="modalContent">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Tambah Produk</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('addProdukModal')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <!-- Menggunakan 'gap-6' untuk menjaga jarak konsisten antar elemen grid -->
        <div class="grid grid-cols-2 gap-6">
          <!-- Nama Produk -->
          <div class="col-span-1">
            <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Nama Produk" value="{{ old('nama_produk') }}" required>
          </div>

          <!-- Harga Produk -->
          <div class="col-span-1">
            <label for="harga_produk" class="block text-sm font-medium text-gray-700">Harga Produk</label>
            <input type="text" name="harga_produk" id="harga_produk"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Harga Produk" value="{{ old('harga_produk') }}" required oninput="formatCurrency(this)">
          </div>

          <div class="col-span-1 relative">
            <label for="benefit" class="block text-sm font-medium text-gray-700">Aplikasi Streaming</label>

            <!-- Input field untuk menampilkan hasil pilihan -->
            <input type="text" id="selectedBenefitsInsert" readonly
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm cursor-pointer bg-white"
              placeholder="Pilih Benefit" value="">
            <p class="mt-2 text-xs text-red-600 mb-[-20px]">* Biarkan kosong jika tidak ada Aplikasi Streaming.</p>

            <!-- Dropdown checkbox -->
            <div id="checkboxDropdownInsert" class="absolute z-10 mt-1 w-full bg-white rounded-md shadow-lg hidden">
              <ul class="py-1 text-sm text-gray-700 max-h-48 overflow-y-auto">
                <li class="flex items-center px-4 py-2 hover:bg-gray-100">
                  <input id="disney" name="benefit[]" type="checkbox" value="Disney+"
                    class="mr-2 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                  <label for="disney" class="cursor-pointer">Disney+</label>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-100">
                  <input id="netflix" name="benefit[]" type="checkbox" value="Netflix"
                    class="mr-2 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                  <label for="netflix" class="cursor-pointer">Netflix</label>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-100">
                  <input id="amazon" name="benefit[]" type="checkbox" value="Amazon Prime"
                    class="mr-2 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                  <label for="amazon" class="cursor-pointer">Amazon Prime</label>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-100">
                  <input id="hook" name="benefit[]" type="checkbox" value="Hook"
                    class="mr-2 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                  <label for="hook" class="cursor-pointer">Hook</label>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-100">
                  <input id="hbo" name="benefit[]" type="checkbox" value="HBO Max"
                    class="mr-2 focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                  <label for="hbo" class="cursor-pointer">HBO Max</label>
                </li>
              </ul>
            </div>
          </div>

          <!-- Kecepatan Produk -->
          <div class="col-span-1">
            <label for="kecepatan" class="block text-sm font-medium text-gray-700">Kecepatan Produk (Mbps)</label>
            <input type="number" name="kecepatan" id="kecepatan"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Kecepatan Produk" value="{{ old('kecepatan') }}" required>
          </div>

          <!-- Kuota Produk -->
          <div class="col-span-1">
            <label for="kuota" class="block text-sm font-medium text-gray-700">Kuota Produk (GB)</label>
            <input type="number" name="kuota" id="kuota"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Kuota Produk" value="{{ old('kuota') }}">
              <p class="mt-2 text-xs text-red-600 mb-[-20px]">* Biarkan kosong jika tidak ada Kuota Unlimited.</p>
          </div>

          <!-- Biaya Pasang -->
          <div class="col-span-1">
            <label for="biaya_pasang" class="block text-sm font-medium text-gray-700">Biaya Pasang</label>
            <input type="text" name="biaya_pasang" id="biaya_pasang"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Biaya Pasang" value="{{ old('biaya_pasang', 0) }}" oninput="formatCurrency(this)">
            <p class="mt-2 text-xs text-red-600 mb-[-20px]">* Jika tidak ada biaya pasang, biarkan kosong.</p>
          </div>

          <!-- Kategori Produk -->
          <div class="col-span-1">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori Produk</label>
            @if(isset($kategoris) && count($kategoris) > 0)
        <select name="id_kategori" id="id_kategori" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
          <option value="">Pilih Kategori</option>
          @foreach($kategoris as $kategori)
        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
        {{ $kategori->nama_kategori }}
        </option>
      @endforeach
        </select>
      @else
    <p class="text-red-500">Kategori tidak tersedia.</p>
  @endif
          </div>

          <!-- Paket Produk -->
          <div class="col-span-1">
            <label for="id_paket" class="block text-sm font-medium text-gray-700">Paket Produk</label>
            @if(isset($pakets) && count($pakets) > 0)
        <select name="id_paket" id="id_paket" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
          <option value="">Pilih Paket</option>
          @foreach($pakets as $paket)
        <option value="{{ $paket->id_paket }}" {{ old('id_paket') == $paket->id_paket ? 'selected' : '' }}>
        {{ $paket->nama_paket }}
        </option>
      @endforeach
        </select>
      @else
    <p class="text-red-500">Paket tidak tersedia.</p>
  @endif
          </div>

          <!-- Deskripsi Produk -->
          <div class="col-span-1">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
            <textarea name="deskripsi" id="deskripsi" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Deskripsi Produk">{{ old('deskripsi') }}</textarea>
          </div>

          <!-- Diskon Produk -->
          <div class="col-span-1">
            <label for="diskon" class="block text-sm font-medium text-gray-700">Diskon (%)</label>
            <input type="number" name="diskon" id="diskon"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Diskon Produk" value="{{ old('diskon') }}">
            <p class="mt-2 text-xs text-red-600 mb-[-20px]">* Biarkan kosong jika tidak ada diskon.</p>
          </div>

        </div>

        <!-- Pesan Error -->
        @if(session('error'))
      <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        <span class="font-medium">Error!</span> {{ session('error') }}
      </div>
    @endif

        <!-- Modal footer -->
        <div class="flex justify-end p-5 border-t border-gray-200 mt-10">
          @if(!isset($kategoris) || count($kategoris) === 0 || !isset($pakets) || count($pakets) === 0)
        <span class="text-red-500">Silakan tambahkan terlebih dahulu kategori dan paket produk.</span>
      @else
      <button type="submit"
      class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
      Tambah Produk
      </button>
    @endif
        </div>
      </form>
      <script>
        // Fungsi untuk menampilkan atau menyembunyikan dropdown checkbox khusus untuk insert
        document.getElementById('selectedBenefitsInsert').addEventListener('click', function (event) {
          event.stopPropagation(); // Mencegah event bubbling
          var dropdown = document.getElementById('checkboxDropdownInsert');
          dropdown.classList.toggle('hidden'); // Toggle kelas hidden
        });

        // Mengambil semua checkbox yang ada di dropdown khusus insert
        var checkboxesInsert = document.querySelectorAll('#checkboxDropdownInsert input[type="checkbox"]');
        var selectedBenefitsInputInsert = document.getElementById('selectedBenefitsInsert');

        // Fungsi untuk meng-update input field dengan nilai yang dipilih untuk insert
        function updateSelectedBenefitsInsert() {
          var selectedBenefitsInsert = [];
          checkboxesInsert.forEach(function (cb) {
            if (cb.checked) {
              selectedBenefitsInsert.push(cb.value);
            }
          });
          selectedBenefitsInputInsert.value = selectedBenefitsInsert.join(', '); // Menampilkan hasil pilihan di input field
        }

        // Event listener untuk setiap checkbox insert
        checkboxesInsert.forEach(function (checkbox) {
          checkbox.addEventListener('change', function () {
            updateSelectedBenefitsInsert();
          });
        });

        // Menutup dropdown jika pengguna mengklik di luar dropdown khusus untuk insert
        document.addEventListener('click', function (event) {
          var dropdownInsert = document.getElementById('checkboxDropdownInsert');
          var inputInsert = document.getElementById('selectedBenefitsInsert');
          if (!inputInsert.contains(event.target) && !dropdownInsert.contains(event.target)) {
            dropdownInsert.classList.add('hidden'); // Menyembunyikan dropdown jika klik di luar elemen
          }
        });
      </script>

    </div>
  </div>
</dialog>