<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;


class BlogLandingPage extends Controller
{
    public function index(){
        return view('blog.layoutBlog');
    }
}
