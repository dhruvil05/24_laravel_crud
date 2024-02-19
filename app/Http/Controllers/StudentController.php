<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){

        $states = State::all();

        return view('create', ['states'=> $states]);

    }

    public function store(Request $request){
        $validated = $request->validate([
            'firstName' =>  'required',
            'lastName' =>  'required',
            'gender' =>  'required',
            'address' =>  'required',
            'city' =>  'required',
            'state' =>  'required',
            'zip' =>  'required',
        ]);

        if($validated){

            $student = new Student();
            $student->first_name = $request->firstName;
            $student->last_name = $request->lastName;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->city = $request->city;
            $student->state = $request->state;
            $student->zip = $request->zip;

            if(!$student->save()){
                return redirect()->back()->with('error', 'Somthing went wrong. please, try again.');
            }

            return redirect()->route('dashboard')->with('Success', 'Data has been stored.');
        }
    }

    public function getStudentData($id){
        $student = Student::find($id)->first();
        $states = State::all();

        return view('update', ['student'=>$student, 'states'=> $states]);

    }

    public function update(Request $request){
        $validated = $request->validate([
            'studentId' => 'required',
            'firstName' =>  'required',
            'lastName' =>  'required',
            'gender' =>  'required',
            'address' =>  'required',
            'city' =>  'required',
            'state' =>  'required',
            'zip' =>  'required',
        ]);

        if($validated){

            $student = Student::find($request->studentId)->first();
            $student->first_name = $request->firstName;
            $student->last_name = $request->lastName;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->city = $request->city;
            $student->state = $request->state;
            $student->zip = $request->zip;

            if(!$student->save()){
                return redirect()->back()->with('error', 'Somthing went wrong. please, try again.');
            }

            return redirect()->route('dashboard')->with('Success', 'Data has been updated.');
        }
    }

    public function delete($id){
        $student = Student::find($id);

        if(!$student->delete()){
            return redirect()->back()->with('error', 'Somthing went wrong. please, try again.');
        }

        return redirect()->route('dashboard')->with('Success', 'Data has been successfully Deleted.');
    }
}
