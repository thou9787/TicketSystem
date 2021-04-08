<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;

class FormController extends Controller
{
    //
    public function index() 
    {
        return view('form');
    }

    public function search(Request $request)
    {
        //$url = 'https://ptx.transportdata.tw/MOTC/v2/Rail/THSR/DailyTimetable/OD/0990/to/1010/2021-04-09?$format=JSON';
        $DailyTimeTable_url = 'https://ptx.transportdata.tw/MOTC/v2/Rail/THSR/DailyTimetable/';
        $OriginStationID = '0990'; //$request->value
        $DestinationStationID = '1010';
        $TrainDate = '2021-04-09';
        //$select = '';
        //$filter = '';
        //$orderby = '';
        //$top = '';
        //$skip = '';
        $format = 'format=JSON';
        $finalUrl = $DailyTimeTable_url. 'OD/' . $OriginStationID . '/to/' . $DestinationStationID . '/' . $TrainDate . '?' . $format;

        $a = new PTXRequest;
        //return $a->getData($finalUrl);
        return $request->all();
        echo $request->option('selected');
    }
}
