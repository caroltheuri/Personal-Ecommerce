@extends('layout')

@section('content')
    <form method="POST" action="/productimages" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="product_price">Upload Image</label> <br>
            <input type="hidden" value="{{ $product->id }}"  name="product_id" >
            <input type="file" name="product_image" id="product_image" accept="image/jpeg, image/jpg, image/gif">
        </div>
        <button type="submit" class="btn btn-primary" >Insert Image</button>
        <a href="/products"  class="btn btn-sm btn-warning" style="margin-top:10px;">Go Back</a>
    </form>
    <br>
    @if(count($product->productimages))
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="1">Actions</th>
        </tr>

        @foreach($product->productimages as $productimage)
        <tr>
            <td>{{ $productimage->id }}</td>
            <td><img src="/{{ $productimage->product_image }}" alt="" style="width:20%;"></td>
            <td>{{ $productimage->created_at->diffForHumans() }}</td>
            <td>{{ $productimage->updated_at->diffForHumans() }}</td>
            <td>
                <form action="/productimages/{{ $productimage->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    @endif
    {{--  @foreach($productimages as $productimage)
    <img src="/images/{{ $productimage->product_image }}">
    @endforeach  --}}



@endsection('content')