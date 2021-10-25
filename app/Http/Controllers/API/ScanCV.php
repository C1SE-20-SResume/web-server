<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ScanCV extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file('file');
        $file->move('uploads', $file->getClientOriginalName());
        $image = 'uploads/'.$file->getClientOriginalName();
        return response()->json(['success' => $image]);
    }
}