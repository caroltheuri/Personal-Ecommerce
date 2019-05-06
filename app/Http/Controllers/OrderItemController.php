<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function index()
//     {
//         $order = DB::table('orders')
//         ->where('user_id', Auth::user()->id)
//         ->Where('order_status_id', 1)
//         ->first();
// $orderId = ( $order )? $order->id  : 0;

// $orderitems=OrderItem::all();

// $countCart= ( $order ) ?$order->orderitems->count():0;
// // dd($orders);
// return view('layouts.buyernav', compact(['orderId','products','orderitems','countCart','itemorder','itemid']));
//     }
    public function cart()
    {
        $order = DB::table('orders')
                ->where('user_id', Auth::user()->id)
                ->Where('order_status_id', 1)
                ->first();
        $orderId = ( $order )? $order->id  : 0;
        $products = DB::table('products')
                    ->get();
        $orderitems=OrderItem::all();
        foreach($orderitems as $item){
            $itemorder = $item->quantity;
            $itemid = $item->id;
        }
        // $countCart = ( $order ) ?$order->orderitems->count():0;
        // dd($orders);
        return view('products.cart', compact(['orderId','products','orderitems','countCart','itemorder','itemid']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate(request(),[
            'quantity'=>'required'

        ]);
        OrderItem::where('product_id', $request->product_id )
        // ->where('product_id', $request->product_id)
            ->update(request(['quantity']));

        session()->flash('success_message', 'You have updated the quantity successfully.!!');
        return redirect('/orderitemscart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        OrderItem::where('id', $id)
        ->delete();

        session()->flash('success_message', 'You have deleted cart items successfully!!');
        return back();
    }
}
