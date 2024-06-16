<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'newPostcode' => 'required|string|max:7|min:7',
            'newAddress' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'newPostcode.required' => '郵便番号を入力してください',
            'newPostcode.string' => '郵便番号は文字列で入力してください',
            'newPostcode.max' => '郵便番号は7文字で入力してください',
            'newPostcode.min' => '郵便番号は7文字で入力してください',
            'newAddress.required' => '住所を入力してください',
            'newAddress.string' => '住所は文字列で入力してください',
        ];
    }
}
