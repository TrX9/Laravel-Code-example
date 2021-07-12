<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use App\Downloads;
use App\Download;
use App\Dcategories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Render a list of a resource.

        $categories = Categories::all();
        $dcategories = Dcategories::all();

        return view('welcome', ['categories'=>$categories, 'dcategories'=>$dcategories]);
    }
    public function showproducts($category)
    {
        //$category1 = 'Category1';
        $categories = Categories::all();
        $dcategories = Dcategories::all();
        $products = Products::where('category', $category)->get();
        return view('showproduct', ['products'=>$products, 'categories'=>$categories, 'dcategories'=>$dcategories]);
    }

    public function showdownloads($dcategory)
    {
        //$category1 = 'Category1';
        $categories = Categories::all();
        $dcategories = Dcategories::all();

        $downlds = Download::where('dcategory', $dcategory)->get();
        return view('showdownloads', ['downlds'=>$downlds, 'categories'=>$categories, 'dcategories'=>$dcategories]);
    }

    /*public function downloadpage()
    {
        //Render a list of a resource.
        $categories = Categories::all();
        $downloads = Download::all();
        $dcategories = Dcategories::all();

        return view('dpage', ['downloads'=>$downloads, 'categories'=>$categories, 'dcategories'=>$dcategories]);
    }*/

    public function aboutus()
    {
        //Render a list of a resource.

        $categories = Categories::all();
        $dcategories = Dcategories::all();

        return view('about', ['categories'=>$categories, 'dcategories'=>$dcategories]);
    }


    public function download($id)
{
    $book = Download::where('id', $id)->firstOrFail();
    $pathToFile = storage_path('app/public/' . $book->link);
    return response()->download($pathToFile);
}
}
