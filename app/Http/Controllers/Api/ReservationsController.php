<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    use ApiTrait;

    public function store(StoreReservationRequest $request)
    {
        // Get table is booked in this date
        // I wont lie This Query was kinda trickey so i used my search skills
        $bookedUp = Reservation::where('table_id', $request->table_id)->where(
                fn ($q) => $q->whereBetween('from_time', [$request->from_time, $request->to_time])
                            ->orWhereBetween('to_time', [$request->from_time, $request->to_time])
                            ->orWhere(
                            fn ($q) => $q->where('from_time', '<=', $request->from_time)
                            ->where('to_time', '=>', $request->to_time)
                            ))->first();

        //  See if table has free capacity
        $table                = Table::where('id',$request->table_id)->first();
        if ($table)
        {
            $HasFreeSpace     = $table->capacity >= $request->guests;
        } else {
            return $this->returnError('Table is not found');
        }

        // if customer doesn't exist throw error
        if(!Customer::where('id',$request->customer_id)->first())
        {
            return $this->returnError('customer not found');
        }


        if($bookedUp == null )
        {
            if ($HasFreeSpace)
            {
                // Make a $Reservation
                $credentials        = Reservation::credentials($request);
                $newReservation     = Reservation::create($credentials);

                return $this->returnData('data', new ReservationResource($newReservation),'Reservation has been created.');
            } else {
                $table              = Table::where('id',$request->table_id)->first();
                return $this->returnError('Guests are over the maximum capacity, maximum capacity is ' . $table->capacity);
            }
        } else {
            // Add customer on waiting list
             $custmoer   = Customer::where('id',$request->customer_id)->first();
             $custmoer->wait_list = 1;
             $custmoer->push();

            return $this->returnError('Table is booked at this time, you are on waiting list');
        }


    }
}
