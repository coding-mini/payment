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
}
