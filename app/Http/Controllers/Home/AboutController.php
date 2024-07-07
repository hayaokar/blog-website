<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    public function AboutPage(){
        $about = About::find(1);
        return view('admin.about_page.about_page_all',compact('about'));
    }

    public function UpdateAbout(Request $request){
        $about_id = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(523,605)->save('upload/about_image/'.$name_gen);
            $save_url = 'upload/about_image/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,


            ]);
            $notification = array(
                'message' => 'About Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } else{

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,



            ]);
            $notification = array(
                'message' => 'About Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } // end Else

    }


    public function HomeAbout(){
        $blogs = Blog::latest()->get();
        return view('frontend.about_page',compact('blogs'));
    }

    public function AboutMultiImage(){
        return view('admin.about_page.about_multi_image');
    }

    public function UpdateMultiImage(Request $request){
        $images = $request->file('multi_image');

        foreach ($images as $image){

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);
            $save_url = 'upload/multi/'.$name_gen;

            MultiImage::insert([

                'multi_image' => $save_url,
                'created_at' => Carbon::now()

            ]);

        }

        $notification = array(
            'message' => 'Multi Images Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllMultiImage(){
        $images = MultiImage::all();
        return view('admin.about_page.multi_image_all',compact('images'));
    }

    public function EditMultiImage($id){
        $image = MultiImage::findorfail($id);
        return view('admin.about_page.edit_multi_imag',compact('image'));
    }

    public function EditMultiImage1(Request $request){
        $image_id = $request->id;

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);
            $save_url = 'upload/multi/'.$name_gen;

            MultiImage::findOrFail($image_id)->update([
                'multi_image' => $save_url,
            ]);
    }
        $notification = array(
            'message' => 'Multi Image updates Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.multi.image')->with($notification);
    }

    public function DeleteMultiImage($id){
        $image = MultiImage::findorfail($id);
        $image_url = $image->multi_image;
        unlink($image_url);
        MultiImage::findorfail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
