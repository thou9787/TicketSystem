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
            'date' => 'required',
            'from' => 'required|different:to',
            'to' => 'required',
        ];
    }

    public function messages()
    {
        return [
            "from.required" => "請選擇出發地點",
            "from.different" => "出發地點必須與目的地不同",
            "to.required" => "請選擇目的地",
        ];
    }
}
