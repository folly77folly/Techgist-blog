@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbtron">
            <h1>{{ $category->name }}</h1>
        <div class="col-md-12">
            <div class="btn-group">
                <a class ="btn btn-primary margin-left btn-sm" href="{{route('categories.edit',[$category->id])}}"> Edit </a>
                <form action="{{ route('categories.destroy', [$category->id]) }}" method="POST">
                {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger btn-sm pull-left">Delete</button>
                {{ csrf_field() }}
                </form>
            </div>
        </div>
        </div>
        <div class="col-md-12">
            @foreach ($category->blog as $blog)
        <h3><a href="{{route('blogs.show', $blog->id)}}">{{ $blog->title }}</a></h3>
            @endforeach
        </div>
    </div>
@endsection