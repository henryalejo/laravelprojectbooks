<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () { return view('welcome');});
//Route::get('/', function () { return view('booksales');});
Route::resource('sale', 'SaleController', ['only' => ['index','store','show','update','destroy']]);
//Route::resource('books', 'BookController');
//Route::resource('books', 'BookController', ['only' => ['index', 'show']]);
//Route::get('book/listsales', 'BookController@listSales');
//Route::get('book/listsales/{id}', 'BookController@listSalesById');

Route::resource('book', 'BookController', ['only' => ['index','store','show','update','destroy']]);
