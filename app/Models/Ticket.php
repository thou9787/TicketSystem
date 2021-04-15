<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'trainNo',
        'originStationName',
        'destinationStationName',
        'departureTime',
        'arrivalTime',
        'amount',
        'fare',
        'user_id',
        'trainDate',
        'ticketNo',
        'paid'
    ];

    public function users() {
        return $this->hasmany('App\Models\User');
    }
}
