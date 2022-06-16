<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'table_id'    => 'required|integer',
            'customer_id' => 'required|integer',
            'guests'      => 'required|min:1',
            'from_time'   => 'required|date',
            'to_time'     => 'required|date|after:from_time'
        ];
    }
}