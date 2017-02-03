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




/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';

Route::get('/', 'ViewController@index');

Route::get('/members', 'ViewController@members');

Route::get('/drama', 'ViewController@drama');

Route::get('/discography', 'ViewController@discography');


Route::get('/inspirit', 'ViewController@insp');

Route::get('/news', 'ViewController@news');

Route::get('/about', function () {
    return view('about');
});

Route::get('/sitemap', function () {
    return view('sitemap');
});


Route::get('/subunits', 'ViewController@subunits');

Route::get('/varshow', 'ViewController@variety');

Route::get('/concerts', 'ViewController@concerts');

Route::get('/awards', 'ViewController@awards');

Route::get('/merch', 'ViewController@merchandises');
Route::get('/mv', 'ViewController@musicvideos');

Route::get('/discography/unit/{id}', ['uses' =>'ViewController@subunitdisco']);
Route::get('/discography/{id}', ['uses' =>'ViewController@albumid']);
Route::get('/drama/{id}', ['uses' =>'ViewController@dramadetail']);
Route::get('/varshow/{id}', ['uses' =>'ViewController@varietydetail']);
Route::get('/members/{id}', ['uses' =>'ViewController@memberdetail']);

Route::get('/songs', 'ViewController@songs');