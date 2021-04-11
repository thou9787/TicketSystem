<?php
namespace App\ApiRequest;
use Carbon\Carbon;

class PTXApiAuth{
    private $appId;
    private $appKey;
    private $time_string;
    private $signature;
    private $opts;
    public function __construct()
    {
        $this->appId = '78c70050ed204b35bfb169173f58d555';
        $this->appKey = 'xKL27y7joTNt92Kaw0UCDscXxzc';
        $this->time_string = $this->getTime();
        $this->signature = base64_encode(hash_hmac("sha1", "x-date: $this->time_string", $this->appKey, true));
        $this->opts = [
                "http" => [
                    "method" => "GET",
                    "header" =>
                    'Authorization:hmac username="' . $this->appId . '", algorithm="hmac-sha1", headers="x-date", signature="' . "$this->signature\"\n" .
                    "x-date: $this->time_string\n",
                    "Accept-Encoding: gzip, deflate\n",
            ]
        ];
    }
    
    private function getTime()
    {
        // Mon, 23 Oct 2017 12:00:00 GMT';
        return Carbon::now()->tz('UTC')->format('D, d M Y H:i:s \G\M\T');
    }
    
    public function getAuthHeaders()
    {
        return $this->opts;
    }
}
//'https://ptx.transportdata.tw/MOTC/v2/Rail/THSR/DailyTrainInfo/Today?$top=5&$format=JSON'

