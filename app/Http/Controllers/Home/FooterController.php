<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function FooterSetup(){
        $footer = Footer::findorfail(1);
        return view('admin.footer.footer_all',compact('footer'));
    }

    public function FooterUpdate(Request $request){
        $footer_id = $request->id;





        Footer::findOrFail($footer_id)->update([
            'number' => $request->number,
            'short_description' => $request->short_description,
            'address' => $request->email,
            'email' => $request->address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright,



        ]);
        $notification = array(
            'message' => 'Footer section Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);




        } // end Else

}
