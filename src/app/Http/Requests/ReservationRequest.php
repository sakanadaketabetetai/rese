<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Store;

class ReservationRequest extends FormRequest
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
            'reservation_time' => 'required',
            'reservation_day' => [
                'required',
                // カスタムバリデーション
                function($attribute, $value, $fail) {
                    $store = Store::find($this->store_id);
                    if ($store) {
                        // 英語の曜日を日本語の曜日に変換するマッピング
                        $days = [
                            'Monday' => '月曜日',
                            'Tuesday' => '火曜日',
                            'Wednesday' => '水曜日',
                            'Thursday' => '木曜日',
                            'Friday' => '金曜日',
                            'Saturday' => '土曜日',
                            'Sunday' => '日曜日',
                        ];
                
                        // 予約日を英語曜日に変換
                        $dayOfWeek = date('l', strtotime($value));
                        
                        // 英語曜日を漢字に変換
                        $japaneseDayOfWeek = $days[$dayOfWeek];
                
                        // 定休日に含まれているか確認
                        if (in_array($japaneseDayOfWeek, explode(',', $store->regular_holiday))) {
                            $fail('選択した日は定休日です。別の日に予約してください。');
                        }
                    }
                }
            ],
            'number_of_people' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'reservation_time.required' => '予約時間を入力してください',
            'reservation_day.required' => '予約日を入力してください',
            'number_of_people.required' => '予約人数を入力してください'
        ];
    }
}
