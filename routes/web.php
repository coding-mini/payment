<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alipay', 'PaymentController@alipay');
Route::post('/alipay/notify', 'PaymentController@notify');
Route::get('/alipay/return', 'PaymentController@return');

Route::get('/wechat_pay', 'PaymentController@wechatPay');
Route::post('/wechat/notify', 'PaymentController@wechatNotify');


