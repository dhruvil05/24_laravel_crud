<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    
    public function index(){
        $checkInTime = Attendance::where('user_id', auth()->id())->first();
        return view('timer.timer', ['checkInTime'=> $checkInTime->check_in]);
    }

    public function checkIn(Request $request){
        $dt = Carbon::now();
        $date = $dt->toDateString();
        $time = $dt->format('H:i:s');

        $attendance = new Attendance();
        $attendance->user_id = auth()->id();
        $attendance->date = $request->date ?? $date;
        $attendance->check_in = $request->time ?? $time;
        
        if(!$attendance->save()){
            return response()->json(['message'=>'Check in failed, try again'], 500);
        }

        return response()->json(['message'=>'Check in successfull', 'time'=> $request->time], 200);

    }
}
