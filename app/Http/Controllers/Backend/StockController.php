<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Stock;
use Carbon\Carbon;
use Image;

class StockController extends Controller
{
    public function StockCart(){
        $stocks = Stock::latest()->get();
        return view('backend.stockcart.homepage',compact('stocks'));
    }

    //Bag
    public function BagView(){
		$bags = Stock::latest()->where('category', 'Bag')->get();
		return view('backend.stockcart.bag.view',compact('bags'));
	}

    public function AddBag(){
		return view('backend.stockcart.bag.add');
	}

    public function BagStore(Request $request){

    	$request->validate([
    		'image' => 'required',
    	],[
    		'image.required' => 'Plz Select One Image',
    	]);

    	$image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(900,1200)->save('upload/stock/bags/'.$name_gen);
    	$save_url = 'upload/stock/bags/'.$name_gen;

	    Stock::insert([
            'image' => $save_url,
            'category' => $request->category,
            'name' => $request->name,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
            'price' => $request->price,
    	]);

	    $notification = array(
			'message' => 'Bag Details Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 

    public function BagEdit($id){
        $bags = Stock::findOrFail($id);
        return view('backend.stockcart.bag.edit',compact('bags'));
    }
    
    
    public function BagUpdate(Request $request){
    
        $id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(900,1200)->save('upload/stock/bags/'.$name_gen);
            $save_url = 'upload/stock/bags/'.$name_gen;

            Stock::findOrFail($id)->update([
                'image' => $save_url,
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Bag Detail Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-bag')->with($notification);

        }else{
            Stock::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Bag Details Updated Without Image Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-bag')->with($notification);

        } // end else 
    } // end method 

    public function BagDelete($id){
    	$bags = Stock::findOrFail($id);
    	$img = $bags->image;
    	unlink($img);
    	Stock::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Bag Delectd Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method


    //Clothing
    public function ClothView(){
        $cloths = Stock::latest()->where('category', 'Clothing')->get();
        return view('backend.stockcart.clothing.view',compact('cloths'));
    }

    public function AddCloth(){
		return view('backend.stockcart.clothing.add');
	}
    
    public function ClothStore(Request $request){
    
        $request->validate([
            'image' => 'required',
        ],[
            'image.required' => 'Plz Select One Image',
        ]);
    
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1200)->save('upload/stock/cloths/'.$name_gen);
        $save_url = 'upload/stock/cloths/'.$name_gen;
    
        Stock::insert([
            'image' => $save_url,
            'category' => $request->category,
            'name' => $request->name,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Clothing Details Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    
    } // end method 
    
    public function ClothEdit($id){
        $cloths = Stock::findOrFail($id);
        return view('backend.stockcart.clothing.edit',compact('cloths'));
    }
    
    
    public function ClothUpdate(Request $request){
    
        $id = $request->id;
        $old_img = $request->old_image;
    
        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(900,1200)->save('upload/stock/cloths/'.$name_gen);
            $save_url = 'upload/stock/cloths/'.$name_gen;
    
            Stock::findOrFail($id)->update([
                'image' => $save_url,
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Clothing Detail Updated Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('manage-cloth')->with($notification);
    
        }else{
            Stock::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Clothing Details Updated Without Image Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('manage-cloth')->with($notification);
    
        } // end else 
    } // end method 
    
    public function ClothDelete($id){
        $cloths = Stock::findOrFail($id);
        $img = $cloths->image;
        unlink($img);
        Stock::findOrFail($id)->delete();
    
        $notification = array(
            'message' => 'Clothing Delectd Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->back()->with($notification);
    
    } // end method


    //WALLET
    public function WalletView(){
        $wallets = Stock::latest()->where('category', 'Wallet')->get();
        return view('backend.stockcart.wallet.view',compact('wallets'));
    }

    public function AddWallet(){
		return view('backend.stockcart.wallet.add');
	}
    
    public function WalletStore(Request $request){
    
        $request->validate([
            'image' => 'required',
        ],[
            'image.required' => 'Plz Select One Image',
        ]);
    
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1200)->save('upload/stock/wallets/'.$name_gen);
        $save_url = 'upload/stock/wallets/'.$name_gen;
    
        Stock::insert([
            'image' => $save_url,
            'category' => $request->category,
            'name' => $request->name,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Wallet Details Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    
    } // end method 
    
    public function WalletEdit($id){
        $wallets = Stock::findOrFail($id);
        return view('backend.stockcart.wallet.edit',compact('wallets'));
    }
    
    
    public function WalletUpdate(Request $request){
    
        $id = $request->id;
        $old_img = $request->old_image;
    
        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(900,1200)->save('upload/stock/wallets/'.$name_gen);
            $save_url = 'upload/stock/wallets/'.$name_gen;
    
            Stock::findOrFail($id)->update([
                'image' => $save_url,
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Wallet Detail Updated Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('manage-wallet')->with($notification);
    
        }else{
            Stock::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Wallet Details Updated Without Image Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('manage-wallet')->with($notification);
    
        } // end else 
    } // end method 
    
    public function WalletDelete($id){
        $wallets = Stock::findOrFail($id);
        $img = $wallets->image;
        unlink($img);
        Stock::findOrFail($id)->delete();
    
        $notification = array(
            'message' => 'Wallet Delectd Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->back()->with($notification);
    
    } // end method


    //SKINCARE
    public function SkincareView(){
        $skincare = Stock::latest()->where('category', 'Skincare')->get();
        return view('backend.stockcart.skincare.view',compact('skincare'));
    }

    public function AddSkincare(){
		return view('backend.stockcart.skincare.add');
	}
    
    public function SkincareStore(Request $request){
    
        $request->validate([
            'image' => 'required',
        ],[
            'image.required' => 'Plz Select One Image',
        ]);
    
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1200)->save('upload/stock/skincare/'.$name_gen);
        $save_url = 'upload/stock/skincare/'.$name_gen;
    
        Stock::insert([
            'image' => $save_url,
            'category' => $request->category,
            'name' => $request->name,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Skincare Details Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    
    } // end method 
    
    public function SkincareEdit($id){
        $skincare = Stock::findOrFail($id);
        return view('backend.stockcart.skincare.edit',compact('skincare'));
    }
    
    
    public function SkincareUpdate(Request $request){
    
        $id = $request->id;
        $old_img = $request->old_image;
    
        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(900,1200)->save('upload/stock/skincare/'.$name_gen);
            $save_url = 'upload/stock/skincare/'.$name_gen;
    
            Stock::findOrFail($id)->update([
                'image' => $save_url,
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Skincare Detail Updated Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('manage-skincare')->with($notification);
    
        }else{
            Stock::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'price' => $request->price,
        ]);
    
        $notification = array(
            'message' => 'Skincare Details Updated Without Image Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('manage-skincare')->with($notification);
    
        } // end else 
    } // end method 
    
    public function SkincareDelete($id){
        $skincare = Stock::findOrFail($id);
        $img = $skincare->image;
        unlink($img);
        Stock::findOrFail($id)->delete();
    
        $notification = array(
            'message' => 'Skincare Delectd Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->back()->with($notification);
    
    } // end method

    //SEARCH
    public function Search(Request $request){
        $item = $request->search;

        // echo "$item";

        $stocks = Stock::where('name', 'LIKE', "%$item%")->paginate(20);

        return view('backend.stockcart.homepage', compact('stocks'));
    }
}
