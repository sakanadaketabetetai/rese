<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'store_name' => ['required', 'string', 'max:255'],
            'store_area' => ['required', 'string', 'max:255'],
            'store_genre' => ['required', 'string', 'max:255'],
            'store_introduction' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:255'],
            'open_time' => ['required', 'regex:/^([01]\d|2[0-3]):([0-5]\d)$/'], // 24時間表記の時刻バリデーション
            'close_time' => ['required', 'regex:/^([01]\d|2[0-3]):([0-5]\d)$/'], // 同じく24時間表記
            'regular_holiday' => ['required', 'string', 'in:月曜日,火曜日,水曜日,木曜日,金曜日,土曜日,日曜日'], // 曜日制限
            'max_number_of_people' => ['required', 'integer', 'max:255'], // 人数を数値で扱うことを推奨
        ];
    }

    public function messages()
    {
        return [
            'store_name.required' => '店舗名は必須項目です。',
            'store_name.string' => '店舗名は文字列で入力してください。',
            'store_name.max' => '店舗名は255文字以内で入力してください。',
            
            'store_area.required' => 'エリアは必須項目です。',
            'store_area.string' => 'エリアは文字列で入力してください。',
            'store_area.max' => 'エリアは255文字以内で入力してください。',
            
            'store_genre.required' => 'ジャンルは必須項目です。',
            'store_genre.string' => 'ジャンルは文字列で入力してください。',
            'store_genre.max' => 'ジャンルは255文字以内で入力してください。',
            
            'store_introduction.required' => '店舗紹介は必須項目です。',
            'store_introduction.string' => '店舗紹介は文字列で入力してください。',
            'store_introduction.max' => '店舗紹介は255文字以内で入力してください。',
            
            'image.required' => '画像は必須項目です。',
            'image.string' => '画像は文字列で入力してください。',
            'image.max' => '画像は255文字以内で入力してください。',
            
            'open_time.required' => '開店時間は必須項目です。',
            'open_time.regex' => '開店時間は24時間表記 (HH:MM) で入力してください。',
            
            'close_time.required' => '閉店時間は必須項目です。',
            'close_time.regex' => '閉店時間は24時間表記 (HH:MM) で入力してください。',
            
            'regular_holiday.required' => '定休日は必須項目です。',
            'regular_holiday.string' => '定休日は文字列で入力してください。',
            'regular_holiday.in' => '定休日は月曜日から日曜日の間で選択してください。',
            
            'max_number_of_people.required' => '最大人数は必須項目です。',
            'max_number_of_people.integer' => '最大人数は整数で入力してください。',
            'max_number_of_people.max' => '最大人数は255人以内で入力してください。',
        ];
    }
}
    
