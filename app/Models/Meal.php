<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $table    = 'meals';
    protected $fillable = [
        'price',
        'description',
        'limit_per_day',
        'quantity_available',
        'discount',
    ];

    public static function credentials($request)
    {
        $credentials = [
            'price'                 => $request->price,
            'description'           => $request->description,
            'limit_per_day'         => $request->limit_per_day,
            'quantity_available'    => $request->quantity_available,
            'discount'              => $request->discount,
        ];

        return $credentials;
    }
}
