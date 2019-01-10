<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pay;

class PaymentController extends Controller
{
    public function alipay()
    {
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ];

        return Pay::alipay()->wap($order);
    }

    public function notify()
    {
        $alipay = Pay::alipay();
        $data = $alipay->verify();

        // 1
        // 2
        // 3

        return $alipay->success();
    }

    public function return()
    {
        return '支付成功';
    }

    public function wechatPay()
    {
        $result = Pay::wechat()->scan([
            'out_trade_no' => time(),
            'body'         => '微信支付测试',
            'total_fee'    => 1 * 100,
        ]);

        $qr = $result->code_url;

    }

    public function wechatNotify()
    {
        $payment = Pay::wechat();

        $data = Pay::wechat()->verify();


        return $payment->success();

    }

    public function wechatReturn()
    {
        return '支付完成';
    }
}
