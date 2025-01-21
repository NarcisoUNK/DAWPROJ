<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function __construct() {
        $this->model = User::class;
        $this->resource = UserResource::class;
        $this->validationRules = [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
        ];
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        return $this->sendResponse(new UserResource($user), 'User registered successfully.');
    }

    public function check(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user === null) {
            return $this->sendError('User does not exist.');
        }
        if($user->password != $request->password){
            return $this->sendError(false,'Wrong password.');
        }
        
        $data = [
            'path' => '/'
        ];

        if(!isset($_COOKIE['perm']))
            setcookie('perm',$user->permissions,$data);
        else
            $_COOKIE['perm'] = $user->permissions;

        if(!isset($_COOKIE['id_user']))
            setcookie('id_user',$user->id_user,$data);
        else
            $_COOKIE['id_user'] = $user->permissions;

        return $this->sendResponse($user,'Logged in.');
    }
}