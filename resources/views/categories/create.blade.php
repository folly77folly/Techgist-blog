@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbtron">
            <h1> Create A New Category</h1>
        </div>
        <div class="col-md-6">
            <form action="{{route('categories.store')}}" method="POST">
                <div class="form-group">
                    <label for="tilte">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">Add New Category</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection