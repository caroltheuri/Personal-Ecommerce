@extends('layout')

@section('content')
    <form method="POST" action="/categories/{{ $category->id}}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="inputItems">
        <label>Select Category:</label>
        <select  name="category_parent" class="form-control">
            <option value="">--- Select a parent ---</option>
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        </select>
    </div>
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name}}">
    </div>
    <button class="btn btn-sm btn-warning"><a href="/categories">Go back</a></button>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection('content')