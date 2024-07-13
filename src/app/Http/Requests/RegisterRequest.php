<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'nickname' => 'required|unique:profiles,nickname',
            'postcode' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'img' => 'required|image|max:2048KB',
            'password' => 'required|min:8|max:12'
        ];
    }

    public function messages()
    {
    return [
            'name.required' => '名前を入力してください',
            'nickname.required' => 'ユーザー名を入力してください',
            'nickname.unique' => 'このユーザー名はすでに使われています',
            'postcode.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスを***@example.comの形式で入力してください',
            'email.unique' => 'このメールアドレスはすでに使われています',
            'img.required' => 'プロフィール画像を選択してください',
            'img.image' => '画像ファイルを選択してください',
            'img.max' => '最大ファイルサイズは2048KBまでです',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8〜12文字で入力してください',
        ];
    }
}
