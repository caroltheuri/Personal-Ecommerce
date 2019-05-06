@extends('layout')

@section('content')
    <form method="POST" action="/products" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name"  placeholder="Enter Product Name" name="product_name">
            <input type="hidden" name="product_status" value="1">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        </div>
        <div class="inputItems">
            <label>Select Category:</label>
            <select  name="category_id" class="form-control">
                <option value=""> --- Select a category --- </option>
                @if (count($categories))
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                @endif
            </select>
        </div><br>
        <div class="form-group">
            <label for="product_description">Product Description</label>
            <textarea class="form-control"  id="product_description" name="product_description"  placeholder="Enter Product Description"></textarea>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price</label>
            <input type="text" class="form-control"  id="product_price" name="product_price"  placeholder="Enter Product Price">
        </div>
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
@endsection('content')