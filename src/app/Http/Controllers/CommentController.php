<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\Favorite;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;



class CommentController extends Controller
{
    public function commentList(Request $request){

        $itemId = $request->item_id;
        $items = Item::where('id',$itemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('item_id')->toArray();

        $comments = Comment::where('item_id',$itemId)
                            ->orderBy('id','asc')
                            ->get();

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('item_id',$itemId)->count();
        $commentsCount = Comment::where('item_id',$itemId)->count();

        return view('comment.comment_list',compact('items','favorites','comments','user','favoritesCount','commentsCount'));
    }

    public function commentListSold(Request $request){

        $soldItemId = $request->sold_item_id;
        $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('sold_item_id')->toArray();

        $comments = Comment::where('sold_item_id',$soldItemId)
                            ->orderBy('id','asc')
                            ->get();

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('sold_item_id',$soldItemId)->count();
        $commentsCount = Comment::where('sold_item_id',$soldItemId)->count();


        return view('comment.comment_list_sold',compact('soldItems','favorites','comments','user','favoritesCount','commentsCount'));
    }

    public function commentSend(CommentRequest $request){

        $result = [
            'item_id' => $request->item_id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
        ];
        Comment::create($result);

        $itemId = $request->item_id;
        $items = Item::where('id',$itemId)
                    ->get();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('item_id')->toArray();

        $comments = Comment::where('item_id',$itemId)
                            ->orderBy('id','asc')
                            ->get();

        //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
        $favoritesCount = Favorite::where('item_id',$itemId)->count();
        $commentsCount = Comment::where('item_id',$itemId)->count();

        return view('comment.comment_list',compact('items','favorites','comments','user','favoritesCount','commentsCount'));
    }

    public function commentConfirm(Request $request){

        $commentId = $request->comment_id;
        $comment = Comment::where('id',$commentId)
                            ->first();
        $itemId = $request->item_id;
        $soldItemId = $request->sold_item_id;

        return view('comment.comment_confirm',compact('comment','itemId','soldItemId'));
    }

    public function commentRemove(Request $request){

        Comment::where('id',$request->comment_id)
                    ->delete();
        $itemId = $request->item_id;
        $soldItemId = $request->sold_item_id;

        return view('comment.comment_removed',compact('itemId','soldItemId'));
    }

    public function commentBack(Request $request){

        $itemId = $request->item_id;
        $soldItemId = $request->sold_item_id;
        if($itemId !== null){

            $items = Item::where('id',$itemId)
                        ->get();
            $user = Auth::user();
            $favorites = $user->favorites->pluck('item_id')->toArray();

            $comments = Comment::where('item_id',$itemId)
                                ->orderBy('id','asc')
                                ->get();

            //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
            $favoritesCount = Favorite::where('item_id',$itemId)->count();
            $commentsCount = Comment::where('item_id',$itemId)->count();


            return view('comment.comment_list',compact('items','favorites','comments','user','favoritesCount','commentsCount'));
        }else{

            $soldItems = SoldItem::where('id',$soldItemId)
                    ->get();
            $user = Auth::user();
            $favorites = $user->favorites->pluck('sold_item_id')->toArray();

            $comments = Comment::where('sold_item_id',$soldItemId)
                                ->orderBy('id','asc')
                                ->get();

            //お気に入りの数とコメントの数をそれぞれのアイコンの下に表示するために
            $favoritesCount = Favorite::where('sold_item_id',$soldItemId)->count();
            $commentsCount = Comment::where('sold_item_id',$soldItemId)->count();

            return view('comment.comment_list_sold',compact('soldItems','favorites','comments','user','favoritesCount','commentsCount'));
        }
    }
}
