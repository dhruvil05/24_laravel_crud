<?php

namespace App\Http\Controllers;

use App\Console\Commands\TimerJobCommand;
use App\Events\AttendancesEvent;
use App\Jobs\ProcessTimerJob;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{   
    protected $dateTime;
    protected $currentDate;
    protected $currentTime;
    protected $timeSeconds;

    public function __construct()
    {
        $this->dateTime = Carbon::now();
        $this->currentDate = $this->dateTime->toDateString();
        $this->currentTime = $this->dateTime->format('H:i:s');
        $this->timeSeconds = strtotime($this->currentTime);
    }
    
    public function index(){
        $checkInTime = Attendance::where('user_id', auth()->id())->where('date', $this->currentDate)->latest('check_in')->first();

        return view('timer.timer', ['checkInTime'=> $checkInTime->check_in??'00:00:00']);
    }

    public function clocking(Request $request){

        $attendance = new Attendance();
        $attendance->where('user_id', auth()->id())->where('date', $request->date)->latest('check_in')->first();
        if(isset($request->status)){
            
            // Check-in 
            if($request->status == 1 ){
                
                if($attendance->count() > 1){

                    $attendance = Attendance::where('user_id', auth()->id())->latest('check_in')->first();
                    $attendance->check_in = $request->time ?? $this->currentTime;
                    $attendance->status = 1;
                    
                    if($attendance->save()){
                        return response()->json(['success'=>'Check in successfully.'], 200);
                    }
                }else{
                    $attendance = new Attendance();
                    $attendance->user_id = auth()->id();
                    $attendance->date = $request->date ?? $this->currentDate;
                    $attendance->check_in = $request->time ?? $this->currentTime;
                    $attendance->status = 1;
                    
                }
                // real time clocking command
                $data = Array('user_id'=>auth()->id(), 'check_in'=>$attendance->check_in, 'status'=>0);
                TimerJobCommand::dispatch($data);
                event(new AttendancesEvent($data));

                if($attendance->save()){
                    return response()->json(['success'=>'Check in successfully.'], 200);
                }

            }

            // Break or stop
            if($request->status == 2 ){

                if($attendance->count() > 1){

                    $attendance = Attendance::where('user_id', auth()->id())->latest('check_in')->first();
                    $attendance->check_in = $request->time ?? $this->currentTime;
                    $attendance->status = 2;
                    if($attendance->save()){
                        return response()->json(['success'=>'Break added successfully.'], 200);
                    }
                }else{
                    $data = Array('user_id'=>auth()->id(), 'check_in'=>$attendance->check_in, 'status'=>1);
                    TimerJobCommand::dispatch($data);
                    event(new AttendancesEvent($data));
                    // dd($request->all());

                }

            }

            // Check-out or Reset
            if($request->status == 3 ){

                if($attendance->count() > 1){

                    $attendance = Attendance::where('user_id', auth()->id())->latest('check_in')->first();
                    $attendance->check_in = $request->time ?? $this->currentTime;
                    $attendance->status = 3;
                    if($attendance->save()){
                        return response()->json(['success'=>'Check Out successfully.'], 200);
                    }

                }else{
                    dd($request->all());

                }

            }
        }else{
            return response()->json(['error'=>'Somthing went wrong, try again.'], 500);
        }

        

        

        // return response()->json(['message'=>'Check in successfull', 'time'=> $request->time], 200);

    }
}
