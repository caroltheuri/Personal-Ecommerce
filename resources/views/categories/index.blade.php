@extends('layout')


@section('content')
    <a href="/categories/create"  class="btn btn-sm btn-warning" style="margin-top:10px;">Add Category</a>
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Category Parent</th>
            <th>Children</th>
            <th>Created At</th>
            <th colspan="2">Actions</th>
        </tr>

        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>
             @foreach($categories as $parent)
                @if($category->category_parent == $parent->id)
                {{ $parent->category_name }}
                @endif
            @endforeach 
            </td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->created_at->toFormattedDateString() }}</td>
            <td><a href="/categories/edit/{{ $category->id }}" class="btn btn-sm btn-primary">Edit</a></td>
            <td>
                <form action="/categories/{{ $category->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
@endsection