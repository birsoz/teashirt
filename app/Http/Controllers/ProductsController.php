<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(5);
        //I will do search results by the following line.
        //$products = Product::where('SKU', 'TS 0005')->get();
        return view('pages.index')->with('products', $products);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'SKU' => 'required',
            'description'=> 'required'

        ]);
        //create a product
        $product=new Product;
        $product-> SKU = $request->input('SKU');
        $product-> Description = $request->input('description');
        $product-> user_name = auth()->user()->name;
        $product->save();

        return redirect('/products')->with('success', 'Product Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('pages.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('pages.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'SKU' => 'required',
            'description'=> 'required'

        ]);
        //create a product
        $product= Product::find($id);
        $product-> SKU = $request->input('SKU');
        $product-> Description = $request->input('description');
        $product-> user_name = auth()->user()->name;
        $product->save();

        return redirect('/products')->with('success', 'Product Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product Deleted');
    }
}
