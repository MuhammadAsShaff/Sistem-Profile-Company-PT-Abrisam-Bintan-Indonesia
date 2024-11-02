<!-- Tombol untuk membuka modal produk -->
<button
  class="ml-2 text-sm font-medium text-red-600 hover:text-red-900 transition-colors duration-200 focus:outline-none"
  onclick="openModal('produkModal-{{ $blog->id_blog }}')">
  Lihat Isi Blog
</button>

<dialog id="produkModal-{{ $blog->id_blog }}"
  class="modal custom-modal rounded-lg shadow-lg w-full max-w-4xl overflow-hidden modal-hide"
  style="position: fixed; top: 0%; left: 0%; transform: translate(-50%, -50%); height: 80vh;">
  <div class="relative bg-white rounded-lg shadow-lg p-6 h-full w-full" id="modalContent" style="overflow-y: auto;">
    <div class="flex items-start justify-between p-5 border-b border-gray-200 rounded-t mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Daftar Produk di paket</h3>
      <button type="button"
        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
        onclick="closeModal('produkModal-{{ $blog->id_blog }}')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
      @if($blog->gambar_cover)
      <div class="mt-4">
      <h4 class="text-sm font-semibold">Gambar Cover:</h4>
      <img src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}" alt="Cover" class="w-full h-auto rounded">
      </div>
    @endif
      <br>
      <h1 class="judul-blog text-3xl font-bold mb-4"
        style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $blog->judul_blog }}</h1>
      <br>
      {{$blog->kategori}}
      <br>
      <br>
      <div style="max-width: 100%; overflow: hidden;">
        <div class="text-gray-700 text-justify"
          style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal; list-style-type: decimal;">
          {!! $blog->isi_blog !!}
        </div>
      </div>
    </div>
  </div>
</dialog>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const listItems = document.querySelectorAll("li[data-list]");
    listItems.forEach(item => {
      const listType = item.getAttribute("data-list");
      if (listType === "ordered" && item.parentNode.tagName !== 'OL') {
        const olElement = document.createElement("ol");
        olElement.style.listStyleType = "decimal";
        olElement.style.marginLeft = "20px";
        olElement.appendChild(item.cloneNode(true));
        item.parentNode.replaceChild(olElement, item);
      } else if (listType === "bullet" && item.parentNode.tagName !== 'UL') {
        const ulElement = document.createElement("ul");
        ulElement.style.listStyleType = "disc";
        ulElement.style.marginLeft = "20px";
        ulElement.appendChild(item.cloneNode(true));
        item.parentNode.replaceChild(ulElement, item);
      }
    });
  });
</script>

<style>
   /* Styling indentasi hingga level 8 */
  .custom-modal .ql-indent-1 { margin-left: 2em; }
  .custom-modal .ql-indent-2 { margin-left: 4em; }
  .custom-modal .ql-indent-3 { margin-left: 6em; }
  .custom-modal .ql-indent-4 { margin-left: 8em; }
  .custom-modal .ql-indent-5 { margin-left: 10em; }
  .custom-modal .ql-indent-6 { margin-left: 12em; }
  .custom-modal .ql-indent-7 { margin-left: 14em; }
  .custom-modal .ql-indent-8 { margin-left: 16em; }

  /* Style khusus untuk modal */
  .custom-modal h1,
  .custom-modal h2,
  .custom-modal h3,
  .custom-modal h4,
  .custom-modal h5,
  .custom-modal h6 {
    font-weight: bold;
    color: #000;
    margin-top: 1em;
    margin-bottom: 0.5em;
  }

  .custom-modal h1 {
    font-size: 2em;
  }

  .custom-modal h2 {
    font-size: 1.75em;
  }

  .custom-modal h3 {
    font-size: 1.5em;
  }

  .custom-modal h4 {
    font-size: 1.25em;
  }

  .custom-modal h5 {
    font-size: 1em;
  }

  .custom-modal h6 {
    font-size: 0.875em;
  }

  .custom-modal p {
    color: #000;
    font-size: 1em;
    line-height: 1.6;
    margin-bottom: 1em;
    text-align: justify;
  }

  .custom-modal ol,
  .custom-modal ul {
    list-style-position: outside;
    margin-left: 1.5em;
    color: #000;
    padding-left: 0;
    margin-bottom: 1em;
  }

  .custom-modal ol {
    list-style-type: decimal;
  }

  .custom-modal ul {
    list-style-type: disc;
  }

  .custom-modal li {
    margin-bottom: 0.5em;
    line-height: 1.5;
  }

  .custom-modal strong {
    font-weight: bold;
  }

  .custom-modal em {
    font-style: italic;
  }

  .custom-modal u {
    text-decoration: underline;
  }

  .custom-modal s {
    text-decoration: line-through;
  }

  .custom-modal .ql-align-center {
    text-align: center;
  }

  .custom-modal .ql-align-right {
    text-align: right;
  }

  .custom-modal .ql-align-justify {
    text-align: justify;
  }

  .custom-modal .ql-direction-rtl {
    direction: rtl;
  }

  .custom-modal a {
    color: #1a73e8;
    text-decoration: underline;
  }

  .custom-modal img {
    max-width: 100%;
    height: auto;
    display: block;
  }

  .custom-modal iframe {
    width: 100%;
    height: auto;
  }

  .custom-modal blockquote {
    border-left: 4px solid #ccc;
    padding-left: 1em;
    color: #555;
    font-style: italic;
  }

  .custom-modal .ql-clean {
    all: initial;
  }
</style>