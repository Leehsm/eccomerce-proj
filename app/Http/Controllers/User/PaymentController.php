<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\TempCheckoutData;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

use App\Http\Requests\BillplzFormCreationRequest;
use Billplz\Client;
use Toyyibpay;

// require 'vendor/autoload.php';

class PaymentController extends Controller
{
    public function StripeOrder(Request $request){
        if ($request->state_id != 3 && $request->state_id != 4){
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 10.00;
            }else{
                $total_amount = round(Cart::total() + 10.00);
            }

            \Stripe\Stripe::setApiKey('sk_test_51Kl2mfAXlhPfw81sbjS5rLjGKHGq4Ehi19jkQnxYlMxvBYESfXsJgLNq5eOefDoUtU5kIlykvdkdisPP1BdGx5wy008MtvwEON');
            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create([
                'amount' => $total_amount*100,
                'currency' => 'myr',
                'description' => 'SahiraShop.com',
                'source' => $token,
                'metadata' => ['order_id' => uniqid()],
            ]);
                // dd($charge); 
                
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'district' => $request->district,
                'state' => $request->state,
                'country' => $request->country,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
        
                'payment_type' => 'Stripe',
                'payment_method' => 'Visa Debit or Credit Card',
                'payment_type' => $charge->payment_method,
                'transaction_id' => $charge->balance_transaction,
                'currency' => $charge->currency,
                'amount' => $total_amount,
                'order_number' => $charge->metadata->order_id,

                'holdername' => $request->holdername,
                'bankname' => $request->bankname,
        
                'invoice_no' => 'SSPS'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),	
            ]);

            // Start Send Email 
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
            ];

            Mail::to($request->email)->send(new OrderMail($data));
            // End Send Email 

            $carts = Cart::content();
            foreach ($carts as $cart) {
                OrderItem::insert([
                    'order_id' => $order_id, 
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),
                ]);
            }

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

            $notification = array(
                'message' => 'Your Order Place Successfully',
                'alert-type' => 'success'
            );

            // $stockDec = DB::table('products')
            //             ->join('order_items', 'products.id', '=', 'order_items.product_id')
            //             ->get(['qty']);

            return redirect()->route('my.orders')->with($notification);
        }else{
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 15.00;
            }else{
                $total_amount = round(Cart::total() + 15.00);
            }

            \Stripe\Stripe::setApiKey('sk_test_51Kl2mfAXlhPfw81sbjS5rLjGKHGq4Ehi19jkQnxYlMxvBYESfXsJgLNq5eOefDoUtU5kIlykvdkdisPP1BdGx5wy008MtvwEON');
            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create([
                'amount' => $total_amount*100,
                'currency' => 'myr',
                'description' => 'SahiraShop.com',
                'source' => $token,
                'metadata' => ['order_id' => uniqid()],
            ]);
                // dd($charge); 
                
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'district' => $request->district,
                'state' => $request->state,
                'country' => $request->country,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
        
                'payment_type' => 'Stripe',
                'payment_method' => 'Visa Debit or Credit Card',
                'payment_type' => $charge->payment_method,
                'transaction_id' => $charge->balance_transaction,
                'currency' => $charge->currency,
                'amount' => $total_amount,
                'order_number' => $charge->metadata->order_id,

                'holdername' => $request->holdername,
                'bankname' => $request->bankname,
        
                'invoice_no' => 'SSPS'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),	
            ]);

            // Start Send Email 
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
            ];
            Mail::to($request->email)->send(new OrderMail($data));
            // End Send Email 

            $carts = Cart::content();
            foreach ($carts as $cart) {
                OrderItem::insert([
                    'order_id' => $order_id, 
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),
                ]);
            }

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

            $notification = array(
                'message' => 'Your Order Place Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('my.orders')->with($notification);
        }

        

    } // end method 

    public function FPXCreateBill(Request $request){

        if ($request->state_id != 3 && $request->state_id != 4){
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 10;
            }else{
                $total_amount = round(Cart::total() + 10);
            }
            
            $code = config('toyyibpay.code');

            $bill_object = array(
                'billName' => 'SahiraShop.com',
                'billDescription' => 'Payment from ' .$request->name .' on ' .Carbon::now()->format('d F Y'),
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $total_amount * 100,
                'billExternalReferenceNo' => 'SSOP'.mt_rand(10000000,99999999),
                'billTo' => $request->name,
                'billEmail' => $request->email,
                'billPhone' => $request->phone,
            );  

            $data = Toyyibpay::createBill($code, (object)$bill_object);

            $bill_code = $data[0]->BillCode;

        }
        else {
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 10;
            }else{
                $total_amount = round(Cart::total() + 10);
            }

            $code = config('toyyibpay.code');

            $bill_object = array(
                'billName' => 'SahiraShop.com',
                'billDescription' => 'Payment for purchased item from SahiraShop website',
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $total_amount * 100,
                'billExternalReferenceNo' => 'SSOP'.mt_rand(10000000,99999999),
                'billTo' => $request->name,
                'billEmail' => $request->email,
                'billPhone' => $request->phone,
            );  

            $data = Toyyibpay::createBill($code, (object)$bill_object);

            $bill_code = $data[0]->BillCode;

        }

        // dd($bill_object['billExternalReferenceNo']);      
        return redirect()->route('fpx:payment',$bill_code);
    }

    public function billPaymentLink($bill_code){

        $data = Toyyibpay::billPaymentLink($bill_code);
        return redirect($data);

    }

    public function billplzCreateBill(Request $req){

        if ($req->state_id != 3 && $req->state_id != 4){
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 10.00;
            }else{
                $total_amount = round(Cart::total() + 10.00);
            }
        }
        else{
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 15.00;
            }else{
                $total_amount = round(Cart::total() + 15.00);
            }
        }

        $billExtRef = 'SSRefNO'.mt_rand(10000000,99999999);

        $billplz = Client::make(config('billplz.billplz_key'), config('billplz.billplz_signature'));

        if(config('billplz.billplz_sandbox')) {
            $billplz->useSandbox();
        }

        $bill = $billplz->bill();

        $bill = $bill->create(
            config('billplz.billplz_collection_id'),
            $req->email,
            $req->phone,
            $req->name,
            // 'Payment for pruchasing from Sahira website',
            \Duit\MYR::given($total_amount * 100),
            url('/'),
            'Thank you for purchasing our product!',
            [
                'reference_1_label' => 'xxx',
                'reference_1' => 'ccc',
                'reference_2_label' => 'xxx',
                'reference_2' => 'ccc',
                'redirect_url' => 'http://127.0.0.1:8000/redirect/'
            ]
        );

        dd($bill->toArray());
        return redirect($bill->toArray()['url']);
    }


    public function billplzHandleRedirect(Request $request){

        $billplz = Client::make(config('billplz.billplz_key'), config('billplz.billplz_signature'));

        if(config('billplz.billplz_sandbox')){
            $billplz->useSandbox();
        }

        $bill = $billplz->bill();

        try{
            $bill = $bill->redirect($request->all());
        }catch(\exception $e){
            dd($e->getMessage());
        }
        dd($bill);
    }

}
