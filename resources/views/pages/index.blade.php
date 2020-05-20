@extends('layouts.app')
@section('content')
<div class="content">
    <img style="width:30px; margin-bottom:8px;" src="\teashirt\resources\images\logo.png" alt="TeaShirt">
    <h3 style="display:inline-block">Welcome to Teashirt</h3>
</div>
@if(count($products) >0)
{{--this guy is limited by pagination
<h4>{{count($products)}} Results found</h4> --}}
<div class="container-fluid">
  <div class="row">
    @foreach ($products  as $product)
          <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-2">
            <div class="card mb-4 box-shadow">
              <div id="carouselExampleIndicators-{{$product->id}}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  @php
                    $dir = "storage/images/$product->image_source/";
                    $images = glob($dir."*.*");
                    $i=1;
                    foreach ($images as $image)
                    {                    
                      if(!($image=="storage/images/$product->image_source/Thumbs.db"))
                      {
                        if($i==1){
                        echo '<div class="carousel-item active"><br/>
                            <img class="d-block w-100" src="'.$image.'"  alt="Image '.$i.'" /><br />
                        </div><br/>';}
                        else
                        {
                        echo '<div class="carousel-item"><br/>
                            <img class="d-block w-100" src="'.$image.'"  alt="Image '.$i.'" /><br />
                        </div><br/>';}  
                      }
                      $i++;
                    }
                    
                  @endphp
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators-{{$product->id}}" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators-{{$product->id}}" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            <div class="card-body">
              <p class="three-lines card-text">{{$product->description}}</p>
              <div class="card-group justify-content-center">
            @if ($product->base_price)
              @if ($product->in_sale)
                <a title="Go to Sale!" href="?filter=sale"><i class="fas fa-tag mr-2 mt-1"></i></a>
                <h5 class="card-text mr-3"><del>{{$product->base_price}} €</del></h5>
                <h5 class="card-text">{{$product->sale_price}} €</h5>
              @else           
                <h5 class="card-text">{{$product->base_price}} €</h5>
              @endif
            @endif
          </div>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  <a title="View" class="btn btn-sm btn-outline-secondary" href="products/{{$product->id}}"><i class="fas fa-eye"></i></a>
                  <a title="Add to Cart!" href="" class="btn btn-sm btn-outline-secondary"><i class="fas fa-cart-arrow-down"></i></a>
                  <a title="Add to Favourites!" href="" class="btn btn-sm btn-outline-secondary"><i class="fas fa-heart"></i></a>
                </div>
              </div>
              @if($product->tag)
              <div style="border:none" class="card-footer two-lines">
                @foreach (explode(' ', $product->tag) as $tag)
                    <a title="Go to tag ' {{$tag}} ' " href="?tag={{$tag}}" class="btn btn-sm justify-content-center"><small class="text-muted">{{$tag}}</small></a>
                @endforeach
              </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach
  </div>
</div>
{{-- pagination links --}}
<div class="container">
  {{$products->links()}}
</div>
@else
    <h1>No Products found!</h1>
@endif
@endsection