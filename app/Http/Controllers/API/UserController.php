<?php

namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * @group Auth API
 *
 * API for login, logout
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login', 'register');
    }

    // check if user is logged in by api_token
    public function check()
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $data = null;
            if ($user->role_level == 0) {
                $results = $user->result;
                $apptitude_score = null;
                $personality_score = null;
                foreach ($results as $result) {
                    if ($result->type_id == 1 || $result->type_id == 2 || $result->type_id == 3) {
                        $apptitude_score = $apptitude_score + $result->ques_score;
                    } else $personality_score = $personality_score + $result->ques_score;
                }
                $data = json_decode(json_encode([
                    'apptitude_score' => $apptitude_score,
                    'personality_score' => $personality_score,
                    'full_name' => $user->full_name,
                    'gender' => $user->gender,
                    'date_birth' => $user->date_birth,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'created_at' => $user->created_at->toDateTimeString(),
                    'updated_at' => $user->updated_at->toDateTimeString(),
                ]));
            } else {
                $company = $user->company;
                $data = json_decode(json_encode([
                    'company_name' => $company->company_name,
                    'logo_url' => $company->logo_url,
                    'full_name' => $user->full_name,
                    'gender' => $user->gender,
                    'date_birth' => $user->date_birth,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'created_at' => $user->created_at->toDateTimeString(),
                    'updated_at' => $user->updated_at->toDateTimeString(),
                ]));
            }
            return response()->json([
                'success' => true,
                'api_token' => $user->api_token,
                'role_level' => $user->role_level,
                'user_id' => $user->id,
                'company_id' => $user->company_id,
                'user_info' => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
    }

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
                'success' => true,
                'api_token' => $api_token,
                'role_level' => $user->role_level,
                'user_id' => $user->id,
                'company_id' => $user->company_id,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Login failed',
        ]);
    }

    /**
     * Register API
     */
    public function register(Request $request)
    {
        if (isset($request['email'])) {
            $check_user = User::where('email', $request['email'])->get();
            if ($check_user->count() == 0 && isset($request['password'])) {
                $request = $request->only('full_name', 'gender', 'date_birth', 'phone_number', 'email', 'password');
                User::create([
                    'full_name' => $request['full_name'],
                    'gender' => $request['gender'],
                    'date_birth' => $request['date_birth'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Register successful'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email already exists'
                ]);
            }
        }
        return response()->json([
            'success' => false,
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
                'success' => true,
                'message' => 'Logout successful'
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
}
