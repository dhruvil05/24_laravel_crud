<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $students = Student::all();

        foreach($students as $student){
            $state = State::where('id', (int)$student->state)->first('name');

            $student->state = $state->name;
        }
        

        return view('dashboard', ['students'=> $students]);
    }
}
