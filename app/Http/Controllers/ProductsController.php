<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
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
        if(!Auth()->user()->user_type)
    {
        return redirect('/products')->with('error', 'You are not authorized, please contact your service provider');
    }
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
            'description'=> 'required',
            'Image_Source'=> 'image|nullable|max:1999'

        ]);
        //Getting the name and extension
        if($request->hasFile('Image_Source'))
        {
            //filename with the extension(can cause overwriting)
            $fileNameWithExt = $request->file('Image_Source')->getClientOriginalName();
            //Instead i will get filename and the extension seperately to concatenate with timestamp
            //But lets try this
            //this works actually but can be hard to look for a specific image
            //or order by name because they all with start with numbers(time)
            $fileNameToStore = time()."_".$fileNameWithExt;
            //$path = $request->file('Image_Source')->storeAs('public/images', $fileNameToStore);
            $path = $request->file('Image_Source')->storeAs('public/images', $fileNameToStore);

        }
        else{
            $fileNameToStore='logo.png';
        }

        //create a product
        $product=new Product;
        $product-> SKU = $request->input('SKU');
        $product-> Description = $request->input('description');
        $product-> user_name = auth()->user()->name;
        $product-> Image_Source = $fileNameToStore;
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
        //check if the user is an admin
        if(!Auth()->user()->user_type)
    {
        return redirect('/products')->with('error', 'You are not authorized, please contact your service provider');
    }
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
        //Check if the user is an admin
        if(!Auth()->user()->user_type)
        {
            return redirect('/products')->with('error', 'You are not authorized, please contact your service provider');
        }
        if($request->hasFile('Image_Source'))
        {
            //filename with the extension(can cause overwriting)
            $fileNameWithExt = $request->file('Image_Source')->getClientOriginalName();
            //Instead i will get filename and the extension seperately to concatenate with timestamp
            //But lets try this
            //this works actually but can be hard to look for a specific image
            //or order by name because they all with start with numbers(time)
            $fileNameToStore = time()."_".$fileNameWithExt;
            //$path = $request->file('Image_Source')->storeAs('public/images', $fileNameToStore);
            $path = $request->file('Image_Source')->storeAs('public/images', $fileNameToStore);

        }
        //edit a product
        $product= Product::find($id);
        $product-> SKU = $request->input('SKU');
        $product-> Description = $request->input('description');
        $product-> user_name = auth()->user()->name;
        if($request->hasFile('Image_Source')){
            $product->Image_Source = $fileNameToStore;
        }
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
        if($product->Image_Source !='logo.png'){
            Storage::delete('/public/images/'.$product->Image_Source);
        }
        $product->delete();

        return redirect('/products')->with('success', 'Product Deleted');
    }
}
