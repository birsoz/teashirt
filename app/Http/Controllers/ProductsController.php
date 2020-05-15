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
        $this->middleware('auth')->except('index', 'show','sale');
    }

    public function index(Request $request)
    {
        //sale link should be here too. its a filter anyway
        //all products should have a condition is_active.

        //if user used navbar links
        if($request->has('filter')){
            $filter = explode(' ', $request->input('filter'), 2);
            $products = Product::where([
            ['category', '=', $filter[0]],
            ['sub_category', '=', $filter[1]]
            ])->paginate(8);
        }
        //if user clicked one of the tags
        else if($request->has('tag')){
            $tag = $request->input('tag');
            $products = Product::where('tag', 'like', '%'.$tag.'%')
            ->orWhere('category', 'like', '%'.$tag.'%')
            ->orWhere('sub_category', 'like', '%'.$tag.'%')->paginate(8);
        }
        
        //if user used searched button
        else if($request->has('search')){
            $search= $request->input('search');
            
            $products=Product::search($search)->paginate(8);
        }
        // {
        //     $search = explode(' ', $request->input('search'),5);
            // if(count($search)==5){ 
                // $products= Product::where('tag', 'like', '%'.$search[0].'%')
                // ->orWhere('Description', 'like', '%'.$search[0].'%')
                // ->orWhere('category', 'like', '%'.$search[0].'%')
                // ->orWhere('sub_category', 'like', '%'.$search[0].'%')
                // ->orWhere('tag', 'like', '%'.$search[1].'%')
                // ->orWhere('Description', 'like', '%'.$search[1].'%')
                // ->orWhere('category', 'like', '%'.$search[1].'%')
                // ->orWhere('sub_category', 'like', '%'.$search[1].'%')
                // ->orWhere('tag', 'like', '%'.$search[2].'%')
                // ->orWhere('Description', 'like', '%'.$search[2].'%')
                // ->orWhere('category', 'like', '%'.$search[2].'%')
                // ->orWhere('sub_category', 'like', '%'.$search[2].'%')
                // ->orWhere('tag', 'like', '%'.$search[3].'%')
                // ->orWhere('Description', 'like', '%'.$search[3].'%')
                // ->orWhere('category', 'like', '%'.$search[3].'%')
                // ->orWhere('sub_category', 'like', '%'.$search[3].'%')
                // ->orWhere('tag', 'like', '%'.$search[4].'%')
                // ->orWhere('Description', 'like', '%'.$search[4].'%')
                // ->orWhere('category', 'like', '%'.$search[4].'%')
                // ->orWhere('sub_category', 'like', '%'.$search[4].'%')->paginate(8);
            // }
            // else if(count($search)==4){ 
            //     $products= Product::where('tag', 'like', '%'.$search[0].'%')
            //     ->orWhere('Description', 'like', '%'.$search[0].'%')
            //     ->orWhere('category', 'like', '%'.$search[0].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[0].'%')
            //     ->orWhere('tag', 'like', '%'.$search[1].'%')
            //     ->orWhere('Description', 'like', '%'.$search[1].'%')
            //     ->orWhere('category', 'like', '%'.$search[1].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[1].'%')
            //     ->orWhere('tag', 'like', '%'.$search[2].'%')
            //     ->orWhere('Description', 'like', '%'.$search[2].'%')
            //     ->orWhere('category', 'like', '%'.$search[2].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[2].'%')
            //     ->orWhere('tag', 'like', '%'.$search[3].'%')
            //     ->orWhere('Description', 'like', '%'.$search[3].'%')
            //     ->orWhere('category', 'like', '%'.$search[3].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[3].'%')->paginate(8);
            //     }
            // else if(count($search)==3){ 
            //     $products= Product::where('tag', 'like', '%'.$search[0].'%')
            //     ->orWhere('Description', 'like', '%'.$search[0].'%')
            //     ->orWhere('category', 'like', '%'.$search[0].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[0].'%')
            //     ->orWhere('tag', 'like', '%'.$search[1].'%')
            //     ->orWhere('Description', 'like', '%'.$search[1].'%')
            //     ->orWhere('category', 'like', '%'.$search[1].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[1].'%')
            //     ->orWhere('tag', 'like', '%'.$search[2].'%')
            //     ->orWhere('Description', 'like', '%'.$search[2].'%')
            //     ->orWhere('category', 'like', '%'.$search[2].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[2].'%')->paginate(8);
            //     }
            // else if(count($search)==2){ 
            //     $products= Product::where('tag', 'like', '%'.$search[0].'%')
            //     ->orWhere('Description', 'like', '%'.$search[0].'%')
            //     ->orWhere('category', 'like', '%'.$search[0].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[0].'%')
            //     ->orWhere('tag', 'like', '%'.$search[1].'%')
            //     ->orWhere('Description', 'like', '%'.$search[1].'%')
            //     ->orWhere('category', 'like', '%'.$search[1].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[1].'%')->paginate(8);
            //     }
            // else if(count($search)==1){ 
            //     $products= Product::where('tag', 'like', '%'.$search[0].'%')
            //     ->orWhere('Description', 'like', '%'.$search[0].'%')
            //     ->orWhere('category', 'like', '%'.$search[0].'%')
            //     ->orWhere('sub_category', 'like', '%'.$search[0].'%')->paginate(8);
            //     }            
        
            
        // }   

            
        
        else{
        $products = Product::orderBy('id','desc')->paginate(8);
        }
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
            'Image_Source'=> 'image|nullable|max:1999',
            // 'tag'    => 'string',
            // 'tag.*'  => 'string|distinct',
        ]);
        //Getting the name and extension of the image
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
        // $product-> is_active = $request->has('is_active') ? $request->input('is_active') : NULL;
        // 'in_stock' => $request->has('in_stock') ? $request->input('in_stock') : NULL;
        // 'in_sale' => $request->has('in_sale') ? $request->input('in_sale') : NULL;
        $product-> is_active = $request->input('is_active');
        $product-> in_sale = $request->input('in_sale');
        $product-> in_stock = $request->input('in_stock');
        $product-> base_price = $request->input('base_price');
        $product-> sale_price = $request->input('sale_price');
        $product-> category = $request->input('category');
        $product-> sub_category = $request->input('sub_category');
        $product-> tag = $request->input('tag');
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
            'description'=> 'required',
            'Image_Source'=> 'image|nullable|max:1999',
            // 'tag'    => 'required|string',
            // //distinct and min:3 doesnt work, tag should be required???
            // 'tag.*'  => 'string|distinct|min:3',

        ]);
        //Check if the user is an admin(This seems unnecessary as its not in route and there is a check on edit function)
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
        $product-> is_active = $request->input('is_active');
        $product-> in_sale = $request->input('in_sale');
        $product-> in_stock = $request->input('in_stock');
        $product-> base_price = $request->input('base_price');
        $product-> sale_price = $request->input('sale_price');
        $product-> category = $request->input('category');
        $product-> sub_category = $request->input('sub_category');
        $product-> tag = $request->input('tag');
        $product-> user_name = auth()->user()->name;
        
        
        //lets check if a new picture is uploaded
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
    public function sale()
    {
        $products= Product::where('in_sale', true)->paginate(8);
        return view('pages.index')->with('products', $products);
    }
}
