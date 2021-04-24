<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function users()
    {
        return $this->hasmany('App\Models\User');
    }
}
