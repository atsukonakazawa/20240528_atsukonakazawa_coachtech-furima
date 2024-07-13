<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_category_id' => 'required',
            'sub_category_id' => 'required',
            'condition_id' => 'required',
            'color_id' => 'required',
            'item_name' => 'required|string',
            'item_detail' => 'required|string|max:500',
            'item_img' => 'required|image|max:2048KB',
            'item_price' => 'required|integer|min:300',
        ];
    }

    public function messages()
    {
    return [
            'main_category_id.required' => 'メインカテゴリーを選択してください',
            'sub_category_id.required' => 'サブカテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'color_id.required' => 'カラーを選択してください',
            'item_name.required' => '商品名を入力してください',
            'item_name.string' => '商品名を文字列で入力してください',
            'item_detail.required' => '商品の説明を入力してください',
            'item_detail.string' => '商品の説明を文字列で入力してください',
            'item_detail.max' => '商品の説明は500文字以内で入力してください',
            'item_img.required' => '商品画像を選択してください',
            'item_img.image' => '最大ファイルサイズは2048KBまでです',
            'item_price.required' => '販売価格を入力してください',
            'item_price.integer' => '販売価格は半角・整数で入力してください',
            'item_price.min' => '販売価格は300円以上で入力してください',
        ];
    }

}
