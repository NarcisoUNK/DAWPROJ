<?php

namespace App\Http\Resources;

use App\Models\Grandstand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GrandstandCollection extends ResourceCollection
{
    public $preserveKeys = true;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
