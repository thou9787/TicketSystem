<?php
namespace App\ApiRequest;

use App\ApiRequest\PTXApiAuth;
use Illuminate\Http\Request;

//TODO:封裝這個PTXRequest，最後只會提供一個getData()
class PTXRequest 
{
    private $ApiAuth;
    private $base_url;
    private $searchTable;
    private $requestFormat;
    private $requestUrl;
    
    /**
     * Instance the PTXApiAuth object
     * 
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct($request)
    {
        $this->ApiAuth = new PTXApiAuth();
        $this->base_url = 'https://ptx.transportdata.tw/MOTC/v2/Rail/THSR/';
        $this->searchTable = 'DailyTimetable/';
        $this->requestFormat = '?$format=JSON';
        $this->requestUrl = $this->getUrl($request);
    }

    /**
     * Combine strings in request
     * 
     * @param \Illuminate\Http\Request  $request
     * @return string
     */
    private function getUrl($request)
    {
        $finalUrl = $this->base_url . $this->searchTable . 'OD/' . $request->from . '/to/' . $request->to . '/' . $request->date . $this->requestFormat;
                 
        return $finalUrl;
    }

    /**
     * To get the data from PTX platform
     * 
     * @return json
     */
    private function sendRequest()
    {
        $timeTable = file_get_contents(
            $this->requestUrl, false, stream_context_create($this->ApiAuth->getAuthHeaders())
        );
        return json_decode($timeTable);
    }
    
    /**
     * Transform request data to array 
     * 
     * @return array
     */
    public function getTimeTable()
    {
        //TODO:將出發時間跟request時間做比較
        foreach ($this->sendRequest() as $table) {
            $timeTableArr[] = [
                'trainDate' => $table->TrainDate,
                'trainNo' => $table->DailyTrainInfo->TrainNo,
                'originStationId' => $table->OriginStopTime->StationID,
                'originStationName' => $table->OriginStopTime->StationName->Zh_tw,
                'destinationStationId' => $table->DestinationStopTime->StationID,
                'destinationStationName' => $table->DestinationStopTime->StationName->Zh_tw,
                'departureTime' => $table->OriginStopTime->DepartureTime,
                'arrivalTime' => $table->DestinationStopTime->ArrivalTime,
            ];
        }
        return $timeTableArr;
    }
}
