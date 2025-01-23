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

    public function get_all_by_race(Request $request, $race) {
        $tickets = Ticket::with('seat')->get();
        
        foreach ($tickets as $key=>$ticket) {
            if($ticket->seat->grandstand->race->id_race != $race) {
                $tickets->forget($key);
            }
        }

        return $this->sendResponse($tickets, 'Retrieved successfully.');
    }

    public function get_seats_with_tickets() {
        $tickets = Ticket::with('seat')->get();
        return $this->sendResponse($tickets, 'Ticket retrieved successfully.');
    }
}
