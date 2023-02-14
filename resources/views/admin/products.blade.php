@extends('layouts.appadmin')

@section('title')
All Products
@endsection


@section('content')
@if(Session::has('status'))
<div class="alert alert-success">
    {{Session::get('status')}}
</div>
@endif

@if(Session::has('status1'))
<div class="alert alert-danger">
    {{Session::get('status1')}}
</div>
@endif

{{Form::hidden('', $increment=1)}}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Products</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$increment}}</td>
                                <td><img src={{ asset('product_images/'.$product->product_image) }} alt=''></td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_price}}</td>
                                <td>{{$product->product_category}}</td>
                                @if($product->status ==1)

                                <td>
                                    <label class="badge badge-success">Activated</label>
                                </td>
                                @else
                                <td>
                                    <label class="badge badge-danger">Unactivated</label>
                                </td>
                                @endif

                                <td>
                                    <button class="btn btn-outline-primary"
                                        onclick="window.location='{{url('editproduct/'.$product->id)}}'">Edit</button>

                                    <a href="/deleteproduct/{{$product->id}}" class="btn btn-outline-danger"
                                        id='delete'>Delete</a>

                                    @if($product->status ==1)

                                    <button class="btn btn-outline-warning"
                                        onclick="window.location='{{url('unactivateproduct/'.$product->id)}}'">Unactivate</button>

                                    @else
                                    <button class="btn btn-outline-success"
                                        onclick="window.location='{{url('activateproduct/'.$product->id)}}'">Activate</button>
                                    @endif
                                </td>
                            </tr>
                            {{Form::hidden('', $increment=$increment+1)}}
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection