@extends('layout')

@section('content')
    <form method="POST" action="/categories">
    {{ csrf_field() }}
    <div class="inputItems">
        <label>Select Category:</label>
        <select  name="category_parent" class="form-control">
            <option value="">--- Select a parent ---</option>
            @if (count($categories))
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="categoryName">Category Name</label>
        <input type="text" class="form-control" id="categoryName"  placeholder="Enter Category Name" name="category_name">
    </div> 
    <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection('content')