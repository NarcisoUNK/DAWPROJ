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
            'race_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id_user'
        ];
    }

    public function index()
    {
        $races = Race::all();
        return $this->sendResponse(RaceResource::collection($races), 'Races retrieved successfully.');
    }

    public function get($id)
    {
        $race = Race::find($id);
        if (is_null($race)) {
            return $this->sendError('Race not found.');
        }
        return $this->sendResponse(new RaceResource($race), 'Race retrieved successfully.');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $race = Race::create($request->all());

        return $this->sendResponse(new RaceResource($race), 'Race created successfully.');
    }
}