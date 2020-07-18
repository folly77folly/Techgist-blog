@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
        <div class="col-md-12">
            <h1>{{ $blog->title }}</h1>
        </div>
        <div class="col-md-12">
            <div class="btn-group">
                <a class ="btn btn-primary margin-left btn-sm" href="{{route('blogs.edit',[$blog->id])}}"> Edit </a>
                <form action="{{ route('blogs.delete', [$blog->id]) }}" method="POST">
                {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger btn-sm pull-left">Delete</button>
                {{ csrf_field() }}
            </div>
            </form>
        </div>
        </div>
        <div class="col-md-12">
        <p>{{ $blog->body }}</p>
        <hr>
        <strong>Categories:</strong>
        @foreach($blog->category as $category)
        <a href="{{route('categories.show', $category->slug) }}"><span>{{ $category->name }}</span></a>
        @endforeach
        </div>
    </div>
@endsection