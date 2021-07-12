<?php

namespace App\Http\Controllers;

use App\Download;
use App\Dcategory;
use Illuminate\Http\Request;

class DwnldsController extends Controller
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

        $downloads = Download::latest()->paginate(200);

  

        return view('downloads.index',compact('downloads'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {
        $dcategories = Dcategory::all();

        return view('downloads.create', ['dcategories'=>$dcategories]);

    }

  

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {      
        if ($request->hasFile('file') && $request->hasFile('link')) 
        {
            if ($request->file('file')->isValid()) {
                    //
                    $validated = $request->validate([
                        'name' => 'string|max:60',
                        'file' => 'mimes:jpeg,png|max:5120',
                        'link' => 'mimes:pdf,txt,doc,docx|max:10240',          
                    ]);
    
                    $file = $request->file('file');
                    $link = $request->file('link');
                    
                    // Generate a file name with extension
                    $fileName = $validated['name'].time().'.'.$file->getClientOriginalExtension();
                    $linkName = $validated['name'].time().'.'.$link->getClientOriginalExtension();
                    // Save the file
                    $path = $file->storeAs('public', $fileName);
                    $path2 = $link->storeAs('public', $linkName);
                    
                    $file = Download::create([
                       'name' => $validated['name'],
                       'link' => $linkName,
                       'description' => $request->description,
                       'image' => $fileName,
                       'dcategory' => $request->dcategory,
                    ]);
    
            //Product::create($request->all());
    
            return redirect()->route('downloads.index')
    
                            ->with('success','Download created successfully.');
                    }
         }

         else if ($request->hasFile('file'))
         {
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
                
                $file = Download::create([
                   'name' => $validated['name'],
                   'description' => $request->description,
                   'image' => $fileName,
                   'dcategory' => $request->dcategory,
                ]);

        //Product::create($request->all());

        return redirect()->route('downloads.index')

                        ->with('success','Download created successfully.');
                }

         }

         else if ($request->hasFile('link'))
         {
            if ($request->file('link')->isValid()) {
                //
                $validated = $request->validate([
                    'name' => 'string|max:40',
                    'link' => 'mimes:pdf,txt,doc,docx|max:10240', 
                ]);

                $link = $request->file('link');
                
                // Generate a file name with extension
                $linkName = $validated['name'].time().'.'.$link->getClientOriginalExtension();
                // Save the file
                $path = $link->storeAs('public', $linkName);
                
                $link = Download::create([
                   'name' => $validated['name'],
                   'link' => $linkName,
                   'description' => $request->description,
                   'dcategory' => $request->dcategory,
                ]);

        //Product::create($request->all());

        return redirect()->route('downloads.index')

                        ->with('success','Download created successfully.');
                }

         }

        else {
    
                Download::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'dcategory' => $request->dcategory,
                 ]);
    
                //Product::create($request->all());
    
                 return redirect()->route('downloads.index')
    
                         ->with('success','Download created successfully.');
    
             }
             abort(500, 'Could not upload image :(');

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Download $download)

    {

        return view('downloads.show',compact('download'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Download $download)

    {
        $dcategories = Dcategory::all();

        return view('downloads.edit', ['download'=>$download, 'dcategories'=>$dcategories]);



    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Download $download)

    {
        if ($request->hasFile('file') && $request->hasFile('link')) 
        {
            if ($request->file('file')->isValid()) {
                    //
                    $validated = $request->validate([
                        'name' => 'string|max:40',
                        'file' => 'mimes:jpeg,png|max:5120',
                        'link' => 'mimes:pdf,txt,doc,docx|max:10240',           
                    ]);
    
                    $file = $request->file('file');
                    $link = $request->file('link');
                    
                    // Generate a file name with extension
                    $fileName = $validated['name'].time().'.'.$file->getClientOriginalExtension();
                    $linkName = $validated['name'].time().'.'.$link->getClientOriginalExtension();
                    // Save the file
                    $path = $file->storeAs('public', $fileName);
                    $path2 = $link->storeAs('public', $linkName);
                    
                    $download->update([
                       'name' => $validated['name'],
                       'link' => $linkName,
                       'description' => $request->description,
                       'image' => $fileName,
                       'dcategory' => $request->dcategory,
                    ]);
    
            //Product::create($request->all());
    
            return redirect()->route('downloads.index')
    
                            ->with('success','Download updated successfully.');
                    }
         }

         else if ($request->hasFile('file'))
         {
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
                
                $download->update([
                   'name' => $validated['name'],
                   'description' => $request->description,
                   'image' => $fileName,
                   'dcategory' => $request->dcategory,
                ]);

        //Product::create($request->all());

        return redirect()->route('downloads.index')

                        ->with('success','Download updated successfully.');
                }

         }

         else if ($request->hasFile('link'))
         {
            if ($request->file('link')->isValid()) {
                //
                $validated = $request->validate([
                    'name' => 'string|max:40',
                    'link' => 'mimes:pdf,txt,doc,docx|max:10240', 
                ]);

                $link = $request->file('link');
                
                // Generate a file name with extension
                $linkName = $validated['name'].time().'.'.$link->getClientOriginalExtension();
                // Save the file
                $path = $link->storeAs('public', $linkName);
                
                $download->update([
                   'name' => $validated['name'],
                   'link' => $linkName,
                   'description' => $request->description,
                   'dcategory' => $request->dcategory,
                ]);

        //Product::create($request->all());

        return redirect()->route('downloads.index')

                        ->with('success','Download updated successfully.');
                }

         }

        else {
    
            $download->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'dcategory' => $request->dcategory,
                 ]);
    
                //Product::create($request->all());
    
                 return redirect()->route('downloads.index')
    
                         ->with('success','Download updated successfully.');
    
             }
             abort(500, 'Could not upload image :(');

             
        $request->validate([

            'name' => 'required',

        ]);

        //$download->update($request->all());

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Download $download)

    {

        $download->delete();

  

        return redirect()->route('downloads.index')

                        ->with('success','deleted successfully');

    }
}
