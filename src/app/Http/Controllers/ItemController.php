<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function home(){

        $items = Item::all();
        $soldItems = SoldItem::all();

        return view('home',compact('items','soldItems'));
    }

    public function homeSearch(Request $request){

        //検索欄に入力されたキーワードをitems・soldItemsテーブルで探す
        $keywords = $request->search;

        // 半角スペースと全角スペースを半角スペースに統一
        $keywords = preg_replace('/[\s　]+/u', ' ', $keywords);

        // キーワードを分割
        $keywordsArray = explode(' ', $keywords);

        $query1 = Item::query();

        foreach($keywordsArray as $keyword){
            $query1->orWhere('item_name','like', '%'.$keyword.'%')
                ->orWhere('item_brand','like', '%'.$keyword.'%')
                ->orWhere('item_color','like', '%'.$keyword.'%')
                ->orWhere('item_detail','like', '%'.$keyword.'%')
                ->orWhere('item_price','like', '%'.$keyword.'%');
        }
        $items = $query1->get();

        $query2 = soldItem::query();
        foreach($keywordsArray as $keyword){
            $query2->orWhere('item_name','like', '%'.$keyword.'%')
                ->orWhere('item_brand','like', '%'.$keyword.'%')
                ->orWhere('item_color','like', '%'.$keyword.'%')
                ->orWhere('item_detail','like', '%'.$keyword.'%')
                ->orWhere('item_price','like', '%'.$keyword.'%');
        }
        $soldItems = $query2->get();

        //検索欄に入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keywordz;
        session(['selected_keyword' => $selectedKeyword]);

        return view('home',compact('items','soldItems'));
    }

    public function homeDetailItem(Request $request){

        $itemId = $request->item_id;
        $items = Item::where('id',$itemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('item_id')->toArray();

        return view('after-login.home_detail',compact('items','favorites'));
    }

    public function homeDetailSold(Request $request){

        $soldItemId = $request->soldItem_id;
        $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('soldItem_id')->toArray();

        return view('after-login.home_sold_detail',compact('soldItems','favorites'));
    }

    public function create(){

        return view('after-login.sell');
    }

}
