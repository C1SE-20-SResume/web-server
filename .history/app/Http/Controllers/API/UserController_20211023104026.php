<?php

namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Auth API
 *
 * API for login, logout
 */
class UserController extends Controller
{
    /**
     * Login API
     *
     * @unauthenticated
     * @queryParam email string required. Example: example@example.org
     * @queryParam password string required. Example: password
     */
    public function login(Request $request)
    {
        $request = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $api_token = Str::random(60);
            $user = Auth::user();
            $user->api_token = $api_token;
            $user->save();

            return response()->json([
                'code' => 1,
                'api_token' => $api_token,
                'user_info' => Auth::user(),
            ]);
        }

        return response()->json([
            'code' => 0,
        ]);
    }

    /**
     * Logout API
     *
     * @return void
     */
    public function logout()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->api_token = null;
            $user->save();
            
            return response()->json([
                'code' => 1,
            ]);
        }
        return response()->json([
            'code' => 0,
        ]);
    }
}
