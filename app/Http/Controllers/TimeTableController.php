<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
use App\Http\Requests\StoreTimeTableRequest;
use Carbon\Carbon;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('timetable');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreTimeTableRequest $request, PTXRequest $ptxrequest)
    {
        $timeTable = $ptxrequest->getAvailableTimeTable();

        if ($timeTable == false) {
            return '<script>alert("No tickets")</script>';
        }
        
        foreach ($timeTable as $table) {
            $duration = date('H:i', (strtotime($table['arrivalTime']) - strtotime($table['departureTime'])));
            if (Carbon::create($request->time)->lte(Carbon::create($table['departureTime']))) {
                $timeTable = TimeTable::create(
                    [
                        'trainDate' => $table['trainDate'],
                        'trainNo' => $table['trainNo'],
                        'originStationId' => $table['originStationId'],
                        'originStationName' => $table['originStationName'],
                        'destinationStationId' => $table['destinationStationId'],
                        'destinationStationName' => $table['destinationStationName'],
                        'departureTime' => $table['departureTime'],
                        'arrivalTime' => $table['arrivalTime'],
                        'duration' => $duration,
                        'type' => $request->type,
                        'amount' => $request->amount,
                    ]
                );
            }
        }
        return redirect('/timetable');
    }
}
