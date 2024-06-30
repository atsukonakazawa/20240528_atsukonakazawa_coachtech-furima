<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Condition;
use App\Models\Color;
use App\Models\Profile;
use App\Models\PaymentWay;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SellRequest;


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
        $query2 = soldItem::query();

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

        return view('home',compact('items','soldItems'));
    }

    public function homeDetailItem(Request $request){

        $itemId = $request->item_id;
        $items = Item::where('id',$itemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('item_id')->toArray();

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('item_id',$itemId)->count();
        $commentsCount = Comment::where('item_id',$itemId)->count();

        return view('home_detail',compact('items','favorites','favoritesCount','commentsCount'));
    }

    public function homeDetailSold(Request $request){

        $soldItemId = $request->soldItem_id;
        $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('sold_item_id')->toArray();

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('sold_item_id',$soldItemId)->count();
        $commentsCount = Comment::where('sold_item_id',$soldItemId)->count();

        return view('home_sold_detail',compact('soldItems','favorites','favoritesCount','commentsCount'));
    }

    public function create(){

        $mainCategories = MainCategory::all();
        $subCategories = SubCategory::all();
        $conditions = Condition::all();
        $colors = Color::all();

        return view('sell',compact('mainCategories','subCategories','conditions','colors'));
    }

    public function store(SellRequest $request){

        $result = [
            'seller_id' => $request->user_id,
            'main_category_id' => $request->main_category_id,
            'sub_category_id' => $request->sub_category_id,
            'condition_id' => $request->condition_id,
            'color_id' => $request->color_id,
            'item_name' => $request->item_name,
            'item_detail' => $request->item_detail,
            'item_price' => $request->item_price,
        ];
        //brandが入力されている場合のみresultに追加
        $brand = $request->item_brand;
        if($brand !== null){

            $result['item_brand'] = $request->item_brand;
        }
        Item::create($result);

        //画像ファイルにitemsテーブルのidの名前をつけてstorage/app/publicに保存
        $item = Item::where('seller_id',$request->user_id)
                        ->orderBy('id','desc')
                        ->first();
        $itemId = $item->id;
        $file = $request->file('item_img');
        $filename = $itemId . '.jpg';
        $path = $file->storeAs('public/items/', $filename);

        //画像までのパスをstorage/...の形式でitemsテーブルのimgカラムに保存
        $publicPath = 'storage/items/' . $filename;
        $item->update(['item_img' => $publicPath]);


        return view('sell_done');
    }

    public function purchase(Request $request){

        $itemId = $request->item_id;
        $item = Item::where('id',$itemId)
                    ->first();
        $userId = $request->user_id;
        $profile = Profile::where('user_id',$userId)
                            ->first();
        $paymentWays = PaymentWay::all();

        return view('purchase.purchase',compact('item','profile','paymentWays'));
    }
}
