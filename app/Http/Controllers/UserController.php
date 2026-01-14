<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'role'  => 'required',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'password'      => bcrypt(Str::random(32)),
            'auth_provider' => 'google',
            'archived'      => false,
        ]);

        return redirect('/')->with('success', 'Usuário cadastrado.');
    }
}
