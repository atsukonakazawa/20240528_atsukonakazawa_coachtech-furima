<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function mypageShow(Request $request){

        $items = Item::where('seller_id',$request->user_id)
                        ->get();
        $soldItems = SoldItem::where('seller_id',$request->user_id)
                        ->get();
        $user = User::where('id',$request->user_id)
                        ->first();
        $profile = Profile::where('user_id',$request->user_id)
                        ->first();

        return view('after-login.mypage',compact('items','soldItems','user','profile'));
    }

    public function mypageSellList(Request $request){

        $items = Item::where('seller_id',$request->user_id)
                        ->get();
        $soldItems = SoldItem::where('seller_id',$request->user_id)
                        ->get();
        $profile = Profile::where('user_id',$request->user_id)
                                ->first();
        return view('after-login.mypage_sell_list',compact('items','soldItems','profile'));
    }

    public function mypagePurchasedList(Request $request){

        $soldItems = SoldItem::where('buyer_id',$request->user_id)
                        ->get();
        $profile = Profile::where('user_id',$request->user_id)
                                ->first();

        return view('after-login.mypage_purchased_list',compact('soldItems','profile'));
    }

    public function myapageSearch(Request $request){

        //検索欄に入力されたキーワードをitemsテーブルのitem_nameの中で探す
        $keyword = $request->search;
        $items = Item::where('seller_id',$request->user_id)
                        ->where('item_name','like', '%'.$keyword.'%')
                        ->orWhere('item_brand','like', '%'.$keyword.'%')
                        ->orWhere('item_color','like', '%'.$keyword.'%')
                        ->orWhere('item_detail','like', '%'.$keyword.'%')
                        ->orWhere('item_price','like', '%'.$keyword.'%')
                        ->get();
        $soldItems = SoldItem::where('seller_id',$request->user_id)
                        ->where('item_name','like', '%'.$keyword.'%')
                        ->orWhere('item_brand','like', '%'.$keyword.'%')
                        ->orWhere('item_color','like', '%'.$keyword.'%')
                        ->orWhere('item_detail','like', '%'.$keyword.'%')
                        ->orWhere('item_price','like', '%'.$keyword.'%')
                        ->get();

        //検索欄に入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keyword;
        session(['selected_keyword' => $selectedKeyword]);

        return view('after-login.mypage',compact('items','soldItems'));
    }

    public function profileEdit(Request $request){

        $user = User::where('id',$request->user_id)
                        ->first();
        $profile = Profile::where('user_id',$request->user_id)
                        ->first();

        return view('after-login.change_profile',compact('user','profile'));

    }

    public function profileUpdate(Request $request){

        $newImg = $request->newImg;
        $newNickname = $request->newNickname;
        $newPostcode = $request->newPostcode;
        $newAddress = $request->newAddress;
        $newBuilding = $request->newBuilding;
        $newIntroduction = $request->newIntroduction;

        if($newImg !== null){
            //画像の変更がある場合

            //必要なユーザー情報を取得
            $user = User::where('id',$request->user_id)
                        ->first();
            $email = $user->email;
            $profile = Profile::where('user_id',$request->user_id)
                                ->first();

            //既存の画像ファイルをstorage/app/publicから削除
            $filename = $email . '.' . pathinfo($profile->img, PATHINFO_EXTENSION);
            $filePath = 'public/' . $filename;

            Storage::delete($filePath);

            //新たな画像ファイルに既存のemailの名前をつけて
            //storage/app/publicに保存
            $file = $request->file('newImg');
            $filename = $email . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $filename);

            //画像までのパスをstorage/...の形式でprofilesテーブルのimgカラムに保存
            $publicPath = 'storage/' . $filename;
            $profile->update(['img' => $publicPath]);
        }

        if($newNickname !== null){
            //ユーザー名の変更がある場合

            $result2 = [
                'nickname' => $newNickname,
            ];
            Profile::where('user_id',$request->user_id)
                        ->update($result2);
        }

        if($newPostcode !== null){
            //郵便番号の変更がある場合

            $result3 = [
                'postcode' => $newPostcode,
            ];
            Profile::where('user_id',$request->user_id)
                        ->update($result3);
        }

        if($newAddress !== null){
            //住所の変更がある場合

            $result4 = [
                'address' => $newAddress,
            ];
            Profile::where('user_id',$request->user_id)
                        ->update($result4);
        }

        if($newBuilding !== null){
            //建物名の変更がある場合

            $result5 = [
                'building' => $newBuilding,
            ];
            Profile::where('user_id',$request->user_id)
                        ->update($result5);
        }

        if($newIntroduction !== null){
            //建物名の変更がある場合

            $result6 = [
                'introduction' => $newIntroduction,
            ];
            Profile::where('user_id',$request->user_id)
                        ->update($result6);
        }

        // ユーザーを再ログインさせる
        //Auth::login($user);

        return view('after-login.profile_changed');
    }
}
