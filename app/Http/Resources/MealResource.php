<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
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
            'id'                    => $this->id,
            'price'                 => $this->price,
            'description'           => $this->description,
            'limit_per_day'         => $this->limit_per_day,
            'quantity_available'    => $this->quantity_available,
            'discount'              => $this->discount,
        ];
    }
}
