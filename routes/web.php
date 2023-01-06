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



Route::get('/', 'AuthController@index')->name('authIndex');
Route::get('login', 'AuthController@loginGet')->name('loginGet');
Route::post('login', 'AuthController@loginPost')->name('loginPost');

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('dashboard', 'DashboardController@dashboardIndex')->name('dashboardIndex');
    Route::resource('brokers', 'BrokerController');
    Route::resource('properties', 'PropertyController');
    //AjaxCommonController
    Route::post('getAjaxDropdown', 'AjaxCommonController@index')->name('getAjaxDropdown');
});


// 404 / Except Above Route
Route::get('*', function () {
    return 'TEst';
})->name('404Route');
