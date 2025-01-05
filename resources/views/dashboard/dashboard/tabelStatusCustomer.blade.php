<h2 class="mb-3 text-xl font-bold">Daftar Nama Customer Terbaru</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
    
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 w-1/2 bg-gray-50 dark:bg-gray-700">
                    Nama Customer
                </th>
                <th scope="col" class="px-6 py-3 w-1/2 bg-gray-50 dark:bg-gray-700">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $customer->nama_customer }}
                </td>
                <td class="px-6 py-4">
                    {{ $customer->status_customer }}
                </td>
            </tr>
               @empty
        <tr>
        <td colspan="2" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
          Tidak ada data Customer.
        </td>
        </tr>
      @endforelse
        </tbody>
    </table>
</div>