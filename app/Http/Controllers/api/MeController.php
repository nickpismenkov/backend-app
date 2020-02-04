<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class MeController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
            'ads' => User::find($request->user()->id)->Ad,
            'type' => User::find($request->user()->id)->Users_type->user_type
        ]);
    }

    public function logout(Request $request)
    {
        $this->auth->invalidate();

        return response()->json([
            'success' => true
        ]);
    }
}
