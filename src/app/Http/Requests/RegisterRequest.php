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
            'img' => 'required|image|mimes:jpeg,jpg,svg|max:2048KB',
            'introduction' => 'required|max:300',
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
            'img.mimes' => 'ファイル形式はjpeg,png,jpg,gif,svgのいずれかです',
            'img.max' => '最大ファイルサイズは2048KBまでです',
            'introduction.required' => '自己紹介文を入力してください',
            'introduction.max:300' => '自己紹介文は300文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8〜12文字で入力してください',
        ];
    }
}
