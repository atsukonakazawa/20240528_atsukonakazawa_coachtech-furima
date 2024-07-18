<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\Favorite;
use App\Models\Comment;


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

        foreach($keywordsArray as $keyword){
            $query1->orWhere('item_name','like', '%'.$keyword.'%')
                ->orWhere('item_brand','like', '%'.$keyword.'%')
                ->orWhere('item_detail','like', '%'.$keyword.'%')
                ->orWhere('item_price','like', '%'.$keyword.'%');
        }
        $items = $query1->get();// 必要なカラムだけを取得

        // sold_itemsテーブルのクエリを作成
        $query2 = SoldItem::query();

        foreach($keywordsArray as $keyword){
            $query2->orWhere('item_name','like', '%'.$keyword.'%')
                ->orWhere('item_brand','like', '%'.$keyword.'%')
                ->orWhere('item_detail','like', '%'.$keyword.'%')
                ->orWhere('item_price','like', '%'.$keyword.'%');
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

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('item_id',$itemId)->count();
        $commentsCount = Comment::where('item_id',$itemId)->count();

        return view('before-login.index_detail',compact('items','favoritesCount','commentsCount'));
    }

    public function indexDetailSold(Request $request){

        $soldItemId = $request->soldItem_id;
        $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('sold_item_id',$soldItemId)->count();
        $commentsCount = Comment::where('sold_item_id',$soldItemId)->count();

        return view('before-login.index_sold_detail',compact('soldItems','favoritesCount','commentsCount'));
    }

}
