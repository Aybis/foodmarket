<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function checkIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|max:2048',
        ]);
        
        $image = $request->file('image')->store('assets/absensi/'.$request->user_id.'/'.date('Y-m-d'), 'public');
        
        //Insert data absensi
        Absensi::created([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'work' => $request->work,
            'check' => $request->check,
            'status' => $request->status,
            'detail_status' => $request->detail_status,
            'detail_check' => $request->detail_check,
            'ip_address' => $request->ip_address,
            'long' => $request->long,
            'lat' => $request->lat,
            'location' => $request->location,
            'image' => $image,
        ]);

       // Check update error
       if($validator->fails()) {
        return ResponseFormatter::error([
            'error' => $validator->errors()
        ], 'Insert photo fails', 401);
    }

    }

    public function checkOut(Request $request)
    {

    }
}
