<?php
use App\Http\Controllers\FavListController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\signupListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\CategoryDetailsController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\VisitorListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/SendVisitorDetails',[VisitorListController::class,'SendVisitorDetails']);
Route::get('/VisitorList',[VisitorListController::class,'VisitorList']);
Route::get('/Contact',[ContactListController::class,'Contact']);
Route::post('/SendContactDetails',[ContactListController::class,'SendContactDetails']);
Route::post('/ContactDelete',[ContactListController::class,'ContactDelete']);
Route::get('/SendSiteInfo',[SiteInfoController::class,'SendSiteInfo']);


Route::get('/SendCategoryDetails',[CategoryDetailsController::class,'SendCategoryDetails']);

Route::post('/addCategory',[CategoryDetailsController::class,'addCategory']);
Route::get('/Category',[CategoryDetailsController::class,'Category']);
Route::get('/Categorys',[CategoryDetailsController::class,'Categorys']);
Route::get('/SubCategory',[CategoryDetailsController::class,'SubCategory']);
Route::post('/addSubCategory',[CategoryDetailsController::class,'addSubCategory']);
Route::post('/CategoryDelete',[CategoryDetailsController::class,'CategoryDelete']);
Route::post('/SubCategoryDelete',[CategoryDetailsController::class,'SubCategoryDelete']);

Route::get('/ProductListByRemark/{remark}',[ProductListController::class,'ProductListByRemark']);
Route::get('/ProductListBySubCategory/{Category}/{SubCategory}',[ProductListController::class,'ProductListBySubCategory']);
Route::get('/ProductListByCategory/{Category}',[ProductListController::class,'ProductListByCategory']);
Route::get('/SendSliderInfo',[SliderController::class,'SendSliderInfo']);
Route::get('/SendSliderInfo',[SliderController::class,'SendSliderInfo']);
Route::get('/SliderShow',[SliderController::class,'SliderShow']);
Route::post('/SliderDelete',[SliderController::class,'SliderDelete']);
Route::post('/AddSlider',[SliderController::class,'AddSlider']);
Route::post('/addToCart',[ProductOrderController::class,'AddToCart']);
Route::get('/addFav/{code}/{mobile}',[FavListController::class,'addFav']);
Route::get('/favList/{mobile}',[FavListController::class,'favList']);
Route::get('/removeFavItem/{code}/{mobile}',[FavListController::class,'removeFavItem']);

Route::get('/ProductDetails/{code}',[ProductDetailsController::class,'ProductDetails']);
Route::get('/ProductDetail',[ProductDetailsController::class,'ProductDetail']);
Route::post('/ProductDetailDelete',[ProductDetailsController::class,'ProductDetailDelete']);
Route::post('/AddProductDetail',[ProductDetailsController::class,'AddProductDetail']);

Route::get('/NotificationHistory',[NotificationController::class,'NotificationHistory']);

Route::get('/ProductBySearch/{key}',[ProductListController::class,'ProductBySearch']);

Route::post('/SendSingupDetails',[signupListController::class,'SendSingupDetails']);
Route::post('/SendSingup',[signupListController::class,'SendSingup']);
Route::get('/SignUp/{mobile}',[signupListController::class,'SignUp']);
Route::get('/SignUps',[signupListController::class,'SignUps']);
Route::get('/CountSummary',[signupListController::class,'CountSummary']);
Route::post('/ProjectDelete',[signupListController::class,'ProjectDelete']);
Route::get('/Roni',[signupListController::class,'ProductList']);
Route::post('/Verifications',[signupListController::class,'Verifications']);
Route::post('/Verification',[signupListController::class,'Verification']);
Route::get('/SimilarProduct/{subcategory}',[ProductListController::class,'SimilarProduct']);
Route::get('/reviewList/{code}',[ReviewController::class,'reviewList']);
Route::get('/Review',[ReviewController::class,'Review']);
Route::post('/postReview',[ReviewController::class,'postReview']);
Route::post('/ReviewDelete',[ReviewController::class,'ReviewDelete']);
Route::post('/addToCart',[ProductOrderController::class,'AddToCart']);
Route::get('/OrderListByUser/{mobile}',[ProductOrderController::class,'OrderListByUser']);
Route::get('/CartCount/{mobile}',[ProductOrderController::class,'CartCount']);
Route::get('/CartList/{mobile}',[ProductOrderController::class,'CartList']);
Route::get('/RemoveCartList/{id}',[ProductOrderController::class,'RemoveCartList']);
Route::post('/CartOrder',[ProductOrderController::class,'CartOrder']);
Route::get('/OrderListByUser/{mobile}',[ProductOrderController::class,'OrderListByUser']);
Route::get('/CartItemPlus/{id}/{quantity}/{price}',[ProductOrderController::class,'CartItemPlus']);
Route::get('/CartItemMinus/{id}/{quantity}/{price}',[ProductOrderController::class,'CartItemMinus']);
Route::get('/Order',[ProductOrderController::class,'Order']);
Route::post('/Orderr',[ProductOrderController::class,'Orderr']);
Route::post('/Moni',[ProductOrderController::class,'Moni']);
Route::post('/Ananna',[ProductOrderController::class,'Ananna']);
Route::post('/OnTheWay',[ProductOrderController::class,'OnTheWay']);
Route::post('/OrderDelivered',[ProductOrderController::class,'OrderDelivered']);
Route::post('/OrderCancel',[ProductOrderController::class,'OrderCancel']);