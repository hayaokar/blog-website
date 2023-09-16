<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BlogController extends Controller
{
    public function AllBlog(){
        $blogs = Blog::latest()->get();
        return view('admin.blog.blog_all',compact('blogs'));

    }

    public function AddBlog(){
        $categories = BlogCategory::orderBy('name','ASC')->get();
        return view('admin.blog.blog_add',compact('categories'));
    }

    public function StoreBlog(Request $request){



        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

        Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        Blog::insert([
            'blog_category_id'=>$request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'blog_tags' => $request->blog_tags,
            'created_at'=> Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);


    }

    public function EditBlog($id){
        $blog = Blog::findorfail($id);
        $categories = BlogCategory::orderBy('name','ASC')->get();
        return view('admin.blog.edit_blog',compact('blog','categories'));
    }

    public function UpdateBlog(Request $request){
        $blog_id = $request->id;

        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id'=>$request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
                'blog_tags' => $request->blog_tags,

            ]);
            $notification = array(
                'message' => 'Blog with image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        }

        else{
            Blog::findOrFail($blog_id)->update([
                'blog_category_id'=>$request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_description' => $request->blog_description,

                'blog_tags' => $request->blog_tags,

            ]);
            $notification = array(
                'message' => 'Blog without image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function DeleteBlog($id){
        $blog = Blog::findorfail($id);
        $image_url = $blog->blog_image;
        unlink($image_url);
        Blog::findorfail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DetailsBlog($id){
        $blog = Blog::findorfail($id);
        $blogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::all();
        return view('frontend.blog_page',compact('blog','blogs','categories'));
    }

    public function CategoryBlog($id){


        $blogpost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('name','ASC')->get();
        $categoryname = BlogCategory::findorfail($id)->name;
        return view('frontend.category_blogs',compact('blogpost','allblogs','categories','categoryname'));
    }

    public function HomeBlog(){
        $allblogs = Blog::latest()->get();
        $categories = BlogCategory::orderBy('name','ASC')->get();
        return view('frontend.blog',compact('allblogs','categories'));
    }

}
