<?php
namespace App\Http\Controllers;
use App\Models\CartModel;
use App\Models\ProductListModel;
use App\Models\DirectOrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
class ProductOrderController extends Controller
{
    
    function AddToCart(Request $request){
        $color=$request->input('color');
        $size=$request->input('size');
        $quantity=$request->input('quantity');
        $mobileNo=$request->input('mobileNo');
        $product_code=$request->input('product_code');
        $ProductDetails= ProductListModel::Where('product_code',$product_code)->get();
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
    function CartCount(Request $request){
        $mobile=$request->mobile;
        $result=CartModel::Where('mobile',$mobile)->count();
        return $result;
    }
    function CartList(Request $request){
        $mobile=$request->mobile;
        $result=CartModel::Where('mobile',$mobile)->get();
        return $result;
    }
    function RemoveCartList(Request $request){
        $id=$request->id;
        $result=CartModel::Where('id',$id)->delete();
        return $result;
    }
    function CartItemPlus(Request $request){
        $id=$request->id;
        $quantity=$request->quantity;
        $price=$request->price;
        $newQuantity=$quantity+1;
        $total_price=$newQuantity*$price;
        $result=CartModel::Where('id',$id)->update(['product_quantity' => $newQuantity, 'total_price' => $total_price]);
        return $result;
    }
    function CartItemMinus(Request $request){
        $id=$request->id;
        $quantity=$request->quantity;
        $price=$request->price;
        if($quantity>=1){
        $newQuantity=$quantity-1;
        $total_price=$newQuantity*$price;
        $result=CartModel::Where('id',$id)->update(['product_quantity' => $newQuantity, 'total_price' => $total_price]);
        return $result;
        }
    }
    function CartOrder(Request $request){
        $city=  $request->input('city');
        $paymentMethod=  $request->input('paymentMethod');
        $yourName=  $request->input('yourName');
        $deliveryAddress=  $request->input('deliveryAddress');
        $mobileNumber=  $request->input('mobileNumber');
        $invoice_no= $request->input('invoice_no');
        $ShippingPrice= $request->input('ShippingPrice');

        date_default_timezone_set("Asia/Dhaka");
        $request_time= date("h:i:sa");
        $request_date= date("d-m-Y");

        $CartList=CartModel::Where('mobile',$mobileNumber)->get();
        $cartInsertDeleteResult="";
        foreach($CartList as $CartListItem) {
            $resultInsert=  DirectOrderModel::insert([
                'invoice_no'=>"C".$invoice_no,
                'product_name'=>$CartListItem['product_name'],
                'product_code'=>$CartListItem['product_code'],
                'shop_name'=> $CartListItem['shop_name'],
                'shop_code'=>$CartListItem['shop_code'],
                'product_info'=>$CartListItem['product_info'],
                'product_quantity'=>$CartListItem['product_quantity'],
                'unit_price'=>$CartListItem['unit_price'],
                'total_price'=> $CartListItem['total_price'],
                'mobile'=> $CartListItem['mobile'],
                'name'=>$yourName,
                'payment_method'=>$paymentMethod,
                'delivery_address'=>$deliveryAddress,
                'city'=>$city,
                'delivery_charge'=>$ShippingPrice,
                'order_date'=>$request_date,
                'order_time'=>$request_time,
                'order_status'=>"Pending",
            ]);

            if($resultInsert==1){
                $resultDelete= CartModel::Where('id',$CartListItem['id'])->delete();
                if($resultDelete==1){
                    $cartInsertDeleteResult=1;
                }
                else{
                    $cartInsertDeleteResult=0;
                }

            }
        }
        return $cartInsertDeleteResult;
    }

    function OrderListByUser(Request $request){
        $Mobile=  $request->mobile;
        $result= DirectOrderModel::Where('mobile',$Mobile)->orderBy('id', 'DESC')->get();
        return $result;
    }
    function Order(){
        $result=DirectOrderModel::orderBy('id','desc')->get();
        return $result;
    }
    function Orderr(Request $request){
        $color=$request->input('color');
        $size=$request->input('size');
        $quantity=$request->input('quantity');
        $mobileNo=$request->input('mobileNo');
        $product_code=$request->input('product_code');

        $ProductDetails= ProductListModel::Where('product_code',$product_code)->get();
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
    function Moni(Request $request){
        $id=$request->id;
        $order_status=$request->order_status;
        $result=DirectOrderModel::Where('id',$id)->update(['order_status' => 'Accept']);
        return $result;
    }
    function OnTheWay(Request $request){
        $id=$request->id;
        $order_status=$request->order_status;
        $result=DirectOrderModel::Where('id',$id)->update(['order_status' => 'On The Way']);
        return $result;
    }
    function OrderDelivered(Request $request){
        $id=$request->id;
        $order_status=$request->order_status;
        $result=DirectOrderModel::Where('id',$id)->update(['order_status' => 'Order Delivered']);
        return $result;
    }
    function OrderCancel(Request $request){
        $id=$request->id;
        $result=DirectOrderModel::Where('id',$id)->delete();
        return $result;
    }
  
}
