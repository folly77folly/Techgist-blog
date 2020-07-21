<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Blog;
use App\User;
use App\Category;
use Session;
use App\Mail\BlogPublished;


class BlogsController extends Controller
{
    public function __construct(){
        $this->middleware('author',['only'=>['create','store','edit','update']]);
        $this->middleware('admin',['only'=>['delete','trash','restore','permanentDelete']]);
    }
    
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
        //rules
        $rules = [
            'title' => 'required|min:5|max:160',
            'body' => 'required|min:20|',            
        ];

        $this->validate($request, $rules);

        $input = $request->all();
        //image upload
        if ($file = $request->file('featured_image')) {
            $name = uniqid() . ($file->getClientOriginalName());
            $name = strtolower(Str_replace(' ','-',$name));
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
        //mail 
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new BlogPublished($blogByUser, $user));
        }

        $request->session()->flash('blog_created_message', 'A New Blog Created Successfully');
        // Session::flash('blog_created_message', 'A New Blog Created Successfully');
        return redirect('/blogs');
    }

    public function show($slug){
        // $blog = Blog::findOrFail($id);
        $blog = Blog::where('slug',$slug)->first();
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
        //image upload
        if ($file = $request->file('featured_image')) {
            if($blog->featured_image){
                unlink('images/featured_images/'.$blog->featured_image);
            }
            $name = uniqid() . ($file->getClientOriginalName());
            $name = strtolower(Str_replace(' ','-',$name));
            $file->move('images/featured_images/', $name);
            $input['featured_image'] = $name;
        }
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
