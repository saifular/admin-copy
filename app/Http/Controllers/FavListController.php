<?php

namespace App\Http\Controllers;

use App\Models\FavListModel;
use App\Models\CartModel;
use App\Models\ProductListModel;
use Illuminate\Http\Request;

class FavListController extends Controller
{
    function addFav(Request $request){
       $code= $request->code;
       $mobile= $request->mobile;
       $ProductDetails= ProductListModel::Where('product_code', $code)->get();
       $result= FavListModel::insert([
           'title'=>$ProductDetails[0]['title'],
           'image'=>$ProductDetails[0]['image'],
           'product_code'=>$code,
           'mobile'=>$mobile,
        ]);
       return $result;
    }


    function favList(Request $request){
        $mobile= $request->mobile;
        $result=FavListModel::Where('mobile',$mobile)->get();
        return  $result;
    }

    function removeFavItem(Request $request){
        $code= $request->code;
        $mobile= $request->mobile;
        $result=FavListModel::Where('mobile',$mobile)->Where('product_code',$code)->delete();
        return  $result;
    }
    function AddToCartTable(Request $request){
        $color=$request->input('color');
        $size=$request->input('size');
        $quantity=$request->input('quantity');
        $mobileNo=$request->input('mobileNo');
        $product_code=$request->input('product_code');

        $ProductDetails=ProductListModel::Where('product_code',$product_code)->get();
        $price=$ProductDetails[0]['price'];
        $special_price=$ProductDetails[0]['special_price'];
        if($special_price=="NA"){
            $total_price=$price*$quantity;
            $unit_price=$price;
        }
        else{
            $total_price=$special_price*$quantity;
            $unit_price= $special_price;
        }
        $result=CartModel::insert([
            'img'=>$ProductDetails[0]['image'],
            'product_name'=>$ProductDetails[0]['title'],
            'product_code'=>$product_code,
            'shop_name'=>$ProductDetails[0]['shop_name'],
            'shop_code'=>$ProductDetails[0]['shop'],
            'product_info'=>"Color: ". $color." Size: ".$size,
            'product_quantity'=>$quantity,
            'unit_price'=>$unit_price,
            'total_price'=>$total_price,
            'mobile'=>$mobileNo,
        ]);
        return $result;
    }
}