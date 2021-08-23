<?php

namespace App\Http\Controllers;
use App\Models\ProductListModel;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    function ProductListByRemark(Request $request){
        $remark= $request->remark;
        $ProductList=ProductListModel::Where('remark',$remark)->get();
        return $ProductList;
    }

    function ProductListBySubCategory(Request $request){
        $Category= $request->Category;
        $SubCategory= $request->SubCategory;
        $ProductList=ProductListModel::Where('category',$Category)->Where('subcategory',$SubCategory)->get();
        return $ProductList;
    }

    function ProductListByCategory(Request $request){
        $Category= $request->Category;
        $ProductList=ProductListModel::Where('category',$Category)->get();
        return $ProductList;
    }

    function ProductBySearch(Request $request){
        $key= $request->key;
        $ProductList= ProductListModel::Where('title','LIKE',"%{$key}%")->get();
        return $ProductList;
    }
    function SimilarProduct(Request $request){
        $subcategory= $request->subcategory;
        $ProductList=ProductListModel::Where('subcategory',$subcategory)->orderBy('id','desc')->limit(12)->get();
        return $ProductList;
    }
}
