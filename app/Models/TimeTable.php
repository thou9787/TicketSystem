<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainDate',
        'trainNo',
        'originStationId',
        'originStationName',
        'destinationStationId',
        'destinationStationName',
        'departureTime',
        'arrivalTime',
        'duration',
        'type',
        'amount'
    ];
}
