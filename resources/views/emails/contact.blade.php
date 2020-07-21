@extends('layouts.app')
@section('content')
@include('partials.tinymce')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1> Contact Page</h1>
        </div>
        <div class="col-md-12">

            @include('partials.error-message')
            <form action="{{route('mail.send')}}" method="POST">
                <div class="form-group">
                <label for="title">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="mail_message" class="form-control">{{ old('mail_message') }}</textarea>
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Say Hi</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection