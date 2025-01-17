<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SeatResource;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends BaseController
{
    public function __construct() {
        $this->model = Seat::class;
        $this->resource = SeatResource::class;
        $this->validationRules = [
            #TODO: Add validation rules
        ];
    }

    #TODO: set index method
}
