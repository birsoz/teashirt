@extends('layouts.app')

@section('content')
<div class="container">
  @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
  @endif
                            
  <div class="row justify-content-center">
      <div class="col-md-10">
          <p >Hi {{ Auth::user()->name }}! You are logged in!</p>
          <div class="card">
              <div class="card-header">
                  <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="?show=cart">Your Cart <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link active" href="?show=favourites">Your Favourites</a>
                            <a class="nav-item nav-link active" href="?show=orders">Recent orders</a>
                            <a class="nav-item nav-link active" href="?show=details">Personal details</a>
                        </div>
                      </div>
                  </nav>
              </div>

              <div class="card-body">
                  
                @if((count($products))>0)
                @foreach ($products as $product)

                  <div class="card mb-4">
                    <div class="row no-gutters">

                      {{--Carousel--}}
                      <div id="carouselExampleIndicators-{{$product->id}}" class="carousel slide col-md-3" data-ride="carousel">
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
                                    <img class="d-block w-40" src="/teashirt/public/'.$image.'"  alt="Image '.$i.'" /><br />
                                </div><br/>';}
                                else
                                {
                                echo '<div class="carousel-item"><br/>
                                    <img class="d-block w-40" src="/teashirt/public/'.$image.'"  alt=Image '.$i.' /><br />
                                </div><br/>';}  
                              }
                              $i++;
                            }
                          @endphp
                          <a class="carousel-control-prev inline" href="#carouselExampleIndicators-{{$product->id}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next inline" href="#carouselExampleIndicators-{{$product->id}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      </div>
                          {{--Carousel--}}

                      <div class="col-md-6">
                        <div class="card-body container">
                          <p class="card-text three-lines">{{$product->description}}</p>
                          <div class="card-group d-flex justify-content-center align-items-center">
                            @if ($product->base_price)
                              @if ($product->in_sale)
                                <a title="Go to Sale!" href="?filter=sale"><i class="fas fa-tag mr-2"></i></a>
                                <h5 class="card-text mr-3"><del>{{$product->base_price}} €</del></h5>
                                <h5 class="card-text">{{$product->sale_price}} €</h5>
                              @else           
                                <h5 class="card-text">{{$product->base_price}} €</h5>
                              @endif
                            @endif
                            {{-- <label class="input-group-text custom-select" for="inputGroupSelect01">Options</label> --}}
                            <input class="mx-2 col-2 custom-select mb-2 mr-sm-2 mb-sm-0" min="1" max="10" type="number" name="quantity" value="1" id="">
                            {{-- ///here we need some sale price --}}
                            @if ($product->in_sale)
                              <h5 class="card-text">{{$product->sale_price}}  €</h5>
                            @else
                              <h5 class="card-text">{{$product->base_price}}  €</h5>
                            @endif
                          </div>
                          @if($product->tag)
                            <div style="border:none" class="card-footer two-lines">
                              @foreach (explode(' ', $product->tag) as $tag)
                                  <a title="Go to tag ' {{$tag}} ' " href="?tag={{$tag}}" class="btn btn-sm justify-content-center"><small class="text-muted">{{$tag}}</small></a>
                              @endforeach
                            </div>
                          @endif
                        
                        </div>
                        <div class="d-flex flex-row align-items-end justify-content-end">
                          <div class="custom-control custom-switch mr-2">
                          {{Form::checkbox('is_active', true, $product->is_active,['disabled id' => 'is_active', 'class' => 'custom-control-input'])}}
                          {{Form::label('is_active' , 'Active', ['class' => 'custom-control-label'])}}
                          </div>
                          <div class="custom-control custom-switch mr-2">
                            {{Form::checkbox('in_stock', true, $product->in_stock,['disabled id' => 'in_stock', 'class' => 'custom-control-input'])}}
                            {{Form::label('in_stock' , 'In Stock', ['class' => 'custom-control-label'])}}
                          </div>
                          <div class="custom-control custom-switch mr-2">
                            {{Form::checkbox('in_sale', true, $product->in_sale,['disabled id' => 'in_sale', 'class' => 'custom-control-input'])}}
                            {{Form::label('in_sale' , 'In Sale', ['class' => 'custom-control-label'])}}
                          </div>
                        </div>
                      </div>
                    </div>               
                  </div>    

                      
                    
                  @endforeach
                @else
                    <h1>No Products found!</h1>
                @endif

                      
              </div>
          </div>
      </div>
  </div>
  {{-- <div class="container">
    <div class="row">
      <h2>Simple Quantity increment buttons with Javascript </h2>
          
          
                          <div class="col-lg-2">
                                          <div class="input-group">
                                      <span class="input-group-btn">
                                          <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                            <span class="glyphicon glyphicon-minus"></span>
                                          </button>
                                      </span>
                                      <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                      <span class="input-group-btn">
                                          <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                              <span class="glyphicon glyphicon-plus"></span>
                                          </button>
                                      </span>
                                  </div>
                          </div>
    </div> --}}
  </div>
@endsection
