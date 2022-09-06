<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function ContactView(){
    	$contacts = Contact::latest()->get();
    	return view('backend.contact.view_contact',compact('contacts'));
    }

    public function ContactStore(Request $request){
    	$request->validate([
    		'contact_call' => 'required',
    		'contact_company' => 'required',
    		'contact_location' => 'required',
    	]);

        Contact::insert([
            'contact_call' => $request->contact_call,
            'contact_company' => $request->contact_company, 
            'contact_location' => $request->contact_location,
            'created_at' => Carbon::now(),
            ]);

        $notification = array(
            'message' => 'Contact Inserted Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    } // end method 

    public function ContactEdit($id){
        $contacts = Contact::findOrFail($id);
        return view('backend.contact.edit_contact',compact('contacts'));
    }

    public function ContactUpdate(Request $request, $id){
        Contact::findOrFail($id)->update([
            'contact_call' => $request->contact_call,
            'contact_company' => $request->contact_company, 
            'contact_location' => $request->contact_location,
            'created_at' => Carbon::now(),
           ]);
        $notification = array(
            'message' => 'Contact Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('manage-contact')->with($notification);
    } // end mehtod 

    public function ContactDelete($id){
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Contact Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
