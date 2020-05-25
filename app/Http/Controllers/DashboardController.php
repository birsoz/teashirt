<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

    
        if($request->has('filter'))
        {
            $filter=$request->input('filter');
            if($filter=='inactive')
            {
                $products = Product::where('is_active', false)->orWhere('is_active', NULL)->get();
                return view('dashboard')->with('products', $products);
            }
            if($filter=='else')
            {
                $products = Product::where('user_name', '!=', Auth()->user()->name)->get();
                return view('dashboard')->with('products', $products);
            }
            if($filter=='incomplete')
            //could have used whereNull
            {
                $products = Product::where('is_active', false)
                ->orWhere('sku', NULL)
                ->orWhere('description', NULL)
                ->orWhere('category', NULL)
                ->orWhere('sub_category', NULL)
                ->orWhere('tag', NULL)
                ->orWhere('base_price', NULL)
                ->orWhere('sale_price', NULL)
                ->orWhere('image_source', 'no_image')->get();
                return view('dashboard')->with('products', $products);
            }
       
        }

        else
        {
        $products = Product::where('user_name', Auth()->user()->name)->get();
        return view('dashboard')->with('products', $products);
        }
    }
}
