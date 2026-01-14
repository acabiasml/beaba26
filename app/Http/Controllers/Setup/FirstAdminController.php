<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Person;

class FirstAdminController extends Controller
{
    public function create()
    {
        if (User::count() > 0) {
            abort(403);
        }

        return view('setup.create');
    }

    public function store(Request $request)
    {
        if (User::count() > 0) {
            abort(403);
        }

        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        // 1️⃣ Criar a pessoa
        $person = Person::create([
            'full_name' => $request->name,
        ]);

        // 2️⃣ Criar o usuário (conta)
        $user = User::create([
            'person_id'    => $person->id,
            'email'        => $request->email,
            'role'         => 'administrador',
            'password'     => bcrypt(Str::random(32)),
            'auth_provider'=> 'local',
            'archived'     => false,
        ]);

        Auth::login($user);

        return redirect('/');
    }

}
