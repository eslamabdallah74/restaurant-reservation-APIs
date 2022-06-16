<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table    = 'reservations';
    protected $fillable = [
        'table_id',
        'customer_id',
        'from_time',
        'to_time',
    ];

    public static function credentials($request)
    {
        $credentials = [
            'table_id'      => $request->table_id,
            'customer_id'   => $request->customer_id,
            'from_time'     => $request->from_time,
            'to_time'       => $request->to_time
        ];

        return $credentials;
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
