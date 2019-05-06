@extends('layout')


@section('content')
    <a href="/orders"  class="btn btn-sm btn-warning" style="margin-top:10px;">Go Back</a>
    <form method="POST" action="/completeorders/{{$order->id}}/{{Auth::user()->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Quantity</th>
            <th>Created at</th>
        </tr>

        @foreach(Auth::user()->product as $one_product)
            @foreach($order->orderitems as $orderitem)
                @if( $one_product->id == $orderitem->product_id )
                <tr>
                <td>{{$orderitem->id}}</td>
                <td> {{$one_product->product_name}} </td>
                <td> {{$one_product->product_description}} </td>
                <td> {{$orderitem->quantity}} </td>
                <td> {{$orderitem->created_at->toFormattedDateString()}} </td>
                </tr>
                @endif
            @endforeach
        @endforeach

    </table>

    <button type="submit" class="btn btn-primary" >Complete Order</button>
    </form>
    
@endsection