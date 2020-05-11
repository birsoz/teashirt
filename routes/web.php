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
//Commented out, because PagesController doesnt have $products variable
// Route::get('/', 'PagesController@index');
Route::get('/', 'ProductsController@index');
// Route::get('/{{$page}}', 'Pagescontroller@{{$page}}');
Route::get('/sale', 'PagesController@sale');
Route::get('/about', 'PagesController@about');
Route::get('/cart', 'PagesController@cart');

Route::resource('products', 'ProductsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
