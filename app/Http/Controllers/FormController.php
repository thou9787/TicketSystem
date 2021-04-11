<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;

class FormController extends Controller
{
    /**
     * Show the THSR search form
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() 
    {
        return view('form');
    }
}
