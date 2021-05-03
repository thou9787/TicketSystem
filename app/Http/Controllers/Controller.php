<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 請求
     *
     * @var Request
     */
    protected $request;

    public function __construct()
    {
        $this->request = app('request');
    }

    /**
     * 防止表單重複提交的key前綴
     * @var string
     */
    private $formResubmitPrefix = 'f_';

    /**
     * 將key加個前綴
     * @param unknown $key
     * @return string
     */
    private function formResubmitKeyProcess($key)
    {
        if (empty($key)) {
            //默認使用當前路由的uri爲key
            return $this->formResubmitPrefix . Route::current()->uri;
        } else {
            return $this->formResubmitPrefix . $key;
        }
    }

    /**
     * 在初始化表單前調用（如上面分步實現中的showRegistrationForm()方法中）
     * @param unknown $key
     */
    protected function formInit($key = null)
    {
        $key = $this->formResubmitKeyProcess($key);
        $this->request->session()->put($key, time());
    }

    /**
     * 在處理表單提交的方法中調用
     * @param string $message
     * @param unknown $key
     * @throws HttpException
     */
    protected function formSubmitted($key = null)
    {
        $key = $this->formResubmitKeyProcess($key);
        if ($this->request->session()->has($key)) {
            $this->request->session()->forget($key);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 在處理表單提交的方法中調用（如上面分步實現中的register()方 法），該方法方便自定義重複提交時的提示頁面，可以在子類中if判斷一下，如果發生重複提交，響應自定義的界面
     * @param string $message
     * @param unknown $key
     */
    protected function formSubmitIsRepetition(string $message = '請勿重複提交！', $key = null)
    {
        // $key = $this->formResubmitKeyProcess($key);
        // if ($this->request->session()->has($key)) {
        //     $this->request->session()->forget($key);
        //     return false;
        // } else {
        //     return response()->view('errors.403', ['message' => $message], 403);
        // }
        return redirect('/pay');
    }
}
