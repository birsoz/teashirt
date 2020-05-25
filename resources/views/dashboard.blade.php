@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
                           
    <div class="row justify-content-center">
        <div class="col-md-10">
            <p >Hi {{ Auth::user()->name }}! You are logged in!</p>
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="/">Dashboard</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            @if(Auth::user()->user_type)
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link active" href="?filter=recent">Recent edits <span class="sr-only">(current)</span></a>
                                    <a class="nav-item nav-link active" href="?filter=inactive">Inactive items</a>
                                    <a class="nav-item nav-link active" href="?filter=else">Items that edited by someone else</a>
                                    <a class="nav-item nav-link active" href="?filter=incomplete">Incomplete items!</a>
                                </div>
                            @else
                            <div class="navbar-nav">
                                <a class="nav-item nav-link active" href="#">Your Cart <span class="sr-only">(current)</span></a>
                                <a class="nav-item nav-link active" href="#">Your Favourites</a>
                                <a class="nav-item nav-link active" href="#">Recent orders</a>
                                <a class="nav-item nav-link active" href="#">Personal details</a>
                            </div>
                            @endif
                        </div>
                    </nav>

                </div>

                <div class="card-body">
                   @foreach ($products as $product)
                       {{$product->id}} <br>
                   @endforeach
                    
            </div>
        </div>
    </div>
</div>
@endsection
