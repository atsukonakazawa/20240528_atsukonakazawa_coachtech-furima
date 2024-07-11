<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* ログイン前 */
Route::get('/',[TopController::class,'index'])->name("top.index");
Route::get('/search',[TopController::class,'search'])->name("top.search");
Route::get('/index/detail',[TopController::class,'indexDetailItem'])->name("top.detail_item");
Route::get('/index/sold/detail',[TopController::class,'indexDetailSold'])->name("top.detail_sold");


/* 認証 */
Route::post('/register',[AuthController::class,'store'])->name("auth.store");


/* ログイン後 */
/* 商品の表示・出品・購入 */
Route::middleware('auth')->group(function () {
    Route::get('/home',[ItemController::class,'home'])->name("item.home");
    Route::get('/home/search',[ItemController::class,'homeSearch'])->name("item.search");
    Route::get('/create',[ItemController::class,'create'])->name("item.create");
    Route::post('/store',[ItemController::class,'store'])->name("item.store");
    Route::get('/home/detail',[ItemController::class,'homeDetailItem'])->name("home.detail_item");
    Route::get('/home/sold/detail',[ItemController::class,'homeDetailSold'])->name("home.detail_sold");
    Route::get('/purchase',[ItemController::class,'purchase'])->name("item.purchase");
});

/* ログイン後 */
/* お気に入りリストの表示・お気に入り追加・削除 */
Route::middleware('auth')->group(function () {
    Route::get('/home/favorite/list',[FavoriteController::class,'favoriteList'])->name("favorite.list");
    Route::get('/home/favorite',[FavoriteController::class,'itemFavorite'])->name("item.favorite");
    Route::get('/home/favorite/sold',[FavoriteController::class,'soldItemFavorite'])->name("solditem.favorite");
});

/* ログイン後 */
/* コメントの表示・送信・自分のコメント削除 */
Route::middleware('auth')->group(function () {
    Route::get('/comment/list',[CommentController::class,'commentList'])->name("comment.list");
    Route::get('/comment/list/sold',[CommentController::class,'commentListSold'])->name("comment.listSold");
    Route::get('/comment/send',[CommentController::class,'commentSend'])->name("comment.send");
    Route::get('/comment/delete/confirm',[CommentController::class,'commentConfirm'])->name("comment.confirm");
    Route::post('/comment/delete',[CommentController::class,'commentRemove'])->name("comment.remove");
    Route::get('/comment/back',[CommentController::class,'commentBack'])->name("comment.back");
});

/* ログイン後 */
/* 購入時の配送先変更・マイページ各種表示・プロフィール編集 */
Route::middleware('auth')->group(function () {
    Route::get('/purchase/address/edit',[UserController::class,'addressEdit'])->name("address.edit");
    Route::post('/purchase/address/update',[UserController::class,'addressUpdate'])->name("address.update");
    Route::get('/mypage/sell/list',[UserController::class,'mypageSellList'])->name("mypage.selllist");
    Route::get('/mypage/purchased/list',[UserController::class,'mypagePurchasedList'])->name("mypage.purchasedlist");
    Route::get('/mypage/search',[UserController::class,'mypageSearch'])->name("mypage.search");
    Route::get('/mypage/profile/edit',[UserController::class,'profileEdit'])->name("profile.edit");
    Route::post('/mypage/profile/update',[UserController::class,'profileUpdate'])->name("profile.update");

});

/* ログイン後 */
/* 支払い関連 */
Route::middleware('auth')->group(function () {
    Route::get('/purchase/payment',[PaymentController::class,'purchasePayment'])->name("item.payment");
    Route::post('/pay/credit',[PaymentController::class,'payCredit'])->name("pay.credit");
});

/* ログイン後 */
/* 管理者専用画面の表示、ユーザー一覧表示と削除、コメント一覧表示と削除 */
Route::middleware('auth')->group(function () {
    Route::get('/admin',[AdminController::class,'admin'])->name("admin.menu");
    Route::get('/admin/users',[AdminController::class,'usersList'])->name("admin.users");
    Route::post('/admin/users/delete',[AdminController::class,'usersRemove'])->name("admin.usersRemove");
    Route::get('/admin/comments',[AdminController::class,'commentsList'])->name("admin.comments");
    Route::post('/admin/comments/delete',[AdminController::class,'commentsRemove'])->name("admin.commentsRemove");
});

/* ログイン後 */
/* 管理者から利用者にメールの送信 */
Route::middleware('auth')->group(function () {
    Route::post('/admin/users/email/create',[AdminController::class,'emailCreate'])->name("admin.email");
    Route::post('/admin/users/email/send',[AdminController::class,'emailSend'])->name("admin.send");
});