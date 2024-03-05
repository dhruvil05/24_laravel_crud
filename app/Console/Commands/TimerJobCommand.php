<?php

namespace App\Console\Commands;

use App\Events\AttendancesEvent;
use App\Jobs\ProcessTimerJob;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TimerJobCommand extends Command
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clocking:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public $time;
    public $user_id;
    public $check_in;
    public $break;
    public $status;

    public function __construct($data=null)
    {   
        $date = date('Y-m-d');
        $attendance = Attendance::where('user_id', auth()->id())->where('date', $date)->latest('check_in')->first();
        $this->status = $attendance->status??0;
        $this->check_in = $attendance->check_in??date('H:i:s');
        $this->break = $attendance->break??date('H:i:s');
        parent::__construct($this);
    }

    public function timer($time){
        $time = explode(':', $time);

        $seconds=$time[2];
        $minutes=$time[1];
        $hours=$time[0];

        $seconds--;

        if($seconds==60){
            $minutes++;
            $seconds=0;
        }

        if($minutes==60){
            $hours++;
            $minutes=0;
        }

        if($hours==24){
            $hours=0;
            $minutes=0;
            $seconds=0;
        }
            
        $this->time = implode(':', $time);

        return $this->time;
        
    }

    public function handle()
    {
        // $this->data = $data;
        
        // dd($this->status);
            if($this->status == 1){
                $this->timer($this->check_in);
                event(new AttendancesEvent($this->time));
                info('Check in timer: '.$this->time);
            }elseif($this->status == 2){
                $this->timer($this->break);
                event(new AttendancesEvent($this->time));
                info('Break timer: '.$this->time);
            }elseif($this->status == 0){
                $this->timer($this->check_in);
                event(new AttendancesEvent($this->time));
                info('Break timer: '.$this->time);
            }else{
                info('stoped event');
            }
            // ProcessTimerJob::dispatch($this->data)
            return 0;
        
    }
}
