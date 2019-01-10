<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alipay', 'PaymentController@alipay');
Route::post('/alipay/notify', 'PaymentController@notify');
Route::get('/alipay/return', 'PaymentController@return');
