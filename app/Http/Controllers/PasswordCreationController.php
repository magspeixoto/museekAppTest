<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PasswordCreationController extends Controller
{
    public function update(User $user, Request $request)
{
    $request->validate([
        'password' => 'required|confirmed|min:8',
    ]);

    $user->password = bcrypt($request->password);
    $user->save();

    return redirect()->route('login')->with('status', 'Password created successfully!');
}
}

