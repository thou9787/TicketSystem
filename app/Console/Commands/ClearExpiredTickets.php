<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Console\Command;


class ClearExpiredTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleted all the expired tickets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Delete tickets which not be paid and expired.
     *
     * @return void
     */
    public function handle()
    {
        $tickets = Ticket::where('paid', 0)
                        ->get('trainDate');
        foreach ($tickets as $ticket) {
            if (Carbon::create($ticket->trainDate)->addDays(1)->lt(Carbon::now())) {
                $ticket->delete();
            }
        }
        return ;
    }
}
