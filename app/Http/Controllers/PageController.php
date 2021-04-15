<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
use App\AddColumnData\AddColumnData;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    /**
     * Show the THSR search form
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form() 
    {
        return view('form');
    }

    /**
     * Show the success page and update the ticket paid column
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function success()
    {
        $success = Ticket::where('user_id', Auth::user()->id)->update(['paid' => AddColumnData::isPaid()]);
        return view('success');
    }

    /**
     * Show the tickets of users
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function pay()
    {
        $userID = Auth::user()->id;
        $tickets = Ticket::where('user_id', $userID)
                        ->where('paid', 0)
                        ->get();
        $total_price = Ticket::where('user_id', $userID)
                        ->where('paid', 0)
                        ->sum('fare');
        return view('pay', [
            'tickets' => $tickets,
            'total_price' => $total_price
        ]);
    }

    /**
     * Show the page about bought tickets
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function history()
    {
        $userID = Auth::user()->id;
        $histories = Ticket::where('user_id', $userID)
                        ->where('paid', 1)
                        ->get();
        return view('history', [
            'histories' => $histories,
        ]);
    }
}
