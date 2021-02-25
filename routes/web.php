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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// DEFAULT: RESOURCES
// ->namespace($this->namespace)
Route::namespace('App\Http\Controllers')->middleware(['auth'])->group(function () {
    // Countries
    // Route::get("countries/{id}", 'CountriesController@show');
    // Route::get("countries/{id}/edit", 'CountriesController@edit');

    Route::get("{collection}", 'ResourcesController@index');
    Route::get("{collection}/trash", 'ResourcesController@trash');
    Route::get("{collection}/create", 'ResourcesController@create');
    Route::post("{collection}", 'ResourcesController@store');

    Route::get("{collection}/import", 'ResourcesController@import');
    Route::post("{collection}/import", 'ResourcesController@doImport');
    Route::get("{collection}/export", 'ResourcesController@export');
    Route::post("{collection}/export", 'ResourcesController@doExport');

    Route::get("{collection}/{id}", 'ResourcesController@show');
    Route::get("{collection}/{id}/edit", 'ResourcesController@edit');
    Route::put("{collection}/{id}", 'ResourcesController@update');
    Route::delete("{collection}/{id}", 'ResourcesController@destroy');


    Route::get("{collection}/{id}/trashed", 'ResourcesController@trashed');
    Route::put("{collection}/{id}/restore", 'ResourcesController@restore');
    Route::delete("{collection}/{id}/delete", 'ResourcesController@delete'); // hard delete item
    Route::delete("{collection}/trash/empty", 'ResourcesController@empty'); // empty all trashed
    Route::put("{collection}/trash/restore", 'ResourcesController@putBack'); // empty all trashed
});
