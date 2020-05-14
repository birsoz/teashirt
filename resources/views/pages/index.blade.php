@extends('layouts.app')
@section('content')
<div class="content">
    <img src="\teashirt\resources\images\logo.png" alt="TeaShirt">
    <div class="title m-b-md">
        Welcome to Teashirt
    </div>
    <div class="links">
        <a href="/teashirt/public/#"><h2>Start Shopping</h2></a>
    </div>
</div>    
{{-- <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Cras justo odio</li>
      <li class="list-group-item">Dapibus ac facilisis in</li>
      <li class="list-group-item">Vestibulum at eros</li>
    </ul>
    <div class="card-body">
      <a href="#" class="card-link">Card link</a>
      <a href="#" class="card-link">Another link</a>
    </div>
    <a href="#"><small class="text-muted">{{$products[2]->tag}}</small></a>
</div> --}}
@if(count($products) >0)
{{--this guy is limited by pagination
<h4>{{count($products)}} Results found</h4> --}}
<div class="album py-5 bg-light">
    <div id="#" class="container">
        <div class="row">
            @foreach ($products  as $product)
                <div class="col-sm-6 col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="/teashirt/public/storage/images/{{$product->Image_Source}}" alt="{{$product->SKU}}">
                        <div class="card-body">
                            <p class="card-text">{{$product->Description}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="products/{{$product->id}}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                                </div>
                                <small class="text-muted">{{$product->tag}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- pagination links --}}
            <div class="container">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
@else
    <h1>No Products found!</h1>
@endif
@endsection