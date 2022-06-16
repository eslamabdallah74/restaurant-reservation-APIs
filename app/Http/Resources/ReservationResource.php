<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'            => $this->id,
            'table'         => new TableResource($this->table),
            'customer'      => new CustomerResource($this->customer),
            'from_time'     => $this->from_time,
            'to_time'       => $this->to_time,
        ];
    }
}
