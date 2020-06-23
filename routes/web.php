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

//authentication routes
Auth::routes();

//home controller
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('customer.index');
});


//Admin namespace
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:adminGate')->group(function () {
    Route::get('/', 'UsersController@index');
    Route::resource('/users', 'UsersController', ['except' => ['show','create','store']]);
    Route::resource('/properties', 'AdminPropertiesController');
});

//Agents namespace
Route::namespace('Agents')->prefix('agents')->name('agents.')->middleware('can:agentGate')->group(function () {
    //this is rouute for /agents
    Route::get('/', 'PropertiesController@index');
    //propertiescontroller routes
    Route::resource('/properties', 'PropertiesController');
});

//generic users namespace
Route::namespace('Customers')->prefix('customers')->name('customers.')->group(function () {
    
});