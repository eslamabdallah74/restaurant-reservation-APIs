<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table    = 'orders';
    protected $fillable = [
        'reservation_id ',
        'table_id',
        'customer_id ',
        'waiter_id',
        'total',
        'paid',
        'date',
    ];

}
