<?php

namespace App\Http\Controllers;

use App\Models\ProductDetailsModel;
use App\Models\ProductListModel;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class ProductDetailsController extends Controller
{

    function ProductDetails(Request $request){

        $product_code=$request->code;

        $ProductDetails= ProductDetailsModel::Where('product_code',$product_code)->get();
        $ProductList= ProductListModel::Where('product_code',$product_code)->get();

        $item=[
            'ProductDetails'=>$ProductDetails,
            'ProductList'=>$ProductList,
        ];

        return $item;

    }
    function AddProductDetail(Request $request){
        $product_code=$request->input('product_code');
        $img1=$request->file('img1')->store('products');
        $img2=$request->file('img2')->store('products');
        $img3=$request->file('img3')->store('products');
        $img4=$request->file('img4')->store('products');
        $des=$request->input('des');
        $color=$request->input('color');
        $size=$request->input('size');
        $details=$request->input('details');
    
        $result=ProductDetailsModel::insert([
            'product_code'=>$product_code,
            'img1'=>$img1,
            'img2'=>$img2,
            'img3'=>$img3,
            'img4'=>$img4,
            'des'=>$des,
            'color'=>$color,
            'size'=>$size,
            'details'=>$details,     
        ]);

        return $result;
        
    }
    function ProductDetail(){
        $result=ProductDetailsModel::all();
        return $result;
    }
    function ProductDetailDelete(Request $request){
        $id=$request->input('id');
        $result=ProductDetailsModel::where('id','=',$id)->delete();
        return $result;
    }
}
