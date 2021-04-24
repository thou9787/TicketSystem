<?php

namespace App\Http\Controllers;

use App\AddColumnData\AddColumnData;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeTable;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the THSR search form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form()
    {
        if (Auth::check()) {
            return view('form');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the success page and update the ticket paid column
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function success()
    {
        if (Auth::check()) {
            $timeTable = TimeTable::all();
            foreach ($timeTable as $data) {
                $data->delete();
            }
            $success = Ticket::where('user_id', Auth::user()->id)->update(['paid' => AddColumnData::isPaid()]);
            return view('success');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the tickets of users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function pay()
    {
        if (Auth::check()) {
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
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the page about bought tickets
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function history()
    {
        if (Auth::check()) {
            $userID = Auth::user()->id;
            $histories = Ticket::where('user_id', $userID)
                ->get();
            return view(
                'history',
                [
                    'histories' => $histories,
                ]
            );
        } else {
            return redirect('/login');
        }
    }
}
