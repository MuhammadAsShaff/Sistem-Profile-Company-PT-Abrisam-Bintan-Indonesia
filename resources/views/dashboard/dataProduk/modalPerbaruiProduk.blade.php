<!-- Button to trigger modal -->
<button id="openModalButton" onclick="openModal('editProdukModal-{{ $produk->id_produk }}')"
  class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
  </svg>
</button>

<!-- Modal -->
<dialog id="editProdukModal-{{ $produk->id_produk }}"
  class="modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%);">
  <div class="relative bg-white rounded-lg shadow-lg p-6" id="modalContent">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Edit Produk</h3>
        <button id="closeModalButton" type="button"
          class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
          onclick="closeModal('editProdukModal-{{ $produk->id_produk }}')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-6">
          <!-- Foto Profile dan Teks Samping -->
          <div class="col-span-2 flex items-center space-x-4">
            <img class="object-cover w-16 h-16 rounded-full"
              src="{{ $produk->gambar_produk ? asset('uploads/produk/' . $produk->gambar_produk) : asset('images/blankImage.jpg') }}"
              alt="avatar">
            <div>
              <h4 class="text-lg font-medium text-gray-900">Ini Produk, {{ $produk->nama_produk }}!</h4>
              <p class="text-sm text-gray-600">Anda dapat mengganti dan menyesuaikan dengan kebutuhan</p>
            </div>
          </div>

          <!-- Nama Produk -->
          <div class="col-span-1">
            <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Nama Produk" required>
          </div>

          <!-- Harga Produk -->
          <div class="col-span-1">
            <label for="harga_produk" class="block text-sm font-medium text-gray-700">Harga Produk</label>
            <input type="text" name="harga_produk" id="harga_produk"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Harga Produk" value="{{ number_format($produk->harga_produk, 0, ',', '.') }}"
              oninput="formatCurrency(this)">
          </div>

          <!-- Benefit Produk -->
          <div class="col-span-1">
            <label for="benefit" class="block text-sm font-medium text-gray-700">Benefit Produk</label>
            <input type="text" name="benefit" id="benefit"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Benefit Produk" value="{{ $produk->benefit }}" required>
          </div>

          <!-- Kecepatan Produk -->
          <div class="col-span-1">
            <label for="kecepatan" class="block text-sm font-medium text-gray-700">Kecepatan Produk (Mbps)</label>
            <input type="number" name="kecepatan" id="kecepatan"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Kecepatan Produk" value="{{ $produk->kecepatan }}" required>
          </div>

          <!-- Kategori Produk -->
          <div class="col-span-1">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori Produk</label>
            <select name="id_kategori" id="id_kategori" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
              <option value="">Pilih Kategori</option>
              @foreach($kategoris as $kategori)
          <option value="{{ $kategori->id_kategori }}" {{ $produk->id_kategori == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
        @endforeach
            </select>
          </div>

          <!-- Paket Produk -->
          <div class="col-span-1">
            <label for="id_paket" class="block text-sm font-medium text-gray-700">Paket Produk</label>
            <select name="id_paket" id="id_paket" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
              <option value="">Pilih Paket</option>
              @foreach($pakets as $paket)
          <option value="{{ $paket->id_paket }}" {{ $produk->id_paket == $paket->id_paket ? 'selected' : '' }}>
          {{ $paket->nama_paket }}
          </option>
        @endforeach
            </select>
          </div>

          <!-- Deskripsi Produk -->
          <div class="col-span-2">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
            <textarea name="deskripsi" id="deskripsi" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Deskripsi Produk">{{ $produk->deskripsi }}</textarea>
          </div>

          <!-- Diskon Produk -->
          <div class="col-span-2">
            <label for="diskon" class="block text-sm font-medium text-gray-700">Diskon (%)</label>
            <input type="number" name="diskon" id="diskon" step="0.01"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              placeholder="Diskon Produk" value="{{ $produk->diskon }}">
          </div>

          <!-- Foto Produk -->
          <div class="col-span-2">
            <label for="dropzone-file" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
            <div class="flex items-center justify-center w-full">
              <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                <svg class="w-8 h-8 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 20 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
                <input id="dropzone-file" type="file" name="gambar_produk" />
              </label>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t border-gray-200">
          <button type="submit"
            class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>