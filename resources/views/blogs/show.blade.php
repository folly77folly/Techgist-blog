@extends('layouts.app')
{{-- @if ($blog->title)

@else
@include('partials.meta_static')  
@endif --}}
@include('partials.meta_dynamic')
{{-- @section('meta_title'){{$blog->meta_title}}
@endsection
@section('meta_description'){{$blog->meta_description}}
@endsection --}}
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <div class="col-md-12">
                @if ($blog->featured_image)
                <img src="/images/featured_images/{{$blog->featured_image? $blog->featured_image: '' }}" 
                alt="{{ Str::limit($blog->title, 10, '...') }}" class="img-responsive featured_image">
                @endif
            </div>
        <div class="col-md-12">
            <h1>{{ $blog->title }}</h1>
        </div>
        @if (Auth::user())
            @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id)        
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
        @endif
        @endif
        </div>
        <div class="col-md-12">
        {!! $blog->body !!}
        @if ($blog->user)
        Author : <a href="{{route('users.show',$blog->user->name)}}">{{$blog->user->name}}</a> | Posted : {{$blog->created_at->diffForHumans()}}
        @endif
        <hr>
        <strong>Categories:</strong>
        @foreach($blog->category as $category)
        <a href="{{route('categories.show', $category->slug) }}"><span>{{ $category->name }}</span></a>
        @endforeach
        </div>
        <hr>
        <aside>
            <div id="disqus_thread"></div>
                <script>
                (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://rerte.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
                })();
                </script>
        </aside>
    </div>
@endsection