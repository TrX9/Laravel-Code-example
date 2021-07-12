<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'CategoryController@index');


Route::get('/login', function () {
    return view('login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('products', 'ProductController');
Route::resource('categories','CategController');
Route::resource('downloads','DwnldsController');
Route::resource('dcategories','DcategController');
Route::resource('cards','AdminCardController');
Route::resource('reports','AdminReportController');


Route::get('/cat/{category}', 'CategoryController@showproducts')->name('showproducts');
///////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/dcat/{dcategory}', 'CategoryController@showdownloads')->name('showdownloads');

//Route::get('/dpage', 'CategoryController@downloadpage');

Route::get('/about', 'CategoryController@aboutus');
Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('dwnlds/{id}/download', 'CategoryController@download')->name('books.download');

Route::get('/forms', 'FormController@index')->name('forms');
Route::get('/addcard', 'FormController@addCard');
Route::post('/addcard', 'FormController@storeCard');

Route::get('/addreport', 'FormController@addReport');
Route::post('/addreport', 'FormController@storeReport');