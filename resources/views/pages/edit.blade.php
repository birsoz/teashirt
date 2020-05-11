@extends('layouts.app')
@section('content')
    <h1>Edit an Item</h1>
    {!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('SKU' , 'SKU')}}
        {{Form::text('SKU', $product->SKU, ['class' => 'form-control', 'placeholder' => 'SKU'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description' , 'Description')}}
        {{Form::textarea('description', $product->Description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::hidden('_method' , 'PUT')}}
    {!! Form::close() !!}
    
@endsection