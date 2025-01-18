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
            'id_grandstand' => 'required|exists:grandstand,id_grandstand',
            'n_seat_grandstand' => 'required|integer',
            'price' => 'required|numeric'
        ];
    }

    public function get_all_by_grandstand(Request $request, $grandstand) {
        $seats = Seat::where('id_grandstand', $grandstand)->get();
        return $this->sendResponse($seats, 'Retrieved successfully.');
    }
}