@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbtron">
            <h1> Create A New Blog</h1>
        </div>
        <div class="col-md-12">
            <form action="{{route('blogs.store')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tilte"></label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body"></label>
                    <textarea name="body" class="form-control"></textarea>
                </div>
                <div class="form-group form-check form-check-inline">
                    @foreach($categories as $category)
                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input">
                    <label for="" class="form-check-label margin-left">{{$category->name}}</label>
                    @endforeach
                </div>
                <div class=form-group>
                    <label for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Create a new blog</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection