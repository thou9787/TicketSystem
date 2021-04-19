<?php

namespace App\Http\Controllers;


use App\Models\Ticket;
use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Auth;
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ticket = Ticket::create($request->all());
        $ticket = $ticket->refresh();
        return redirect('/admin/tickets');
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
            ]);
            $request->amount--;
        }
        
        return redirect('/pay');
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
    
    //TODO:針對更新的request做validate
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());
        return back();
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
        return back();
    }
}
