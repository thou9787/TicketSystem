<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'date' => 'required',
            'from' => 'required|different:to',
            'to' => 'required',
        ]);
        $tableCatcher = new PTXRequest($request);
        $timeTable = $tableCatcher->getAvailableTimeTable();
        /**
         * FIXME:把timetable資料存進cache裡，paginate要做一下
         */
        foreach ($timeTable as $table) {
            $duration = date('H:i', (strtotime($table['arrivalTime']) - strtotime($table['departureTime'])));
            if (Carbon::create($request->time)->lte(Carbon::create($table['departureTime']))) {
                $timeTable = TimeTable::create([
                    'trainDate' => $table['trainDate'],
                    'trainNo' => $table['trainNo'],
                    'originStationId' => $table['originStationId'],
                    'originStationName' => $table['originStationName'],
                    'destinationStationId' => $table['destinationStationId'],
                    'destinationStationName' => $table['destinationStationName'],
                    'departureTime' => $table['departureTime'],
                    'arrivalTime' => $table['arrivalTime'],
                    'duration' => $duration, 
                ]);
            }
            
        }
        return view('ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeTable  $timeTable
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
