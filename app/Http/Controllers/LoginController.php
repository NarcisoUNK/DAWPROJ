<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('loginhome');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $redirectUrl = $user->permissions === '111' ? route('sellerpage') : route('userpage');

            // Set cookies
            $data = [
                'path' => '/',
                'expires' => time() + (86400 * 30), // 30 days
            ];
            setcookie('perm', $user->permissions, $data);
            setcookie('id_user', $user->id_user, $data);

            return response()->json(['success' => true, 'redirectUrl' => $redirectUrl]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid email or password.'], 401);
    }
}