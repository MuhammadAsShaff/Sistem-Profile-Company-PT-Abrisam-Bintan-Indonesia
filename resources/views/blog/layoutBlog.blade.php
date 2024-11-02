<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>PT Abrisam Bintan Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-white text-gray-900 flex flex-col min-h-screen overflow-x-hidden">
  @include('landingPage.navbar')

  <div class="container mx-auto p-8 mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Konten Blog diisi AJAX -->
    <div id="blog-content" class="col-span-2 space-y-8">
    </div>
    <!-- Kolom Kanan: Search Bar dan Recent Posts -->
    <div
      class="bg-gradient-to-r from-[#001a41] to-[#0e336c] shadow-xl rounded-bl-[3rem] rounded-tr-[3rem] p-6 space-y-6">
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
  </div>
  <br>
  @include('landingPage.footer')
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

  <script>
    // Load blog content on page load
    document.addEventListener("DOMContentLoaded", function () {
      loadPageContent("{{ route('tampilBlog') }}");

      // Search event
      document.getElementById('search-input').addEventListener('input', function () {
        loadPageContent("{{ route('blog.search') }}?query=" + this.value);
      });
    });

    // Function to load page content using AJAX
    function loadPageContent(url) {
      fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => response.text())
        .then(html => {
          document.querySelector("#blog-content").innerHTML = html;
          bindPaginationLinks();
        })
        .catch(error => console.error("Error loading content:", error));
    }

    // Bind pagination links for AJAX
    function bindPaginationLinks() {
      document.querySelectorAll("#pagination-links a").forEach(link => {
        link.addEventListener("click", function (event) {
          event.preventDefault();
          loadPageContent(this.href);
        });
      });
    }
  </script>
</body>

</html>