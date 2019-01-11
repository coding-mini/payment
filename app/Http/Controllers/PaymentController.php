<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use Illuminate\Http\Request;
use Pay;

class PaymentController extends Controller
{
    public function placeOrder(Book $book)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'status'  => 'pending',
            'trade_no' => uniqid(time()),
            'book_id'   => $book->id,
            'price'     => $book->price,
            'remark'    => auth()->user()->name.' 想要购买 '.$book->name
        ]);
        return view('payments.buy',compact('book','order'));
    }

    public function alipayScan(Order $order)
    {
        $payment = Pay::alipay();

        return $payment->web([
            'out_trade_no' => $order->trade_no,
            'total_amount' => $order->price,
            'subject'      => $order->remark
        ]);
    }

    public function alipayNotify()
    {
        $payment = Pay::alipay();
        $data = $payment->verify();

        $trade_no = $data->out_trade_no;
        $order  = Order::where('trade_no',$trade_no)->first();

        if(!$order)
            return 'fail';

        $order->update([
            'status' => 'paid'
        ]);

        return $payment->success();
    }

    public function alipayReturn()
    {
        $payment = Pay::alipay();
        $data = $payment->verify();

        $trade_no = $data->out_trade_no;
        $order  = Order::where('trade_no',$trade_no)->first();

        dd($order->remark.' 购买成功');
    }

    public function wechatScan(Order $order)
    {
        $payment = Pay::wechat();

        $result = $payment->scan([
            'out_trade_no' => $order->trade_no,
            'total_fee'    => (int) $order->price*100,
            'body'         => $order->remark
        ]);

        $qr_code = $result->code_url;

        return view('payments.wechat.scan',compact('qr_code','order'));
    }

    public function wechatNotify()
    {
        $payment = Pay::wechat();
        $data = $payment->verify();

        if ($data->result_code === 'SUCCESS' && $data->return_code === 'SUCCESS') {
            $trade_no = $data->out_trade_no;
            $order  = Order::where('trade_no',$trade_no)->first();

            if(!$order)
                return 'fail';

            $order->update([
                'status' => 'paid'
            ]);
        }

        return $payment->success();
    }

    public function ajaxOrderStatus(Request $request)
    {
        if ($request->ajax()) {
            $order = Order::find($request->order_id);
            if (!order) {
                return response()->json([
                    'status'  => 'failed'
                ]);
            }
            return response()->json([
                'status'  => $order->status
            ]);
        }

        return 'not ajax requst';
    }

    public function wechatReturn()
    {
        return 'success';
    }
}
