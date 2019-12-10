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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('/import', 'ImportController');
    Route::resource('/table', 'TableController');

    Route::get('/calls/history', 'CallsHistoryController@index')->name('calls.history');
    Route::delete('/calls/history/flash', 'CallsHistoryController@flash')->name('calls.flash');
    Route::post('/calls/add', 'CallsHistoryController@add')->name('calls.add');
    Route::post('/calls/factory', 'CallsHistoryController@factory')->name('calls.factory');

//    Route::post('/calls/add/{number}', function($number) { });
});
