@extends('layouts.app')
@section('content')
    <h1>Create an Item</h1>
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('sku' , 'SKU')}}
        {{Form::text('sku','',['class' => 'form-control', 'placeholder' => 'SKU'])}}
    </div>
    <div class="form-group">
        {{Form::label('description' , 'Description')}}
        {{Form::textarea('description','',['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            {{Form::checkbox('is_active', true, true,['id' => 'is_active', 'class' => 'custom-control-input'])}}
            {{Form::label('is_active' , 'Is Active?', ['class' => 'custom-control-label'])}}
        </div>
        <div class="custom-control custom-switch">
            {{Form::checkbox('in_stock', true, true,['id' => 'in_stock', 'class' => 'custom-control-input'])}}
            {{Form::label('in_stock' , 'In Stock?', ['class' => 'custom-control-label'])}}
        </div>
        <div class="custom-control custom-switch">
            {{Form::checkbox('in_sale', true, false,['id' => 'in_sale', 'class' => 'custom-control-input'])}}
            {{Form::label('in_sale' , 'In Sale?', ['class' => 'custom-control-label'])}}
        </div>
    </div>    
    <div class="form-group">
        {{Form::label('base_price' , 'Base Price')}}
        {{Form::number('base_price', '', ['step'=>'0.01'])}}
        {{Form::label('sale_price' , 'Sale Price')}}
        {{Form::number('sale_price', '', ['step'=>'0.01'])}}
    </div>
    <div class="form-group">
        {{Form::label('category' , 'Category')}}
        {{Form::select('category', array(
        'women'=> 'Women', 'men' => 'Men', 'children' => 'Children', 'accessories' => 'Accessories'),
        '',
        ['placeholder' => 'Select a category please'])}}
        {{Form::label('sub_category' , 'Sub Category')}}
        {{Form::select('sub_category', array(
        'Women-Men-Children' => array('tshirts' => 'T-Shirts', 'jumpers'=> 'Jumpers', 'jackets'=> 'Jackets'),
        'Accessories' => array('totebags' => 'Tote bags', 'bandanas'=> 'Bandanas', 'hats'=> 'Hats')),
        '',
        ['placeholder' => 'Select a sub-category please'])}}
    </div>
    <div class="form-group">
        {{Form::label('tag' , 'Tags')}}
        {{Form::text('tag','',['class' => 'form-control', 'placeholder' => ''])}}
    </div>
    {{Form::label('file', 'Images(You can select multiple files with mouse)')}}
    {{Form::file('image[]', array('multiple'=>true))}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection