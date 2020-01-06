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

    Route::resources([
        'import' => 'ImportController',
        'table' => 'TableController',
        'column' => 'ColumnController',
    ]);

    Route::get('/calls/history', 'CallsHistoryController@index')->name('calls.history');
    Route::delete('/calls/history/flash', 'CallsHistoryController@flash')->name('calls.flash');
    Route::post('/calls/add', 'CallsHistoryController@job')->name('calls.add');
    Route::post('/calls/factory', 'CallsHistoryController@factory')->name('calls.factory');

    Route::get('/calls/faker', 'CallsHistoryController@faker')->name('calls.faker');
    Route::post('/calls/faker', 'CallsHistoryController@fake')->name('calls.fake');

    Route::get('/settings', 'SettingsController@get')->name('settings.get');
    Route::post('/settings/set', 'SettingsController@set')->name('settings.set');

    Route::get('/columns/info/{table}', ['uses' => 'TableController@info'])->name('columns.info');
    Route::get('/columns/info/{table}/store', ['uses' => 'TableController@store'])->name('columns.store');

    Route::post('/import/{id}/execute', 'ImportController@execute')->name('import.execute');

    Route::get('agent', 'AgentController@index')->name('agent.index');
    Route::post('agent', 'AgentController@add')->name('agent.add');
    Route::get('agent/{id}', ['uses' => 'AgentController@show'])->name('agent.show');
    Route::post('agent/{id}/destroy', ['uses' => 'AgentController@destroy'])->name('agent.destroy');

    Route::get('/queues', 'AgentController@queues')->name('agent.queues');


});
