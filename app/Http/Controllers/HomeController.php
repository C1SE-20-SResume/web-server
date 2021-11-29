<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'api_token' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
            // 'new_password' => 'required|string|min:8|confirmed',
            // 'confirm_password' => 'required',
        ]);
        $user = Auth::user();
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            // The passwords matches
            return response()->json([
                'success' => false,
                'message' => 'Error: Your current password does not matches!',
            ]);
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            // Current password and new password same
            return response()->json([
                'success' => false,
                'message' => 'Error: New password cannot be same as current password!',
            ]);
        }
        //Change Password
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Your password successfully changed!',
        ]);
    }
}
