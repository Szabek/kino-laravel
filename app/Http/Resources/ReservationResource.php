<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'screening' => ScreeningResource::make($this->screening),
            'seats' => $this->seats,
            'total_price' => $this->total_price,
            'is_paid' => $this->is_paid,
        ];
    }
}
