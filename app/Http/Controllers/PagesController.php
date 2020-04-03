<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
    public function design()
    {
        return view('pages.design');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function checkout()
    {
        return view('pages.checkout');
    }
    public function cart()
    {
        return view('pages.cart');
    }
}
