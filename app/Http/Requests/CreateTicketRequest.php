<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateTicketRequest extends FormRequest
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
            'trainNo' => 'in:"0108", "0109", "0112", "0113", "0116",
                "0117", "0120", "0121", "0124", "0125",
                "0128", "0129", "0132", "0133", "0136",
                "0137", "0140", "0141", "0144", "0145",
                "0148", "0149", "0152", "0153", "0156",
                "0157", "0160", "0161", "0165", "0203",
                "0204", "0205", "0206", "0242", "0249",
                "0294", "0295", "0300", "0333", "0502",
                "0508", "0565", "0567", "0583", "0598",
                "0603", "0606", "0609", "0610", "0612",
                "0613", "0615", "0616", "0618", "0619",
                "0621", "0624", "0625", "0627", "0628",
                "0630", "0633", "0636", "0639", "0642",
                "0645", "0648", "0651", "0654", "0657",
                "0658", "0660", "0661", "0663", "0664",
                "0666", "0667", "0669", "0670", "0672",
                "0673", "0675", "0676", "0678", "0681",
                "0684", "0687", "0690", "0693", "0696",
                "0802", "0803", "0805", "0806", "0809",
                "0810", "0813", "0814", "0817", "0818",
                "0821", "0822", "0825", "0826", "0829",
                "0830", "0833", "0834", "0837", "0838",
                "0841", "0842", "0845", "0846", "0849",
                "0850", "0853", "0854", "0857", "0858", 
                "0861", "0862", "1210", "1234", "1237",
                "1238", "1241", "1245", "1246", "1250",
                "1253", "1254", "1257", "1258", "1264",
                "1318", "1320", "1326", "1328", "1330",
                "1538", "1541", "1542", "1545", "1546", 
                "1549", "1550", "1553", "1554", "1557",
                "1558", "1562", "1563", "1566", "1570",
                "1622", "1640", "1643", "1646", "1649",
                "1652", "1655", "1679", "1682", "1685",
                "1688"',
              'to' => 'different:from',
              'fare' => 'required|numeric|min:0',
              'amount' => 'required|min:1',
              'user_id' => 'required',
              'trainDate' => 'required|date',
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
            'trainNo.required' => "必須要填入列車編號",
            'trainNo.in' => "請選擇已有的列車編號",
            'from.required' => "請填入出發地",
            'to.required' => "請選擇目的地",
            'to.different' => "出發地需與目的地不同",
            'fare.required' => "請填入價錢",
            'fare.numeric' => "請填入阿拉伯數字",
            'fare.min' => "請填入正確價格",
            'amount.required' => "請填入票券數量",
            'amount.min' => "票券最少要填入一張喔",
            'user_id.required' => "請選擇會員ID",
            'trainDate.required' => "請填入日期",
            'trainDate.date' => "填入的日期不符合格式",
        ];
    }
}
