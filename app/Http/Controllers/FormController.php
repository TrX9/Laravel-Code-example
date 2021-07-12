<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use App\Downloads;
use App\Download;
use App\Dcategories;
use App\Card;
use App\Report;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        //Render a list of a resource.

        $categories = Categories::all();
        $dcategories = Dcategories::all();

        return view('forms', ['categories'=>$categories, 'dcategories'=>$dcategories]);
    }

    public function addCard()
    {
        //Render a list of a resource.

        $categories = Categories::all();
        $dcategories = Dcategories::all();

        return view('addcard', ['categories'=>$categories, 'dcategories'=>$dcategories]);
    }

    public function storeCard(Request $request)

    {
                //
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

        return redirect()->route('forms')

                        ->with('success','Created successfully.');
                
     }

     public function addReport()
    {
        //Render a list of a resource.

        $categories = Categories::all();
        $dcategories = Dcategories::all();

        return view('addreport', ['categories'=>$categories, 'dcategories'=>$dcategories]);
    }

    public function storeReport(Request $request)

    {
                //
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

        return redirect()->route('forms')

                        ->with('success','Created successfully.');
                
     }


}