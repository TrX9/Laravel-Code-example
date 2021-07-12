<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('auth')->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $products = Product::latest()->paginate(200);

  

        return view('products.index',compact('products'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {
        $categories = Categories::all();

        return view('products.create', ['categories'=>$categories]);

    }

  

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {
        if ($request->hasFile('file')) {
        if ($request->file('file')->isValid()) {
                //
                $validated = $request->validate([
                    'name' => 'string|max:80',
                    'file' => 'mimes:jpeg,png|max:5120',          
                ]);

                $file = $request->file('file');
                // Generate a file name with extension
                $fileName = $validated['name'].time().'.'.$file->getClientOriginalExtension();
                // Save the file
                $path = $file->storeAs('public', $fileName);
                
                $file = Product::create([
                   'name' => $validated['name'],
                   'category' => $request->category,
                   'description' => $request->description,
                   'image' => $fileName,
                ]);

        //Product::create($request->all());

        return redirect()->route('products.index')

                        ->with('success','Product created successfully.');
                }
         }
         else {

            Product::create([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
             ]);

            //Product::create($request->all());

             return redirect()->route('products.index')

                     ->with('success','Product created successfully.');

         }
         abort(500, 'Could not upload image :(');
        
    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Product $product)

    {

        return view('products.show',compact('product'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Product $product)

    {
        $categories = Categories::all();
        return view('products.edit', ['product'=>$product, 'categories'=>$categories]);

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Product $product)

    {
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                    //
                    $validated = $request->validate([
                        'name' => 'string|max:80',
                        'file' => 'mimes:jpeg,png|max:5120',          
                    ]);
    
                    $file = $request->file('file');
                    // Generate a file name with extension
                    $fileName = $validated['name'].time().'.'.$file->getClientOriginalExtension();
                    // Save the file
                    $path = $file->storeAs('public', $fileName);
                    //$path = $imgfile->storeAs('public', $validated['name'].".".$extension);
                    //$url = \Storage::url($validated['name'].time().".".$file->getClientOriginalExtension());
                    $product->update([
                       'name' => $validated['name'],
                       'category' => $request->category,
                       'description' => $request->description,
                       'image' => $fileName,
                    ]);
    
            //Product::create($request->all());
    
            return redirect()->route('products.index')
    
                            ->with('success','Product updated successfully.');
                    }
             }
             else {
    
                $product->update([
                    'name' => $request->name,
                    'category' => $request->category,
                    'description' => $request->description,
                 ]);
    
                //Product::create($request->all());
    
                 return redirect()->route('products.index')
    
                         ->with('success','Product updated successfully.');
    
             }
             abort(500, 'Could not upload image :(');
  

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)

    {

        $product->delete();

  

        return redirect()->route('products.index')

                        ->with('success','Product deleted successfully');

    }
}
