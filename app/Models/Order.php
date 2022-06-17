<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table    = 'orders';

    protected $fillable = [
        'reservation_id',
        'table_id',
        'customer_id',
        'waiter_id',
        'total',
        'paid',
        'date',
    ];

    public static function credentials($request,$table,$cusomter,$total)
    {
        $randomNumber = mt_rand(10, 9999);

        $credentials = [
            'reservation_id'    => $request->reservation_id,
            'table_id'          => $table,
            'customer_id'       => $cusomter,
            'waiter_id'         => $randomNumber,
            'total'             => $total,
            'date'              => Carbon::now()
        ];

        return $credentials;
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

}
