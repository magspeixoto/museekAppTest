<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function index()
    {
        return inertia(
            'Users/Index',
            [
                'users' => User::all(),
            ]
        );
    }
    
    public function show(User $user)
    {
        return inertia(
            'Users/Show',
            [
                'user'=> $user
            ]
        );
    }
    public function create()
    {
        return inertia(
            'Users/Create',
        );
    }
    public function store(Request $request)
{
    User::create(
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required|min:1|max:20000',
            'role' => 'required|in:admin,editor',
        ])
        
        /* event(new Registered($user)); */
        );

        // Optionally, you can return a response or redirect
        return redirect()->route('user.index')->with('success', 'user was created!');
}

    public function edit(User $user)
    {
        return inertia('Users/Edit',[
            'user'=> $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update(
            $request->validate([
                'name' => 'required',
            'email' => 'required',
            'password'=> 'required|min:1|max:20000',
            
                ])
        );

        return redirect()->route('user.index')
            ->with('success', 'user was updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'user was deleted!');
    }
}
