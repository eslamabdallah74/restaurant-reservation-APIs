<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table    = 'customer';
    protected $fillable = [
        'name',
        'phone',
        'wait_list'
    ];

    public static function credentials($request)
    {
        $credentials = [
            'name'       => $request->name,
            'phone'      => $request->phone,
        ];

        return $credentials;
    }

    public function reservations()
    {
        $this->belongsTo(Reservation::class);
    }

}
