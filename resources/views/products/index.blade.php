@extends('layout')


@section('content')
    <a href="/products/create"  class="btn btn-sm btn-warning" style="margin-top:10px;">Add product</a>
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Status</th>
            <th>Product Price</th>
            <th>User Name</th>
            <th>Category Name</th>
            <th>Product Description</th>
            <th>Created At</th>
            <th colspan="4" style="text-align:center">Actions</th>
        </tr>
        
        @foreach($products as $product)
        @if(Auth::user()->id == $product->user_id)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->product_status }}</td>
            <td>{{ $product->product_price }}</td>
            <td>{{ $product->user->name }}</td>
            <td>{{ $product->category['category_name'] }}</td>
            <td>{{ $product->product_description }}</td>
            <td>{{ $product->created_at->toFormattedDateString() }}</td>
            <td><a href="/products/edit/{{ $product->id }}" class="btn btn-sm btn-primary">Edit</a></td>
            <td><a href="/productfeatures/{{$product->id}}" class="btn btn-sm btn-primary">Add/ViewFeatures</a></td>
            <td><a href="/productimages/{{$product->id}}" class="btn btn-sm btn-primary">Add images</a></td>
            <td>
                <form action="/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endif
        @endforeach
        
    </table>
    
@endsection