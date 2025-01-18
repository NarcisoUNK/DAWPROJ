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
            'name' => 'required|string|max:255',
            'id_race' => 'required|exists:races,id_race'
        ];
    }

    public function index()
    {
        $grandstands = Grandstand::all();
        return $this->sendResponse(GrandstandResource::collection($grandstands), 'Grandstands retrieved successfully.');
    }

    public function get($id)
    {
        $grandstand = Grandstand::find($id);
        if (is_null($grandstand)) {
            return $this->sendError('Grandstand not found.');
        }
        return $this->sendResponse(new GrandstandResource($grandstand), 'Grandstand retrieved successfully.');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $grandstand = Grandstand::create($request->all());

        return $this->sendResponse(new GrandstandResource($grandstand), 'Grandstand created successfully.');
    }
}