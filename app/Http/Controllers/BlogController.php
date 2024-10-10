<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session
        session(['previous_url' => url()->full()]);

        // Ambil query pencarian
        $search = $request->input('search');

        // Query dasar untuk mengambil semua blog
        $query = Blog::orderBy('created_at', 'desc');

        // Filter berdasarkan pencarian judul blog
        if (!empty($search)) {
            $query->where('judul_blog', 'like', '%' . $search . '%');
        }

        $blogCount = blog::count();
        // Lakukan paginasi dengan limit 5
        $blogs = $query->paginate(5);

        return view('dashboard.blog.blog', compact('blogs', 'blogCount','search'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_blog' => 'required|string|max:255',
            'isi_blog' => 'required|string',
            'gambar_ilustrasi' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Persiapan data blog baru
        $blogData = [
            'judul_blog' => $request->input('judul_blog'),
            'isi_blog' => $request->input('isi_blog'),
            'tanggal_penulisan' => now(),
        ];

        // Jika ada file gambar diupload, simpan file
        if ($request->hasFile('gambar_ilustrasi')) {
            $file = $request->file('gambar_ilustrasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $blogData['gambar_ilustrasi'] = $filename;
        }

        if ($request->hasFile('gambar_cover')) {
            $file = $request->file('gambar_cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $blogData['gambar_cover'] = $filename;
        }

        // Simpan data blog ke database
        Blog::create($blogData);

        return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil ditambahkan');
    }

    public function update(Request $request, $id_blog)
    {
        $blog = Blog::find($id_blog);

        if (!$blog) {
            return redirect()->back()->with('error', 'Blog tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'judul_blog' => 'required|string|max:255',
            'isi_blog' => 'required|string',
            'gambar_ilustrasi' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $blog->judul_blog = $request->input('judul_blog');
        $blog->isi_blog = $request->input('isi_blog');

        // Jika ada file gambar diupload, simpan file baru
        if ($request->hasFile('gambar_ilustrasi')) {
            if ($blog->gambar_ilustrasi && file_exists(public_path('uploads/blogs/' . $blog->gambar_ilustrasi))) {
                unlink(public_path('uploads/blogs/' . $blog->gambar_ilustrasi));
            }
            $file = $request->file('gambar_ilustrasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $blog->gambar_ilustrasi = $filename;
        }

        if ($request->hasFile('gambar_cover')) {
            if ($blog->gambar_cover && file_exists(public_path('uploads/blogs/' . $blog->gambar_cover))) {
                unlink(public_path('uploads/blogs/' . $blog->gambar_cover));
            }
            $file = $request->file('gambar_cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $blog->gambar_cover = $filename;
        }

        $blog->save();

        return redirect()->back()->with('success', 'Blog berhasil diupdate.');
    }

    public function destroy($id_blog)
    {
        $blog = Blog::find($id_blog);

        if (!$blog) {
            return redirect()->back()->with('error', 'Blog tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if ($blog->gambar_ilustrasi && file_exists(public_path('uploads/blogs/' . $blog->gambar_ilustrasi))) {
            unlink(public_path('uploads/blogs/' . $blog->gambar_ilustrasi));
        }
        if ($blog->gambar_cover && file_exists(public_path('uploads/blogs/' . $blog->gambar_cover))) {
            unlink(public_path('uploads/blogs/' . $blog->gambar_cover));
        }

        $blog->delete();

        return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil dihapus.');
    }
}
