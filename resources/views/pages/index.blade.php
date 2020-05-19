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
  <div class="container">
    <div class="row">
      @foreach ($products  as $product)
            <div class="col-sm-6 col-md-3">
              <div class="card mb-4 box-shadow">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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
                              <img class="d-block w-100" src="'.$image.'"  alt="Image. ." /><br />
                          </div><br/>';}
                          else
                          {
                          echo '<div class="carousel-item"><br/>
                              <img class="d-block w-100" src="'.$image.'"  alt="Image. ." /><br />
                          </div><br/>';}  
                        }
                        $i++;
                      }
                    @endphp
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              <div class="card-body">
                <p class="card-text">{{$product->description}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="products/{{$product->id}}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                    </a>
                    <a href="">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                    </a>
                  </div>
                    @foreach (explode(' ', $product->tag) as $tag)
                        <a href="?tag={{$tag}}" class="btn btn-sm"><small class="text-muted">{{$tag}}</small></a>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        @endforeach
    </div>
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