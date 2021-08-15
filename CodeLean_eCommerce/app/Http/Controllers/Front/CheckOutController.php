<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request){
        //01. Thêm đơn hàng
        $order = Order::create($request->all());
        //02. Thêm chi tiết đơn hàng
        $carts = Cart::content();

        foreach ($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->price * $cart->qty,
            ];

            OrderDetail::create($data);
        }

        if ($request->payment_type == 'pay_later'){

            //03. Gửi email
            $total = Cart::total();
            $subtotal = Cart::subtotal();

            $this->sendEmail($order, $total, $subtotal);

            //04. Xóa giỏ hàng
            Cart::destroy();

            //05. Trả về kết quả
            return redirect('checkout/result')
                ->with('notification', 'Succes you will pay on delivery. Please check your email');
        }

        if ($request->payment_type == 'online_payment'){
            //01. Lấy URL thanh toan VN Pay
                $data_url = VNPay::vnpay_create_payment([
                   'vnp_TxnRef' => $order->id,
                   'vnp_OrderInfo' => 'Mô tả đơn hàng ở đây...',
                    'vnp_Amount' => Cart::total(0, '', '') * 22832,
                ]);
            //02. Chuyển hướng tới URL lấy được
            return redirect()->to($data_url);

        }

    }

    public function vnPayCheck(Request $request){
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount');

        if ($vnp_ResponseCode != null){
            if ($vnp_ResponseCode == 00){
                $order = Order::find($vnp_TxnRef);
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $total, $subtotal);

                Cart::destroy();

                return redirect('checkout/result')
                    ->with('notification', 'Success! Has paid online. Please check your email');
            }else{
                Order::find($vnp_TxnRef)->delete();

                return redirect('checkout/result')
                    ->with('notification', 'ERROR: Payment failed or canceled.');
            }
        }
    }

    public function result(){
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }

    private function sendEmail($order, $total, $subtotal){
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'), function ($message) use ($email_to){
            $message->from('codelean@gmail.com', 'CodeLean eCommerce');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }
}
