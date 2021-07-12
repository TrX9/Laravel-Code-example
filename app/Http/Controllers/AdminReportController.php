<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
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

        $reports = Report::latest()->paginate(200);

  

        return view('reports.index',compact('reports'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('reports.create');

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
            'visitDate' => 'string|max:180',
            'companyname' => 'string|max:180',
            'companyAddress' => 'string|max:180',
            'contactName' => 'string|max:180',
            'mobileNumber' => 'string|max:180', 
            'emailAddress' => 'string|max:180',
            'contactType' => 'string|max:180',
            'reasonFirstTime' => 'string|max:180',
            'reasonBOQ' => 'string|max:180',
            'reasonBidSubmit' => 'string|max:180', 
            'reasonFollowup' => 'string|max:180',
            'reasonInstallation' => 'string|max:180',
            'reasonPreview' => 'string|max:180',
            'reasonBill' => 'string|max:180',
            'reasonCollect' => 'string|max:180',    
            'siteType' => 'string|max:180',          
            'Notes' => 'string|max:10000',          

        ]);
        $dateString = date("Y-m-d", strtotime($request->visitDate));
        $file = Report::create([
            'visitDate' => $dateString,
            'companyName' => $validated['companyname'],
            'companyAddress' => $validated['companyAddress'],
            'contactName' => $validated['contactName'],
            'mobileNumber' => $validated['mobileNumber'],
            'emailAddress' => $validated['emailAddress'],
            'contactType' => $validated['contactType'],
            'reasonFirstTime' => $validated['reasonFirstTime'],
            'reasonBOQ' => $validated['reasonBOQ'],
            'reasonBidSubmit' => $validated['reasonBidSubmit'],
            'reasonFollowup' => $validated['reasonFollowup'],
            'reasonInstallation' => $validated['reasonInstallation'],
            'reasonPreview' => $validated['reasonPreview'],
            'reasonBill' => $validated['reasonBill'],
            'reasonCollect' => $validated['reasonCollect'],
            'siteType' => $validated['siteType'],
            'Notes' => $validated['Notes'],
        ]);

    //Product::create($request->all());

    return redirect()->route('reports.index')

                ->with('success','Created successfully.');

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Report $report)

    {

        return view('reports.show',compact('report'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Report $report)

    {

        return view('reports.edit',compact('report'));

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Report $report)

    {
        $validated = $request->validate([
            'visitDate' => 'string|max:180',
            'companyname' => 'string|max:180',
            'companyAddress' => 'string|max:180',
            'contactName' => 'string|max:180',
            'mobileNumber' => 'string|max:180', 
            'emailAddress' => 'string|max:180',
            'contactType' => 'string|max:180',
            'reasonFirstTime' => 'string|max:180',
            'reasonBOQ' => 'string|max:180',
            'reasonBidSubmit' => 'string|max:180', 
            'reasonFollowup' => 'string|max:180',
            'reasonInstallation' => 'string|max:180',
            'reasonPreview' => 'string|max:180',
            'reasonBill' => 'string|max:180',
            'reasonCollect' => 'string|max:180',    
            'siteType' => 'string|max:180',          
            'Notes' => 'string|max:10000',          

        ]);
        $dateString = date("Y-m-d", strtotime($request->visitDate));

                    $report->update([
                        'visitDate' => $dateString,
                        'companyName' => $validated['companyname'],
                        'companyAddress' => $validated['companyAddress'],
                        'contactName' => $validated['contactName'],
                        'mobileNumber' => $validated['mobileNumber'],
                        'emailAddress' => $validated['emailAddress'],
                        'contactType' => $validated['contactType'],
                        'reasonFirstTime' => $validated['reasonFirstTime'],
                        'reasonBOQ' => $validated['reasonBOQ'],
                        'reasonBidSubmit' => $validated['reasonBidSubmit'],
                        'reasonFollowup' => $validated['reasonFollowup'],
                        'reasonInstallation' => $validated['reasonInstallation'],
                        'reasonPreview' => $validated['reasonPreview'],
                        'reasonBill' => $validated['reasonBill'],
                        'reasonCollect' => $validated['reasonCollect'],
                        'siteType' => $validated['siteType'],
                        'Notes' => $validated['Notes'],
                    ]);
    
                    //Product::create($request->all());

                     return redirect()->route('reports.index')
                      ->with('success','Updated successfully.');
                    
                

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Report $report)
    {

        $report->delete();

        return redirect()->route('reports.index')

                        ->with('success',' deleted successfully');

    }

}