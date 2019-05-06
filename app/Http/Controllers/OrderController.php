<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;
use App\Order;
use App\User;
use App\OrderUser;
use App\Product;
use App\OrderStatus;
use Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
                ->where('order_status_id', 2)
                ->orWhere('order_status_id', 3)
                ->get();
        // $orderitems = OrderItem::all();
        $order = Order::where('order_status_id', 2)
        ->first();
        $orderitems= OrderItem::all();
        foreach($orderitems as $orderitem){
            $orderitemid = $orderitem->product_id;
        }
        $products = Product::all();
        foreach($products as $product){
            $productid = $product->user_id;
            $productids=$product->id;
        }
        $users = User::all();
        $orderStatuses = OrderStatus::all();
        
        // $countCart= ( $order ) ?$order->orderitems->count():0;
        return view('orders.index',compact(['orders','order','products','productid','productids','users','orderStatuses','orderitemid','orderitem']));
    }
    public function indexBuyer($orderid)
    {
        // $orders = DB::table('orders')
        //         ->where('order_status_id', 2)
        //         ->orWhere('order_status_id', 3)
        //         ->get();
        // $orderitems = OrderItem::all();
        // $order = Order::where( 'user_id', Auth::user()->id )
        // ->Where('order_status_id', 1)
        // ->first();
        // $orderId = ( $order )? $order->id  : 0;
        // $countCart= ( $order ) ?$order->orderitems->count():0;
        // $products = Product::all();
        // $users = User::all();
        // $orderStatuses = OrderStatus::all();
        // foreach($orderitems as $item){
        //     $itemorder = $item->quantity;
        //     $itemid = $item->id;
        // }
        $order= Order::find($orderid);
        $orderitems=$order->orderitems;
        $products = Product::all();
        $orderStatuses = OrderStatus::all();
        return view('orders.indexBuyer', compact(['order','orderitems','products','orderStatuses']));
        // return view('orders.indexBuyer',compact(['orders','orderId','orderitems','products','users','countCart','orderStatuses','itemorder','itemid']));
    }
    public function orderBuyer()
    {
        $orders = DB::table('orders')
                ->where('order_status_id', 2)
                ->orWhere('order_status_id', 3)
                ->get();
        $orderitems = OrderItem::all();
        $order = Order::where( 'user_id', Auth::user()->id )
        ->Where('order_status_id', 2)
        ->first();
        $orderId = ( $order )? $order->id  : 0;
        $countCart= ( $order ) ?$order->orderitems->count():0;
        $products = Product::all();
        $orderStatuses = OrderStatus::all(); 
        return view('orders.showOnlyOrders',compact(['orders','orderId','orderitems','products','countCart','orderStatuses']));
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
        $this->validate(request(),[
            'user_id'=>'required',
            'product_id'=>'required',
            'product_price'=>'required',
            'seller_id'=>'required',
        ]);
        
        $orders = Order::where('user_id', Auth::user()->id)
        ->where('order_status_id', 1)->get();
        if(!count($orders)){
            $seller = User::find($request->seller_id);
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->order_status_id = 1;
            $order->order_number = mt_rand();

           if( $order->save() ){
               $order_id = $order->id;
           }

            $seller->addCart()->attach($order_id);
            $orderitem = new OrderItem();
            $orderitem->order_id=$order_id;
            $orderitem->product_id = $request->product_id;
            $orderitem->product_price = $request->product_price;
            $orderitem->quantity = 1;
            $orderitem->save();
            return redirect('/buyers');
        }
        else{
            $order = Order::where('user_id', Auth::user()->id)
                            ->where('order_status_id', 1)->first();
                $order_id = $order->id;

            $orderInCart = OrderUser::where('user_id',$request->seller_id)
            ->where('order_id',$order_id)->get();

            if( !count($orderInCart) ) {
                $seller = User::find($request->seller_id);
                $seller->addCart()->attach($order_id);
            }
            
            $orderitem = new OrderItem();
            $orderitem->order_id=$order_id;
            $orderitem->product_id = $request->product_id;
            $orderitem->product_price = $request->product_price;
            $orderitem->quantity = 1;
            $orderitem->save();
            return redirect('/buyers');
        }
        
        return back();
    }
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $order = Order::find($request->id)->orderitems();
        $order=Order::find($id);
        $users = User::all();
        return view('orders.show', compact(['order','users']));
        // return view('orders.show', compact(['order','users','productid','orderitems','products']));
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
    public function update(Request $request, $id)
    {
        Order::where('order_status_id', 1)
            ->update(request(['order_status_id']));
        // OrderItem::where('id', $request->itemid)
        //     ->update(request(['quantity']));
        session()->flash('success_message', 'You have placed order successfully!!');
        return back();
    }
    public function completeOrder($id, $seller_id)
    {   
        OrderUser::where('user_id', $seller_id)
                ->where('order_id', $id)->update(['completed' => 1]);

        $unCompletedorders=OrderUser::where('order_id',$id)->where('completed', 0)->get();
        if(!count($unCompletedorders)){
            Order::where('id', $id)
                    ->update(['order_status_id' => 3]);
        }
        // $orderuser = 
        // if($orderuser->seller_id == Auth::user()->id){
        //     $orderuser->completed = 1;
        //     $orderuser->save();
        
        // $orderuser= $orderuser->where('order_id',$id)
        //                       ->where('completed', 1)
        //                       ->get();
        // $order=$orderuser->Order::where('order_status_id', 2)
        // ->update(request(['order_status_id']));
        session()->flash('success_message', 'You have completed order successfully!!');
        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       
    }
}
