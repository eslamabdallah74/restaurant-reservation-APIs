<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Http\Resources\CheckoutResource;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class CheckoutController extends Controller
{
    use ApiTrait;

    public function checkout(CheckoutRequest $request)
    {
        $Reservation    = Reservation::where('id',$request->reservation_id)->first();
        if($Reservation)
        {
            // Change order [Paid] status to true - Suppose that when the invoice is issued, payment is made
            $Orders      = $Reservation->order;
            foreach ($Orders as $Order)
            {
                $Order->update([
                    'paid'  => true
                ]);
            }

            // Return invoice
            return $this->returnData('data',new CheckoutResource($Reservation), 'invoice');
        } else {
            return $this->returnError('Reservation not found, check Reservation_id');
        }
    }

}
