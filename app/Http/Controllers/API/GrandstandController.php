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
            #TODO: Add validation rules
        ];
    }

    #TODO: set index method
}
