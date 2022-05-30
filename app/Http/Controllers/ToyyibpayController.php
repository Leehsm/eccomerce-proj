<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class ToyyibpayController extends Controller
{
    public function createBill(Request $request){
        if ($request->state_id != 3 && $request->state_id != 4){
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 10.00;
            }else{
                $total_amount = round(Cart::total() + 10.00);
            }

            $some_data = array(
                'userSecretKey' => config('toyyibpay.key'),
                'categoryCode' => config('toyyibpay.category'),
                'billName' => 'SahiraShop.com',
                'billDescription' => 'Payment for purchased item from SahiraShop website',
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $total_amount*100,
                'billReturnUrl' => route('toyyibpay-status'),
                'billCallbackUrl' => route('toyyibpay-callback'),
                'billExternalReferenceNo' => 'SSOP'.mt_rand(10000000,99999999),
                'billTo' => $request->name,
                'billEmail' => $request->email,
                'billPhone' => $request->phone,
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => '0', //0 for fpx, 1 for both fpx and credi card
                'billContentEmail' => 'Thank you for purchasing our product!',
                'billChargeToCustomer' => 2,
                // 'metadata' => ['order_id' => uniqid()],
                // 'currency' => 'myr',
            );  

            $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
            $response = Http::asForm()->post($url, $some_data);
            $billCode = $response[0]['BillCode'];
            return redirect('https://dev.toyyibpay.com/' . $billCode);
        }
        else{
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 15.00;
            }else{
                $total_amount = round(Cart::total() + 15.00);
            }

            $some_data = array(
                'userSecretKey' => config('toyyibpay.key'),
                'categoryCode' => config('toyyibpay.category'),
                'billName' => 'SahiraShop.com',
                'billDescription' => 'Payment for purchased item from SahiraShop website',
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $total_amount*100,
                'billReturnUrl' => route('toyyibpay-status'),
                'billCallbackUrl' => route('toyyibpay-callback'),
                'billExternalReferenceNo' => 'SSOP'.mt_rand(10000000,99999999),
                'billTo' => $request->name,
                'billEmail' => $request->email,
                'billPhone' => $request->phone,
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => '0', //0 for fpx, 1 for both fpx and credi card
                'billContentEmail' => 'Thank you for purchasing our product!',
                'billChargeToCustomer' => 2,
                'metadata' => ['order_id' => uniqid()],
                'currency' => 'myr',
            );  

            $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
            $response = \Http::asForm()->post($url, $some_data);
            $billCode = $response[0]['BillCode'];
            return redirect('https://dev.toyyibpay.com/' . $billCode);
        }
    }

    public function paymentStatus(){

    }

    public function callBack(){

    }
}
