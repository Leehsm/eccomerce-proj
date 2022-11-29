<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function CategoryView(){

        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_my' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'Input English Category Name',
            'category_name_my.required' => 'Input Malay Category Name',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_my' => $request->category_name_my,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_my' => str_replace(' ', '-',$request->category_name_my),
            'category_icon' => $request->category_icon,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id){

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request){

        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_my' => $request->category_name_my,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_my' => str_replace(' ', '-',$request->category_name_my),
            'category_icon' => $request->category_icon,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id){

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
