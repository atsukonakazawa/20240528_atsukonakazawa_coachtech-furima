<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Item;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;



class FavoriteController extends Controller
{
    public function favoriteList(){

        $user = Auth::user();
        $favorites = Favorite::where('user_id',$user->id)
                                ->get();

        return view('home_mylist',compact('favorites'));
    }

    public function itemFavorite(Request $request){

        $itemId = $request->item_id;
        $userId = $request->user_id;
        $check  = Favorite::where('user_id',$userId)
                ->where('item_id',$itemId)
                ->first();

        if($check !== null){
            //もしお気に入り登録済みなら削除
            Favorite::where('user_id',$userId)
                ->where('item_id',$itemId)
                ->delete();
        }else{
            //お気に入り登録されていなければ、登録
            $result = [
                'user_id' => $userId,
                'item_id' => $itemId,
            ];
            Favorite::create($result);
        }

        $user = Auth::user();
        $favorites = $user->favorites->pluck('item_id')->toArray();
        $items = Item::where('id',$itemId)
                    ->get();

        return view('after-login.home_detail',compact('items','favorites'));
    }

    public function soldItemFavorite(Request $request){

        $soldItemId = $request->sold_item_id;
        $userId = $request->user_id;
        $check  = Favorite::where('user_id',$userId)
                ->where('sold_item_id',$soldItemId)
                ->first();

        if($check !== null){
            //もしお気に入り登録済みなら削除
            Favorite::where('user_id',$userId)
                ->where('sold_item_id',$soldItemId)
                ->delete();
        }else{
            //お気に入り登録されていなければ、登録
            $result = [
                'user_id' => $userId,
                'sold_item_id' => $soldItemId,
            ];
            Favorite::create($result);
        }

        $user = Auth::user();
        $favorites = $user->favorites->pluck('sold_item_id')->toArray();
        $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();

        return view('after-login.home_sold_detail',compact('soldItems','favorites'));
    }

}
