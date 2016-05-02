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

Blade::setContentTags('<%', '%>');
Blade::setEscapedContentTags('<%%', '%%>');
//Route::get('/', function () { return view('welcome');});
Route::get('/', function () { return view('booksales');});
Route::resource('sale', 'SaleController', ['only' => ['index','store','show']]);
Route::get('book/admin', function () { return view('bookadmin');});
Route::resource('book', 'BookController', ['only' => ['index','store','show','update','destroy']]);
