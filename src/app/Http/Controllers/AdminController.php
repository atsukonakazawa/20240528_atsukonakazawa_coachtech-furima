<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Item;
use App\Models\SoldItem;




class AdminController extends Controller
{
    public function admin(Request $request){

        $userId = $request->user_id;
        $getRole = User::where('id',$userId)
                    ->where('role','admin')
                    ->first();

        if($getRole !== null){

        return view('admin.admin_menu');

        }else{

            $items = Item::all();
            $soldItems = SoldItem::all();

            session()->flash('message','管理者のみがアクセスできます');

            return view('home',compact('items','soldItems'));
        }
    }

    public function usersList(){

        $users = User::with('profile')->get();

        return view('admin.users_list',compact('users'));
    }

    public function usersRemove(Request $request){

        $userId = $request->user_id;
        $user = User::where('id',$userId)->first();
        User::where('id',$userId)->delete();

        session()->flash('message','選択された会員情報を削除しました');

        $users = User::all();

        return view('admin.users_list',compact('users'));
    }

    public function commentsList(){

        $comments = Comment::all();

        return view('admin.comments_list',compact('comments'));
    }

    public function commentsRemove(Request $request){

        $commentId = $request->comment_id;
        $comment = Comment::where('id',$commentId)->first();
        Comment::where('id',$commentId)->delete();

        session()->flash('message','選択されたコメントを削除しました');

        $comments = Comment::all();

        return view('admin.comments_list',compact('comments'));
    }


}
