<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\SoldItem;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;


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
        ];

        //buildingが入力されている場合のみresult2に追加
        $building = $request->building;
        if($building !== null)
        {
            $result2['building'] = $request->building;
        }else{

        }
        Profile::create($result2);

        // 画像ファイルにitemsテーブルのidの名前をつけてS3に保存
        $email = $request->email;
        $file = $request->file('img');
        $filename = $email . '.jpg';
        $s3Path = 'profiles/' . $filename;
        Storage::disk('s3')->put($s3Path, file_get_contents($file));

        // 画像までのパスをS3のURL形式でitemsテーブルのimgカラムに保存
        $profile = Profile::where('user_id',$user_id)
                            ->first();
        $s3Url = Storage::disk('s3')->url($s3Path);
        $profile->update(['img' => $s3Url]);

        $items = Item::all();
        $soldItems = SoldItem::all();

        session()->flash('message','会員登録が完了しました!');

        return view('auth.login');
    }


}
