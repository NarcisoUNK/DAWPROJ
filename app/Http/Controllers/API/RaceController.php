<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\RaceResource;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends BaseController
{
    public function __construct() {
        $this->model = Race::class;
        $this->resource = RaceResource::class;
        $this->validationRules = [
            #TODO: Add validation rules
        ];
    }
}
