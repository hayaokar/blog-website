<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    //
    public function AllBlogCategory(){
        $categories = BlogCategory::all();
        return view('admin.blog_category.all_blog_categories',compact('categories'));
    }

    public function AddBlogCategory(){
        return view('admin.blog_category.add_blog_category');
    }

    public function StoreBlogCategory(Request $request){

        BlogCategory::insert([
            'name'=>$request->name
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category.all')->with($notification);
    }

    public function EditBlogCategory($id){
        $category = BlogCategory::findorfail($id);
        return view('admin.blog_category.edit_blog_category',compact('category'));
    }

    public function UpdateBlogCategory(Request $request){
        $category_id  = $request->id;

        BlogCategory::findOrFail($category_id)->update([
            'name' => $request->name,

        ]);
        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category.all')->with($notification);
    }

    public function DeleteBlogCategory($id){
        BlogCategory::findorfail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
