@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbtron">
            <h1> Edit Category Name</h1>
        </div>
        <div class="col-md-12">
        <form action="{{route('categories.update',[$category->id])}}" method="POST">
            {{method_field('patch')}}
                <div class="form-group">
                    <label for="tilte"></label>
                <input type="text" name="name" class="form-control" value ="{{$category->name}}">
                </div>
                <button class="btn btn-primary" type="submit">Update Category</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection