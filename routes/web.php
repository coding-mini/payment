<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', 'HomeController@home')->name('home');
Auth::routes();

Route::get('/books', 'BookController@index');
Route::get('buy/{book}','PaymentController@placeOrder');
Route::get('/alipay/scan/{order}', 'PaymentController@alipayScan');
Route::post('/alipay/notify', 'PaymentController@alipayNotify');
Route::get('/alipay/return', 'PaymentController@alipayReturn');

Route::get('/wechat/scan/{order}', 'PaymentController@wechatScan');
Route::post('/wechat/notify', 'PaymentController@wechatNotify');

Route::post('ajax/order_status','PaymentController@ajaxOrderStatus');
Route::get('/wechat/return', 'PaymentController@wechatReturn');








