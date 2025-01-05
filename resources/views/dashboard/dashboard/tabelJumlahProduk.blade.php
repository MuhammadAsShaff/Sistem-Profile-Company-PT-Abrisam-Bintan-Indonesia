<h2 class="mb-3 text-xl font-bold">Daftar Jumlah Produk</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-collapse">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 w-1/2 bg-gray-50 dark:bg-gray-700">
                    Nama Produk
                </th>
                <th scope="col" class="px-6 py-3 w-1/2 bg-gray-50 dark:bg-gray-700">
                    Jumlah Produk
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produks as $produk)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$produk->nama_kategori}}
                    </td>
                    <td class="px-6 py-4">
                        {{$produk->produk_count}} Produk
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                        Tidak ada data Produk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>