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
    return view('welcome');
});

Route::get('/alipay', 'PaymentController@alipay');
Route::post('/alipay/notify', 'PaymentController@notify');
Route::get('/alipay/return', 'PaymentController@return');
