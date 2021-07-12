<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class AdminCardController extends Controller
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

        $cards = Card::latest()->paginate(200);

  

        return view('cards.index',compact('cards'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('cards.create');

    }

  

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {
        $validated = $request->validate([
            'companyname' => 'string|max:180',
            'customername' => 'string|max:180',
            'suppliername' => 'string|max:180',
            'companynumber' => 'string|max:180',
            'companyaddress' => 'string|max:180',          
        ]);

        $file = Card::create([
            'companyName' => $validated['companyname'],
            'customerName' => $validated['customername'],
            'supplierName' => $validated['suppliername'],
            'companyNumber' => $validated['companynumber'],
            'companyAddress' => $validated['companyaddress'],
        ]);

    //Product::create($request->all());

    return redirect()->route('cards.index')

                ->with('success','Created successfully.');

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Card $card)

    {

        return view('cards.show',compact('card'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Card $card)

    {

        return view('cards.edit',compact('card'));

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Card $card)

    {
        $validated = $request->validate([
            'companyname' => 'string|max:180',
            'customername' => 'string|max:180',
            'suppliername' => 'string|max:180',
            'companynumber' => 'string|max:180',
            'companyaddress' => 'string|max:180',          
        ]);
                    
                    $card->update([
                        'companyName' => $validated['companyname'],
                        'customerName' => $validated['customername'],
                        'supplierName' => $validated['suppliername'],
                        'companyNumber' => $validated['companynumber'],
                        'companyAddress' => $validated['companyaddress'],
                    ]);
    
                    //Product::create($request->all());

                     return redirect()->route('cards.index')
                      ->with('success','Updated successfully.');
                    
                

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Card $card)
    {

        $card->delete();

        return redirect()->route('cards.index')

                        ->with('success',' deleted successfully');

    }

}