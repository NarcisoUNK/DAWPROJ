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
            'id_seat' => 'required|integer',
            'id_user' => 'required|integer',
            'final_price' => 'required|string',
        ];
    }

    public function get_all_by_user(Request $request, $user) {
        $ticket = Ticket::where('id_user', $user)->get();
        return response()->json($ticket);
    }
}
