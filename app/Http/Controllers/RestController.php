<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RestController extends Controller
{
    public function startRest()
    {
        $user = Auth::user();

        $restStart = Attendance::where('user_id',$user->id)->latest()->first();

        $timestamp = Rest::create([
            'attendance_id' => $restStart->id,
            'start_time' => Carbon::now(),
        ]);
        return redirect()->back()->with([
            'status' => '休憩開始です。',
            'rest_start' => true,
        ]);
    }

    public function endRest()
    {
        $user = Auth::user();
        $restEnd = Attendance::where('user_id', $user->id)->latest()->first();
        $timestamp = Rest::where('attendance_id',$restEnd->id)->latest()->first();
        
        $timestamp->update([
            'end_time' => Carbon::now()
        ]);

        return redirect('/')->with([
            'status' => '休憩終了です。',
            'rest_end' => true,
            ]);

        $timestamp = Rest::where('attendance_id',$user->id)->latest()->first();
    }
}