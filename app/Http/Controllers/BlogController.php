<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $query = Blog::orderBy('created_at', 'desc');

    if (!empty($search)) {
      $query->where('judul_blog', 'like', '%' . $search . '%');
    }

    $blogs = $query->paginate(5);
    $blogCount = Blog::count();

    return view('dashboard.blog.blog', compact('blogs', 'blogCount', 'search'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'judul_blog' => 'required|string|max:255',
      'isi_blog' => 'required|string',
      'kategori' => 'required|string|max:100',
      'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:10000',
    ]);

    // Buat slug awal dari judul
    $slug = Str::slug($validated['judul_blog']);
    $blogData = array_merge($validated, [
      'tanggal_penulisan' => now(),
      'slug' => $slug, // Set slug sementara
    ]);

    if ($request->hasFile('gambar_cover')) {
      $coverFilename = time() . '_cover_' . $request->file('gambar_cover')->getClientOriginalName();
      $request->file('gambar_cover')->move(public_path('uploads/blogs'), $coverFilename);
      $blogData['gambar_cover'] = $coverFilename;
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
      'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:10000',
    ]);

    $blog->fill($validated);

    // Perbarui slug jika judul berubah
    if ($blog->isDirty('judul_blog')) {
      $slug = Str::slug($validated['judul_blog']) . '-' . $blog->id_blog;
      $blog->slug = $slug;
    }

    if ($request->hasFile('gambar_cover')) {
      if ($blog->gambar_cover && file_exists(public_path('uploads/blogs/' . $blog->gambar_cover))) {
        unlink(public_path('uploads/blogs/' . $blog->gambar_cover));
      }

      $filename = time() . '_' . $request->file('gambar_cover')->getClientOriginalName();
      $request->file('gambar_cover')->move(public_path('uploads/blogs'), $filename);
      $blog->gambar_cover = $filename;
    }

    $blog->save();

    return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil diupdate');
  }

  public function edit($id_blog)
  {
    $blog = Blog::findOrFail($id_blog);

    return view('dashboard.blog.perbaruiBlog', compact('blog'));
  }

  public function insert(){
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
