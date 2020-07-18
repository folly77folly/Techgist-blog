@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Trashed Blogs</h1>
    </div>
    <div class="col-md-12">
        @foreach ($trashedBlogs as $blog)
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->body }}</p>
            <div class="btn-group">

                <form action="{{route('blogs.restore',[$blog->id])}}" method="get">
                    <button type="submit" class="btn btn-success btn-xs pull-left margin-left">Restore</button>
                    {{csrf_field()}}
                </form>
                <form action="{{route('blogs.permanent-delete',[$blog->id])}}" method="post">
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger btn-xs pull-left margin-left">Delete</button>
                    {{csrf_field()}}
            </div>
            </form>
        @endforeach
    </div>
</div>

@endsection