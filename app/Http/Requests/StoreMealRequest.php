<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
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
            'price'                  => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description'            => 'required|min:2',
            'limit_per_day'          => 'required|min:1|integer',
            'quantity_available'     => 'required|min:1|integer',
            'discount'               => 'nullable|numeric|between:1,99.99',
        ];
    }
}
