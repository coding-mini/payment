@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="text-center">
            <img src="{{ $book->poster }}" alt="" class="img-thumbnail" width="300">
            <h4 style="margin-top: 20px"> {{ $book->name }} </h4>
            <p> {{ $book->price }} </p>
            <br>
            <a href="{{ url('alipay/scan/'.$order->id) }}" class="btn btn-info" style="margin-right: 50px"> 支付宝 </a>
            <a href="{{ url('wechat/scan/'.$order->id) }}" class="btn btn-success"> 微信支付 </a>
        </div>
    </div>
@stop