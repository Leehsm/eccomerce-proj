<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Models\TempCheckoutData;
use Carbon\Carbon;

use Auth;

use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{
    public function DistrictGetAjax($division_id){

    	$ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
    	return json_encode($ship);

    } // end method 


    public function StateGetAjax($district_id){

    	$ship = ShipState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
    	return json_encode($ship);

    } // end method 

    public function CheckoutStore(Request $request){
		$sabahsarawak = 15;
		$semenanjung = 10;
		// dd($request->all());
		
		$shipping_name = strtoupper($request->shipping_name);
    	$shipping_email = strtoupper($request->shipping_email);
    	$shipping_phone = $request->shipping_phone;
    	$address1 = strtoupper($request->address1);
    	$address2 = strtoupper($request->address2);
    	$post_code = strtoupper($request->post_code);
    	$district = strtoupper($request->district);
    	$state = strtoupper($request->state);
    	$country = strtoupper($request->country);
    	$notes = $request->notes;
    	$amount = $request->amount;

    	$data = array();
    	$data['shipping_name'] = strtoupper($request->shipping_name);
    	$data['shipping_email'] = strtoupper($request->shipping_email);
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['address1'] = strtoupper($request->address1);
    	$data['address2'] = strtoupper($request->address2);
    	$data['post_code'] = strtoupper($request->post_code);
    	$data['district'] = strtoupper($request->district);
    	$data['state'] = strtoupper($request->state);
    	$data['country'] = strtoupper($request->country);
    	$data['notes'] = $request->notes;

		if($data['state'] == 'SABAH' || $data['state'] == 'SARAWAK')
    		$data['amount'] = $request->amount + $sabahsarawak;
		else
			$data['amount'] = $request->amount + $semenanjung;

        $cartTotal = Cart::total();
        // dd($data);

		TempCheckoutData::insertGetId([
			// 'id' => increments('id'),
			'user_id' => Auth::id(),
            'name' => $shipping_name,
			'email' => $shipping_email,
			'phone' => $shipping_phone,
			'address1' => $address1,
			'address2' => $address2,
			'post_code' => $post_code,
			'district' => $district,
			'state' => $state,
			'country' => $country,
			'notes' => $notes,
			'total_amount' => $amount,
            'created_at' => Carbon::now(),
            ]);

		return view('frontend.payment.fpx', compact('data', 'cartTotal', 'shipping_name', 'shipping_email', 'shipping_phone', 'address1', 'address2', 'post_code', 'district', 'state', 'country', 'notes', 'amount'));

    	// if ($request->payment_method == 'stripe') {
    	// 	return view('frontend.payment.stripe',compact('data', 'cartTotal'));
    	// }elseif ($request->payment_method == 'fpx') {
    	// 	return view('frontend.payment.fpx', compact('data', 'cartTotal', 'shipping_name', 'shipping_email', 'shipping_phone', 'address1', 'address2', 'post_code', 'district', 'state', 'country', 'notes', 'amount'));
    	// }else{
        //     return 'cash';
    	// }
    }
}
