@extends('layout')


@section('content')
   
   <br><a href="/orderbuyer" class="btn btn-sm btn-primary">Go Back</a> <br>
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>Order Item_Id</th>
            <th>Order Number</th>
            <th>Product Name</th>
            <th>Seller Name</th>
            <th>Order Status</th>
            <th>Quantity</th>
            <th>Product Price</th>
            <th>Created at</th>
        </tr>

        @foreach($orderitems as $orderitem)
        @if(Auth::user()->id == $orderitem->order->user_id && ($orderitem->order->order_status_id == 2 || $orderitem->order->order_status_id == 3))
        <tr>
            <td>{{ $orderitem->id }}</td>
            <td>{{ $orderitem->order->order_number}}</td>
            @foreach($products as $product)
                @if($orderitem->product_id == $product->id)
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->user->name}}</td>
                @endif
            @endforeach
            @foreach($orderStatuses as $orderStatus)
                @if($orderitem->order->order_status_id ==  $orderStatus->id)
                    <td>{{$orderStatus->order_status_type}}</td>
                @endif
            @endforeach
            <td>{{$orderitem->quantity}}</td>
            <td>{{$orderitem->product_price}}</td>
            <td>{{ $orderitem->created_at->toFormattedDateString() }}</td>
            
        </tr>
        @endif
        @endforeach
      
    </table>
    
@endsection