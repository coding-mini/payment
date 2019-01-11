@extends('layouts.app')
@section('content')
    <div class="container">
        {!! QrCode::size(400)->generate($qr_code); !!}
        <p>请使用微信完成扫码支付</p>
    </div>
    <script>
        $(function () {
            let home = '{!! url('') !!}';
            let timer = setInterval(()=>{
                $.ajax({
                    type: 'POST',
                    url : home + 'ajax/order_status',
                    data: {
                        '_token'   : '{!! csrf_token() !!}',
                        'order_id' : '{!! $order->id !!}'
                    },
                    success: function (result) {
                        if(result.status === 'paid'){
                            clearInterval(timer);
                            window.location.href = '{!! url('wechat/return') !!}'
                        }
                    }
                })
            },2000)
        })
    </script>
@stop