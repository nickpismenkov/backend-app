<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AllController extends Controller
{
    public static function index($country = null, $city = null)
    {
        if($country != null && $city != null){
            $data = DB::table('ads')->where('country', $country)->where('city', $city)->get();
        } else if ($country != null){
            $data = DB::table('ads')->where('country', $country)->get();
        } else {
            $data = DB::table('ads')->get();
        }

        if($data != '[]'){
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        }

        return response()->json([
            'success' => false,
            'errors' => [
                'No ads'
            ]
        ], 200);
    }
}
