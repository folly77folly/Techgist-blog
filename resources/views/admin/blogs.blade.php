@extends('layouts.app')
@include('partials.meta_static')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Manage Blogs</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Published</h3>
        <hr>
        @foreach ($publishedBlogs as $blog)
            <h2> <a href=" {{route('blogs.show',$blog->id) }} ">{{ $blog->title }}</a></h2>
            {{-- {!! Str::limit($blog->body, 100, '...') !!} --}}
            <form action="{{route('blogs.update',[$blog->id])}}" method="POST">
                {{method_field('patch')}}
                <input type="checkbox" value="0" name = "status" checked style="display: none">
                <button class="btn btn-warning btn-xs" type="submit">Save as Draft</button>
            {{ csrf_field() }}
            </form>
        @endforeach

    </div>
    <div class="col-md-6">
        <h3>Drafts</h3>
        <hr>
        @foreach ($draftBlogs as $blog)
            <h2> <a href=" {{route('blogs.show',$blog->id) }} ">{{ $blog->title }}</a></h2>
            {{-- {!! Str::limit($blog->body, 100, '...') !!} --}}
            <form action="{{route('blogs.update',[$blog->id])}}" method="POST">
                {{method_field('patch')}}
                <input type="checkbox" value="1" name = "status" checked style="display: none">
                <button class="btn btn-success btn-xs" type="submit">Publish</button>
            {{ csrf_field() }}
            </form>
        @endforeach
    </div>
</div>
@endsection