<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactPage(){
        return view('frontend.contact_page');
    }

    public function ContactSend(Request $request){
        Contact::insert([
            'name'=>$request->name,
            'email' => $request->email,
            'message' => $request->message,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'created_at'=> Carbon::now(),

        ]);
        $notification = array(
            'message' => 'message sent Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ContactMessages(){
        $data = Contact::all();
        return view('admin..contact.contact_messages',compact('data'));
    }

    public function DeleteMessage($id){
        Contact::findorfail($id)->delete();

        $notification = array(
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
