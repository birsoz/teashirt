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
            if(Auth()->user()->user_type)
            {
                $filter=$request->input('filter');
                if($filter=='inactive')
                {
                    $products = Product::where('is_active', false)->orWhere('is_active', NULL)->get();
                    return view('dashboardAdmin')->with('products', $products);
                }
                else if($filter=='else')
                {
                    $products = Product::where('user_name', '!=', Auth()->user()->name)->get();
                    return view('dashboardAdmin')->with('products', $products);
                }
                else if($filter=='incomplete')
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
                    return view('dashboardAdmin')->with('products', $products);
                }
                else
                {
                    $products = Product::where('user_name', Auth()->user()->name)->get();
                    return view('dashboardAdmin')->with(['products'=> $products, 'error'=> 'No such filter exists']);
                }
        
            

                
            }
            else
            {
                return view('dashboardCustomer')->with('error', 'unaout');
            }

        }
        else
        {
            if(Auth()->user()->user_type)
            {
                
                $products = Product::where('user_name', Auth()->user()->name)->get();
                return view('dashboardAdmin')->with('products', $products);
                
            }
            else
            {
                if($request->has('show'))
                {
                    $show= $request->input('show');
                    if($show=='cart')
                    {
                        $cart = explode(' ', auth()->user()->cart);
                        $products = Product::whereIn('id', $cart)->get();
                        return view('dashboardCartAndFavourites')->with('products', $products);
                    }

                    else if($show=='favourites')
                    {   
                        $favourites = explode(' ', auth()->user()->favourites);          
                        $products = Product::whereIn('id', $favourites)->get();
                        return view('dashboardCartAndFavourites')->with('products', $products);
                    }
                    else if($show=='orders')
                    {
                        return view('dashboardCustomer');
                    }
                    else if($show=='details')
                    {
                        return view('dashboardCustomer');
                    }
                    else
                    {
                        return view('dashboardCustomer');
                    }
                    
                }
                else
                {
                    
                    return view('dashboardCustomer')->with('error', 'No such filter exists');
                }

            }
        }
    }
}
