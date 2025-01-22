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
            'image' => 'required|string',
            'circuit' => 'required|string',
        ];
    }

    public function index()
    {
        $races = Race::all();
        $upcomingRace = Race::where('year', '>=', date('Y'))->orderBy('year')->first();
        return response()->json([
            'success' => true,
            'data' => [
                'races' => RaceResource::collection($races),
                'upcomingRace' => new RaceResource($upcomingRace)
            ],
            'message' => 'Races retrieved successfully.'
        ]);
    }
    
    public function show($id)
    {
        $race = Race::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => new RaceResource($race),
            'message' => 'Race retrieved successfully.'
        ]);
    }

    public function user_races($id_user){
        $races = Race::where('id_user', $id_user)->get();
        return $this->sendResponse(RaceResource::collection($races),'Races retrieved successfully');
    }
}