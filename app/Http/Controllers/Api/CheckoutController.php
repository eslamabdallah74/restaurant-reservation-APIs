<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class CheckoutController extends Controller
{
    use ApiTrait;

    public function checkout(CheckoutRequest $request)
    {
        $Reservation    = Reservation::findOrFail($request->reservation_id)->first();
        dd($Reservation->order->count());
    }

}
