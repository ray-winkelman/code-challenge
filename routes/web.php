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


// Not a huge fan of the home page being rendered by a search controller.
// I would like to see a home controller return the exact same view for the sake of keeping organized.
Route::get('/', "SearchController@index");

Route::post('/search', "SearchController@search");
