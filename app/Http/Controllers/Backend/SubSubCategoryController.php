<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;


class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView(){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.subsubcategory_view', compact('subsubcategory','subcategory','categories'));
    }

    public function SubSubCategoryStore(Request $request){

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_my' => 'required',
        ],[
            'category_id.required' => 'Please Select Any Option',
            'subcategory_id.required' => 'Please Select Any Option',
            'subsubcategory_name_en.required' => 'Input English Sub Sub Category Name',
            // 'subcategory_name_my.required' => 'Input Malay Sub Category Name',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_my' => $request->subsubcategory_name_my,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_my' => str_replace(' ', '-',$request->subsubcategory_name_my),
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        return view('backend.category.subsubcategory_edit', compact('subsubcategory','subcategories','categories'));
    }

    public function SubSubCategoryUpdate(Request $request){

        $subcat_id = $request->id;

        SubSubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_my' => $request->subsubcategory_name_my,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_my' => str_replace(' ', '-',$request->subsubcategory_name_my),
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id){

        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Sub Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function GetSubCategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function GetSubSubCategory($subcategory_id){

        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
    }
}
