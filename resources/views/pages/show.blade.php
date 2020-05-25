@extends('layouts.app')
@section('content')
@if(($product))
<div class="card mb-4">
  <div class="row no-gutters">
    <div id="carouselExampleIndicators-{{$product->id}}" class="carousel slide col-md-5" data-ride="carousel">
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
    <div class="col-md-6">
      <div class="card-body container">
        <p class="card-text">{{$product->description}}</p>
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
        @if($product->tag)
          <div style="border:none" class="card-footer two-lines">
            @foreach (explode(' ', $product->tag) as $tag)
                <a title="Go to tag ' {{$tag}} ' " href="?tag={{$tag}}" class="btn btn-sm justify-content-center"><small class="text-muted">{{$tag}}</small></a>
            @endforeach
          </div>
        @endif
      
      </div>
      <div class="d-flex flex-row lign-items-end justify-content-end">
        @if(!Auth::guest())
          @if (Auth::user()->user_type)
          <div class="custom-control custom-switch">
            {{Form::checkbox('is_active', true, $product->is_active,['disabled id' => 'is_active', 'class' => 'custom-control-input'])}}
            {{Form::label('is_active' , 'Active Status', ['class' => 'custom-control-label'])}}
          </div>
          @endif
        @endif
        <div class="custom-control custom-switch">
          {{Form::checkbox('in_stock', true, $product->in_stock,['disabled id' => 'in_stock', 'class' => 'custom-control-input'])}}
          {{Form::label('in_stock' , 'Stock Status', ['class' => 'custom-control-label'])}}
        </div>
        <div class="custom-control custom-switch">
          {{Form::checkbox('in_sale', true, $product->in_sale,['disabled id' => 'in_sale', 'class' => 'custom-control-input'])}}
          {{Form::label('in_sale' , 'Sale Status', ['class' => 'custom-control-label'])}}
        </div>
        <div class="ml-4 btn-group">
          <a title="Add to Cart!" href="" class="btn btn-outline-secondary"><i class="fas fa-cart-arrow-down"></i></a>
          <a title="Add to Favourites!" href="" class="btn btn-outline-secondary"><i class="fas fa-heart"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>    
@if (!Auth::guest())
    @if (Auth::user()->user_type)
    <div class="d-flex flex-row-reverse">
      {!! Form::open(['ProductsContrller@destroy', $product->id],['method'=>'POST']) !!}
      <small>Last Edited by {{$product->user_name}} at {{$product->updated_at}}</small>
      <a href="/teashirt/public/products/{{$product->id}}/edit" class="btn btn-primary">Edit Item</a>
      {{ Form::hidden('_method', 'DELETE') }}
      {{ Form::submit('Delete', ['class'=> 'btn btn-danger']) }}
      {!! Form::close()!!}
    </div>
    @endif
@endif
@else
    <h1>No Products found!</h1>
@endif
@endsection