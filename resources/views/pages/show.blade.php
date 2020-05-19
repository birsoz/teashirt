@extends('layouts.app')
@section('content')
@if(($product))
  <div class="col-sm-10 col-md-7">
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
                  <img class="d-block w-100" src="/teashirt/public/'.$image.'"  alt="Image '.$i.'" /><br />
              </div><br/>';}
              else
              {
              echo '<div class="carousel-item"><br/>
                  <img class="d-block w-100" src="/teashirt/public/'.$image.'"  alt=Image '.$i.' /><br />
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
    </div>       
    <div class="card-body">
      <p class="card-text">{{$product->description}}</p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
        </div>
      </div>
    </div>
    @if (!Auth::guest())
        @if (Auth::user()->user_type)
        {!! Form::open(['ProductsContrller@destroy', $product->id],['method'=>'POST', 'class'=> 'pull-right']) !!}
        <small>Last Edited by {{$product->user_name}} at {{$product->updated_at}}</small>
        <a href="/teashirt/public/products/{{$product->id}}/edit" class="btn btn-primary">Edit Item</a>
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class'=> 'btn btn-danger']) }}
        {!! Form::close()!!}
        @endif
    @endif
@else
    <h1>No Products found!</h1>
@endif
@endsection