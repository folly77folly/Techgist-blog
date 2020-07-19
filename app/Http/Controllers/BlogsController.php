<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Blog;
use App\Category;


class BlogsController extends Controller
{
    //
    public function index(){
        // $blogs = Blog::latest()->get();
        $blogs = Blog::where('status', 1)->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    public function create(){
        $categories = Category::latest()->get();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request){
        $input = $request->all();
        //image upload
        if ($file = $request->file('featured_image')) {
            $name = uniqid() . ($file->getClientOriginalName());
            $file->move('images/featured_images/', $name);
            $input['featured_image'] = $name;
        }
        //meta stuffs
        $input['slug']= Str::slug($request['title']);
        $input['meta_title']= Str::limit($request['title'], 50);
        $input['meta_description']= Str::limit($request['title'], 100,'...');
        // Blog instance
        // $blog = Blog::create($input);

        //user instance
        $blogByUser = $request->user()->blogs()->create($input);

        // $newBlog = new Blog();
        // $newBlog->title = $request->title;
        // $newBlog->body = $request->body;
        // $newBlog->save();
        //sync with categories
        if ($request->category_id) {
            $blogByUser->category()->sync($request->category_id);
        }
        return redirect('/blogs');
    }

    public function show($id){
        $blog = Blog::findOrFail($id);
        return view('/blogs.show', compact('blog'));
    }

    public function edit($id){
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        $bc = array();
        foreach ($blog->category as  $c) {
            $bc[] = ($c->id-1);
        }
        $filtered = Arr::except($categories, $bc);
        return view('/blogs.edit', ['blog'=>$blog, 'categories'=> $categories, 'filtered'=>$filtered]);
    }

    public function update(Request $request, $id){

        $input = $request->all();
        $blog = Blog::findOrFail($id);
        $blog->update($input);
        //sync with categories
        if ($request->category_id) {
            $blog->category()->sync($request->category_id);
        }
        return redirect('/blogs');

    }

    public function delete($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('blogs');

    }
    public function trash(){
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));

    }
    public function restore($id){
        $restoreBlog = Blog::onlyTrashed()->findOrFail($id);
        $restoreBlog->restore($restoreBlog);
        return redirect('blogs');

    }
    public function permanentDelete($id){
        $toBeDeletedBlog = Blog::onlyTrashed()->findOrFail($id);
        $toBeDeletedBlog->forceDelete($toBeDeletedBlog);
        return redirect('blogs');

    }
}
