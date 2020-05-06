@extends('layouts.app')
@section('content')

<div class="content">
    <img src="\teashirt\resources\images\logo.png" alt="TeaShirt" class="centered">
    <div class="title m-b-md">
        Welcome to Teashirt
    </div>

    <div class="links">
        <a href="/teashirt/public/#"><h2>Start Shopping</h2></a>
    </div>
</div>    
    {{-- Lets just give alert class in a div for now.I dont even know if that exist. --}}
    <div class="alert">
        @if(count($products) >0)
        <div class="album py-5 bg-light">
            <div id="#" class="container">
                <div class="row">
            @foreach ($products  as $product)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="/{{$product->Image_Source}}" alt="{{$product->SKU}}">
                            <div class="card-body">
                            <p class="card-text">{{$product->Description}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="products/{{$product->id}}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                                </div>
                                {{-- <small class="text-muted">9 mins</small> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                                    {{-- pagination links --}}
            <div class="container">
                {{$products->links()}}
            </div>
            {{-- <ul>
            <li>
                <p>{{$product->id}}</p>
            </li>
            <li>
            <img src="/{{$product->Image_Source}}" alt="{{$product->SKU}}">
                {{-- Lets check the adress --}}
            {{-- <p>{{$product->Image_Source}}</p>
            </li>
            <li>1
                <p>{{$product->Description}}</p>
            </li>
        </ul> --}}
        </div>
    </div>
</div>
        @else
            <h1>No Products found!</h1>
        @endif
@endsection



           
      