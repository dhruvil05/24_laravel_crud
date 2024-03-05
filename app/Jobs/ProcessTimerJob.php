<?php

namespace App\Jobs;

use App\Events\AttendancesEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTimerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
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
            
        $time = implode(':', $time);

        return $time;
        
    }
    
    public function handle(): void
    {
        $checkInData = $this->data;
        
        $this->data = $this->timer($this->data['check_in']);
        event(new AttendancesEvent($this->data));

        
    }
}
