@extends('layout')

 @section('content')
 <br><a href="/buyers" class="btn btn-sm btn-primary">Go Back</a> <br>
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>Order Item_Id</th>
            <th>Order Number</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Created at</th>
            <th>Quantity</th>
            <th colspan="2" style="text-align:center">Actions</th>
        </tr>

        @foreach($orderitems as $orderitem)
        @if(Auth::user()->id == $orderitem->order->user_id && $orderitem->order->order_status_id == 1)
        <tr>
            <td>{{ $orderitem->id }}</td>
            <td>{{ $orderitem->order->order_number}}</td>
            @foreach($products as $product)
                @if($orderitem->product_id == $product->id)
                    <td>{{$product->product_name}}</td>
                @endif
            @endforeach
            <td>{{$orderitem->product_price}}</td>
            <td>{{ $orderitem->created_at->toFormattedDateString() }}</td>
                <form action="/orderitems/{{$orderitem->id}}" method="POST" onsubmit="return confirm('Are you sure you want to edit?')">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                   <input type="hidden" name="product_id" value="{{$orderitem->product_id}}">
                   <td><input type="number" name="quantity" value="{{$orderitem->quantity}}" style="width:65%;"></td>
                    <td><button class="btn btn-sm btn-primary" type="submit">Edit Quantity</button></td>
                </form>
            <td>
                <form action="/orderitems/{{$orderitem->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endif
        @endforeach

        <br>
        <form action="/orders/{{$orderId}}" method="POST" onsubmit="return confirm('Are you sure you want to place an order?')">
                  {{ csrf_field() }} {{ method_field('PATCH') }}
                  <input type="hidden" name="order_status_id" value="2">
                  @if(count($orderitems) > 0)
                  <button class="btn btn-sm btn-primary" type="submit">Place Order</button>
                  @endif
                </form>
      
    </table>

@endsection