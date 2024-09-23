<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Rules\Password;

class AddStoreOwnerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password],
            'store_id' => 'required',
        ];
    }
    
    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '店舗代表者氏名は必須項目です。',
            'name.string' => '店舗代表者氏名は文字列で入力してください。',
            'name.max' => '店舗代表者氏名は255文字以内で入力してください。',
            'email.required' => '店舗代表者のメールアドレスは必須項目です。',
            'email.string' => '店舗代表者のメールアドレスは文字列で入力してください。',
            'email.max' => '店舗代表者のメールアドレスは255文字以内で入力してください。',
            'email.email' => '店舗代表者のメールアドレスはメールアドレス形式で入力してください。',
            'password.required' => '店舗代表者のパスワードは必須項目です。',
            'password.string' => '店舗代表者のパスワードは文字列で入力してください。',
            'store_id.required' => '店舗名を選択してください。',
        ];
    }
}
