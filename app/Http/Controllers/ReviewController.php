<?php

namespace App\Http\Controllers;
use App\Models\ReviewModel;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function postReview(Request $request){
        $product_name=  $request->input('product_name');
        $product_code=  $request->input('product_code');
        $mobile=  $request->input('mobile');
        $reviewer_photo=$request->input('reviewer_photo');
        $reviewer_name=$request->input('reviewer_name');
        $reviewer_rating=$request->input('reviewer_rating');
        $reviewer_comments=$request->input('reviewer_comments');
        $result= ReviewModel::insert([
            'product_code'=>$product_code,
            'product_name'=>$product_name,
            'mobile'=>$mobile,
            'reviewer_photo'=>$reviewer_photo,
            'reviewer_name'=> $reviewer_name,
            'reviewer_rating'=> $reviewer_rating,
            'reviewer_comments'=>$reviewer_comments,
        ]);
        return $result;
    }

    function reviewList(Request $request){
        $code=  $request->code;
        $result= ReviewModel::where('product_code',$code)->orderBy('id','desc')->limit(7)->get();
        return $result;
    }
    function Review(){
        $result=ReviewModel::all();
        return $result;
    }
    function ReviewDelete(Request $request){
        $id=$request->input('id');
        $result=ReviewModel::where('id','=',$id)->delete();
        return $result;
    }
}
