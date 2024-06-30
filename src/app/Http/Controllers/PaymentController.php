<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\User;
use App\Models\Profile;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PaymentController extends Controller
{
    public function purchasePayment(Request $request){

        $itemId = $request->item_id;
        $item = Item::where('id',$itemId)
                        ->first();
        $userId = $request->user_id;
        $user = User::where('id',$userId)
                        ->first();
        $profile = Profile::where('user_id',$userId)
                            ->first();
        $paymentWayId = $request->payment_way_id;

        if($paymentWayId == '1'){

            return view('purchase.payment_credit',compact('item','user','profile'));

        }elseif($paymentWayId == '2'){

            return view('purchase.payment_conbini',compact('item','user','profile'));

        }else{

            return view('purchase.payment_transfer',compact('item','user','profile'));
        }
    }

    public function payCredit(Request $request){
        try{
            //.envに追加したシークレットキーを使用
            Stripe::setApiKey(env('STRIPE_SECRET'));

            //送信された金額を取得
            $amount = $request->item_price;

            //顧客情報をStripe側に登録
            $customer = Customer::create(array('email' => $request->stripeEmail,
                'source' => $request->stripeToken
                )
            );

            //支払処理
            $charge = Charge::create(array('customer' => $customer->id,
                'amount' => $amount,//送信された金額
                'currency' => 'jpy'
                )
            );

            //該当商品の取得
            $itemId = $request->item_id;
            $item = Item::where('id',$itemId)->first();

            //該当商品をsoldItemsテーブルに登録
            $result = [
                'seller_id' => $item->seller_id,
                'buyer_id' => $request->user_id,
                'main_category_id' => $item->main_category_id,
                'sub_category_id' => $item->sub_category_id,
                'condition_id' => $item->condition_id,
                'color_id' => $item->color_id,
                'payment_way_id' => '1',
                'item_name' => $item->item_name,
                'item_detail' => $item->item_detail,
                'item_price' => $item->item_price
            ];
            //brandが入力されている場合のみresultに追加
            $brand = $item->item_brand;
            if($brand !== null){

                $result['item_brand'] = $request->item_brand;
            }
            SoldItem::create($result);

            //soldItemsテーブルに保存した該当商品を取得
            $soldItem = SoldItem::where('buyer_id',$request->user_id)
                        ->orderby('id','desc')
                        ->first();

            //元々の画像ファイル名とパスを取得
            $originalFilename = $item->id . '.jpg';
            $originalFilePath = 'public/items/' . $originalFilename;

            //新しい画像ファイル名とパス
            $newFilename = $soldItem->id . '.jpg';
            $newFilePath = 'public/sold_items/' . $newFilename;

            //storage内でファイルを移動
            if (Storage::exists($originalFilePath)) {
                Storage::move($originalFilePath, $newFilePath);
            } else {
                return response()->json(['error' => 'File not found'], 404);
            }

            // soldItemsテーブルのitem_imgカラムに新しいパスを保存
            $soldItem->item_img = 'storage/sold_items/' . $newFilename;
            $soldItem->save();

            //該当商品をitemsテーブルから削除
            Item::where('id',$itemId)->delete();

            return view('purchase.thanks');

        }catch(Exception $e){

            return $e->getMessage();
        }
    }
}