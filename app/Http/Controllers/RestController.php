<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function startRest(Request $request)
    { 
        $user_id = Auth::id();
        $today = Carbon::today()->format('Y-m-d');
        $start_rest = Rest::where('attendance_id', $user_id)->where('date', $today)->value('start_time');
        $end_rest = Rest::where('attendance_id', $user_id)->where('date', $today)->value('end_time');

        if ($start_rest == null || $end_rest != null) { 
            Rest::create([
                'user_id' => Auth::id(),
                'date' => Carbon::today()->format('Y-m-d'),
                'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('/')->with('result', '休憩開始しました');
        } else {
            return redirect('/')->with('result', '休憩開始済みです');
        }
    }

    public function endRest(Request $request)
    { 
        $user_id = Auth::id();
        $today = Carbon::today()->format('Y-m-d');
        $rest_val = Rest::where('attendance_id', $user_id)->where('date', $today)->where('end_time', 0)->first();

        if ($rest_val == null) {

            return redirect('/')->with('result', '休憩中ではありません');
        } else {
            $start_rest = new Carbon($rest_val->work_day . ' ' . $rest_val->start_rest);
            $end_rest = Carbon::now()->format('Y-m-d H:i:s');
            $total_rest_time = $start_rest->diffInSeconds($end_rest);

            Rest::where('user_id', $user_id)->where('date', $today)->where('end_time', 0)->update([
                'user_id' => Auth::id(),
                'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('/')->with('result', '休憩終了しました');
        }
    }
}
