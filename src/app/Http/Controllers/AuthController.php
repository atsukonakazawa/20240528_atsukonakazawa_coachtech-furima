<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\SoldItem;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{

    public function store(RegisterRequest $request)
    {
        //画像ファイル以外の会員情報の保存
        $result1 = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        User::create($result1);

        $user1 = User::where('email',$request->email)
                        ->first();
        $user_id = $user1->id;

        $result2 = [
            'user_id' => $user_id,
            'nickname' => $request->nickname,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'introduction' => $request->introduction,
        ];

        //buildingが入力されている場合のみresult2に追加
        $building = $request->building;
        if($building !== null)
        {
            $result2['building'] = $request->building;
        }else{

        }
        Profile::create($result2);

        //画像ファイルにemailの名前をつけてstorage/app/publicに保存
        $email = $request->email;
        $file = $request->file('img');
        $filename = $email . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public', $filename);

        //画像までのパスをstorage/...の形式でprofilesテーブルのimgカラムに保存
        $user=Profile::where('user_id',$user_id)->first();
        $publicPath = 'storage/' . $filename;
        $user->update(['img' => $publicPath]);

        $items = Item::all();
        $soldItems = SoldItem::all();

        return view('home',compact('items','soldItems'));
    }


}
