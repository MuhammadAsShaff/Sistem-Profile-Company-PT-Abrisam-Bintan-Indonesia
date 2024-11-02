@extends('dashboard.layoutDashboard')

@section('editBlog')
<section class="container px-4 mx-auto my-8">
  <div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-semibold text-gray-900">Edit Blog</h2>
  </div>

  <div class="bg-white rounded-lg shadow-lg p-6">
    <form id="blogForm" action="{{ route('blog.update', ['id_blog' => $blog->id_blog]) }}" method="POST"
      enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
      @csrf
      @method('PUT')

      <!-- Input Gambar Cover -->
      <div class="mb-4">
        <label for="dropzone-file-cover" class="block text-sm font-medium text-gray-700">Ubah Gambar Cover</label>
        <input id="dropzone-file-cover" type="file" name="gambar_cover" accept="image/png, image/jpeg, image/jpg"
          class="mt-2 w-full" onchange="previewImage(event, 'cover-preview')">
        <img id="cover-preview" class="mt-3 max-w-xs rounded" src="{{ asset('uploads/blogs/' . $blog->gambar_cover) }}"
          alt="Gambar Cover">
      </div>

      <!-- Judul Blog -->
      <div class="mb-4">
        <label for="judul_blog" class="block text-sm font-medium text-gray-900 mb-2">Judul Blog</label>
        <input type="text" name="judul_blog" id="judul_blog"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
          value="{{ $blog->judul_blog }}" required>
      </div>

      <div class="mb-4">
        <label for="kategori_blog" class="block text-sm font-medium text-gray-900 mb-2">Kategori Blog</label>
        <select name="kategori" id="kategori_blog"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
          required>
          <option value="" disabled {{ $blog->kategori ? '' : 'selected' }}>Pilih Kategori</option>
          <option value="Hiburan" {{ $blog->kategori == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
          <option value="Tips" {{ $blog->kategori == 'Tips' ? 'selected' : '' }}>Tips</option>
          <option value="Pengetahuan" {{ $blog->kategori == 'Pengetahuan' ? 'selected' : '' }}>Pengetahuan</option>
          <option value="Teknologi" {{ $blog->kategori == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
          <option value="Pendidikan" {{ $blog->kategori == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
          <option value="Games" {{ $blog->kategori == 'Games' ? 'selected' : '' }}>Games</option>
        </select>
      </div>

      <!-- Isi Blog -->
      <label for="isi_blog" class="block text-sm font-medium text-gray-900 mb-2">Isi Blog</label>
      <div id="editor-container">{!! $blog->isi_blog !!}</div>

      <!-- Input Hidden -->
      <input type="hidden" name="isi_blog" id="content">

      <div class="flex justify-end mt-4">
        <button type="submit"
          class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  <script>
    function previewImage(event, previewId) {
      const input = event.target;
      const preview = document.getElementById(previewId);

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    let quill;

    function handleSubmit(event) {
      const contentInput = document.querySelector('#content');
      contentInput.value = quill.root.innerHTML;

      if (!contentInput.value.trim()) {
        alert("Isi Blog tidak boleh kosong.");
        event.preventDefault();
        return false;
      }

      return true;
    }

    document.addEventListener("DOMContentLoaded", function () {
        quill = new Quill('#editor-container', {
          theme: 'snow',
          modules: {
            toolbar: [
              [{ 'header': [1, 2, false] }],
              ['bold', 'italic', 'underline', 'strike'],
              [{ 'list': 'ordered' }, { 'list': 'bullet' }],
              [{ 'indent': '-1' }, { 'indent': '+1' }], // Tambahkan indent dan outdent
              [{ 'direction': 'rtl' }],
              [{ 'align': [] }],
              ['link', 'image', 'video'],
              ['blockquote'],
              ['clean']
            ]
          }
        });
      });

  </script>
</section>
@endsection