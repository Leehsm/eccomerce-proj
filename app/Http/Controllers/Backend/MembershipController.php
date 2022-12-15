<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\membership;
use Carbon\Carbon;

class MembershipController extends Controller
{
    public function MembershipView(){
		$membership = Membership::get();
		return view('backend.stockcart.membership.view',compact('membership'));
	}

    public function AddMembership(){
		return view('backend.stockcart.membership.add');
	}

    public function MembershipStore(Request $request){

    	Membership::insert([
            'name' => $request->name,
            'ic' => $request->ic,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'created_at' => Carbon::now(),
    	]);

	    $notification = array(
			'message' => 'Membership Details Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 

    public function MembershipEdit($id){
        $membership = Membership::findOrFail($id);
        // dd($id);
        return view('backend.stockcart.membership.edit',compact('membership'));
    }
    
    
    public function MembershipUpdate(Request $request){
    
        $id = $request->id;
        // dd($request->type);
        Membership::findOrFail($id)->update([
            'name' => $request->name,
            'ic' => $request->ic,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'updated_at' =>Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Membership Detail Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-membership')->with($notification);
    } // end method 

    public function MembershipDelete($id){

    	Membership::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Membership Delectd Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method
}
