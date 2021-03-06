<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\UserCompany;
use Illuminate\Support\Arr;

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
    // get auth user
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
    // check if user is logged in by api_token
    public function check()
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $data = null;
            if ($user->role_level == 0) {
                $results = $user->result;
                $aptitude_score = null;
                $personality_score = null;
                $aptitude_graph = [];
                $personality_graph = [];
                foreach ($results as $result) {
                    $type = $result->type;
                    if ($result->type_id == 1 || $result->type_id == 2 || $result->type_id == 3) {
                        $aptitude_score = $aptitude_score + $result->ques_score;
                        $aptitude_graph = Arr::add($aptitude_graph, $type->type_name, $result->ques_score);
                    } else {
                        $personality_score = $personality_score + $result->ques_score;
                        $personality_graph = Arr::add($personality_graph, $type->type_name, $result->ques_score);
                    }
                }
                $data = json_decode(json_encode([
                    'aptitude_score' => $aptitude_score.'/15',
                    'personality_score' => $personality_score.'/75',
                    'aptitude_graph' => $aptitude_graph,
                    'personality_graph' => $personality_graph,
                    'full_name' => $user->full_name,
                    'gender' => $user->gender,
                    'date_birth' => $user->date_birth,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'created_at' => $user->created_at->toDateTimeString(),
                    'updated_at' => $user->updated_at->toDateTimeString(),
                ]));
            } else {
                $company_name = null;
                $logo_url = null;
                if($user->company != null) {
                    $company_name = $user->company->company_name;
                    $logo_url = $user->company->logo_url;
                }
                $data = json_decode(json_encode([
                    'company_name' => $company_name,
                    'logo_url' => $logo_url,
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
            if(User::where('email', $request['email'])->first()->email_verified_at == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your email is not verified yet',
                ]);
            }
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
                $user = User::create([
                    'full_name' => $request['full_name'],
                    'gender' => $request['gender'],
                    'date_birth' => $request['date_birth'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);

                event(new Registered($user));

                // login user
                $api_token = Str::random(60);
                $user->api_token = $api_token;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Register successful',
                    'access_token' => $api_token
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
    public function logout(Request $request)
    {
        $request->user()->api_token = null;
        $request->user()->save();
        return response()->json([
            'success' => true,
            'message' => 'Logout successful'
        ]);
    }

    /**
     * Update profile API
     *
     * @return void
     */
    public function profile(Request $request)
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();

            $request_info = $request->only('full_name', 'gender', 'date_birth', 'phone_number');
            $user_update = User::find($user->id);
            $user_update->update($request_info);
            if ($user->role_level == 1) {
                $request_company = $request->only('company_name', 'logo_url');
                $company_update = UserCompany::find($user->company->id);
                $company_update->update($request_company);
            }
            return response()->json([
                'success' => true,
                'message' => 'Update profile successful'
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
}