<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;


class TablesController extends Controller
{
    use ApiTrait;

    public function store(StoreTableRequest $request)
    {
        // Create new table
        $credentials = Table::credentials($request);
        $newTable    = Table::create($credentials);

        return $this->returnData('data', new TableResource($newTable),'Table has been created.');
    }
    
}
