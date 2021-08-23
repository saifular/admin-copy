<?php

namespace App\Http\Controllers;
use App\Models\signupModel;
use App\Models\ProductListModel;
use App\Models\CategoryLavel1Model;
use App\Models\CategoryLavel2Model;
use App\Models\SliderModel;
use App\Models\ReviewModel;
use App\Models\DirectOrderModel;
use App\Models\contactModel;
use App\Models\ProductDetailsModel;
use App\Models\AdminLoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
class signupListController extends Controller
{
    function SendSingupDetails(Request $request){
        $title=$request->input('title');
        $price=$request->input('price');
        $special_price=$request->input('special_price');
        $image=$request->file('image')->store('products');
        $category=$request->input('category');
        $subcategory=$request->input('subcategory');
        $remark=$request->input('remark');
        $brand=$request->input('brand');
        $shop=$request->input('shop');
        $shop_name=$request->input('shop_name');
        $star=$request->input('star');
        $product_code=$request->input('product_code');
        $stock=$request->input('stock');
        
     
        $result=ProductListModel::insert([
            'title'=>$title,
            'price'=>$price,
            'special_price'=>$special_price,
            'image'=>$image,
            'category'=>$category,
            'subcategory'=>$subcategory,
            'remark'=>$remark,
            'brand'=>$brand,
            'shop'=>$shop,
            'shop_name'=>$shop_name,
            'star'=>$star,
            'product_code'=>$product_code,
            'stock'=>$stock,
            
        ]);

        return $result;
        
    }
    function SendSingup(Request $request){
        $image=$request->file('image')->store('products');
        $name=$request->input('name');
        $mobile=$request->input('mobile');
        $password=$request->input('password');
        
        $result=signupModel::insert([
            'image'=>$image,
            'name'=>$name,
            'mobile'=>$mobile,
            'password'=>$password,
        ]);

        return $result;
        
    }
    function ProductList(){
        $result=ProductListModel::all();
        return $result;
    }
    function ProjectDelete(Request $request){
        $id=$request->input('id');
        $result=ProductListModel::where('id','=',$id)->delete();
        return $result;
    }

    function Verification(Request $request){
        $mobile= $request->input('mobile');
        $password= $request->input('password');
        $countNo= signupModel::Where('mobile',$mobile)->Where('password',$password)->count();
        if($countNo>0){
            return 1;
        }
        else{
            return 0;
        }
    }
    function SignUp(Request $request){
        $mobile= $request->mobile;
        $result=signupModel::Where('mobile',$mobile)->get();
        return  $result;
    }
    function SignUps(){
        $result=signupModel::all();
        return  $result;
    }
    function CountSummary(){
        $ProductListModel=ProductListModel::count();
        $signupModel=signupModel::count();
        $CategoryLavel1Model=CategoryLavel1Model::count();
        $CategoryLavel2Model=CategoryLavel2Model::count();
        $SliderModel=SliderModel::count();
        $ReviewModel=ReviewModel::count();
        $DirectOrderModel=DirectOrderModel::count();
        $contactModel=contactModel::count();
        $ProductDetailsModel=ProductDetailsModel::count();
        $totalCount=array('addproduct'=>$ProductListModel,'contact'=>$contactModel,'order'=>$DirectOrderModel,'category'=>$CategoryLavel1Model,'subcategory'=>$CategoryLavel2Model,'review'=>$ReviewModel,'slider'=>$SliderModel,'productdetails'=>$ProductDetailsModel,'user'=>$signupModel);
        return json_encode($totalCount);
    }

    function Verifications(Request $request){
        $user_name= $request->input('user_name');
        $password= $request->input('password');
        $countNo=AdminLoginModel::Where('user_name',$user_name)->Where('password',$password)->count();
        if($countNo>0){
            return 1;
        }
        else{
            return 0;
        }
    }

}


