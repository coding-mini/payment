@extends('layouts.app')
@section('content')
    <div class="container">
        {!! QrCode::size(400)->generate($qr_code); !!}
        <p>请使用微信完成扫码支付</p>
    </div>
@stop