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
            'id_grandstand' => 'required|exists:grandstands,id_grandstand',
            'n_seat_grandstand' => 'required|integer',
            'price' => 'required|numeric'
        ];
    }

    public function index()
    {
        $seats = Seat::all();
        return $this->sendResponse(SeatResource::collection($seats), 'Seats retrieved successfully.');
    }

    public function get($id)
    {
        $seat = Seat::find($id);
        if (is_null($seat)) {
            return $this->sendError('Seat not found.');
        }
        return $this->sendResponse(new SeatResource($seat), 'Seat retrieved successfully.');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $seat = Seat::create($request->all());

        return $this->sendResponse(new SeatResource($seat), 'Seat created successfully.');
    }
}