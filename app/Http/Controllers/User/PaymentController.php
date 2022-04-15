<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class PaymentController extends Controller
{
    public function StripeOrder(Request $request){
        if (Session::has('coupon')) {
    		$total_amount = Session::get('coupon')['total_amount'];
    	}else{
    		$total_amount = round(Cart::total());
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
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
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
    
            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
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

    } // end method 

    // public function FPXOrder(Request $request){
    //     $stripe = new \Stripe\StripeClient('sk_test_51Kl2mfAXlhPfw81sbjS5rLjGKHGq4Ehi19jkQnxYlMxvBYESfXsJgLNq5eOefDoUtU5kIlykvdkdisPP1BdGx5wy008MtvwEON');
    //     $stripe->paymentIntents->create(
    //         ['payment_method_types' => ['fpx'], 'amount' => 1099, 'currency' => 'myr']
    //         );
    // }
}
