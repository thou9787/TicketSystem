<?php
namespace App\ApiRequest;

use App\ApiRequest\PTXApiAuth;

class PTXRequest 
{
    private $ApiAuth;
    private $base_url;
    private $dailyTimeTableUrl;
    private $availableSeatsUrl;
    private $requestFormat;
    private $fareUrl;
    
    /**
     * Instance the PTXApiAuth object
     * 
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct($request)
    {
        $this->ApiAuth = new PTXApiAuth();
        $this->request = $request;
        $this->base_url = 'https://ptx.transportdata.tw/MOTC/v2/Rail/THSR/';
        $this->dailyTimeTableUrl = 'DailyTimetable/';
        $this->availableSeatsUrl = 'AvailableSeatStatus/Train/';
        $this->fareUrl = 'ODFare';
        $this->requestFormat = '$format=JSON';
    }

    /**
     * Combine timetable url strings in request
     * 
     * @param \Illuminate\Http\Request  $request
     * @return string
     */
    private function getTimeTableUrl($request)
    {
        $timeTableUrl = $this->base_url . $this->dailyTimeTableUrl . 'OD/' . $request->from . '/to/' . $request->to . '/' . $request->date . '?' . $this->requestFormat;
                 
        return $timeTableUrl;
    }

    /**
     * Combine seat url strings in request
     * 
     * @param \Illuminate\Http\Request  $request
     * @param array $filter
     * @return string
     */
    private function getAvailableSeatsUrl($request, $filter=NULL)
    {
        $availableSeatsUrl = $this->base_url . $this->availableSeatsUrl . 'OD/' . $request->from . '/to/' . $request->to . '/TrainDate/' . $request->date . '?';
        if ($filter != NULL) {
            $filterQuery = '$filter=trainNo%20eq%20';
            $filterQuery .= implode('%20or%20trainNo%20eq%20', $filter);
            $availableSeatsUrl .= $filterQuery . '%20&' . $this->requestFormat;
        } else {
            $availableSeatsUrl .= $this->requestFormat;
        }
        
        return $availableSeatsUrl;
    }

    /**
     * Get the url of the ticket fare page
     * 
     * @param \Illuminate\Http\Request  $request
     * @return string
     */
    private function getFareUrl($request) 
    {
        $filterQuery = 'OriginStationID%20eq%20' . "'{$request->originStationId}'" . '%20and%20DestinationStationID%20eq%20' . "'{$request->destinationStationId}'" . '&' . $this->requestFormat;
        $fareUrl = $this->base_url . $this->fareUrl . '?$filter=' . $filterQuery;
        
        return $fareUrl;
    }

    /**
     * To get the data from PTX platform
     * 
     * @param string $requestUrl
     * @return json
     */
    private function sendRequest($requestUrl)
    {
        $timeTable = file_get_contents(
            $requestUrl, false, stream_context_create($this->ApiAuth->getAuthHeaders())
        );
        return json_decode($timeTable);
    }

    /**
     * Transform request data to array 
     * 
     * @return array
     */
    private function getTimeTable()
    {
        foreach ($this->sendRequest($this->getTimeTableUrl($this->request)) as $table) {
            $timeTableArr[$table->DailyTrainInfo->TrainNo] = [
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

    /**
     * Get the time table which has seats
     * 
     * @return array
     */
    public function getAvailableTimeTable()
    {
        $timeTableArr = $this->getTimeTable();
        foreach ($timeTableArr as $table) {
            $trainNoArr[] = "'" . $table['trainNo'] . "'";
        }
        $requestAvailableSeatsUrl = $this->getAvailableSeatsUrl($this->request, $trainNoArr);
        $availableSeats = $this->sendRequest($requestAvailableSeatsUrl);

        foreach ($availableSeats->AvailableSeats as $seat) {
            if ($seat->StandardSeatStatus == "O") {
                $availableTimeTable[$seat->TrainNo] = $timeTableArr[$seat->TrainNo];
            }
        }
        return $availableTimeTable;
    }

    /**
     * Get the fare of the tickets
     * 
     * @return integer
     */
    public function getFare() 
    {
        $fare = $this->sendRequest($this->getFareUrl($this->request));
        if ($this->request->type == "business") {
            return $fare[0]->Fares[0]->Price*$this->request->amount;
        } else {
            return $fare[0]->Fares[1]->Price*$this->request->amount;
        }
    }
}
