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
        // Table is booked in this date
        $bookedUp = DB::table('reservations')
            ->where('table_id', $request->table_id)
            ->where(
                fn ($q) => $q->whereBetween('from_time', [$request->from_time, $request->to_time])
                            ->orWhereBetween('to_time', [$request->from_time, $request->to_time])
                            ->orWhere(
                                fn ($q) => $q->where('from_time', '<=', $request->from_time)
                                    ->where('to_time', '=>', $request->to_time) )
            )->first();

        // dd($bookedUp);
        //  See if table have free capacity
        $table              = Table::where('id',$request->table_id)->first();
        $tableHaveRoom      = $table->capacity >= ( $table->reserved + $request->guests);

        if($bookedUp == null )
        {
            if ($tableHaveRoom)
            {
                $credentials        = Reservation::credentials($request);
                $newReservation     = Reservation::create($credentials);
                $ReservationTable   = Reservation::where('table_id',$newReservation->table_id)->first();
                // Add customer to the table
                $ReservationTable->table->reserved = $ReservationTable->table->reserved + $request->guests;
                $ReservationTable->push();
                return $this->returnData('data', new ReservationResource($newReservation),'Reservation has been created.');
            } else {
                return $this->returnError('Table is full or guests are over the maximum capacity');
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
