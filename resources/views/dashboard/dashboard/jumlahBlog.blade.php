<a href="{{route('dashboard.blog.blog')}}" class="block w-full h-full p-4 shadow-md rounded-lg shadow bg-white flex items-center space-x-4 min-h-[120px]">
  <!-- Ikon -->
  <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
  </svg>

  <!-- Teks -->
  <div>
    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Jumlah Blog</h5>
    @if ($blogCount !== null)
    <span class="px-3 py-1 text-xs text-black bg-gray-200 rounded-full dark:bg-gray-800 dark:text-red-400">Blog Yang Diupload
    <b>{{$blogCount}}</b></span>
    @endif
  </div>
</a>
