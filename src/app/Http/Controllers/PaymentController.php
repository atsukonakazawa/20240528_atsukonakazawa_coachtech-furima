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
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PurchaseRequest;

class PaymentController extends Controller
{
    public function purchasePayment(PurchaseRequest $request){

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

            try {
                // $item->id を用いてファイル名を決定
                $filename = $itemId . '.jpg';
                $filePath = 'items/' . $filename;

                // S3からファイルを取得
                if (Storage::disk('s3')->exists($filePath)) {
                    $fileContents = Storage::disk('s3')->get($filePath);

                    // sold_itemsフォルダにファイルを保存
                    $soldItemId = $soldItem->id; // $soldItem は売れたアイテムオブジェクト
                    $newFilename = $soldItemId . '.jpg';
                    $newFilePath = 'sold_items/' . $newFilename;

                    Storage::disk('s3')->put($newFilePath, $fileContents);

                    Storage::disk('s3')->delete($filePath);

                    //該当商品をitemsテーブルから削除
                    Item::where('id',$itemId)->delete();

                    //soldItemsテーブルのitem_imgカラムに新しいパスを保存
                    $soldItem->item_img = Storage::disk('s3')->url($newFilePath);
                    $soldItem->save();

                    return view('purchase.payment_conbini',compact('item','user','profile'));

                } else {
                    // ファイルが存在しない場合の処理
                    return response()->json(['message' => 'ファイルが存在しません。'], 404);
                }
            } catch (\Exception $e) {
                // エラーが発生した場合の処理
                return response()->json(['message' => 'エラーが発生しました: ' . $e->getMessage()], 500);
            }
        }else{

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

            try {
                // $item->id を用いてファイル名を決定
                $filename = $itemId . '.jpg';
                $filePath = 'items/' . $filename;

                // S3からファイルを取得
                if (Storage::disk('s3')->exists($filePath)) {
                    $fileContents = Storage::disk('s3')->get($filePath);

                    // sold_itemsフォルダにファイルを保存
                    $soldItemId = $soldItem->id; // $soldItem は売れたアイテムオブジェクト
                    $newFilename = $soldItemId . '.jpg';
                    $newFilePath = 'sold_items/' . $newFilename;

                    Storage::disk('s3')->put($newFilePath, $fileContents);

                    Storage::disk('s3')->delete($filePath);

                    //該当商品をitemsテーブルから削除
                    Item::where('id',$itemId)->delete();

                    //soldItemsテーブルのitem_imgカラムに新しいパスを保存
                    $soldItem->item_img = Storage::disk('s3')->url($newFilePath);
                    $soldItem->save();

                    return view('purchase.payment_transfer',compact('item','user','profile'));
                } else {
                    // ファイルが存在しない場合の処理
                    return response()->json(['message' => 'ファイルが存在しません。'], 404);
                }
            } catch (\Exception $e) {
                // エラーが発生した場合の処理
                return response()->json(['message' => 'エラーが発生しました: ' . $e->getMessage()], 500);
            }
        }
    }

    public function payCredit(Request $request){
        try {
            // .envに追加したシークレットキーを使用
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // 送信された金額を取得
            $amount = $request->item_price;

            // 顧客情報をStripe側に登録
            $customer = Customer::create(array('email' => $request->stripeEmail,
                'source' => $request->stripeToken
                )
            );

            // 支払処理
            $charge = Charge::create(array('customer' => $customer->id,
                'amount' => $amount,//送信された金額
                'currency' => 'jpy'
                )
            );

            // 該当商品の取得
            $itemId = $request->item_id;
            $item = Item::where('id', $itemId)->first();

            // 該当商品をsoldItemsテーブルに登録
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

            // brandが入力されている場合のみresultに追加
            $brand = $item->item_brand;
            if ($brand !== null) {
                $result['item_brand'] = $brand;
            }

            SoldItem::create($result);

            // soldItemsテーブルに保存した該当商品を取得
            $soldItem = SoldItem::where('buyer_id', $request->user_id)
                                ->orderBy('id', 'desc')
                                ->first();


            // $item->id を用いてファイル名を決定
            $filename = $itemId . '.jpg';
            $filePath = 'items/' . $filename;

            // S3からファイルを取得
            if (Storage::disk('s3')->exists($filePath)) {
                $fileContents = Storage::disk('s3')->get($filePath);

                // sold_itemsフォルダにファイルを保存
                $soldItemId = $soldItem->id; // $soldItem は売れたアイテムオブジェクト
                $newFilename = $soldItemId . '.jpg';
                $newFilePath = 'sold_items/' . $newFilename;

                Storage::disk('s3')->put($newFilePath, $fileContents);

                Storage::disk('s3')->delete($filePath);

                //該当商品をitemsテーブルから削除
                Item::where('id',$itemId)->delete();

                //soldItemsテーブルのitem_imgカラムに新しいパスを保存
                $soldItem->item_img = Storage::disk('s3')->url($newFilePath);
                $soldItem->save();

                return view('purchase.thanks');

            } else {
                // ファイルが存在しない場合の処理
                return response()->json(['message' => 'ファイルが存在しません。'], 404);
            }
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            return response()->json(['message' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }
}