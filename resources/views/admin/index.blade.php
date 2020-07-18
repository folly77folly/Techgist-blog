@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Admin Dasboard</h1>
    </div>
    <div class="col-md-12">
        <button class="btn btn-primary margin-left">
        <a class ="text-white" href="{{route('blogs.create')}}">Create blog</a>
        </button>
        <button class="btn btn-danger margin-left">
            <a class ="text-white" href="{{route('blogs.trash')}}">Trashed blog</a>
        </button>
        <button class="btn btn-success margin-left">
            <a class ="text-white" href="{{route('categories.create')}}">Create Category</a>
        </button>
    </div>
</div>
@endsection