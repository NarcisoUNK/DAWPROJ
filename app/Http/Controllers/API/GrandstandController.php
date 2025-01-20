<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\GrandstandResource;
use App\Models\Grandstand;
use Illuminate\Http\Request;

class GrandstandController extends BaseController
{
    public function __construct() {
        $this->model = Grandstand::class;
        $this->resource = GrandstandResource::class;
        $this->validationRules = [
            'id_race' => 'required|integer',
            'name' => 'required|string',
        ];
    }

    public function get_all_by_race($race) {
        $grandstands = Grandstand::where('id_race', $race)->get();
        return $this->sendResponse(GrandstandResource::collection($grandstands), 'Grandstands retrieved successfully.');
    }
}