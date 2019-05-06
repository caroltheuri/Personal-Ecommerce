<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Product;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }
    public function layout(){

        $orders = Order::all();
        $orderitems = OrderItem::all();
        $products = Product::all();
        $order = Order::where( 'user_id', Auth::user()->id )
        ->Where('order_status_id', 1)
        ->first();
        $orderId = ( $order )? $order->id  : 0;
        $countCart= ( $order ) ?$order->orderitems->count():0;
        foreach($orderitems as $item){
            $itemorder = $item->quantity;
            $itemid = $item->id;
        }
        return view('layout', compact(['orders','orderId','orderitems','products','countCart','itemorder','itemid']));
    }
    
}
