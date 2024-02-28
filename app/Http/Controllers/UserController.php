<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('user.users', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('user.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|string|min:6',
            'roles'=> 'required|array'
        ]);

        $user = User::create($request->all());

        $user->roles()->attach($request->input('roles'));

        $data = ['name'=>$user->name, 'roles'=>$user->roles, 'email'=>$user->email];
        event(new UserCreated($data));

        return redirect()->route('users')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, $id)
    {
        $user = $user->find($id);
        return view('user.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $roles = Role::all();
        $user = $user->find($id);
    
        return view('user.update', ['roles'=>$roles, 'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> "required|email|unique:users,email,$id",
            'roles'=> 'required|array',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {   
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully!');

    }
}
