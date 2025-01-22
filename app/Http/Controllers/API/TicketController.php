<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends BaseController
{
    public function __construct() {
        $this->model = Ticket::class;
        $this->resource = TicketResource::class;
        $this->validationRules = [
            'id_seat' => 'required|exists:seat,id_seat',
            'id_user' => 'required|exists:user,id_user',
            'final_price' => 'required|numeric'
        ];
    }
    public function create(Request $request)
    {
        $request->validate([
            'id_seat' => 'required|exists:seat,id_seat',
            'id_user' => 'required|exists:users,id_user',
            'final_price' => 'required|numeric',
        ]);

        $ticket = Ticket::create([
            'id_seat' => $request->id_seat,
            'id_user' => $request->id_user,
            'final_price' => $request->final_price,
        ]);

        return response()->json(['data' => $ticket, 'message' => 'Ticket created successfully.'], 201);
    }
}
