<?php

namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            $user_info = json_decode(json_encode([
                'full_name' => $user->full_name,
                'gender' => $user->gender,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]));

            return response()->json([
                'status' => 1,
                'api_token' => $api_token,
                'user_id' => $user->id,
                'company_id' => $user->company_id,
                'role_level' => $user->role_level,
                'user_info' => $user_info,
            ]);
        }

        return response()->json([
            'status' => 0,
        ]);
    }

    /**
     * Register API
    */
    public function register(Request $request)
    {
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user->count() == 0 && isset($request['password']) && isset($request['phone_number'])) {
            $request = $request->only('full_name', 'gender', 'phone_number', 'email', 'password');
            if($request != null){
                User::create([
                    'full_name' => $request['full_name'],
                    'gender' => $request['gender'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
                return response()->json([
                    'status' => 1,
                ]);
            }
        }
        return response()->json([
            'status' => 0,
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
                'status' => 1,
            ]);
        }

        return response()->json([
            'status' => 0,
        ]);
    }
}
