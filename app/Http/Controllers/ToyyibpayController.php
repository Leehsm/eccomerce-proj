<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\TempCheckoutData;
use App\Models\FPXOrder;
use App\Models\Size;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

use Toyyibpay;

class ToyyibpayController extends Controller
{
    public function FPXCreateBill(Request $request){

        $billExtRef = 'SSRefNO'.mt_rand(10000000,99999999);
        // $transaction_id = 'SSTNID'.request('billcode'), //SAHIRASHOPTRANSACTIONID
        // $order_number = 'SSON'.request('billcode'), //SAHIRASHOPOEDERNUMBER
        // $invoice_no = 'SSIN'.request('billcode'), //SAHIRASHOPINVOICENUMBER

        if ($request->state_id != 3 && $request->state_id != 4){
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 10.00;
            }else{
                $total_amount = round(Cart::total() + 10.00);
            }

            $some_data = array(
                'userSecretKey' => env('TOYYIBPAY_USER_SECRET_KEY'),
                'categoryCode' => env('TOYYIBPAY_CODE'),
                'billName' => 'SahiraShop.com',
                'billDescription' => 'Payment for purchased item from SahiraShop website',
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $total_amount*100,
                'billReturnUrl' => route('toyyibpay-status', $billExtRef),
                'billCallbackUrl' => route('toyyibpay-callback'),
                'billExternalReferenceNo' => $billExtRef,
                'billTo' => $request->name,
                'billEmail' => $request->email,
                'billPhone' => $request->phone,
                'billPaymentChannel'=>'2',
                'billContentEmail'=>'Thank you for purchasing our product!',
                'billChargeToCustomer'=>2,
            );  

            $order_id = Order::insertGetId([
                'billExtNo' => $billExtRef,
                'user_id' => Auth::id(),
                'district' => $request->division_id,
                'state' => $request->district_id,
                'country' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
        
                'payment_type' => 'FPX',
                'payment_method' => 'FPX Online Transfer',
                'transaction_id' => 'SSTNID' .request('billcode'), //SAHIRASHOPTRANSACTIONID
                'currency' => 'myr',
                'amount' => $total_amount,
                'order_number' => 'SSON' .request('billcode'), //SAHIRASHOPOEDERNUMBER

                'holdername' => $request->name,
                'bankname' => 'FPX Transfer',
        
                'invoice_no' => 'SSIN' .request('billcode'), //SAHIRASHOPINVOICENUMBER
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),	
            ]);
            // dd($order_id);

