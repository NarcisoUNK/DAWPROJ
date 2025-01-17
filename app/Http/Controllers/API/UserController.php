<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;
use Validator;

class UserController extends BaseController
{
    public function __construct() {
        $this->model = User::class;
        $this->resource = UserResource::class;
        $this->validationRules = [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'permissions' => 'required',
            'name' => 'required'
        ];
    }
    
    public function index()
    { 
        return $this->sendError("Can't retrieve all users.");
    }
}
