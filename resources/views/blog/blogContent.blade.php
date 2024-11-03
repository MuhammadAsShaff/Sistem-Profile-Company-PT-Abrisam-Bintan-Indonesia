<div id="blog-content" class="col-span-2 space-y-8">
  @foreach($blogs as $blog)
    <a href="{{ route('isiBlog', ['slug' => $blog->slug]) }}"
    class="flex bg-gray-100 shadow-md rounded-lg overflow-hidden h-[160px] md:h-[180px] lg:h-[200px] hover:shadow-lg transition-shadow duration-300">
    <!-- Left Side: Image -->
    <div class="w-1/3">
      @if($blog->gambar_cover)
      <img src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="{{ $blog->judul_blog }}"
      class="w-full h-full object-cover">
    @else
      <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500">
      Tidak ada gambar
      </div>
    @endif

    </div>

    <!-- Right Side: Text -->
    <div class="p-4 w-2/3 flex flex-col justify-between">
      <div class="overflow-hidden flex-grow">
      <h3 class="text-red-500 text-xs font-bold uppercase font-telkomsel">{{ strtoupper($blog->kategori) }}</h3>
      <h2 class="text-lg font-bold mb-1 font-telkomsel leading-tight">{{ $blog->judul_blog }}</h2>
      <p class="text-gray-700 text-sm leading-relaxed line-clamp-4">
        {{ Str::limit(strip_tags($blog->isi_blog), 100) }}
      </p>
      </div>
      <div class="text-gray-500 mt-3 text-xs">
      <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}</span>
      </div>
    </div>
    </a>
  @endforeach

  <!-- Include Pagination -->
  <div id="pagination-links" class="mt-6">
    @include('blog.pagination', ['blogs' => $blogs])
  </div>
</div>