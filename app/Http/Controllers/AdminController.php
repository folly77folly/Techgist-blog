<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\StaticCollections\Status;

class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['auth','admin'],['only'=>'blogs']);
        $this->middleware(['auth']);
    }
    public function index(){
        return view('admin.dashboard');
    }
    public function blogs(){
        $publishedBlogs = Blog::where('status', Status::$PUBLISHED)->latest()->get();
        $draftBlogs = Blog::where('status', Status::$DRAFT)->latest()->get();
        return view('admin.blogs', compact('publishedBlogs','draftBlogs'));
    }
}
