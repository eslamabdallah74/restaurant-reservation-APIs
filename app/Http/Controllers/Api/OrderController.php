<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class OrderController extends Controller
{
    use ApiTrait;

    public function order(OrderRequest $request)
    {
        $mealIDs= $request->meal_ids;
        $Reservation   = Reservation::where('id',$request->reservation_id)->first();
        // if $Reservation id is not correct
        if(!$Reservation)
        {
            return $this->returnError('Reservation not found');
        }

        $TotalmealsPrice = null;

        foreach($mealIDs as $meal)
        {
            $getMeal                = Meal::where('id',$meal)->first();
            if ($getMeal !== null)
            {

                // Get Meals Price After Discount [Total]
                $PriceAfterDiscount     = $getMeal->price - ($getMeal->price * ($getMeal->discount / 100));
                $TotalmealsPrice        += $PriceAfterDiscount;

                // Get Meals served today
                $OrderdMeal             = OrderDetails::where('meal_id',$meal)
                ->whereDate('created_at', Carbon::today())->get();

                // If the meal reaches the maximum per day dont serve it throw error
                if ($OrderdMeal->count() == $getMeal->limit_per_day)
                {
                    return $this->returnError('Meal reached max serve per day, ID ' . $getMeal->id);
                }

                // If meal quantity is 0
                if ($getMeal->quantity_available < 1)
                {
                    return $this->returnError('Meal is not available now, ID ' . $getMeal->id);
                }

                // reduce meal quantity by one
                $getMeal->update([
                    'quantity_available'    => $getMeal->quantity_available  -= 1,
                ]);
            } else {
                return $this->returnError('Meal not found!');
            }

        } // end foreach

        // Start Ordering
        $credentials   = Order::credentials($request,$Reservation->table->id,$Reservation->customer->id,$TotalmealsPrice);
        $newOrder      = Order::create($credentials);

        // Create Order details
        foreach ($mealIDs as $meal)
        {
            $getMeal                = Meal::where('id',$meal)->first();
            $mealPrice              = $getMeal->price - ($getMeal->price * ($getMeal->discount / 100));
            $credentials            = OrderDetails::credentials($newOrder->id,$getMeal->id,$mealPrice);
            $newOrderDetail         = OrderDetails::create($credentials);
        }

        return $this->returnData('data', new OrderResource($newOrder),'Order has been created.');
        // End
    }

}
