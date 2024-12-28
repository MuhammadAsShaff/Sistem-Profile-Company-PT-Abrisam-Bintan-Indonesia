<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $query = Blog::orderBy('created_at', 'desc');
    $kategori = $request->input('kategori');

    if (!empty($search)) {
      $query->where(function ($q) use ($search) {
        $q->where('judul_blog', 'like', '%' . $search . '%')
          ->orWhere('tanggal_penulisan', 'like', '%' . $search . '%')
          ->orWhere('kategori', 'like', '%' . $search . '%');
      });
    }

    // Filter berdasarkan role (posisi admin)
    if (!empty($kategori)) {
      $query->where('kategori', '=', $kategori);
    }

    // Ambil posisi unik untuk dropdown
    $kategoris = Blog::distinct()->pluck('kategori')->filter()->toArray(); // Ambil posisi unik dan hilangkan null

    $blogs = $query->paginate(5);
    $blogCount = Blog::count();

    return view('dashboard.blog.blog', compact('blogs', 'blogCount', 'search', 'kategori', 'kategoris'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'judul_blog' => 'required|string|max:255',
      'isi_blog' => 'required|string',
      'kategori' => 'required|string|max:100',
      'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Buat slug awal dari judul
    $slug = Str::slug($validated['judul_blog']);
    $blogData = array_merge($validated, [
      'tanggal_penulisan' => now(),
      'slug' => $slug, // Set slug sementara
    ]);

    if ($request->hasFile('gambar_cover')) {
      $file = $request->file('gambar_cover');
      $filename = time() . '_' . $file->getClientOriginalName();

      // Memastikan direktori tujuan ada
      $destinationPath = public_path('uploads/blogs');
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
      }

      // Menggunakan Intervention Image untuk resize dan crop gambar
      $image = Image::make($file); // Membuka file gambar
      $image->fit(1080, 640, function ($constraint) {
        $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
      });

      // Simpan gambar yang sudah di-resize dan di-crop
      $image->save($destinationPath . '/' . $filename);

      // Menyimpan nama file gambar
      $blogData['gambar_cover'] = $filename;
    }

    // Simpan blog terlebih dahulu untuk mendapatkan id_blog
    $blog = Blog::create($blogData);

    // Update slug dengan id_blog agar unik
    $blog->slug = $slug . '-' . $blog->id_blog;
    $blog->save();

    return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil ditambahkan');
  }


  public function update(Request $request, $id_blog)
  {
    $blog = Blog::findOrFail($id_blog);

    $validated = $request->validate([
      'judul_blog' => 'required|string|max:255',
      'isi_blog' => 'required|string',
      'kategori' => 'required|string|max:100',
      'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Perbarui slug jika judul berubah
    if ($blog->isDirty('judul_blog')) {
      $slug = Str::slug($validated['judul_blog']) . '-' . $blog->id_blog;
      $blog->slug = $slug;
    }

    // Jika ada file gambar baru diunggah
    if ($request->hasFile('gambar_cover')) {
      // Hapus gambar lama jika ada
      if (!empty($blog->gambar_cover) && file_exists(public_path('uploads/blogs/' . $blog->gambar_cover))) {
        unlink(public_path('uploads/blogs/' . $blog->gambar_cover));
      }

      // Proses file baru
      $file = $request->file('gambar_cover');
      $filename = time() . '_' . $file->getClientOriginalName();

      // Pastikan direktori tujuan ada
      $destinationPath = public_path('uploads/blogs');
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
      }

      // Resize dan simpan gambar baru
      $image = Image::make($file);
      $image->fit(1080, 640, function ($constraint) {
        $constraint->upsize();
      });
      $image->save($destinationPath . '/' . $filename);

      // Update nama file gambar
      $blog->gambar_cover = $filename;
    }

    // Simpan perubahan ke database
    $blog->save();

    return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil diupdate');
  }



  public function edit($id_blog)
  {
    $blog = Blog::findOrFail($id_blog);

    return view('dashboard.blog.perbaruiBlog', compact('blog'));
  }

  public function insert()
  {
    return view('dashboard.blog.insertBlog');
  }

  public function destroy($id_blog)
  {
    $blog = Blog::findOrFail($id_blog);

    if ($blog->gambar_cover && file_exists(public_path('uploads/blogs/' . $blog->gambar_cover))) {
      unlink(public_path('uploads/blogs/' . $blog->gambar_cover));
    }

    $blog->delete();

    return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil dihapus.');
  }
}
