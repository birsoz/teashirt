@extends('layouts.app')
@section('content')
    <img class="card-img-top" src="/{{$product->Image_Source}}" alt="{{$product->SKU}}">
    <div class="card-body">
        <p class="card-text">{{$product->Description}}</p>
    <div class="d-flex justify-content-between align-items-center">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
    </div>
@endsection