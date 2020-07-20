@extends('layouts.app')
@section('content')
@include('partials.tinymce')
    <div class="container-fluid">
        <div class="jumbotron">
        <h1> Edit | {{$blog->title}}</h1>
        </div>
        <div class="col-md-12">
        <form action="{{route('blogs.update',[$blog->id])}}" method="POST" enctype="multipart/form-data">
            {{method_field('patch')}}
                <div class="form-group">
                    <label for="tilte"></label>
                <input type="text" name="title" class="form-control" value ="{{$blog->title}}">
                </div>
                <div class="form-group">
                    <label for="body"></label>
                    <textarea name="body" class="form-control">{{$blog->body}}</textarea>
                </div>
                <div class="form-group form-check form-check-inline">
                    {{ $blog->category->count() ? 'Current Categories: ': '' }} &nbsp;
                    @foreach($blog->category as $category)
                    <input type="checkbox" checked value="{{ $category->id }}" name="category_id[]" class="form-check-input">
                    <label for="" class="form-check-label margin-left">{{$category->name}}</label>
                    @endforeach
                </div>
                <div class="form-group form-check form-check-inline">
                    {{ $filtered->count() ? 'Unused Categories: ': '' }} &nbsp;
                    @foreach($filtered as $category)
                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input">
                    <label for="" class="form-check-label margin-left">{{$category->name}}</label>
                    @endforeach
                </div>
                <div class=form-group>
                    <label class="btn btn-default">
                    <span class="btn btn-outline btn-sm btn-info">Featured Image</span>
                    <input type="file" name="featured_image" class="form-control" hidden>
                </label>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Update blog</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection