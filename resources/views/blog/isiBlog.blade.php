<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('images/logoAbi.png') }}" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>PT Abrisam Bintan Indonesia</title>

  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Vite Tailwind CSS -->
  @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-white text-gray-900 overflow-x-hidden">
  <!-- Navbar Section -->
  @include('landingPage.navbar')

  <!-- Main Container -->
  <div class="w-screen mx-0 flex flex-col justify-between min-h-screen">
    <div class="container mx-auto p-8 mt-20">
      <div class="blog-detail-content-area bg-gray-100 shadow-md rounded-lg overflow-hidden mb-6">
        {{-- Gambar Blog --}}
        <img class="blog-detail-image w-full h-full object-cover"
          src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="{{ $blog->judul_blog }}">

        {{-- Konten Blog --}}
        <div class="p-6 blog-detail-content">
          {{-- Kategori Blog --}}
          <h3 class="blog-detail-category text-red-500 uppercase text-sm font-bold  font-telkomsel ">
            {{ strtoupper($blog->kategori) }}
          </h3>

          {{-- Judul Blog --}}
          <h1 class="blog-detail-title text-3xl font-bold font-telkomsel text-gray-800 ">{{ $blog->judul_blog }}
          </h1>

          {{-- Tanggal Blog --}}
          <div class="blog-detail-meta font-telkomsel text-gray-500 text-sm mb-6">
            <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}</span>
          </div>

          {{-- Deskripsi dan Konten Blog --}}
          <div class="blog-detail-content-text text-gray-700 leading-relaxed text-justify">
            {!! $blog->isi_blog !!}
          </div>
        </div>
      </div>
      <br>
      <hr>
      <br><br>
      <!-- Bagian Blog Lainnya -->
      <div class="mt-18">
        <h2 class="text-2xl font-bold font-telkomsel text-gray-800 mb-6">Blog Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @foreach ($relatedBlogs as $related)
        <div class="bg-gray-100 shadow-md rounded-lg overflow-hidden">
        <a href="{{ route('isiBlog', ['slug' => $related->slug]) }}">
          <img src="{{ asset('uploads/blogs/' . $related->gambar_cover) }}" alt="{{ $related->judul_blog }}"
          class="w-full h-48 object-cover">
          <div class="p-4">
          <h3 class="text-red-500 text-xs font-bold uppercase">{{ strtoupper($related->kategori) }}</h3>
          <h2 class="text-lg font-bold font-telkomsel mb-1">{{ $related->judul_blog }}</h2>
          <p class="text-gray-700 text-sm mb-2">{{ Str::limit(strip_tags($related->isi_blog), 60) }}</p>
          <span
            class="text-gray-500 text-xs">{{ \Carbon\Carbon::parse($related->created_at)->format('d M Y') }}</span>
          <a href="{{ route('isiBlog', ['slug' => $related->slug]) }}"
            class="text-red-500 text-sm font-bold font-telkomsel block mt-2">Lihat Selengkapnya &gt;</a>
          </div>
        </a>
        </div>
      @endforeach
        </div>
      </div>

    </div>
    <br>
    <!-- Footer -->
    <footer class="bg-white mt-12">
      @include('landingPage.footer')
    </footer>
  </div>


  <!-- Vite JS -->
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Seleksi semua elemen `li` dengan atribut `data-list`
      const listItems = document.querySelectorAll("li[data-list]");

      listItems.forEach(item => {
        const listType = item.getAttribute("data-list");

        if (listType === "ordered") {
          // Pastikan item terbungkus dalam <ol> untuk ordered list
          if (item.parentNode.tagName !== 'OL') {
            const olElement = document.createElement("ol");
            olElement.style.listStyleType = "decimal";
            olElement.style.marginLeft = "20px";
            olElement.appendChild(item.cloneNode(true));
            item.parentNode.replaceChild(olElement, item);
          }
        } else if (listType === "bullet") {
          // Pastikan item terbungkus dalam <ul> untuk bullet list
          if (item.parentNode.tagName !== 'UL') {
            const ulElement = document.createElement("ul");
            ulElement.style.listStyleType = "disc";
            ulElement.style.marginLeft = "20px";
            ulElement.appendChild(item.cloneNode(true));
            item.parentNode.replaceChild(ulElement, item);
          }
        }
      });
    });
  </script>

  <style>
    /* Styling indentasi hingga level 8 */
    .blog-detail-content-text .ql-indent-1 {
      margin-left: 2em;
    }

    .blog-detail-content-text .ql-indent-2 {
      margin-left: 4em;
    }

    .blog-detail-content-text .ql-indent-3 {
      margin-left: 6em;
    }

    .blog-detail-content-text .ql-indent-4 {
      margin-left: 8em;
    }

    .blog-detail-content-text .ql-indent-5 {
      margin-left: 10em;
    }

    .blog-detail-content-text .ql-indent-6 {
      margin-left: 12em;
    }

    .blog-detail-content-text .ql-indent-7 {
      margin-left: 14em;
    }

    .blog-detail-content-text .ql-indent-8 {
      margin-left: 16em;
    }

    /* Styles khusus untuk konten di dalam .blog-detail-content-text */
    .blog-detail-content-text h1,
    .blog-detail-content-text h2 {
      font-family: 'TelkomselBatikSans', sans-serif;
      font-weight: bold;
      color: #000;
    }

    .blog-detail-content-text h1 {
      font-size: 2em;
    }

    .blog-detail-content-text h2 {
      font-size: 1.5em;
    }


    .blog-detail-content-text h4 {
      font-size: 1.25em;
    }

    .blog-detail-content-text h5 {
      font-size: 1em;
    }

    .blog-detail-content-text h6 {
      font-size: 0.875em;
    }

    .blog-detail-content-text p {
      color: #000;
      font-size: 1em;
      line-height: 1.6;
      text-align: justify;
    }

    .blog-detail-content-text ol,
    .blog-detail-content-text ul {
      list-style-position: outside;
      margin-left: 1.5em;
      color: #000;
      padding-left: 0;

    }

    .blog-detail-content-text ol {
      list-style-type: decimal;
    }

    .blog-detail-content-text ul {
      list-style-type: disc;
    }

    .blog-detail-content-text li {
      margin-bottom: 0.5em;
      line-height: 1.5;
    }

    .blog-detail-content-text strong {
      font-weight: bold;
    }

    .blog-detail-content-text em {
      font-style: italic;
    }

    .blog-detail-content-text u {
      text-decoration: underline;
    }

    .blog-detail-content-text s {
      text-decoration: line-through;
    }

    .blog-detail-content-text .ql-align-center {
      text-align: center;
    }

    .blog-detail-content-text .ql-align-right {
      text-align: right;
    }

    .blog-detail-content-text .ql-align-justify {
      text-align: justify;
    }

    .blog-detail-content-text .ql-direction-rtl {
      direction: rtl;
    }

    .blog-detail-content-text a {
      color: #1a73e8;
      text-decoration: underline;
    }

    .blog-detail-content-text img {
      max-width: 100%;
      height: auto;
      display: block;
    }

    .blog-detail-content-text iframe {
      width: 100%;
      height: auto;
    }

    .blog-detail-content-text blockquote {
      border-left: 4px solid #ccc;
      padding-left: 1em;
      color: #555;
      font-style: italic;
    }

    .blog-detail-content-text .ql-clean {
      all: initial;
    }
  </style>


</body>

</html>