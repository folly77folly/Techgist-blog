@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        @if (Auth::user() && Auth::user()->role_id === 1)
        <h1>Admin Dasboard</h1>
        @elseif(Auth::user() && Auth::user()->role_id === 2)
        <h1>Author Dasboard</h1>
        @elseif(Auth::user() && Auth::user()->role_id === 3)
        <h1>Subscriber Dasboard</h1>
        @endif
    </div>
    @if (Auth::user() && Auth::user()->role_id === 1)
    <div class="col-md-12">
        <button class="btn btn-primary margin-left">
        <a class ="text-white" href="{{route('blogs.create')}}">Create blog</a>
        </button>
        <button class="btn btn-primary margin-left">
            <a class ="text-white" href="{{route('admin.blogs')}}">Publish blog</a>
            </button>
        <button class="btn btn-danger margin-left">
            <a class ="text-white" href="{{route('blogs.trash')}}">Trashed blog</a>
        </button>
        <button class="btn btn-success margin-left">
            <a class ="text-white" href="{{route('categories.create')}}">Create Category</a>
        </button>
    </div>
    @endif
    @if (Auth::user() && Auth::user()->role_id === 2)
    <div class="col-md-12">
        <button class="btn btn-primary margin-left">
        <a class ="text-white" href="{{route('blogs.create')}}">Create blog</a>
        </button>
        <button class="btn btn-success margin-left">
            <a class ="text-white" href="{{route('categories.create')}}">Create Category</a>
        </button>
    </div>
    @endif
    @if (Auth::user() && Auth::user()->role_id === 3)
    <div class="col-md-12">
        <button class="btn btn-primary margin-left">
        <a class ="text-white" href="#">What Can I do?</a>
        </button>
    </div>
    @endif
</div>
@endsection