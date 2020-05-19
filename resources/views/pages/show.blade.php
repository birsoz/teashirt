@extends('layouts.app')
@section('content')
@if(($product))
    <div class="col-sm-8 col-md-5">
        <img class="card-img-top" src="/teashirt/public/storage/images/{{$product->image_source}}" alt="{{$product->sku}}">
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