<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $table    = 'tables';
    protected $fillable = [
        'capacity',
        'reserved'
    ];

    public static function credentials($request)
    {
        $credentials = [
            'capacity' => $request->capacity
        ];

        return $credentials;
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
