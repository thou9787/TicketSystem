<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TicketResource;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::all();
        return response(['data' => $tickets], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateTicketRequest $request)
    {
        $ticket = Ticket::create($request->all());
        
        return redirect('/admin/tickets')->with('success', 'Create ticket successfully');
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
            Ticket::create(
                [
                    'trainNo' => $request->trainNo,
                    'originStationName' => $request->originStationName,
                    'destinationStationName' => $request->destinationStationName,
                    'departureTime' => $request->departureTime,
                    'arrivalTime' => $request->arrivalTime,
                    'fare' => $fare->getFare(),
                    'amount' => 1,
                    'user_id' => Auth::user()->id,
                    'trainDate' => $request->date,
                ]
            );
            $request->amount--;
        }

        return redirect('/pay');
    }

    //TODO:針對更新的request做validate
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
        return back()->with('success', 'Update ticket successfully');
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
        return back()->with('success', 'Delete ticket successfully');
    }
}
