<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
public function index(Request $request)
{
session(['previous_url' => url()->full()]);

$search = $request->input('search');
$query = Blog::orderBy('created_at', 'desc');

if (!empty($search)) {
$query->where('judul_blog', 'like', '%' . $search . '%');
}

$blogCount = Blog::count();
$blogs = $query->paginate(5);

return view('dashboard.blog.blog', compact('blogs', 'blogCount', 'search'));
}

public function store(Request $request)
{
$validated = $request->validate([
'judul_blog' => 'required|string|max:255',
'isi_blog' => 'required|string',
'gambar_ilustrasi' => 'nullable|mimes:jpg,jpeg,png|max:2048',
'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:2048',
]);

$blogData = [
'judul_blog' => $validated['judul_blog'],
'isi_blog' => $validated['isi_blog'],
'tanggal_penulisan' => now(),
];

if ($request->hasFile('gambar_ilustrasi')) {
$filename = time() . '_' . $request->file('gambar_ilustrasi')->getClientOriginalName();
$request->file('gambar_ilustrasi')->move(public_path('uploads/blogs'), $filename);
$blogData['gambar_ilustrasi'] = $filename;
}

if ($request->hasFile('gambar_cover')) {
$filename = time() . '_' . $request->file('gambar_cover')->getClientOriginalName();
$request->file('gambar_cover')->move(public_path('uploads/blogs'), $filename);
$blogData['gambar_cover'] = $filename;
}

Blog::create($blogData);

return redirect()->route('dashboard.blog.blog')->with('success', 'Blog berhasil ditambahkan');
}

public function update(Request $request, $id_blog)
{
$blog = Blog::find($id_blog);
if (!$blog) {
return redirect()->back()->with('error', 'Blog tidak ditemukan.');
}

$validated = $request->validate([
'judul_blog' => 'required|string|max:255',
'isi_blog' => 'required|string',
'gambar_ilustrasi' => 'nullable|mimes:jpg,jpeg,png|max:2048',
'gambar_cover' => 'nullable|mimes:jpg,jpeg,png|max:2048',
]);

$blog->judul_blog = $validated['judul_blog'];
$blog->isi_blog = $validated['isi_blog'];

if ($request->hasFile('gambar_ilustrasi')) {
if (file_exists(public_path('uploads/blogs/' . $blog->gambar_ilustrasi))) {
unlink(public_path('uploads/blogs/' . $blog->gambar_ilustrasi));
}
$filename = time() . '_' . $request->file('gambar_ilustrasi')->getClientOriginalName();
$request->file('gambar_ilustrasi')->move(public_path('uploads/blogs'), $filename);
$blog->gambar_ilustrasi = $filename;
}

if ($request->hasFile('gambar_cover')) {
if (file_exists(public_path('uploads/blogs/' . $blog->gambar_cover))) {
unlink(public_path('uploads/blogs/' . $blog->gambar_cover));
}
$filename = time() . '_' . $request->file('gambar_cover')->getClientOriginalName();
$request->file('gambar_cover')->move(public_path('uploads/blogs'), $filename);
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