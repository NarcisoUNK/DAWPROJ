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

    public function get_all_by_user(Request $request, $user) {
        $tickets = Ticket::where('id_user', $user)->get();
        return $this->sendResponse($tickets, 'Retrieved successfully.');
    }
}
