<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'QuotesController@index')->name('index');
Route::get('/approved-quotes', 'QuotesController@approvedQuotes')->name('approvedQuotes');
Route::get('/rejected-quotes', 'QuotesController@rejectedQuotes')->name('rejectedQuotes');
Route::get('/add-quote','QuotesController@addQuote')->name('addQuote');
Route::post('/add-quote','QuotesController@store')->name('addQuote');
Route::get('/edit-quote/{id}','QuotesController@edit')->name('editQuote');
Route::put('/edit-quote/{id}','QuotesController@update')->name('updateQuote');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
