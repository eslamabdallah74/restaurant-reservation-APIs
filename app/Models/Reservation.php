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
        'customer_id ',
        'from_time',
        'to_time',
    ];
}
