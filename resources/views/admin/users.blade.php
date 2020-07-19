@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Manage Users</h1>
    </div>
<div class="col-md-12">
    <div class="row">
        @foreach ($users as $user)
        <div class="col-md-4">
        <form action="{{route('users.update', $user->id)}}" method="POST">
        {{method_field('patch')}}
        <div class="form-group">
        <input type="text" class="form-control" value ="{{$user->name}}" disabled>
        </div>
        <div class="form-group">
        <select name="role_id" id="" class="form-control">
        <option selected>{{ $user->role->name }}</option>
        <option value="2">Author</option>
        <option value="3">subscriber</option>
        </select>
        </div>
        <div class="form-group">
        <input type="text" class="form-control" value ="{{$user->email}}" disabled>
        </div>
        <div class="form-group">
        <input type="text" class="form-control" value ="{{$user->created_at->diffForHumans()}}" disabled>
        </div>
        <div>
            <button class="btn btn-primary btn-xs pull-left col-md-12">Update</button>
        </div>        
    {{ csrf_field() }}
    </form>
    <form action="{{route('users.destroy', $user)}}" method="POST">
        {{method_field('delete')}}
        <button class="btn btn-danger pull-left col-md-12 btn-xs mt-1" type="submit">Delete</button>
        {{csrf_field()}}
    </form>
</div>
        @endforeach
    </div>
</div>

</div>
@endsection