<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductFeature;
use App\Feature;
use App\OrderItem;
use App\Order;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            request(),
            [
                'product_name' => 'required',
                'product_price' => 'required',
                'product_description' => 'required'
            ]
        );
        Product::create(request(['product_name', 'product_status', 'product_price', 'user_id', 'category_id', 'product_description']));
        session()->flash('success_message', 'You have created a new product!!');
        return redirect('/products');
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
        $product = Product::find($id);
        return view('products.edit', compact(['product']));
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
        $this->validate(request(), [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required'

        ]);
        Product::where('id', $id)
            ->update(request(['product_name', 'product_status', 'product_price', 'user_id', 'category_id', 'product_description']));

        session()->flash('success_message', 'You have updated the product successfully.!!');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)
            ->delete();

        return back();
    }

    // public function showProductstoBuyers()
    // {
    //     $orders = DB::table('orders')
    //         ->where('user_id', 'Auth::user()')
    //         ->orWhere('order_status_id', 1)
    //         ->get();
    // }
    public function showProductsJSON()
    {
        $products = DB::table('product_images')
            ->join('products', 'product_images.product_id', '=', 'products.id')
            ->get();

        return $products;
    }
    public function showProductstoBuyers(Request $request)
    {
        $orders = DB::table('orders')
            ->where('user_id', 'Auth::user()')
            ->orWhere('order_status_id', 1)
            ->get();
        $orderitems = OrderItem::all();
        $productimages = ProductImage::all();
        $productfeatures = ProductFeature::all();
        foreach ($productfeatures as $productfeature) {
            $oneProductfeature = $productfeature->product_id;
        }
        $features = Feature::all();
        $categories = Category::all();
        $products = Product::all();
        return view('products.showAll', compact('products', 'productimages', 'productfeatures', 'categories', 'orders'));
        if ($category_name = $request->category_name) {
            $categorys = Category::where('category_name', $category_name)->get();
            foreach ($categorys as $category) {
                $catid = $category->id;
                $products = Product::where('category_id', $catid)->get();
            }
        }
        $order = Order::where('user_id', Auth::user()->id)
            ->Where('order_status_id', 1)
            ->first();
        $orderId = ($order) ? $order->id : 0;
        $countCart = ($order) ? $order->orderitems->count() : 0;
        // foreach($orderitems as $item){
        //     $itemorder = $item->quantity;
        //     $itemid = $item->id;
        // }

        return view('products.showAll', compact(['products', 'productimages', 'productfeatures', 'categories', 'orders', 'order', 'orderId', 'orderitems', 'countCart', 'itemorder', 'itemid', 'features', 'oneProductfeature']));
    }
}
