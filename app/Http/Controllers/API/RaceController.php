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
            'id_user' => 'required|exists:user,id_user',
            'race_name' => 'required|string',
            'year' => 'required|integer',
            'country' => 'required|string',
            'city' => 'required|string',
        ];
    }
}
