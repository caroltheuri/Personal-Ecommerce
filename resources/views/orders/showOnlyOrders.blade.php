@extends('layout')


@section('content')
   
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Order Number</th>
            <th>No.Of Items in my order</th>
            <th>Order Status</th>
            <th>Created at</th>
            <th colspan="1" style="text-align:center">Actions</th>
            
        </tr>
        @foreach($orders as $order)
        @if(Auth::user()->id == $order->user_id && ($order->order_status_id == 2 || $order->order_status_id == 3))
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_number}}</td>
            <td>{{$countCart}}</td>
            @foreach($orderStatuses as $orderStatus)
                @if($order->order_status_id ==  $orderStatus->id)
                    <td>{{$orderStatus->order_status_type}}</td>
                @endif
            @endforeach
            <td>{{1}}</td>
            <td><a href="/orderitembuyer/{{$order->id}}" class="btn btn-sm btn-primary">View Items</a></td>
        </tr>
        @endif
        @endforeach
      
    </table>
    
@endsection