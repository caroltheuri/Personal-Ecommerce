@extends('layout')


@section('content')
    <!-- Button trigger modal -->
    <a href="/products"  class="btn btn-sm btn-warning" style="margin-top:10px;">Go back</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productfeatureModal" style="margin-top:30px;margin-left:0px;">Add Product Features</button>
    <!-- Modal -->
    <div class="modal fade" id="productfeatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/productfeatures" method="post" class="form-horizontal">
            {{ csrf_field()}}
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Features to {{$product->product_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01" name="feature_id">
                        <option value="">Select a Feature</option>
                        @foreach($features as $feature)
                            <option value="{{$feature->id}}">{{$feature->feature_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                    <input type="text" class="form-control" id="feature_name"  placeholder="Enter Product Feature Name" name="product_feature_name">
                </div>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" id="feature_name"  placeholder="Enter Product Feature Additional Price" name="product_feature_price">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add ProductFeature</button>
            </div>
            </div>
        </form>
    </div>
    </div>
    {{--  display product features data  --}}
    @if(count($product->productfeatures))
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Feature Name</th>
            <th>Product Feature Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="2">Actions</th>
        </tr>

        @foreach($product->productfeatures as $productfeature)
        <tr>
            <td>{{ $productfeature->id }}</td>
            <td>{{ $productfeature->feature->feature_name }}</td>
            <td>{{ $productfeature->product_feature_name }}</td>
            <td>{{ $productfeature->created_at->diffForHumans() }}</td>
            <td>{{ $productfeature->updated_at->diffForHumans() }}</td>
            {{--  begin of edit modal  --}}
            <td>
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $productfeature->id}}">
                    Edit
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $productfeature->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="/productfeatures/{{$productfeature->id}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Feature</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select class="custom-select" id="inputGroupSelect01" name="feature_id">
                                            @foreach($features as $feature)
                                                <option value="{{$feature->id}}">{{$feature->feature_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit Product Feature</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
            </td>
            {{--  end of edit modal  --}}
            <td>
                <form action="/productfeatures/{{ $productfeature->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    @endif 

@endsection