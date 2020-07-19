@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Manage Users</h1>
    </div>
<div class="col-md-12">
    <div class="row">
        @foreach ($users as $user)
        <p> {{ $user->name }}</p>
        @endforeach
    </div>
</div>

</div>
@endsection