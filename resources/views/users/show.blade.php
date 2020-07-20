@extends('layouts.app')

@section('content')
    <div class="container">
    <h3>{{$user->name}}'s recent's blogs</h3>
    <p>Role : {{$user->role->name}}</p>
    <hr>
    @foreach ($user->blogs as $blog)
    <h4><a href="{{route('blogs.show', $blog->id)}}">{{$blog->title}}</a></h4>
        {!! $blog->body !!}
    @endforeach
    </div>
@endsection