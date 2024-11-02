<div class="flex items-center justify-between">
  <!-- Tombol Previous -->
  @if ($blogs->onFirstPage())
    <span
    class="flex items-center px-5 py-2 text-sm text-gray-400 capitalize bg-white border rounded-md gap-x-2 cursor-not-allowed">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="w-5 h-5 rtl:-scale-x-100">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
    </svg>
    <span>Previous</span>
    </span>
  @else
    <a href="{{ $blogs->previousPageUrl() }}" onclick="loadPage(event, '{{ $blogs->previousPageUrl() }}')"
    class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="w-5 h-5 rtl:-scale-x-100">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
    </svg>
    <span>Previous</span>
    </a>
  @endif

  <!-- Links Pagination -->
  <div class="items-center hidden lg:flex gap-x-3">
    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
    @if ($page == $blogs->currentPage())
    <span class="px-2 py-1 text-sm text-red-500 rounded-md dark:bg-gray-800 bg-red-100/60">{{ $page }}</span>
  @else
  <a href="{{ $url }}" onclick="loadPage(event, '{{ $url }}')"
    class="px-2 py-1 text-sm text-gray-500 rounded-md hover:bg-gray-100">{{ $page }}</a>
@endif
  @endforeach
  </div>

  <!-- Tombol Next -->
  @if ($blogs->hasMorePages())
    <a href="{{ $blogs->nextPageUrl() }}" onclick="loadPage(event, '{{ $blogs->nextPageUrl() }}')"
    class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100">
    <span>Next</span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="w-5 h-5 rtl:-scale-x-100">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
    </svg>
    </a>
  @else
    <span
    class="flex items-center px-5 py-2 text-sm text-gray-400 capitalize bg-white border rounded-md gap-x-2 cursor-not-allowed">
    <span>Next</span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="w-5 h-5 rtl:-scale-x-100">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
    </svg>
    </span>
  @endif
</div>