<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Blog;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class IndexController extends Controller
{
    public function index(){

        // return view('frontend.index');
        
    	$products = Product::where('status',1)
                            ->orderBy('id','DESC')
                            ->latest()
                            ->get();
    	$sliders = Slider::where('status',1)
                        ->orderBy('id','DESC')
                        ->limit(3)
                        ->get();

        $categories = Category::orderBy('category_name_en','ASC')->get();

    	$featured = Product::where('featured',1)
                            ->where('status',1)
                            ->orderBy('id','DESC')
                            ->limit(6)
                            ->get();
    	$hot_deals = Product::where('hot_deals',1)
                            ->where('status',1)
                            ->where('discount_price','!=',NULL)
                            ->orderBy('id','DESC')
                            ->latest()->get();
    	$special_offer = Product::where('special_offer',1)
                                ->where('status',1)
                                ->orderBy('id','DESC')
                                ->limit(6)
                                ->get();
    	$special_deals = Product::where('special_deals',1)
                                ->where('status',1)
                                ->orderBy('id','DESC')
                                ->limit(3)
                                ->get();

    	$skip_category_0 = Category::skip(0)->first();
    	$skip_product_0 = Product::where('status',1)
                                ->where('category_id',$skip_category_0->id)
                                ->where('status',1)
                                ->orderBy('id','DESC')
                                ->get();

        $skip_category_1 = Category::skip(1)->first();
    	$skip_product_1 = Product::where('status',1)
                                ->where('category_id',$skip_category_1->id)
                                ->where('status',1)
                                ->orderBy('id','DESC')
                                ->get();

    	$skip_brand_1 = Brand::skip(1)->first();
    	$skip_brand_product_1 = Product::where('status',1)
                                        ->where('brand_id',$skip_brand_1->id)
                                        ->where('status',1)
                                        ->orderBy('id','DESC')
                                        ->get();


    	// return $skip_category->id;
    	// die();

    	return view('frontend.index',compact('categories','sliders','products','featured','hot_deals','special_offer','special_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'));
    }

    public function UserLogout(){

        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request){

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Your Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function UserUpdateChangePassword(Request $request){
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }
    }

    public function ProductDetails($id,$slug){
		$product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
		$product_color_en = explode(',', $color_en);

		$color_my = $product->product_color_my;
		$product_color_my = explode(',', $color_my);

		$size_en = $product->product_size_en;
		$product_size_en = explode(',', $size_en);

		$size_my = $product->product_size_my;
		$product_size_my = explode(',', $size_my);

        $multiImag = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
		$relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->where('product_qty','>=',1)->orderBy('id','DESC')->get();
	 	return view('frontend.product.product_details',compact('product','multiImag','product_color_en','product_color_my','product_size_en','product_size_my','relatedProduct'));

	}

    public function TagWiseProduct($tag){
		$products = Product::where('status',1)->where('product_tags_en',$tag)->where('product_tags_my',$tag)->orderBy('id','DESC')->paginate(3);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.tags.tags_view',compact('products','categories'));

	}

    public function ColorWiseProduct($color){
		$products = Product::where('status',1)->where('product_color_en',$color)->orderBy('id','DESC')->paginate(3);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.tags.colors_view',compact('products','categories'));

	}

    // Subcategory wise data
	public function SubCatWiseProduct($subcat_id,$slug){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.product.subcategory_view',compact('products','categories'));

	}
    
    // Sub-Subcategory wise data
	public function SubSubCatWiseProduct($subsubcat_id,$slug){
		$products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.product.sub_subcategory_view',compact('products','categories'));

	}

    public function ProductViewAjax($id){
		$product = Product::with('category','brand')->findOrFail($id);

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

    }

    public function ContactUs(){
        return view('frontend.others.contactUs');
    }
    public function Faq(){
        return view('frontend.others.faq');
    }
    public function Delivery(){
        return view('frontend.others.delivery');
    }
    public function Blog(){
        $blogs = Blog::where('status',1)
                        ->orderBy('id','DESC')
                        ->get();
        return view('frontend.others.blog', compact('blogs'));
    }
    public function BlogDetail($id){
        $blogs = Blog::findOrFail($id);

        $image = $blogs->blogImg;
		$title = $blogs->title;

		$date = $blogs->date;
		$description = $blogs->description;
		$description2 = $blogs->long_description;

        return view('frontend.others.blogDetails', compact('blogs','image','title','date','description','description2'));
    }
}
