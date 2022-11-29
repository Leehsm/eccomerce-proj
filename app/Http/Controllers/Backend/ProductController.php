<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Quantity;
use Carbon\Carbon;
use Image;
use Auth;

class ProductController extends Controller
{
    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
        
    }

    public function StoreProduct(Request $request){

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1200)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        $image2 = $request->file('size_chart');
        if(!empty($image2)){
            $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
            Image::make($image2)->resize(900,1200)->save('upload/products/sizeChart/'.$name_gen2);
            $save_url2 = 'upload/products/sizeChart/'.$name_gen2;
        }else{
            $save_url2 = null;
        }
        
        // dd($image2);

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name_en' => $request->product_name_en,
            'product_name_my' => $request->product_name_my,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_my' => str_replace(' ', '-', $request->product_name_my),
            'product_code' => $request->product_code,
            'product_qty' => 1,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_my' => $request->product_tags_my,
            'product_size_en' => 1,
            'product_size_my' => $request->product_size_my,
            'product_color_en' => $request->product_color_en,
            'product_color_my' => $request->product_color_my,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_my' => $request->short_desc_my,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_my' => $request->long_desc_my,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            // 'new_arrival' => $request->new_arrival,
      	    // 'best_seller' => $request->best_seller,

            'product_thambnail' => $save_url,
            'size_chart' => $save_url2,
            'status' => 1,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        // dd($product_id);
        
        $quantity = explode(',',$request->product_qty);
        $size = explode(',', $request->product_size_en);
        $prod_id = $product_id;

        $arrayCount = max(count($quantity), count($size));

        for ($i = 0; $i < $arrayCount; $i++) {
            if(isset($size[$i])) {
                $size_id = Size::insertGetId([
                    'product_id' => $product_id,
                    'Size_type' => $size[$i],
                    'quantity' => $quantity[$i],
                ]);
            }
        }

        ////////// Multiple Image Upload Start ///////////
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(900,1200)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);
        }////////// End Multiple Image Upload///////////

        $notification = array(
			'message' => 'Product Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('product-manage')->with($notification);
    }

    public function ManageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id){
        
        $categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		$subcategory = SubCategory::latest()->get();
		$subsubcategory = SubSubCategory::latest()->get();
		$products = Product::findOrFail($id);
        $size = Size::where('product_id',$id)->get('size_type');
        $quantity = Size::where('product_id',$id)->get('quantity');//->implode(',', all())
        $multiImgs = MultiImg::where('product_id',$id)->get();
		return view('backend.product.product_edit',compact('categories','brands','subcategory','subsubcategory','products','size','quantity','multiImgs'));

    }

    public function ReviewProduct($id){

        $categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		$subcategory = SubCategory::latest()->get();
		$subsubcategory = SubSubCategory::latest()->get();
		$products = Product::findOrFail($id);
        $size = Size::where('product_id',$id)->get('size_type');
        $quantity = Size::where('product_id',$id)->get('quantity');//->implode(',', all())
        $multiImgs = MultiImg::where('product_id',$id)->get();

        $join = DB::table('sizes')
        ->join('products', 'sizes.product_id', '=', 'products.id')
        ->where('products.id', $id)
        ->select('products.*', 'sizes.id as size_id', 'sizes.*')
        ->get();

        // dd($join);

		return view('backend.product.product_display',compact('categories','brands','subcategory','subsubcategory','products','size','quantity','multiImgs'));

    }

    public function UpdateDataProduct(Request $request){

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_my' => $request->product_name_my,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_my' => str_replace(' ', '-', $request->product_name_my),
            'product_code' => $request->product_code,

            // 'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_my' => $request->product_tags_my,
            // 'product_size_en' => $request->product_size_en,
            // 'product_size_my' => $request->product_size_my,
            'product_color_en' => $request->product_color_en,
            'product_color_my' => $request->product_color_my,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_my' => $request->short_desc_my,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_my' => $request->long_desc_my,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals, 
            // 'new_arrival' => $request->new_arrival,
            // 'best_seller' => $request->best_seller,      	 
            'status' => 1,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(), 
        ]);

        $quantity = explode(',',$request->product_qty);
        $size = explode(',', $request->product_size_en);
        // dd($size);
        $prod_id = $product_id;

        $arrayCount = max(count($quantity), count($size));

        for ($i = 0; $i < $arrayCount; $i++) {
            if(isset($size[$i])) {
                Size::where('product_id',$product_id)->update([
                    'Size_type' => $size[$i],
                    'quantity' => $quantity[$i],
                    'updated_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
		);

		return redirect()->route('product-manage')->with($notification);

    }

    public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(900,1200)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now(),
            ]);
	    } 

       $notification = array(
			'message' => 'Product Image Updated Successfully',
			'alert-type' => 'info'
		);
		return redirect()->back()->with($notification);
	}

    public function ThambnailImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);
   
        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1200)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
   
    } // end method

    public function SizeChartUpdate(Request $request){

        $pro_id = $request->id;
        $oldImage = $request->old_img;

        if(empty($oldImage)){
            
            $image = $request->file('size_chart');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1000,1000)->save('upload/products/sizeChart/'.$name_gen);
            $save_url = 'upload/products/sizeChart/'.$name_gen;
    
            Product::findOrFail($pro_id)->update([
                'size_chart' => $save_url,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now(),
    
            ]);

        }else{

            unlink($oldImage);

            $image = $request->file('size_chart');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1000,1000)->save('upload/products/sizeChart/'.$name_gen);
            $save_url = 'upload/products/sizeChart/'.$name_gen;

            Product::findOrFail($pro_id)->update([
                'size_chart' => $save_url,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now(),

            ]);
        }

        $notification = array(
            'message' => 'Product Image size Chart Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
   
    } // end method

    //// Multi Image Delete ////
    public function MultiImageDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
           'message' => 'Product Image Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    } // end method 

    public function ProductInactive($id){
     	Product::findOrFail($id)->update(['status' => 0]);
     	$notification = array(
			'message' => 'Product Inactive',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
     }


    public function ProductActive($id){
  	    Product::findOrFail($id)->update(['status' => 1]);
     	$notification = array(
			'message' => 'Product Active',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

     }

    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        
        if(!empty($product->product_thambnail)){
            unlink($product->product_thambnail);
        }
        

        if(!empty($product->size_chart)){
            unlink($product->size_chart);
        }

        Product::findOrFail($id)->delete();
        Size::where('product_id',$id)->delete();

        $images = MultiImg::where('product_id',$id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
           'message' => 'Product Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    }

    // public function SizeUpdate(Request $request){

    //     $data = Size::where('product_id',$request->prod_id)->get();
    //     $data2 = count($data);

    //     // dd($data2);
    //     // dd(Size::where('id',$request->id)->get('product_id'));

    //     for ($i = 0; $i < $data2; $i++) {
    //         // if(isset($size[$i])) {
    //         Size::where('product_id', $request->prod_id[$i])->update([
    //         'size_type' => $request->product_size,
    //         'quantity' => $request->product_qty,
    //         ]);
    //         // }
    //     }

    //     // Size::findOrFail($request->id)->update([
    //     //     'size_type' => $request->product_size,
    //     //     'quantity' => $request->product_qty,
    //     //     'updated_at' => Carbon::now(),
    //     // ]);

    //    $notification = array(
	// 		'message' => 'Product Size Updated Successfully',
	// 		'alert-type' => 'info'
	// 	);
	// 	return redirect()->back()->with($notification);
	// }

    // public function SizeDelete($id){
    //     Size::findOrFail($id)->delete();

    //     $notification = array(
    //        'message' => 'Product Size Deleted Successfully',
    //        'alert-type' => 'success'
    //    );

    //    return redirect()->back()->with($notification);

    // } // end method 


}
