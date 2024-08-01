<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'newImg' => 'nullable|mimes:jpg,svg|max:1024',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $input = $this->except(['user_id', '_token']); // user_idと_token を除外する
            $hasAtLeastOneInput = false;

            foreach ($input as $value) {
                if (!empty($value)) {
                    $hasAtLeastOneInput = true;
                    break;
                }
            }

            if (!$hasAtLeastOneInput) {
                $validator->errors()->add('at_least_one', '少なくとも1つの入力フィールドに変更内容を入力してください。');
            }
        });
    }


    public function messages()
    {
        return [
            'at_least_one' => '少なくとも1つの入力フィールドに変更内容を入力してください。',
            'newImg.mimes' => 'jpgまたはsvg形式のファイルを選択してください。',
            'newImg.max' => '画像の容量は最大1024KBです。'
        ];
    }
}
