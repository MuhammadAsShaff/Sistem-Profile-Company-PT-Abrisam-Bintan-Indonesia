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
    <!-- Search Bar untuk Mobile -->
    <div class="block md:hidden bg-gradient-to-r from-[#001a41] to-[#0e336c] shadow-xl rounded-xl p-4 md:p-6">
      <div class=" mb-4">
        <h3 class="text-lg font-bold font-telkomsel text-white mb-2">Temukan Inspirasi Anda</h3>
        <p class="text-sm text-white mb-4">Cari blog yang sesuai dengan minat dan kebutuhan Anda</p>
      </div>

      <div class="relative">
        <input type="text" id="search-input" placeholder="Ketik kata kunci blog..." class="w-full p-3 text-sm text-gray-800 bg-white/90 border-0 rounded-lg 
             focus:outline-none focus:ring-2 focus:ring-blue-500 
             transition duration-300 ease-in-out placeholder-gray-500">
        <div class="absolute inset-y-0 right-0 flex items-center px-3">
         
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          
        </div>
      </div>
    </div>

    <!-- Kolom Kiri: Konten Blog -->
    @include('blog.blogContent')


    <!-- Kolom Kanan: Search Bar dan Recent Posts (Hanya Desktop) -->
    @include('blog.searchAndRecent')
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