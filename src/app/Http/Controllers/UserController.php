<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\User;
use App\Models\Profile;
use App\Models\PaymentWay;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;



class UserController extends Controller
{
    public function mypageSellList(Request $request){

        $items = Item::where('seller_id',$request->user_id)
                        ->get();
        $soldItems = SoldItem::where('seller_id',$request->user_id)
                        ->get();
        $profile = Profile::where('user_id',$request->user_id)
                                ->first();
        return view('mypage_sell_list',compact('items','soldItems','profile'));
    }

    public function mypagePurchasedList(Request $request){

        $soldItems = SoldItem::where('buyer_id',$request->user_id)
                        ->get();
        $profile = Profile::where('user_id',$request->user_id)
                                ->first();

        return view('mypage_purchased_list',compact('soldItems','profile'));
    }

    public function mypageSearch(Request $request){

        //検索欄に入力されたキーワードをitemsテーブルの中で探す
        $keyword = $request->search;
        $items = Item::where('seller_id',$request->user_id)
                        ->where('item_name','like', '%'.$keyword.'%')
                        ->orWhere('item_brand','like', '%'.$keyword.'%')
                        ->orWhere('item_detail','like', '%'.$keyword.'%')
                        ->orWhere('item_price','like', '%'.$keyword.'%')
                        ->get();
        //検索欄に入力されたキーワードをsold_itemsテーブルの中で探す
        $soldItems = SoldItem::where('seller_id',$request->user_id)
                        ->where('item_name','like', '%'.$keyword.'%')
                        ->orWhere('item_brand','like', '%'.$keyword.'%')
                        ->orWhere('item_detail','like', '%'.$keyword.'%')
                        ->orWhere('item_price','like', '%'.$keyword.'%')
                        ->get();
        $profile = Profile::where('user_id',$request->user_id)
                                ->first();

        //検索欄に入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keyword;
        session(['selected_keyword' => $selectedKeyword]);

        return view('mypage_sell_list',compact('items','soldItems','profile'));
    }

    public function mypageSearchSold(Request $request){

        //検索欄に入力されたキーワードをsold_itemsの中で探す
        $keyword = $request->search;
        $soldItems = SoldItem::where('buyer_id',$request->user_id)
                        ->where('item_name','like', '%'.$keyword.'%')
                        ->orWhere('item_brand','like', '%'.$keyword.'%')
                        ->orWhere('item_detail','like', '%'.$keyword.'%')
                        ->orWhere('item_price','like', '%'.$keyword.'%')
                        ->get();
        $profile = Profile::where('user_id',$request->user_id)
                                ->first();

        //検索欄に入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keyword;
        session(['selected_keyword' => $selectedKeyword]);

        return view('mypage_purchased_list',compact('soldItems','profile'));
    }


    public function profileEdit(Request $request){

        $user = User::where('id',$request->user_id)
                        ->first();
        $profile = Profile::where('user_id',$request->user_id)
                        ->first();

        return view('change_profile',compact('user','profile'));

    }

    public function profileUpdate(ProfileRequest $request){

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
            $filename = $email . '.jpg';
            $filePath = 'public/profiles/' . $filename;

            Storage::delete($filePath);

            //新たな画像ファイルに既存のemailの名前をつけて
            //storage/app/publicに保存
            $file = $request->file('newImg');
            $filename = $email . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/profiles/', $filename);

            //画像までのパスをstorage/...の形式でprofilesテーブルのimgカラムに保存
            $publicPath = 'storage/profiles/' . $filename;
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

        return view('profile_changed');
    }

    public function addressEdit(Request $request){

        $profileId = $request->profile_id;
        $profile = Profile::where('id',$profileId)
                        ->first();
        $itemId = $request->item_id;
        $item = Item::where('id',$itemId)
                        ->first();

        return view('purchase.change_address',compact('profile','item'));
    }

    public function addressUpdate(AddressRequest $request){

        $result = [
            'postcode' => $request->newPostcode,
            'address' => $request->newAddress
        ];

        //buildingが入力されている場合のみresultに追加
        $building = $request->newBuilding;
        if($building !== null)
        {
            $result['building'] = $request->newBuilding;
        }

        $profileId = $request->profile_id;
        Profile::where('id',$profileId)
                    ->update($result);
        $profile = Profile::where('id',$profileId)
                        ->first();

        $itemId = $request->item_id;
        $item = Item::where('id',$itemId)
                    ->first();
        $paymentWays = PaymentWay::all();

        return view('purchase.purchase',compact('item','profile','paymentWays'));
    }
}
