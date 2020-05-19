@extends('layouts.app')
@section('content')
@if($product)
    <h1>Edit an Item</h1>
    {!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('sku' , 'SKU')}}
        {{Form::text('sku', $product->sku, ['class' => 'form-control', 'placeholder' => 'SKU'])}}
    </div>
    <div class="form-group">
        {{Form::label('description' , 'Description')}}
        {{Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            {{Form::checkbox('is_active', true, $product->is_active,['id' => 'is_active', 'class' => 'custom-control-input'])}}
            {{Form::label('is_active' , 'Is Active?', ['class' => 'custom-control-label'])}}
        </div>
        <div class="custom-control custom-switch">
            {{Form::checkbox('in_stock', true, $product->in_stock,['id' => 'in_stock', 'class' => 'custom-control-input'])}}
            {{Form::label('in_stock' , 'In Stock?', ['class' => 'custom-control-label'])}}
        </div>
        <div class="custom-control custom-switch">
            {{Form::checkbox('in_sale', true, $product->in_sale,['id' => 'in_sale', 'class' => 'custom-control-input'])}}
            {{Form::label('in_sale' , 'In Sale?', ['class' => 'custom-control-label'])}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('base_price' , 'Base Price')}}
        {{Form::number('base_price', $product->base_price, ['step'=>'0.01'])}}
        {{Form::label('sale_price' , 'Sale Price')}}
        {{Form::number('sale_price', $product->sale_price, ['step'=>'0.01'])}}
    </div>
    <div class="form-group">
        {{Form::label('category' , 'Category')}}
        {{Form::select('category', array(
        'women'=> 'Women', 'men' => 'Men', 'children' => 'Children', 'accessories' => 'Accessories'),
        $product->category,
        ['placeholder' => 'Select a category please'])}}
        {{Form::label('sub_category' , 'Sub Category')}}
        {{Form::select('sub_category', array(
        'Women-Men-Children' => array('tshirts' => 'T-Shirts', 'jumpers'=> 'Jumpers', 'jackets'=> 'Jackets'),
        'Accessories' => array('totebags' => 'Tote bags', 'bandanas'=> 'Bandanas', 'hats'=> 'Hats')),
        $product->sub_category,
        ['placeholder' => 'Select a sub-category please'])}}
    </div>
    <div class="form-group">
        {{Form::label('tag' , 'Tags')}}
        @if ($product->tag)
        {{Form::text('tag',$product->tag,['class' => 'form-control', 'placeholder' => ''])}}
        @else
        {{Form::text('tag','',['class' => 'form-control', 'placeholder' => 'No tag is recorded for this item'])}}
        @endif
    </div>
    {{Form::label('file', 'Images(You can select multiple files with mouse,
    Warning: If you select new files existing files will be deleted!)')}}
    {{Form::file('image[]', array('multiple'=>true))}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::hidden('_method' , 'PUT')}}
    {!! Form::close() !!}
@else
    <h1>No Products found!</h1>
@endif
@endsection