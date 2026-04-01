<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('blogCategory')->where('status','Published')->latest()->paginate(6);
        // $blogs = BlogCategory::where('status','Published')->latest()->paginate(6);

        return view('blog.index',compact('blogs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $single = Blog::where('slug',$slug)->first();
       
        return view('blog.single',compact('single'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function category($category){
        $category = BlogCategory::with('blogs')->where('slug',$category)->first();
        $blogs = $category->blogs()->with('blogCategory')->paginate(6);

        return view('blog.category',compact('blogs','category'));
    }
}
