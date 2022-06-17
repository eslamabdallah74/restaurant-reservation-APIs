<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'                 =>  $this->id,
            'reservation'        =>  new ReservationResource($this->reservation),
            'waiter_id'          =>  $this->waiter_id,
            'total'              =>  $this->total,
            'paid'               =>  $this->paid,
            'date'               =>   \Carbon\Carbon::parse($this->date)->format('Y-m-d H:i:s'),
        ];
    }
}
