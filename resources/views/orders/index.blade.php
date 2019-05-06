@extends('layout')


@section('content')
   
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Buyer Id</th>
            <th>Order Number</th>
            <th>Created at</th>
            <th colspan="1" style="text-align:center">Actions</th>
        </tr>
                @foreach( Auth::user()->product as $One_product )
                    @foreach( Auth::user()->addCart()->where('order_status_id','>', 1)->get() as $order )
                        @foreach( $order->orderitems as $orderItem )
                        
                            @if( $One_product->id == $orderItem->product_id)
                            <tr>
                                <td>{{$order->id}}</td>
                                @foreach($users as $user)
                                @if($order->user_id == $user->id)
                                <td>{{$user->name}}</td>
                                @endif
                                @endforeach
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->created_at->toFormattedDateString()}}</td>
                                <td><a href="/orders/{{$order->id}}" class="btn btn-sm btn-primary">View and Complete</a></td>
                            </tr>
                            @endif
                            
                        @endforeach
                    @endforeach
                @endforeach
    </table>
    
@endsection