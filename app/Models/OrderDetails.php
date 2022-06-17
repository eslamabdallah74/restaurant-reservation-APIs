<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table    = 'order_details';
    protected $fillable = [
        'order_id',
        'meal_id',
        'amount_to_pay',
    ];

    public static function credentials($order_id,$meal_id,$amount_to_pay)
    {
        $credentials = [
            'order_id'          => $order_id,
            'meal_id'           => $meal_id,
            'amount_to_pay'     => $amount_to_pay,
        ];
        return $credentials;
    }
}
