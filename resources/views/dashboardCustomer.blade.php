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
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="?show=cart">Your Cart <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link active" href="?show=favourites">Your Favourites</a>
                            <a class="nav-item nav-link active" href="?show=orders">Recent orders</a>
                            <a class="nav-item nav-link active" href="?show=details">Personal details</a>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="card-body">
               <div class="card mb-4">
                <div class="row no-gutters">
                  <div class="col-md-6">
                  
                      
                      
                    </div>
                  </div>
                </div>
  
</div>

                    
            </div>
        </div>
    </div>
</div>
@endsection
