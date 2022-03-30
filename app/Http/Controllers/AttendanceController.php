<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function getIndex(Request $request)
    {
        $attendance_start= true;
        $attendance_end = true;
        $rest = true;
        $attendance = Attendance::getAttendance();
        if(empty($attendance)) {
            return view('index');
        }
        $rest = $attendance->rests->whereNull("end_time")->first();
        if ($attendance->end_time) {
            return view('index')->with([
                "attendance_start" => true,
                "attendance_end" => true,
            ]);
        }
        if ($attendance->start_time) {
            if (isset($rest)) {
                return view('index')->with([
                    "rest" => true,
                    "attendance_start" => true,
                ]);
            } else {
                return view('index')->with([
                    "rest" => false,
                    "attendance_start" => true,
                ]);
            }
        }
    }

    public function startAttendance(Request $request)
    {
        $user = Auth::user();
        $timeStamp = Attendance::where('user_id',$user->id)->latest()->first();
        if($timeStamp){
            $oldTimeStampStart = new Carbon($timeStamp->begin_time);
            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }
        $newTimeStampDay = Carbon::today();
        $timeStamp = Attendance::create([
            'user_id' => $user->id,
            'begin_time' => Carbon::now(),
            'date' => Carbon::today()
        ]);
            return redirect('/')->back()->with([
                'start_time' => true,
            ]);   
    }

    public function endAttendance(Request $request)
    {
        $user = Auth::user();
        $timestamp = Attendance::where('user_id', $user->id)->latest()->first();

            $timestamp->update([
                'end_time' => Carbon::now()
            ]);

            return redirect('/')->back()->with([
            'end_time' => true,
        ]);
    }

    public function getAttendance(Request $request)
    {
        $num = (int)$request->num;
        $dt = new Carbon();
        if ($num == 0) {
            $date = $dt;
        } elseif ($num > 0) {
            $date = $dt->addDays($num);
        } else {
            $date = $dt->subDays(-$num);
        }
        $fixed_date = $date->toDateString();
        $attendances = Attendance::where('date', $fixed_date)->paginate(5); 
        $adjustAttendances = Attendance::adjustAttendance($attendances);
        return view('attendance', compact("adjustAttendances", "num", "fixed_date"));
    }
}