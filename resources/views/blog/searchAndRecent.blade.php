<div class="bg-gradient-to-r from-[#001a41] to-[#0e336c] shadow-xl rounded-bl-[3rem] rounded-tr-[3rem] p-6 space-y-6 hidden md:block">
  <div class="font-telkomsel mt-4">
    <input type="text" id="search-input" placeholder="Cari Blog..."
      class="w-full p-3 border rounded-md focus:outline-none focus:ring focus:border-red-300">
  </div>
  <div class="font-telkomsel h-full">
    <h3 class="font-bold text-white mb-4 text-2xl">Recent Posts</h3>
    <ul class="space-y-2 text-white">
      @foreach($recentBlogs as $recent)
      <a href="{{ route('isiBlog', ['slug' => $recent->slug]) }}">
      <li class="cursor-pointer hover:text-red-500 hover:underline">{{ $recent->judul_blog }}</li>
      </a>
    @endforeach
    </ul>
  </div>
</div>