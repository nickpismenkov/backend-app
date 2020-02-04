<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function create(Request $request)
    {
        $validator = $this->validator($request->all());
        if(!$validator->fails()) {
            $ad = DB::table('ads')->insert([
                'user_id' => $request->user()->id,
                'category' => $request->category,
                'country' => $request->country,
                'city' => $request->city,
                'title' => $request->title,
                'description' => $request->description
            ]);

            if($ad) {
                return response()->json([
                    'success' => true
                ], 200);
            }
        }

        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    public function delete(Request $request)
    {
        $delete = DB::table('ads')->where('id', $request->id)->delete();

        if($delete) {
            return response()->json([
                'success' => true
            ], 200);
        }

        return response()->json([
            'success' => false
        ], 422);
    }

    public function change(Request $request)
    {
        $validator = $this->validator($request->all());
        if(!$validator->fails()) {
            $ad = DB::table('ads')->where('id', $request->id)->update([
                'user_id' => $request->user()->id,
                'category' => $request->category,
                'country' => $request->country,
                'city' => $request->city,
                'title' => $request->title,
                'description' => $request->description
            ]);

            if($ad) {
                return response()->json([
                    'success' => true
                ], 200);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'changes' => ['No changes found']
                    ]
                ], 422);
            }
        }

        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'category' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);
    }
}
