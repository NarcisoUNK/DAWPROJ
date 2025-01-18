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
            'id_seat' => 'required|exists:seats,id_seat',
            'id_user' => 'required|exists:users,id_user',
            'final_price' => 'required|numeric'
        ];
    }

    public function index()
    {
        $tickets = Ticket::all();
        return $this->sendResponse(TicketResource::collection($tickets), 'Tickets retrieved successfully.');
    }

    public function get($id)
    {
        $ticket = Ticket::find($id);
        if (is_null($ticket)) {
            return $this->sendError('Ticket not found.');
        }
        return $this->sendResponse(new TicketResource($ticket), 'Ticket retrieved successfully.');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $ticket = Ticket::create($request->all());

        return $this->sendResponse(new TicketResource($ticket), 'Ticket created successfully.');
    }
}