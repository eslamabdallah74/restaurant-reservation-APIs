<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class CustomerController extends Controller
{
    use ApiTrait;
    
    public function store(StoreCustomerRequest $request)
    {
        $credentials = Customer::credentials($request);
        $newCustomer = Customer::create($credentials);

        if($newCustomer)
        {
            return $this->returnData('data', new CustomerResource($newCustomer),'Customer has been created.');
        } else {
            return $this->returnError('failed');
        }
    }
}
