<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwitterProfileUpdateRequest extends FormRequest
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
            'account_name' => 'max:50',
            'body' => 'max:160',
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'account_name' => 'アカウント名は50文字以内で入力してください',
            'body' => '自己紹介は160文字以内で入力してください',
        ];
    }
}
