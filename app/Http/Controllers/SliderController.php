<?php

namespace App\Http\Controllers;
use App\Models\SliderModel;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    function SendSliderInfo(){
        $result= SliderModel::all();
        return $result;
     }
     function SliderShow(){
        $result=SliderModel::all();
        return $result;
    }
    function SliderDelete(Request $request){
        $id=$request->input('id');
        $result=SliderModel::where('id','=',$id)->delete();
        return $result;
    }
    function AddSlider(Request $request){
        $text_color=$request->input('text_color');
        $bg_color=$request->input('bg_color');
        $image=$request->file('image')->store('products');
        $title=$request->input('title');
        $sub_title=$request->input('sub_title');
        $product_code=$request->input('product_code');

        $result=SliderModel::insert([
            'text_color'=>$text_color,
            'bg_color'=>$bg_color,
            'image'=>$image,
            'title'=>$title,
            'sub_title'=>$sub_title,
            'product_code'=>$product_code,  
        ]);

        return $result;
        
    }
}
