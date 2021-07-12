<?php

namespace App\Http\Controllers;

use App\Dcategory;
use Illuminate\Http\Request;

class DcategController extends Controller
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

        $dcategories = Dcategory::latest()->paginate(200);

  

        return view('dcategories.index',compact('dcategories'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('dcategories.create');

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
                    $file = Dcategory::create([
                       'name' => $validated['name'],
                       'image' => $fileName,
                    ]);
    
                    //Product::create($request->all());

                     return redirect()->route('dcategories.index')
                      ->with('success','Created successfully.');
                    }
                }
                else {

                    Dcategory::create([
                        'name' => $request->name,
                        ]);

                        //Product::create($request->all());

                        return redirect()->route('dcategories.index')
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

    public function show(Dcategory $dcategory)

    {

        return view('dcategories.show',compact('dcategory'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Dcategory $dcategory)

    {
        
        return view('dcategories.edit',compact('dcategory'));

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Dcategory $dcategory)

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
                    
                    
                    $dcategory->update([
                       'name' => $validated['name'],
                       'image' => $fileName,
                    ]);
    
                    //Product::create($request->all());

                     return redirect()->route('dcategories.index')
                      ->with('success','Updated successfully.');
                    }
                }
                else {

                    $dcategory->update([
                        'name' => $request->name,
                        ]);

                        //Product::create($request->all());

                        return redirect()->route('dcategories.index')
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

    public function destroy(Dcategory $dcategory)

    {

        $dcategory->delete();

  

        return redirect()->route('dcategories.index')

                        ->with('success',' deleted successfully');

    }
}
