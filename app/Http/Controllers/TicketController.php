<?php

namespace App\Http\Controllers;

use App\AddColumnData\AddColumnData;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PageController::pay();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $fare = new PTXRequest($request);
        while ($request->amount > 0) {
            Ticket::create([
                'trainNo' => $request->trainNo,
                'originStationName' => $request->originStationName,
                'destinationStationName' => $request->destinationStationName,
                'departureTime' => $request->departureTime,
                'arrivalTime' => $request->arrivalTime,
                'fare' => $fare->getFare(),
                'amount' => 1,
                'user_id' => Auth::user()->id,
                'trainDate' => $request->date,
                'ticketNo' => AddColumnData::generateHash(),
            ]);
            $request->amount--;
        }
        
        return $this->index($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
        return new TicketResource($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->all());
        return view('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect('/history');
    }
}
