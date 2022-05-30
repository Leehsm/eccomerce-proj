<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use Carbon\Carbon;
use Image;

class BlogController extends Controller
{
    public function BlogView(){
        $blog = Blog::latest()->get();
        return view('backend.blog.blog_view', compact('blog'));
    }

    public function BlogAdd(){
        return view('backend.blog.blog_add');
    }

    public function BlogStore(Request $request){
        $request->validate([
    		'blogImg' => 'required',
    	],[
    		'blogImg.required' => 'Please Select One Image',
    	]);

    	$image = $request->file('blogImg');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(780,433)->save('upload/blogs/'.$name_gen);
    	$save_url = 'upload/blogs/'.$name_gen;

	    Blog::insert([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'long_description' => $request->long_description,
            'blogImg' => $save_url,
    	]);

	    $notification = array(
			'message' => 'Blog Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }

    public function BlogEdit($id){
        $blogs = Blog::findOrFail($id);
        return view('backend.blog.blog_edit',compact('blogs'));
    }

    public function BlogUpdate(Request $request){
        $blog_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('blogImg')) {
            unlink($old_img);
            $image = $request->file('blogImg');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(780,433)->save('upload/blogs/'.$name_gen);
            $save_url = 'upload/blogs/'.$name_gen;

            Blog::findOrFail($blog_id)->update([
                'title' => $request->title,
                'date' => $request->date,
                'description' => $request->description,
                'description2' => $request->long_description,
                'blogImg' => $save_url,
        ]);

        $notification = array(
            'message' => 'Blog Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all-blog')->with($notification);

        }else{
            Blog::findOrFail($blog_id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'description2' => $request->long_description,
        ]);

        $notification = array(
            'message' => 'Blog Updated Without Image Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all-blog')->with($notification);
        }
    }

    public function BlogDelete($id){
    	$blog = Blog::findOrFail($id);
    	$img = $blog->blogImg;
    	unlink($img);
    	Blog::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Blog Deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method


    public function BlogInactive($id){
        Blog::findOrFail($id)->update(['status' => 0]);
        $notification = array(
           'message' => 'Blog Inactive',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }


   public function BlogActive($id){
        Blog::findOrFail($id)->update(['status' => 1]);
        $notification = array(
           'message' => 'Blog Active',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    }

}