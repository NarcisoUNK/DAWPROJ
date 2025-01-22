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
        $tickets = Ticket::where('id_user', $user)->with('seat')->get();
        return $this->sendResponse($tickets, 'Retrieved successfully.');
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
}
