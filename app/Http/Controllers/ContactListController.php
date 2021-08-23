<?php

namespace App\Http\Controllers;

use App\Models\adminModel;
use App\Models\contactModel;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
        function SendContactDetails(Request $request){
            $name=$request->input('name');
            $mobile=$request->input('mobile');
            $message=$request->input('message');
            date_default_timezone_set("Asia/Dhaka");
            $contact_time= date("h:i:sa");
            $contact_date= date("d-m-Y");

            $result= ContactModel::insert([
                'name'=>$name,
                'mobile'=>$mobile,
                'message'=>$message,
                'contact_date'=>$contact_date,
                'contact_time'=>$contact_time
            ]);

            return $result;
        }
        function Contact(){
            $result=ContactModel::orderBy('id','desc')->get();
            return $result;
        }
        function ContactDelete(Request $request){
            $id=$request->input('id');
            $result=ContactModel::where('id','=',$id)->delete();
            return $result;
        }
}
