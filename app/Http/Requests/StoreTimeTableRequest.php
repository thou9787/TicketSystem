<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeTableRequest extends FormRequest
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
            'from' => 'required|different:to|in:"0990", "1000", "1010", "1020", "1030",
                    "1035", "1040", "1043", "1047", "1050",
                    "1060", "1070"',
            'to' => 'required|in:"0990", "1000", "1010", "1020", "1030",
                    "1035", "1040", "1043", "1047", "1050",
                    "1060", "1070"',
            'amount' => 'required|in:"1", "2", "3", "4", "5",
                    "6", "7", "8", "9"',
            'date' => 'required|after_or_equal:today',
            'type' => 'required|in:"economic", "business"',
            'time' => 'required|in:"00:00", "01:00", "02:00", "03:00", "04:00",
                    "05:00", "06:00", "07:00", "08:00", "09:00",
                    "10:00", "11:00", "12:00", "13:00", "14:00",
                    "15:00", "16:00", "17:00", "18:00", "19:00",
                    "20:00", "21:00", "22:00", "23:00"',
        ];
    }

    public function messages()
    {
        return [
            "from.required" => "請選擇出發地點",
            "from.different" => "出發地點必須與目的地不同",
            "from.in" => "請輸入正確的出發地點",
            "to.in" => "請輸入正確的目的地",
            "to.required" => "請選擇目的地",
            "amount.in" => "請輸入正確的數量",
            "amount.required" => "請輸入正確的數量",
            "date.after_or_equal" => "過去的日期是不會有車票的喔",
            "date.required" => "請填入正確日期",
            "type.required" => "請填入票券種類",
            "type.in" => "票券只有兩種呦",
            "time.required" => "請輸入時間",
            "time.in" => "請輸入正確時間",
        ];
    }
}
