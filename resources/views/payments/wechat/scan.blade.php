@extends('layouts.app')
@section('content')
    {!! QrCode::size(400)->generate($qr); !!}
    <p style="letter-spacing: 2px;font-size: 16px">请使用微信扫码完成支付</p>
@stop