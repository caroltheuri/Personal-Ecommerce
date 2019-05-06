@extends('layout')

@section('content')
    <form method="POST" action="/products/{{ $product->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        </div>
        <div class="form-group">
            <label for="product_status">Product Status</label>
            <input type="number" class="form-control" id="product_status" name="product_status" value="{{ $product->product_status}}">
        </div>
        <div class="inputItems">
            <label>Select Category:</label>
            <select  name="product_parent" class="form-control">
                <option value="{{ $product->category_id }}">---- {{ $product->category->category_name }} ---- </option>
            </select>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description</label>
            <textarea class="form-control"  id="product_description" name="product_description">{{ $product->product_description}}</textarea>
        </div>
        <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price}}">
            </div>
        <button class="btn btn-sm btn-warning"><a href="/products">Go back</a></button>
        <button type="submit" class="btn btn-primary">Update Products</button>
    </form>
@endsection('content')