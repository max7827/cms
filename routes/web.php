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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('category', 'CategoryController');
    Route::get('categoryrestore/{id}', 'CategoryController@restore');
    Route::get('category-trashed', 'CategoryController@trashed')->name('category-trashed');

    Route::resource('tag', 'TagController');
    Route::get('tagrestore/{id}', 'TagController@restore');
    Route::get('tag-trashed', 'TagController@trashed')->name('tag-trashed');

    Route::resource('post', 'PostController');
    Route::get('postrestore/{id}', 'PostController@restore');
    Route::get('post-trashed', 'PostController@trashed')->name('post-trashed');


    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
});

Route::get('k', 'CategoryController@as');
Auth::routes(['verify' => true]);
