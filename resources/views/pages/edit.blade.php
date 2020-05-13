@extends('layouts.app')
@section('content')
    <h1>Edit an Item</h1>
    {!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('SKU' , 'SKU')}}
        {{Form::text('SKU', $product->SKU, ['class' => 'form-control', 'placeholder' => 'SKU'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description' , 'Description')}}
        {{Form::textarea('description', $product->Description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('is_active' , 'Is Active?')}}
        {{Form::checkbox('is_active', 'value', true)}}
    </div>
    <div class="form-group">
        {{Form::label('in_sale' , 'In Sale?')}}
        {{Form::checkbox('in_sale', 'value', false)}}
    <div class="form-group">
        {{Form::label('base_price' , 'Base Price')}}
        {{Form::number('base_price', 'value')}}
        {{Form::label('sale_price' , 'Sale Price')}}
        {{Form::number('sale_price', 'value')}}
    </div>
    <div class="form-group">
        {{Form::label('categories' , 'Categories')}}
        {{Form::select('categories', array(
        'Select a category please',
        'Women' => array('tshirts' => 'T-Shirts', 'jumpers'=> 'Jumpers', 'jackets'=> 'Jackets'),
        'Men' => array('tshirts' => 'T-Shirts', 'jumpers'=> 'Jumpers', 'jackets'=> 'Jackets'),
        'Children' => array('tshirts' => 'T-Shirts', 'jumpers'=> 'Jumpers', 'jackets'=> 'Jackets'),
        'Accessories' => array('totebags' => 'Tote bags', 'bandanas'=> 'Bandanas', 'hats'=> 'Hats'),
    ))}}
    </div>
    {{Form::file('Image_Source')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::hidden('_method' , 'PUT')}}
    {!! Form::close() !!}
    
@endsection