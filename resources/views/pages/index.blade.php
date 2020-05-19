@extends('layouts.app')
@section('content')
<div class="content">
    <img style="width:30px; margin-bottom:8px;" src="\teashirt\resources\images\logo.png" alt="TeaShirt">
    <h3 style="display:inline-block">Welcome to Teashirt</h3>
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
                <p class="card-text">{{$product->description}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group card-img-overlay">
                    <a href="products/{{$product->id}}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                    </a>
                    <a href="">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                    </a>
                    <a href="">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Favourite</button>
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