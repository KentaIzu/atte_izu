<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function getIndex()
    {
        $user = Auth::user();
        $date = Carbon::today();
        $timestamp = Attendance::where('user_id',$user->id)->latest()->first();
        if ($timestamp == null ){
            $timestamp = Attendance::create([
                'user_id' => $user->id,
            ]);
        }
        return view('index', ['user' => $user]);

        if ($timestamp->today != null) {
            $oldTimeStampStart = new Carbon($timestamp->start_time);

            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }

        $newTimeStampDay = Carbon::today();
        if ((isset($oldTimeStampDay) == $newTimeStampDay) && (empty($timestamp->end_time))) {
            return redirect()->back()->with('error', 'すでに出勤済みです。');
        }
        return view('index', ['user' => $user]);

        if ($timestamp->start_time != null && $date != date("Y-m-d", strtotime($timestamp->start_time)) && $timestamp->end_time == null) {
            $lastEndTime = $timestamp->end_time;
            $lastDateTime = $timestamp->start_time;
            $lastDate = date("Y-m-d", strtotime(($lastDateTime)));
            $nextdate = date("Y-m-d", strtotime($lastDateTime . "+1 day"));
            while ($lastEndTime == null && $lastDate != $date) {

            $timestamp->update([
                'end_time' => Carbon::parse($lastDateTime)->endOfDay(),
                'getRest' => '00:00:00'
            ]);
            }

        return view('index',['user'=>$user]);
        }
    }

    public function startAttendance(Request $request)
    {
        $user = Auth::user();
        $timeStamp = Attendance::where('user_id',$user->id)->latest()->first();
        if($timeStamp){
            $oldTimeStampStart = new Carbon($timeStamp->start_time);

            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }

        $newTimeStampDay = Carbon::today();

        $timeStamp = Attendance::create([
            'user_id' => $user->id,
            'start_time' => Carbon::now(),
            'date' => Carbon::today()
        ]);
            return redirect()->back()->with([
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

            return redirect()->back()->with([
            'end_time' => true,
        ]);
    }

    public function getAttendance(Request $request)
    {
        if ($request->page) {
        $date = $request->date; 
        } else {
            $date = Carbon::today()->format("Y-m-d");
        }
        $user = Auth::user();
        $user_id = Auth::id();
        $date = Carbon::today()->format("Y-m-d");

        $nowdate = $request->input('today');
        $dayflg = $request->input('dayflg');

        if ($dayflg == "next") {
            $date = date("Y-m-d", strtotime($nowdate . "+1 day"));
        } else if ($dayflg == "back") {
            $date = date("Y-m-d", strtotime($nowdate . "-1 day"));
        }

        $attendance = Attendance::where('user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id',$attendance->id)->latest()->first();
        $items = Attendance::whereDate('start_time', $date)->paginate(5);
        $items->appends(compact('date'));
        return view('attendance',['today'=>$date,'items'=>$items]);
    }

    public function getUserList(){
        $items = User::Paginate(10);
        return view('userList',['items'=>$items]);
    }

    public function getUserAttendance(){
        $date = Carbon::today()->format("Y-m-d");

        $user = Auth::user();
        $user_id = Auth::id();

        $nowdate = $request->input('today');
        $dayflg = $request->input('dayflg');

        if ($dayflg == "next") {
            $date = date("Y-m-d", strtotime($nowdate . "+1 day"));
        } else if ($dayflg == "back") {
            $date = date("Y-m-d", strtotime($nowdate . "-1 day"));
        }
        $attendance = Attendance::where('user_id', $user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id', $attendance->id)->latest()->first();

        $items = Attendance::whereDate('start_time', $date)->where('user_id', $user_id)->paginate(5);
        $items->appends(compact('date'));

        return view('userAttendance', ['today' => $date, 'items' => $items]);
    }
}