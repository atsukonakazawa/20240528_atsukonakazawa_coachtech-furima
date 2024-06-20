<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;


class TopController extends Controller
{
    public function index(){

        $items = Item::all();
        $soldItems = SoldItem::all();

        return view('before-login.index',compact('items','soldItems'));
    }

    public function search(Request $request){

        //検索欄に入力されたキーワードをitemsテーブルで探す
        $keywords = $request->search;

        // 半角スペースと全角スペースを半角スペースに統一
        $keywords = preg_replace('/[\s　]+/u', ' ', $keywords);

        // キーワードを分割
        $keywordsArray = explode(' ', $keywords);

        // itemsテーブルのクエリを作成
        $query1 = Item::query();

        // colorsテーブルとjoin
        $query1->join('colors', 'items.color_id', '=', 'colors.id');

        foreach($keywordsArray as $keyword){
            $query1->orWhere('item_name','like', '%'.$keyword.'%')
                ->orWhere('item_brand','like', '%'.$keyword.'%')
                ->orWhere('item_detail','like', '%'.$keyword.'%')
                ->orWhere('item_price','like', '%'.$keyword.'%')
                ->orWhere('colors.color', 'like', '%' . $keyword . '%');
        }
        $items = $query1->get();// 必要なカラムだけを取得

        // sold_itemsテーブルのクエリを作成
        $query2 = soldItem::query();

        // colorsテーブルとjoin
        $query2->join('colors', 'sold_items.color_id', '=', 'colors.id');

        foreach($keywordsArray as $keyword){
            $query2->orWhere('item_name','like', '%'.$keyword.'%')
                ->orWhere('item_brand','like', '%'.$keyword.'%')
                ->orWhere('item_detail','like', '%'.$keyword.'%')
                ->orWhere('item_price','like', '%'.$keyword.'%')
                ->orWhere('colors.color', 'like', '%' . $keyword . '%');
        }
        $soldItems = $query2->get();

        // 検索結果が空の場合にフラッシュメッセージをセッションに保存
        if ($items->isEmpty() && $soldItems->isEmpty()) {
            session()->flash('search_message', '該当するものがありませんでした');
        }

        //検索欄に入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keywords;
        session(['selected_keyword' => $selectedKeyword]);

        return view('before-login.index',compact('items','soldItems'));
    }

    public function indexDetailItem(Request $request){

        $itemId = $request->item_id;
        $items = Item::where('id',$itemId)
                    ->get();

        return view('before-login.index_detail',compact('items'));
    }

    public function indexDetailSold(Request $request){

        $soldItemId = $request->soldItem_id;
        $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();

        return view('before-login.index_sold_detail',compact('soldItems'));
    }

}
