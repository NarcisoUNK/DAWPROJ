<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrandstandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_grandstand' => $this->id_grandstand,
            'id_race' => $this->id_race,
            'name' => $this->name,
            'seats' => SeatResource::collection($this->seats)
        ];
    }
}