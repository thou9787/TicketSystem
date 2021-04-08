<?php
namespace App\ApiRequest;

use App\ApiRequest\PTXApiAuth;

class PTXRequest 
{
    private $ApiAuth;

    public function __construct()
    {
        $this->ApiAuth = new PTXApiAuth();
    }

    public function getData($url)
    {
        $THSRData = file_get_contents(
            $url, false, stream_context_create($this->ApiAuth->getAuthHeaders())
        );
        return $THSRData;
    }

    public static function getData1()
    {
        $a = new PTXRequest;
        return $a->getData('');
    }
}
