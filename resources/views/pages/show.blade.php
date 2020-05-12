@extends('layouts.app')
@section('content')
    <img class="card-img-top" src="/{{$product->Image_Source}}" alt="{{$product->SKU}}">
    <div class="card-body">
        <p class="card-text">{{$product->Description}}</p>
    <div class="d-flex justify-content-between align-items-center">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
    </div>
    @if (Auth::user()->user_type)
        {!! Form::open(['ProductsContrller@destroy', $product->id],['method'=>'POST', 'class'=> 'pull-right']) !!}
        <small>Last Edited by {{$product->user_name}} at {{$product->updated_at}}</small>
        <a href="/teashirt/public/products/{{$product->id}}/edit" class="btn btn-primary align-right">Edit Item</a>
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class'=> 'btn btn-danger']) }}
        {!! Form::close()!!}
    @endif
@endsection