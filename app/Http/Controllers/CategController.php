<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $categories = Category::latest()->paginate(200);

  

        return view('categories.index',compact('categories'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('categories.create');

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
                        'name' => 'string|max:40',
                        'file' => 'mimes:jpeg,png|max:5120',          
                    ]);
    
                    $file = $request->file('file');
                    // Generate a file name with extension
                    $fileName = $validated['name'].time().'.'.$file->getClientOriginalExtension();
                    // Save the file
                    $path = $file->storeAs('public', $fileName);
                    //$path = $imgfile->storeAs('public', $validated['name'].".".$extension);
                    //$url = \Storage::url($validated['name'].time().".".$file->getClientOriginalExtension());
                    $file = Category::create([
                       'name' => $validated['name'],
                       'image' => $fileName,
                    ]);
    
                    //Product::create($request->all());

                     return redirect()->route('categories.index')
                      ->with('success','Created successfully.');
                    }
                }
                else {

                    Category::create([
                        'name' => $request->name,
                        ]);

                        //Product::create($request->all());

                        return redirect()->route('categories.index')
                    ->with('success','Created successfully.');

                }
                
                abort(500, 'Could not upload image :(');

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Category $category)

    {

        return view('categories.show',compact('category'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Category $category)

    {

        return view('categories.edit',compact('category'));

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Category $category)

    {

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                    //
                    $validated = $request->validate([
                        'name' => 'string|max:40',
                        'file' => 'mimes:jpeg,png|max:5120',          
                    ]);
    
                    $file = $request->file('file');
                    // Generate a file name with extension
                    $fileName = $validated['name'].time().'.'.$file->getClientOriginalExtension();
                    // Save the file
                    $path = $file->storeAs('public', $fileName);
                    
                    
                    $category->update([
                       'name' => $validated['name'],
                       'image' => $fileName,
                    ]);
    
                    //Product::create($request->all());

                     return redirect()->route('categories.index')
                      ->with('success','Updated successfully.');
                    }
                }
                else {

                    $category->update([
                        'name' => $request->name,
                        ]);

                        //Product::create($request->all());

                        return redirect()->route('categories.index')
                    ->with('success','Updated successfully.');

                }
                
                abort(500, 'Could not upload image :(');

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Category $category)

    {

        $category->delete();

  

        return redirect()->route('categories.index')

                        ->with('success',' deleted successfully');

    }
}
