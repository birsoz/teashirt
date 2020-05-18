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
@if(count($products) >0)
{{--this guy is limited by pagination
<h4>{{count($products)}} Results found</h4> --}}
<div class="album py-5 bg-light">
    <div id="#" class="container">
        <div class="row">
            @foreach ($products  as $product)
                
                       

                        {{-- <img class="card-img-top" src="public/storage/images/{{$product->Image_Source}}" alt="{{$product->SKU}}"> --}}
                        <div class="card-body">
                            <p class="card-text">{{$product->Description}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="products/{{$product->id}}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                                </div>
                                @foreach (explode(' ', $product->tag) as $tag)
                                    <a href="?tag={{$tag}}" class="btn btn-sm"><small class="text-muted">{{$tag}}</small></a>
                                @endforeach
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