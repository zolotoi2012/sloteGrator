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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get-prize', 'PrizeController@getPrize')->name('get-prize');
Route::get('/convert-money/{amount}', 'PrizeController@convert')->name('convert-money');
Route::post('/cancel-prize/{prize}', 'PrizeController@cancel')->name('cancel-prize');
