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
    @include('blog.blogContent')
    <!-- Kolom Kanan: Search Bar dan Recent Posts -->
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