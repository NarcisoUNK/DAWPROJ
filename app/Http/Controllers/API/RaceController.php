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
            'id_user' => 'required|exists:users,id_user',
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
    public function create()
    {
        return view('createrace');
    }


    public function store(Request $request)
    {
        $request->validate([
            'race_name' => 'required|string|max:255',
            'year' => 'required|integer',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        Race::create([
            'race_name' => $request->race_name,
            'year' => $request->year,
            'country' => $request->country,
            'city' => $request->city,
            'id_user' => auth()->id(), // Assuming the user is authenticated
            'image' => '', // Add logic to handle image upload if necessary
            'circuit' => '', // Add logic to handle circuit upload if necessary
        ]);

        return redirect()->route('sellerpage')->with('success', 'Race created successfully.');
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
}