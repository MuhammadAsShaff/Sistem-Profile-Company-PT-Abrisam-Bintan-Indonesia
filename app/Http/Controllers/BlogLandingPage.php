<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogLandingPage extends Controller
{
    public function index(Request $request)
    {
        $recentBlogs = Blog::orderBy('tanggal_penulisan', 'desc')->take(10)->get();
        $blogs = Blog::orderBy('tanggal_penulisan', 'desc')->paginate(3);

        // Check for AJAX request
        if ($request->ajax()) {
            return view('blog.blogContent', compact('blogs'))->render();
        }

        return view('blog.layoutBlog', compact('blogs', 'recentBlogs'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('judul_blog', 'like', '%' . $query . '%')
            ->orWhere('isi_blog', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('blog.blogContent', compact('blogs'))->render();
    }

    public function isiBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Mendapatkan 3 blog terkait secara acak, tidak termasuk blog saat ini
        $relatedBlogs = Blog::where('id_blog', '!=', $blog->id_blog)
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Debugging: Tampilkan ID dari blog terkait yang diambil secara acak
        foreach ($relatedBlogs as $related) {
            logger()->info("Related Blog ID: {$related->id_blog}");
        }

        return view('blog.isiBlog', compact('blog', 'relatedBlogs'));
    }

}
