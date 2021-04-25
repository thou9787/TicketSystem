<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::User()->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ];
    }

    /**
     * Set the display messages when get validate errors
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "請填入會員名稱",
            'name.string' => "名稱必須是字串",
            'name.max' => "名稱最多255字元",
            'email.required' => "請填入信箱",
            'email.email' => "請輸入正確的信箱",
            'email.unique' => "這個信箱已經有人用囉",
            'role.required' => "請對這個會員帳號設定權限",
            'password.required' => "請輸入會員密碼",
            'password.min' => "密碼最少8位數",
            'password.regex' => "密碼不符合格式"
        ];
    }
}
