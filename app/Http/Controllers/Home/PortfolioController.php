<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use App\Models\MultiImage;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
class PortfolioController extends Controller
{
    public function AllPortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolio'));
    }
    public function AddPortfolio(){

        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request){

        $request->validate([
           'name'=>'required',
            'title'=>'required',
            'image'=>'required',
        ],[
            'name.required' => 'Portfolio name is required',
            'title.required' => 'Portfolio title is required'
        ]);


        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

        Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
        $save_url = 'upload/portfolio/'.$name_gen;

        Portfolio::insert([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
            'created_at'=>Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);



        }

        public function EditPortfolio($id){
            $portfolio = Portfolio::findorfail($id);
            return view('admin.portfolio.edit_portfolio',compact('portfolio'));
        }

        public function UpdatePortfolio(Request $request){
            $portfolio_id = $request->id;

            if ($request->file('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

                Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
                $save_url = 'upload/portfolio/'.$name_gen;

                Portfolio::findOrFail($portfolio_id)->update([
                    'name' => $request->name,
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Portfolio with image Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.portfolio')->with($notification);
            }

            else{
                Portfolio::findOrFail($portfolio_id)->update([
                    'name' => $request->name,
                    'title' => $request->title,
                    'description' => $request->description,

                ]);
                $notification = array(
                    'message' => 'Portfolio without image Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.portfolio')->with($notification);
            }
            }

            public function DeletePortfolio($id){
                $portfolio = Portfolio::findorfail($id);
                $image_url = $portfolio->image;
                unlink($image_url);
                Portfolio::findorfail($id)->delete();

                $notification = array(
                    'message' => 'Portfolio Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }

            public function DetailsPortfolio($id){
                $portfolio = Portfolio::findorfail($id);
                return view('frontend.portfolio_page',compact('portfolio'));
            }

            public function HomePortfolio(){
                $portfolio = Portfolio::latest()->get();
                return view('frontend.portfolio',compact('portfolio'));
            }



}
