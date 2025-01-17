<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return $this->sendResponse(UserResource::collection($users), 'Users retrieved successfully.');
    }
}
