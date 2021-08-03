<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScreeningResource extends JsonResource
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
            'movie' => MovieResource::make($this->movie),
            'room' => RoomResource::make($this->room),
            'start_time' => $this->start_time,
            'price' => $this->price,
            'available_seats' => $this->available_seats
        ];
    }
}