            $carts = Cart::content();
            foreach ($carts as $cart) {
                OrderItem::insert([
                    'order_id' => $order_id, 
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'buyRefNo' => $billExtRef,
                    'created_at' => Carbon::now(),
                ]);
            }
            // dd(OrderItem::all());
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

        }
        else{
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'] + 15.00;
            }else{
                $total_amount = round(Cart::total() + 15.00);
            }
            
            $some_data = array(
                'userSecretKey' => env('TOYYIBPAY_USER_SECRET_KEY'),
                'categoryCode' => env('TOYYIBPAY_CODE'),
                'billName' => 'SahiraShop.com',
                'billDescription' => 'Payment for purchased item from SahiraShop website',
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $total_amount*100,
                'billReturnUrl' => route('toyyibpay-status', $billExtRef),
                'billCallbackUrl' => route('toyyibpay-callback'),
                'billExternalReferenceNo' => $billExtRef,
                'billTo' => $request->name,
                'billEmail' => $request->email,
                'billPhone' => $request->phone,
                'billPaymentChannel'=>'2',
                'billContentEmail'=>'Thank you for purchasing our product!',
                'billChargeToCustomer'=>2,
            );  

            $order_id = Order::insertGetId([
                'billExtRef' => $billExtRef,
                'user_id' => Auth::id(),
                'district' => $request->division_id,
                'state' => $request->district_id,
                'country' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
        
                'payment_type' => 'FPX',
                'payment_method' => 'FPX Online Transfer',
                'transaction_id' => 'SSTNID' .request('billcode'), //SAHIRASHOPTRANSACTIONID
                'currency' => 'myr',
                'amount' => $total_amount,
                'order_number' => 'SSON' .request('billcode'), //SAHIRASHOPOEDERNUMBER

                'holdername' => $request->name,
                'bankname' => 'FPX Transfer',
        
                'invoice_no' => 'SSIN'.request('billcode'), //SAHIRASHOPINVOICENUMBER
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),	
            ]);
            // dd($order_id);

            $carts = Cart::content();
            foreach ($carts as $cart) {
                OrderItem::insert([
                    'order_id' => $order_id, 
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'buyRefNo' => $billExtRef,
                    'created_at' => Carbon::now(),
                ]);
            }
            
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();
        }

        $url = 'https://toyyibpay.com/index.php/api/createBill';
        $response = Http::asForm()->post($url, $some_data);
        $billCode = $response[0]['BillCode'];
        return redirect('https://toyyibpay.com/' . $billCode);
    }

    public function paymentStatus(Request $request){
        $response = request()->all();
        // dd($response);

        //if payment success ipdate transaction id, order num, inv num
        if(request('status_id') == 1){
            Order::where('billExtNo', request()->order_id)->update([
                'transaction_id' => request()->transaction_id, //SAHIRASHOPTRANSACTIONID
                'order_number' => request()->order_id, //SAHIRASHOPOEDERNUMBER
                'invoice_no' => 'SSIN' .request()->billcode, //SAHIRASHOPINVOICENUMBER
                 ]);

            // collect data from db before sending email
            $invoice = Order::where('billExtNo', request()->order_id)->get("invoice_no");
            $total_amount = Order::where('billExtNo', request()->order_id)->get("amount");
            $name = Order::where('billExtNo', request()->order_id)->get("name");
            $email = Order::where('billExtNo', request()->order_id)->get("email");
            
            $data = [
                'invoice_no' => $invoice,
                'amount' => $total_amount,
                'name' => $name,
                'email' => $email,
            ];

            //send Email
            Mail::to($email)->send(new OrderMail($data));

            //get id for the product purchased from OrderItem DB
            $orderItem = OrderItem::where('buyRefNo', request()->order_id)->pluck('product_id');
            // dd($orderItem);

            //get size for the product purchased from OrderItem DB
            $sizeItem = OrderItem::where('buyRefNo', request()->order_id)->pluck('size');
            // dd($sizeItem);

            //count max data
            $arrayCount = max(count($orderItem), count($sizeItem));
            // dd($arrayCount);

            for ($i = 0; $i < $arrayCount; $i++) {
                if(isset($orderItem[$i])) {
                    // dd($orderItem[$i]);
                    //get size_type from db using product_id
                    $sizeType = Size::where('product_id',$orderItem[$i])->where('size_type',$sizeItem[$i])->pluck('quantity');  
                    // dd($sizeType);

                    //get quantity base on product id purchased before from OrderItem DB
                    $orderItem3 = OrderItem::where('buyRefNo', request()->order_id)->where('product_id', $orderItem[$i])->value('qty');
                    // dd($orderItem3);

                    //decrement process for product quantity in Product DB, base on id and quantity that we get before
                    $orderQty = Size::where('product_id', $orderItem[$i])->where('size_type', $sizeItem[$i])->decrement('quantity', $orderItem3);
                    // dd($orderQty);

                    $orderQty = Size::where('product_id', $orderItem[$i])->sum('quantity');
                    // dd($orderQty);

                    if($orderQty < 1){
                        Product::findOrFail($orderItem[$i])->update([
                            'product_qty' => 0,
                        ]);
                    }
                }
            }

            $notification = array(
                'message' => 'Your Order Place Successfully',
                'alert-type' => 'success'
            );

        }else{
            Order::where('billExtNo', request()->order_id)->update([
                'transaction_id' => request()->transaction_id, //SAHIRASHOPTRANSACTIONID
                'order_number' => request()->order_id, //SAHIRASHOPOEDERNUMBER
                'invoice_no' => request()->billcode, //SAHIRASHOPINVOICENUMBER
                'status' => 'CANCEL / UNSUCCESSFUL'
                    ]);

            // OrderItem::where('buyRefNo', request()->order_id)->delete();

            $notification = array(
                'message' => 'Your Order Unsuccessful',
                'alert-type' => 'warning'
            );
        }
        // return $response;
        return redirect()->route('my.orders')->with($notification);
    }

    public function callBack(){
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'status_id', 'order_id']);
        Log::info($response);
            
        return redirect()->route('my.orders');
    }
}
