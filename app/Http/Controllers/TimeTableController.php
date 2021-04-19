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
    public function create(StoreTimeTableRequest $request)
    {
        $tableCatcher = new PTXRequest($request);
        $timeTable = $tableCatcher->getAvailableTimeTable();

        if ($timeTable == false) return '<script>alert("No tickets")</script>';
        /**
         * FIXME:把timetable資料存進cache裡，paginate要做一下
         */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeTableRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeTable  $timeTable
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(TimeTable $timeTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeTable $timeTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeTable $timeTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeTable $timeTable)
    {
        //
    }
}
