<?php
namespace App\Http\Controllers;
use App\Models\CategoryLavel1Model;
use App\Models\CategoryLavel2Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class CategoryDetailsController extends Controller
{


    function SendCategoryDetails(){

          $ParentCategory=CategoryLavel1Model::all();
          $CategoryDetailsArray=[];

          foreach ($ParentCategory as $value){
                $SubCategory=CategoryLavel2Model::Where('cat1_name',$value['cat1_name'])->get();
                $item=[
                    'ParentCategoryName'=>$value['cat1_name'],
                    'ParentCategoryImg'=>$value['cat1_image'],
                    'SubCategory'=>$SubCategory
                ];
                array_push($CategoryDetailsArray,$item);
          }

          return $CategoryDetailsArray;
    }


           

    function addCategory(Request $request){
        $cat1_image=$request->file('cat1_image')->store('public');
        $cat1_name=$request->input('cat1_name');
        
        $result=CategoryLavel1Model::insert([
            'cat1_image'=>$cat1_image,
            'cat1_name'=>$cat1_name,
        ]);

        return $result;
        
    }
    function Category(){
        $result=CategoryLavel1Model::all();
        return $result;
    }
    function CategoryDelete(Request $request){
        $id=$request->input('id');
        $result=CategoryLavel1Model::where('id','=',$id)->delete();
        return $result;
    }
    function SubCategory(){
        $result=CategoryLavel2Model::all();
        return $result;
    }
    function SubCategoryDelete(Request $request){
        $id=$request->input('id');
        $result=CategoryLavel2Model::where('id','=',$id)->delete();
        return $result;
    }

     
    function addSubCategory(Request $request){
        $cat1_name=$request->input('cat1_name');
        $cat2_name=$request->input('cat2_name');
        
        $result=CategoryLavel2Model::insert([
            'cat1_name'=>$cat1_name,
            'cat2_name'=>$cat2_name,
        ]);

        return $result;
        
    }
    function Categorys(Request $request){
        $id=$request->input('id');
        $result=CategoryLavel1Modelwhere::where('id','=',$id)->get();;
        return $result;
    }
     

}
