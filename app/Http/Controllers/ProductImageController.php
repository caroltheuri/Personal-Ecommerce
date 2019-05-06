<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Facades\Input;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),
        [
            'product_image'=>'required'
        ]);
        
        $productimg = new ProductImage;
        if(Input::hasFile('product_image')){
            $file=Input::file('product_image');
            $file->move(public_path(). '/', $file->getClientOriginalName());
            $productimg->product_image = $file->getClientOriginalName();
        }
        $productimg->product_id=$request->product_id;
        $productimg->save();
        
        // ProductImage::create(request(['product_id']));
        return back();
        // if(Input::hasFile('product_image')){
        //     $file=Input::file('product_image');
        //     $filename = time().'.'.$file->getClientOriginalName();
        //     $file->move(public_path('images'),$filename);
        //  }else {
        //      $filename = '';
        //  }
        
        //  session()->flash('success_message', 'You have created a new image!!');
        //  ProductImage::create(request(['product_image','product_id']));
        //  return back();
        // return view('productimages.create', compact(['productimages']));

    }
    public function passProduct($id)
    {
        $productimages = ProductImage::all();
        $product = Product::find($id);
        return view('productimages.create', compact(['product', 'productimages']));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductImage::where('id', $id)
        ->delete();

        return back();
    }
}
