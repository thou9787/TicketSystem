<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'trainNo' => $this->trainNo,
            'originStationName' => $this->originStationName,
            'destinationStationName' => $this->destinationStationName,
            'departureTime' => $this->departureTime,
            'arrivalTime' => $this->arrivalTime,
            'amount' => $this->amount,
            'fare' => $this->fare,
            'user_id' => $this->user_id,
            'ticketNo' => $this->ticketNo
        ];
    }
}
