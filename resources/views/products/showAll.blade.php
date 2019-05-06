@extends('layout') @section('content')
<br>
<style>
  div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 250px;
    height: 70%;
    padding-bottom:10px;
    margin-right: 25px;
  }
  
  div.gallery:hover {
    border: 1px solid #777;
  }
  
  button:disabled:hover {
    cursor: not-allowed;
  }
  
  div.gallery img {
    width: 100%;
    height: 40%;
    object-fit: cover;
  }
  
  div.desc {
    padding: 10px;
    text-align: center;
  }
  .featured{
    margin-bottom: 20px;
    margin-left: 5px;
  }
</style>
</head>

<body>
  <div class="row">
    <div class="col-md-3">
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Shop by Category
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/buyers">All Products</a>
          @foreach($categories as $category)
              @if($category->category_parent !== NULL)
                <a class="dropdown-item" href="/buyers?category_name={{$category->category_name}}">{{$category->category_name}}</a>
              @endif
          @endforeach
        </div>
      </div>
    </div>
   
    <div class="col-md-7"></div>
    <div class="col-md-2">
      <a  href="/orderitemscart">
        <img src="/icons8-shopping-cart-64.png" alt=""><span class="badge badge-light">{{ $countCart }}</span>
      </a>
    </div>
  </div>
  <div>
  <div class="row">
    <span class="featured"><b><u>Featured Products:</u></b></span>
    <div className="d-flex flex-row">
      @if(count($products)>0) 
      @foreach($products as $product)
      <div class="gallery">
        
        @foreach($product->productimages as $productimage)
          <a target="_blank" href="{{$productimage->product_image}}">
          <img src="/{{$productimage->product_image}}">
          </a> 
        @endforeach
        <div class="desc">
          <p><b><u>{{$product->product_name}}</u></b></p>
          <p>Category: {{$product->category->category_name}}
          </p>
          {{$product->product_description}}  <br>
        </div>
        <div class="desc"><b>Ksh.{{$product->product_price}}</b></div>
        <form action="/orders" method="POST">
          {{ csrf_field() }} @if($product->product_status == 1)
          <div class="desc">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="product_price" value="{{$product->product_price}}">
            <input type="hidden" name="seller_id" value="{{$product->user_id}}">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#p{{$product->id}}">
              View
            </button> <br> <br>
            <!-- Modal -->
            <div class="modal fade" id="p{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$product->product_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @foreach($product->productimages as $productimage)
                      <a target="_blank" href="{{$productimage->product_image}}">
                      @if($productimage->product_image)
                      <img src="/{{$productimage->product_image}}" style="width:100%;height:40%;object-fit:contain;">
                      @endif
                      @if($productimage->product_image == "")
                      <img src="/e-commerce-1024x645.jpg" style="width:100%;height:40%;object-fit:cover;">
                      @endif
                      </a> 
                    @endforeach
                    <b>Product Description:  </b>{{$product->product_description}} <br>
                    <div style="text-align:justify;">
                      <span style="font-size:20px;color:green;">FEATURES:</span> <br>
                      @foreach($features as $feature)
                        @if($feature->user_id == $product->user_id)
                          @if(count($feature->productfeatures))
                            <b><u>{{$feature->feature_name}}:</u></b> <br> <br>
                            @foreach($feature->productfeatures as $productfeature)
                              @if($product->id == $productfeature->product_id)
                                @if($feature->id == $productfeature->feature_id)
                                <form action="/buyers/{{$productfeature->id}}">
                                  <input type="submit" name="product" value="{{$productfeature->product_feature_name}}"/> <br> <br>
                                </form>
                                @endif
                              @endif  
                            @endforeach
                          @endif
                        @endif
                      @endforeach <br>
                      <b>Ksh.</b>{{$product->product_price}} <br>
                      <span style="color:red;">Total Price:</span>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Add to Cart</button>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-sm btn-success " style="margin-left:5%;margin-bottom:10%;">Add to Cart</button> <br>
          </div>
          @endif
        </form>
        @if($product->product_status == 2)
          <div class="desc">
            <button type="submit" class="btn btn-sm btn-primary " style="margin-left:5%;" disabled>Out of Stock</button>
          </div>
        @endif
      </div>
      @endforeach 
      @endif
    </div>
</body>
@endsection