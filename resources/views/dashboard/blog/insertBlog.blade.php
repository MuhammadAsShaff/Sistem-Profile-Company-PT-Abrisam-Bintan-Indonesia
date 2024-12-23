@extends('dashboard.layoutDashboard')

@section('tambahBlog') 
<section class="container px-4 mx-auto my-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-semibold text-gray-900">Tambah Blog</h2>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            <div class="mb-4">
                <img id="cover-preview" class="mt-3 max-w-xs rounded" style="display: none;">
                <label for="dropzone-file-cover" class="block text-sm font-medium text-gray-700 mt-4">Unggah Gambar
                    Blog</label>
                <input id="dropzone-file-cover" type="file" name="gambar_cover"
                    accept="image/png, image/jpeg, image/jpg" class="mt-2 w-full"
                    onchange="previewImage(event, 'cover-preview')">
            </div>


            <div class="mb-4">
                <label for="judul_blog" class="block text-sm font-medium text-gray-900 mb-2">Judul Blog</label>
                <input type="text" name="judul_blog" id="judul_blog"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                    placeholder="Judul Blog" required>
            </div>

            <div class="mb-4">
                <label for="kategori_blog" class="block text-sm font-medium text-gray-900 mb-2">Kategori Blog</label>
                <select name="kategori" id="kategori_blog"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                    required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="Tips">Tips</option>
                    <option value="Pengetahuan">Pengetahuan</option>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Games">Games</option>
                </select>
            </div>



            <label for="judul_blog" class="block text-sm font-medium text-gray-900 mb-2">Isi Blog</label>
            <div id="editor-container"></div>

            <!-- Input Hidden untuk menyimpan konten Quill -->
            <input type="hidden" name="isi_blog" id="content">

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="inline-flex justify-center px-5 py-2.5 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
                    Tambah Blog
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

    document.addEventListener("DOMContentLoaded", function () {
        var quill = new Quill('#editor-container', {
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
                    ['clean']                                       // Bersihkan format
                ]
            }
        });

        // Saat form dikirim, masukkan konten Quill ke input hidden
        document.querySelector('#blogForm').onsubmit = function () {
            document.querySelector('#content').value = quill.root.innerHTML;
        };
    });
</script>


</section>
@endsection