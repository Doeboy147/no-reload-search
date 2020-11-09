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

Route::get('/', 'HomeController@index');

Auth::routes();

/*Dashboard Routes*/

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getCars', 'HomeController@getCars')->name('get-cars');
Route::post('/search', 'HomeController@search')->name('search');


/*Listing Routes*/

Route::post('/add-listing', 'Listing@store')->name('add');


Route::delete('/delete-item/{id}', 'Listing@destroy')->name('delete');

