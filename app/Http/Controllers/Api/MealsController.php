<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class MealsController extends Controller
{
    use ApiTrait;

    // Menu
    public function allMeals()
    {
        $Meals  = Meal::all();
        return $this->returnData('data', MealResource::collection($Meals),'All meals');
    }

    public function store(StoreMealRequest $request)
    {
        $credentials = Meal::credentials($request);
        $newMeal     = Meal::create($credentials);

        return $this->returnData('data', new MealResource($newMeal),'Meal has been created.');
    }
}
