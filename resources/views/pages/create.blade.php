@extends('layouts.app')
@section('content')
    <h1>Create an Item</h1>
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('SKU' , 'SKU')}}
        {{Form::text('SKU','',['class' => 'form-control', 'placeholder' => 'SKU'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('description' , 'Description')}}
        {{Form::textarea('description','',['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    {{Form::file('Image_Source')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    {{-- POST method is not supported error comes out from the following snippet --}}
        
    {{-- <form action="'ProductsController@store'" method="POST">
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="title" label="Title" name="title" id="title" placeholder="Title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="textarea" row="4" cols="40" name="description" id="description" placeholder="Description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> --}}
@endsection